@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="text-dark fw-bold mb-0">Daftar Pemesanan Ruangan</h2>
                    <div class="text-muted">
                        <small>Total: {{ count($bookings) }} pemesanan</small>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="mb-0 text-muted">Daftar Pemesanan</h6>
                            </div>
                            <div class="col-auto">
                                <div class="btn-group" role="group">
                                    <input type="radio" class="btn-check" name="filter" id="all" checked>
                                    <label class="btn btn-outline-primary btn-sm" for="all">Semua</label>

                                    <input type="radio" class="btn-check" name="filter" id="active">
                                    <label class="btn btn-outline-primary btn-sm" for="active">Aktif</label>

                                    <input type="radio" class="btn-check" name="filter" id="finished">
                                    <label class="btn btn-outline-primary btn-sm" for="finished">Selesai</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="py-3 px-4">Ruangan</th>
                                        <th class="py-3 px-4">Pemesan</th>
                                        <th class="py-3 px-4">Jenis</th>
                                        <th class="py-3 px-4">Tanggal</th>
                                        <th class="py-3 px-4">No. HP</th>
                                        <th class="py-3 px-4">Alamat</th>
                                        <th class="py-3 px-4">Peserta</th>
                                        <th class="py-3 px-4">Total Harga</th>
                                        <th class="py-3 px-4">Pembayaran</th>
                                        <th class="py-3 px-4">Status</th>
                                        <th class="py-3 px-4 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($bookings as $booking)
                                        <tr class="booking-row"
                                            data-status="{{ $booking->is_finished ? 'finished' : 'active' }}">
                                            <td class="px-4 py-3">
                                                <strong>{{ $booking->room->name }}</strong><br>
                                            </td>
                                            <td class="px-4 py-3">
                                                <strong>{{ $booking->user->name }}</strong><br>
                                            </td>
                                            <td class="px-4 py-3">
                                                <span
                                                    class="badge {{ $booking->type === 'sewa' ? 'bg-warning' : 'bg-info' }} text-white">
                                                    {{ ucfirst($booking->type) }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3">
                                                <strong>{{ \Carbon\Carbon::parse($booking->start_date)->format('d M Y') }}</strong><br>
                                                <small class="text-muted">s.d
                                                    {{ \Carbon\Carbon::parse($booking->end_date)->format('d M Y') }}</small>
                                            </td>
                                            <td class="px-4 py-3">{{ $booking->no_hp }}</td>
                                            <td class="px-4 py-3">{{ $booking->alamat }}</td>
                                            <td class="px-4 py-3">{{ $booking->jumlah_peserta }}</td>
                                            <td class="px-4 py-3">
                                                @if ($booking->type === 'sewa')
                                                    @php
                                                        $start = \Carbon\Carbon::parse($booking->start_date);
                                                        $end = \Carbon\Carbon::parse($booking->end_date);
                                                        $duration = $start->diffInDays($end) + 1;
                                                        $total = $duration * $booking->room->rental_price;
                                                    @endphp
                                                    Rp{{ number_format($total, 0, ',', '.') }}
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>

                                            <td class="px-4 py-3">
                                                @if ($booking->type === 'sewa')
                                                    @if ($booking->is_paid)
                                                        <span class="badge bg-success">Sudah Bayar</span>
                                                    @else
                                                        <span class="badge bg-danger">Belum Bayar</span>
                                                    @endif
                                                @else
                                                    <span class="badge bg-secondary">Tidak Perlu</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3">
                                                @if ($booking->is_finished)
                                                    <span class="badge bg-success">Selesai</span>
                                                @else
                                                    <span class="badge bg-warning">Aktif</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 text-center">
                                                @if (auth()->id() === $booking->user_id)
                                                    @if ($booking->type === 'sewa' && !$booking->is_paid)
                                                        <a href="{{ route('bookings.invoice', $booking->id) }}"
                                                            class="btn btn-success btn-sm">
                                                            Bayar
                                                        </a>
                                                    @elseif (!$booking->is_finished || auth()->user()->role === 'admin')
                                                        <form action="{{ route('bookings.finish', $booking->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Selesaikan booking dan kembalikan ruangan?')"
                                                            class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-primary btn-sm">
                                                                Selesai
                                                            </button>
                                                        </form>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                @elseif(auth()->user()->role === 'admin' && !$booking->is_finished)
                                                    <form action="{{ route('bookings.finish', $booking->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Selesaikan booking dan kembalikan ruangan?')"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-primary btn-sm">
                                                            Selesai
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="11" class="text-center py-5">
                                                <div class="text-muted">
                                                    <p class="mb-0">Tidak ada data pemesanan</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if (count($bookings) > 0)
                        <div class="card-footer bg-white py-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <small class="text-muted">
                                        Menampilkan {{ count($bookings) }} dari {{ count($bookings) }} pemesanan
                                    </small>
                                </div>
                                {{-- <div class="col-auto">
                                    <div class="d-flex gap-2">
                                        <span
                                            class="badge bg-warning bg-opacity-15 text-warning border border-warning border-opacity-25">
                                            <i class="fas fa-clock me-1"></i>
                                            {{ $bookings->where('is_finished', false)->count() }} Aktif
                                        </span>
                                        <span
                                            class="badge bg-success bg-opacity-15 text-success border border-success border-opacity-25">
                                            <i class="fas fa-check-circle me-1"></i>
                                            {{ $bookings->where('is_finished', true)->count() }} Selesai
                                        </span>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        // Filter functionality
        document.querySelectorAll('input[name="filter"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const filterValue = this.id;
                const rows = document.querySelectorAll('.booking-row');

                rows.forEach(row => {
                    if (filterValue === 'all') {
                        row.style.display = '';
                    } else {
                        const status = row.getAttribute('data-status');
                        row.style.display = status === filterValue ? '' : 'none';
                    }
                });
            });
        });
    </script>
@endsection
