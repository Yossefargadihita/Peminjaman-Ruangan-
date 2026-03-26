@extends('layouts.app')
@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-edit me-2"></i>Edit Ruangan
                        </h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Terdapat kesalahan:</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('rooms.update', $room->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label fw-bold">
                                            <i class="fas fa-door-open me-1"></i>Nama Ruangan
                                        </label>
                                        <input type="text" name="name" id="name"
                                            class="form-control form-control-lg" value="{{ $room->name }}" required
                                            placeholder="Masukkan nama ruangan">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="floor" class="form-label fw-bold">
                                            <i class="fas fa-building me-1"></i>Lantai
                                        </label>
                                        <input type="text" name="floor" id="floor"
                                            class="form-control form-control-lg" value="{{ $room->floor }}" required
                                            placeholder="Masukkan lantai">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="rental_price" class="form-label fw-bold">
                                            <i class="fas fa-money-bill-wave me-1"></i>Harga Sewa Per Hari
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="number" name="rental_price" id="rental_price"
                                                class="form-control form-control-lg" value="{{ $room->rental_price }}"
                                                required placeholder="0">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="status" class="form-label fw-bold">
                                            <i class="fas fa-info-circle me-1"></i>Status
                                        </label>
                                        <select name="status" id="status" class="form-select form-select-lg" required>
                                            <option value="tersedia" {{ $room->status === 'tersedia' ? 'selected' : '' }}>
                                                <i class="fas fa-check-circle"></i> Tersedia
                                            </option>
                                            <option value="dipakai" {{ $room->status === 'dipakai' ? 'selected' : '' }}>
                                                <i class="fas fa-user"></i> Dipakai
                                            </option>
                                            <option value="rusak" {{ $room->status === 'rusak' ? 'selected' : '' }}>
                                                <i class="fas fa-exclamation-triangle"></i> Rusak
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-label fw-bold">
                                    <i class="fas fa-align-left me-1"></i>Deskripsi
                                </label>
                                <textarea name="description" id="description" class="form-control" rows="4"
                                    placeholder="Masukkan deskripsi ruangan...">{{ $room->description }}</textarea>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold mb-3">
                                    <i class="fas fa-tools me-1"></i>Peralatan
                                </label>
                                <div class="card">
                                    <div class="card-body">
                                        @if (count($items) > 0)
                                            <div class="row">
                                                @foreach ($items as $item)
                                                    <div class="col-md-6 mb-3">
                                                        <div class="input-group">
                                                            <input type="number" name="items[{{ $item->id }}]"
                                                                class="form-control" placeholder="Jumlah" min="0"
                                                                value="{{ $room->items->find($item->id)?->pivot->quantity ?? '' }}">
                                                            <span class="input-group-text bg-light">
                                                                <i class="fas fa-cube me-1"></i>{{ $item->name }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="text-center text-muted py-3">
                                                <i class="fas fa-inbox fa-2x mb-2"></i>
                                                <p>Tidak ada peralatan yang tersedia</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-2 justify-content-end">
                                <a href="{{ route('rooms.index') }}" class="btn btn-secondary btn-lg">
                                    <i class="fas fa-times me-1"></i>Batal
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-save me-1"></i>Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .form-control:focus,
        .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .card {
            border: none;
            border-radius: 10px;
        }

        .card-header {
            border-radius: 10px 10px 0 0 !important;
        }

        .input-group-text {
            font-weight: 500;
        }

        .btn-lg {
            padding: 0.75rem 1.5rem;
            font-size: 1.1rem;
        }

        .alert {
            border-radius: 8px;
        }

        .form-label {
            margin-bottom: 0.75rem;
            color: #495057;
        }

        .form-control,
        .form-select {
            border-radius: 6px;
        }

        .shadow-sm {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
        }
    </style>
@endsection
