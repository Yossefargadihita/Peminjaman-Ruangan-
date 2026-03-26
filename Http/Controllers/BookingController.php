<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create(Room $room)
    {
        $user = Auth::user();

        // Hanya umum atau kategorial yang bisa booking
        if (!in_array($user->role, ['umum', 'kategorial'])) {
            abort(403, 'Anda tidak memiliki izin untuk memesan ruangan.');
        }

        // Umum = sewa, Kategorial = pinjam
        $type = $user->role === 'umum' ? 'sewa' : 'pinjam';

        // Cek apakah ruangan tersedia
        if ($room->status !== 'tersedia') {
            return redirect()->route('rooms.index')->with('error', 'Ruangan tidak tersedia.');
        }

        return view('bookings.create', compact('room', 'type'));
    }

    public function store(Request $request, Room $room)
    {
        $user = Auth::user();

        // Batasi hanya untuk role 'umum' dan 'kategorial'
        if (!in_array($user->role, ['umum', 'kategorial'])) {
            abort(403, 'Anda tidak memiliki izin untuk membuat pemesanan.');
        }

        // Validasi inputan user
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'keterangan' => 'nullable|string',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'jumlah_peserta' => 'required|integer|min:1',
        ]);

        // Cegah booking jika ruangan tidak tersedia
        if ($room->status !== 'tersedia') {
            return redirect()->route('rooms.index')->with('error', 'Ruangan tidak tersedia untuk dipesan.');
        }

        // Tetapkan jenis booking dan status pembayaran
        $type = $user->role === 'umum' ? 'sewa' : 'pinjam';

        // Buat data booking
        $booking = Booking::create([
            'user_id' => $user->id,
            'room_id' => $room->id,
            'type' => $type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'keterangan' => $request->keterangan,
            'is_paid' => false,
            'is_finished' => false,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'jumlah_peserta' => $request->jumlah_peserta,
        ]);

        // Update status ruangan menjadi 'dipakai'
        $room->status = 'dipakai';
        $room->save();

        if ($user->role === 'umum') {
            return redirect()->route('bookings.invoice', $booking->id)
                ->with('success', 'Pemesanan berhasil. Silakan lihat invoice Anda.');
        }

        return redirect()->route('dashboard')->with('success', 'Peminjaman berhasil.');
    }

    public function invoice(Booking $booking)
    {
        $user = Auth::user();

        if ($user->id != $booking->user_id || $booking->type != 'sewa') {
            abort(403, 'Anda tidak memiliki akses ke invoice ini.');
        }

        $room = $booking->room;
        $start = \Carbon\Carbon::parse($booking->start_date);
        $end = \Carbon\Carbon::parse($booking->end_date);

        $duration = $start->diffInDays($end) + 1; // Tambahkan 1 agar inklusif
        $totalPrice = $room->rental_price * $duration;

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;


        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-000' . $booking->id,
                'gross_amount' => $totalPrice,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
                'phone' => $booking->no_hp,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('bookings.invoice', compact('booking', 'duration', 'totalPrice', 'snapToken'));
    }

    public function pay(Booking $booking)
    {
        $user = Auth::user();

        if ($user->id != $booking->user_id || $booking->type != 'sewa') {
            abort(403, 'Anda tidak dapat membayar pesanan ini.');
        }

        $booking->is_paid = true;
        $booking->save();

        return redirect()->route('bookings.index')
            ->with('success', 'Pembayaran berhasil!');
    }

    public function index()
    {
        $user = Auth::user();

        // Jika user umum atau kategorial, tampilkan hanya booking miliknya
        if (in_array($user->role, ['umum', 'kategorial'])) {
            $bookings = Booking::with('room', 'user')
                ->where('user_id', $user->id)
                ->orderByDesc('created_at')
                ->get();
        } else {
            // Admin bisa melihat semua booking
            $bookings = Booking::with('room', 'user')
                ->orderByDesc('created_at')
                ->get();
        }

        return view('bookings.index', compact('bookings'));
    }

    public function finish(Booking $booking)
    {
        $user = Auth::user();

        // Hanya admin atau user yang membuat booking yang bisa menyelesaikan
        if ($user->id !== $booking->user_id && $user->role !== 'admin') {
            abort(403, 'Anda tidak memiliki izin untuk menyelesaikan booking ini.');
        }

        // Cegah jika sudah selesai
        if ($booking->is_finished) {
            return back()->with('info', 'Booking sudah selesai.');
        }

        // Tandai booking sebagai selesai
        $booking->is_finished = true;
        $booking->save();

        // Ubah status ruangan jadi tersedia
        $booking->room->status = 'tersedia';
        $booking->room->save();

        return back()->with('success', 'Booking telah diselesaikan dan ruangan tersedia kembali.');
    }
}
