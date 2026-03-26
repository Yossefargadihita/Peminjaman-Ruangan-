@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-warning text-dark">
                        <h4 class="mb-0">
                            <i class="fas fa-edit me-2"></i>
                            Edit Peralatan
                        </h4>
                    </div>
                    <div class="card-body">
                        <!-- Alert Success -->
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Alert Error -->
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Terjadi kesalahan:</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Info Card -->
                        <div class="alert alert-info d-flex align-items-center mb-4" role="alert">
                            <i class="fas fa-info-circle me-2"></i>
                            <div>
                                Anda sedang mengedit peralatan: <strong>{{ $item->name }}</strong>
                            </div>
                        </div>

                        <form action="{{ route('items.update', $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="name" class="form-label fw-bold">
                                    <i class="fas fa-tag me-1"></i>
                                    Nama Peralatan <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="name" id="name"
                                    class="form-control form-control-lg @error('name') is-invalid @enderror"
                                    placeholder="Contoh: Proyektor Epson EB-X41" value="{{ old('name', $item->name) }}"
                                    required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Masukkan nama peralatan yang jelas dan mudah diidentifikasi
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-label fw-bold">
                                    <i class="fas fa-align-left me-1"></i>
                                    Deskripsi
                                </label>
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                    rows="4"
                                    placeholder="Contoh: Proyektor LCD dengan resolusi XGA (1024x768), brightness 3600 lumens, dilengkapi dengan kabel HDMI dan VGA. Kondisi baik, tahun pembelian 2023.">{{ old('description', $item->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-lightbulb me-1"></i>
                                    Opsional: Tambahkan informasi seperti merk, spesifikasi, kondisi, atau catatan penting
                                    lainnya
                                </div>
                            </div>

                            <!-- Button Actions -->
                            <div class="mt-4">
                                <div class="d-flex flex-wrap gap-3 justify-content-between align-items-center">
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('items.show', $item->id) }}"
                                            class="btn btn-outline-secondary btn-lg">
                                            <i class="fas fa-eye me-2"></i>
                                            Lihat Detail
                                        </a>
                                        <a href="{{ route('items.index') }}" class="btn btn-outline-dark btn-lg">
                                            <i class="fas fa-list me-2"></i>
                                            Ke Daftar
                                        </a>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-secondary btn-lg" onclick="resetForm()">
                                            <i class="fas fa-undo me-2"></i>
                                            Reset
                                        </button>
                                        <button type="submit" class="btn btn-warning btn-lg">
                                            <i class="fas fa-save me-2"></i>
                                            Update Peralatan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Card Informasi Tambahan -->
                <div class="card mt-4 shadow-sm">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">
                            <i class="fas fa-clock me-2"></i>
                            Informasi Peralatan
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <small class="text-muted">Dibuat pada:</small>
                                <p class="mb-2">{{ $item->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted">Terakhir diubah:</small>
                                <p class="mb-2">{{ $item->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .card {
            border-radius: 10px;
            border: none;
        }

        .card-header {
            border-radius: 10px 10px 0 0 !important;
        }

        .bg-warning {
            background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%) !important;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #dee2e6;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #ffc107;
            box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
            transform: translateY(-1px);
        }

        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .form-control.is-invalid:focus {
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }

        .form-control-lg {
            padding: 12px 16px;
            font-size: 1.1rem;
        }

        .btn {
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .btn-warning {
            background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
            border: none;
            color: #212529;
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #e0a800 0%, #cc9a00 100%);
            color: #212529;
        }

        .alert {
            border-radius: 8px;
            border: none;
        }

        .form-text {
            font-size: 0.875rem;
            color: #6c757d;
        }

        .shadow-sm {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
        }

        .invalid-feedback {
            display: block;
            font-size: 0.875rem;
            color: #dc3545;
        }

        .alert-info {
            background-color: #d1ecf1;
            border-color: #bee5eb;
            color: #0c5460;
        }
    </style>
@endpush

@push('scripts')
    <script>
        function resetForm() {
            if (confirm('Apakah Anda yakin ingin mereset form? Semua perubahan akan hilang.')) {
                document.getElementById('name').value = '{{ $item->name }}';
                document.getElementById('description').value = '{{ $item->description }}';

                // Remove validation classes
                document.querySelectorAll('.is-invalid').forEach(function(element) {
                    element.classList.remove('is-invalid');
                });

                // Hide alerts
                document.querySelectorAll('.alert').forEach(function(alert) {
                    if (!alert.classList.contains('alert-info')) {
                        alert.style.display = 'none';
                    }
                });
            }
        }

        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                document.querySelectorAll('.alert-success, .alert-danger').forEach(function(alert) {
                    if (alert.querySelector('.btn-close')) {
                        alert.querySelector('.btn-close').click();
                    }
                });
            }, 5000);
        });
    </script>
@endpush
