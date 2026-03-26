@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold text-primary mb-0">
                        <i class="fas fa-door-open me-2"></i>Daftar Ruangan
                    </h2>
                    <div class="text-muted">
                        <i class="fas fa-list me-1"></i>{{ $rooms->count() }} ruangan tersedia
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="row">
                    @forelse ($rooms as $room)
                        <div class="col-lg-6 col-xl-4 mb-4">
                            <div class="card h-100 shadow-sm border-0 room-card">
                                <div class="card-header bg-primary text-white py-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title mb-0 fw-bold">
                                            <i class="fas fa-door-closed me-2"></i>{{ $room->name }}
                                        </h5>
                                        @if ($room->status === 'tersedia')
                                            <span class="badge bg-success fs-6">
                                                <i class="fas fa-check me-1"></i>Tersedia
                                            </span>
                                        @else
                                            <span class="badge bg-secondary fs-6">
                                                <i class="fas fa-times me-1"></i>{{ ucfirst($room->status) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="card-body p-4">
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center text-muted mb-2">
                                            <i class="fas fa-building me-2 text-primary"></i>
                                            <strong>Lantai:</strong>
                                            <span class="ms-2 badge bg-light text-dark">{{ $room->floor }}</span>
                                        </div>
                                    </div>

                                    {{-- Daftar peralatan --}}
                                    @if ($room->items->count())
                                        <div class="mb-3">
                                            <h6 class="text-primary mb-2">
                                                <i class="fas fa-tools me-2"></i>Peralatan:
                                            </h6>
                                            <div class="equipment-list">
                                                @foreach ($room->items as $item)
                                                    <span class="badge bg-light text-dark me-1 mb-1 p-2">
                                                        <i class="fas fa-cube me-1"></i>{{ $item->name }}
                                                        <span
                                                            class="text-primary fw-bold">({{ $item->pivot->quantity }})</span>
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <div class="text-muted mb-3">
                                            <i class="fas fa-info-circle me-2"></i>Tidak ada item tersedia
                                        </div>
                                    @endif
                                </div>

                                {{-- Tombol aksi --}}
                                @auth
                                    @php
                                        $role = auth()->user()->role;
                                    @endphp

                                    @if ($room->status === 'tersedia')
                                        <div class="card-footer bg-transparent border-0 pt-0">
                                            @if ($role === 'umum')
                                                <a href="{{ route('bookings.create', $room->id) }}"
                                                    class="btn btn-primary btn-lg w-100 fw-bold">
                                                    <i class="fas fa-shopping-cart me-2"></i>Sewa Ruangan
                                                </a>
                                            @elseif ($role === 'kategorial')
                                                <a href="{{ route('bookings.create', $room->id) }}"
                                                    class="btn btn-warning btn-lg w-100 fw-bold">
                                                    <i class="fas fa-handshake me-2"></i>Pinjam Ruangan
                                                </a>
                                            @endif
                                        </div>
                                    @else
                                        <div class="card-footer bg-transparent border-0 pt-0">
                                            <button class="btn btn-secondary btn-lg w-100" disabled>
                                                <i class="fas fa-lock me-2"></i>Tidak Tersedia
                                            </button>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info text-center py-5 shadow-sm">
                                <i class="fas fa-info-circle fa-3x text-info mb-3"></i>
                                <h4 class="mb-2">Belum ada ruangan</h4>
                                <p class="mb-0 text-muted">Saat ini belum ada ruangan yang tersedia dalam sistem.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <style>
        .room-card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .room-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
        }

        .equipment-list {
            max-height: 120px;
            overflow-y: auto;
        }

        .equipment-list::-webkit-scrollbar {
            width: 4px;
        }

        .equipment-list::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .equipment-list::-webkit-scrollbar-thumb {
            background: #007bff;
            border-radius: 10px;
        }

        .equipment-list::-webkit-scrollbar-thumb:hover {
            background: #0056b3;
        }
    </style>
@endsection
