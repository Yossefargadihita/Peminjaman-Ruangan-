@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <!-- Header Section -->
        <div class="row align-items-center mb-4">
            <div class="col">
                <h2 class="mb-0 text-primary">
                    <i class="fas fa-tools me-2"></i>
                    Daftar Peralatan
                </h2>
                <p class="text-muted mb-0">Kelola semua peralatan yang tersedia</p>
            </div>
            <div class="col-auto">
                <a href="{{ route('items.create') }}" class="btn btn-primary btn-lg shadow-sm">
                    <i class="fas fa-plus me-2"></i>
                    Tambah Peralatan
                </a>
            </div>
        </div>

        <!-- Success Alert -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Equipment Table Card -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-light border-0 py-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="mb-0 text-dark">
                            <i class="fas fa-list me-2"></i>
                            Daftar Peralatan
                        </h5>
                    </div>
                    <div class="col-auto">
                        <span class="badge bg-primary fs-6">
                            {{ $items->count() }} Item
                        </span>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                @if ($items->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0 py-3 px-4">
                                        <i class="fas fa-tag me-2 text-primary"></i>
                                        Nama Peralatan
                                    </th>
                                    <th class="border-0 py-3 px-4">
                                        <i class="fas fa-info-circle me-2 text-primary"></i>
                                        Deskripsi
                                    </th>
                                    <th class="border-0 py-3 px-4 text-center">
                                        <i class="fas fa-cogs me-2 text-primary"></i>
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr class="border-bottom">
                                        <td class="py-3 px-4">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                                    <i class="fas fa-wrench text-primary"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 text-dark">{{ $item->name }}</h6>
                                                    <small class="text-muted">ID: #{{ $item->id }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3 px-4">
                                            @if ($item->description)
                                                <p class="mb-0 text-muted">{{ $item->description }}</p>
                                            @else
                                                <span class="text-muted fst-italic">
                                                    <i class="fas fa-minus me-1"></i>
                                                    Tidak ada deskripsi
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-4 text-center">
                                            <div class="btn-group gap-2" role="group">
                                                <a href="{{ route('items.show', $item->id) }}"
                                                    class="btn btn-outline-info btn-sm" title="Lihat Detail">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('items.edit', $item->id) }}"
                                                    class="btn btn-outline-warning btn-sm" title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <button type="button" class="btn btn-outline-danger btn-sm" title="Hapus"
                                                    onclick="confirmDelete({{ $item->id }})">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-box-open text-muted" style="font-size: 4rem;"></i>
                        </div>
                        <h4 class="text-muted mb-2">Belum Ada Peralatan</h4>
                        <p class="text-muted mb-4">Mulai dengan menambahkan peralatan pertama Anda</p>
                        <a href="{{ route('items.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>
                            Tambah Peralatan Pertama
                        </a>
                    </div>
                @endif
            </div>
        </div>

        {{-- <!-- Pagination (if needed) -->
        @if ($items->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $items->links() }}
            </div>
        @endif --}}
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Konfirmasi Hapus
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">Apakah Anda yakin ingin menghapus peralatan ini? Tindakan ini tidak dapat dibatalkan.
                    </p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteForm" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-2"></i>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(itemId) {
            const form = document.getElementById('deleteForm');
            form.action = `/items/${itemId}`;
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        }
    </script>
@endsection
