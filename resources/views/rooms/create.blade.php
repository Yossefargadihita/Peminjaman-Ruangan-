@extends('layouts.app')
@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-plus-circle me-2"></i>
                            Tambah Ruangan Baru
                        </h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Terjadi kesalahan!</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('rooms.store') }}" method="POST">
                            @csrf

                            <!-- Nama Ruangan -->
                            <div class="mb-4">
                                <label for="name" class="form-label fw-bold">
                                    <i class="fas fa-door-open me-1"></i>
                                    Nama Ruangan
                                </label>
                                <input type="text" name="name" id="name" class="form-control form-control-lg"
                                    placeholder="Masukkan nama ruangan" required>
                            </div>

                            <!-- Pemilihan Lantai -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-building me-1"></i>
                                    Pemilihan Lantai
                                </label>
                                <div class="mt-2">
                                    <div class="form-check form-check-inline me-4">
                                        <input class="form-check-input" type="radio" name="floor" id="floor2"
                                            value="Lantai 2" required>
                                        <label class="form-check-label" for="floor2">
                                            <i class="fas fa-layer-group me-1"></i>
                                            Lantai 2
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="floor" id="floor3"
                                            value="Lantai 3">
                                        <label class="form-check-label" for="floor3">
                                            <i class="fas fa-layer-group me-1"></i>
                                            Lantai 3
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Harga Sewa -->
                            <div class="mb-4">
                                <label for="rental_price" class="form-label fw-bold">
                                    <i class="fas fa-money-bill-wave me-1"></i>
                                    Harga Sewa Per Hari
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" step="0.01" name="rental_price" id="rental_price"
                                        class="form-control" placeholder="0.00" required>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="mb-4">
                                <label for="status" class="form-label fw-bold">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Status
                                </label>
                                <select name="status" id="status" class="form-select" required>
                                    <option value="" disabled selected>Pilih status ruangan</option>
                                    <option value="tersedia">
                                        <i class="fas fa-check-circle"></i>
                                        Tersedia
                                    </option>
                                    <option value="dipakai">
                                        <i class="fas fa-user"></i>
                                        Dipakai
                                    </option>
                                    <option value="rusak">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        Rusak
                                    </option>
                                </select>
                            </div>

                            <!-- Deskripsi -->
                            <div class="mb-4">
                                <label for="description" class="form-label fw-bold">
                                    <i class="fas fa-file-text me-1"></i>
                                    Deskripsi
                                    <span class="text-muted fw-normal">(opsional)</span>
                                </label>
                                <textarea name="description" id="description" class="form-control" rows="4"
                                    placeholder="Masukkan deskripsi ruangan..."></textarea>
                            </div>

                            <!-- Peralatan -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-tools me-1"></i>
                                    Peralatan yang Tersedia
                                </label>
                                <div class="row">
                                    @foreach ($items as $item)
                                        <div class="col-md-6 mb-3">
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">
                                                    <i class="fas fa-cube me-1"></i>
                                                    {{ $item->name }}
                                                </span>
                                                <input type="number" name="items[{{ $item->id }}]" class="form-control"
                                                    min="0" placeholder="Jumlah">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-between pt-3 border-top">
                                <a href="{{ route('rooms.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-1"></i>
                                    Kembali
                                </a>
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fas fa-save me-1"></i>
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card {
            border: none;
            border-radius: 12px;
        }

        .card-header {
            border-radius: 12px 12px 0 0 !important;
            border-bottom: none;
            padding: 1.5rem;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            padding: 0.75rem;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .form-control-lg {
            padding: 1rem;
            font-size: 1.1rem;
        }

        .form-check-input:checked {
            background-color: #007bff;
            border-color: #007bff;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #e0e0e0;
            border-radius: 8px 0 0 8px;
        }

        .btn {
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
        }

        .btn-outline-secondary {
            border: 2px solid #6c757d;
        }

        .btn-outline-secondary:hover {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .alert-danger {
            border-radius: 8px;
            border: none;
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        }

        .form-label {
            color: #495057;
            margin-bottom: 0.5rem;
        }

        .shadow-sm {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
        }

        .border-top {
            border-color: #e9ecef !important;
        }

        .row .col-md-6:nth-child(odd) .input-group-text {
            background-color: #e3f2fd;
        }

        .row .col-md-6:nth-child(even) .input-group-text {
            background-color: #f3e5f5;
        }
    </style>
@endsection
