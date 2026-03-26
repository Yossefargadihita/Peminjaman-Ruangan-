<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Item;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Hanya admin yang dapat mengakses halaman ini.');
        }

        $rooms = Room::with('items')->get();
        return view('rooms.index', compact('rooms'));
    }

    public function indexDashboard()
    {
        $rooms = Room::with('items')->get();
        return view('dashboard', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = Item::all();
        return view('rooms.create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'floor' => 'required',
            'status' => 'required',
            'rental_price' => 'required|numeric|min:0',
        ]);

        $room = Room::create($request->only('name', 'description', 'floor', 'status', 'rental_price'));

        $items = $request->input('items', []);
        foreach ($items as $itemId => $qty) {
            if ($qty > 0) {
                $room->items()->attach($itemId, ['quantity' => $qty]);
            }
        }

        return redirect()->route('rooms.index')->with('success', 'Ruangan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $room = Room::with('items')->findOrFail($id);
        $items = Item::all();

        return view('rooms.edit', compact('room', 'items'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'floor' => 'required',
            'status' => 'required|in:tersedia,dipakai,rusak',
            'rental_price' => 'required|numeric|min:0',
        ]);

        $room = Room::findOrFail($id);
        $room->update($request->only('name', 'description', 'floor', 'status', 'rental_price'));

        // Sync ulang item jika ada
        $items = $request->input('items', []);
        $syncData = [];

        foreach ($items as $itemId => $qty) {
            if ($qty > 0) {
                $syncData[$itemId] = ['quantity' => $qty];
            }
        }

        $room->items()->sync($syncData);

        return redirect()->route('rooms.index')->with('success', 'Ruangan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
