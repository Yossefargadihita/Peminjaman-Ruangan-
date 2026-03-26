<?php $__env->startSection('content'); ?>
    <div class="container mt-3">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">Daftar Ruangan</h2>
                <p class="text-muted mb-0">Kelola ruangan dan peralatan yang tersedia</p>
            </div>
            <a href="<?php echo e(route('rooms.create')); ?>" class="btn btn-success">
                <i class="fas fa-plus me-2"></i>Tambah Ruangan
            </a>
        </div>

        <!-- Success Alert -->
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Main Content -->
        <?php if($rooms->count()): ?>
            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">Tersedia</h6>
                                    <h3 class="mb-0"><?php echo e($rooms->where('status', 'tersedia')->count()); ?></h3>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-door-open fa-2x opacity-75"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">Dipakai</h6>
                                    <h3 class="mb-0"><?php echo e($rooms->where('status', 'dipakai')->count()); ?></h3>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-users fa-2x opacity-75"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-danger text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">Maintenance</h6>
                                    <h3 class="mb-0"><?php echo e($rooms->where('status', 'maintenance')->count()); ?></h3>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-tools fa-2x opacity-75"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">Total Ruangan</h6>
                                    <h3 class="mb-0"><?php echo e($rooms->count()); ?></h3>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-building fa-2x opacity-75"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table Card -->
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-table me-2"></i>Data Ruangan
                        </h5>
                        <small class="text-muted">Total: <?php echo e($rooms->count()); ?> ruangan</small>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="fw-semibold">
                                        <i class="fas fa-door-closed me-2"></i>Nama Ruangan
                                    </th>
                                    <th class="fw-semibold">
                                        <i class="fas fa-layer-group me-2"></i>Lantai
                                    </th>
                                    <th class="fw-semibold">
                                        <i class="fas fa-info-circle me-2"></i>Status
                                    </th>
                                    <th class="fw-semibold">
                                        <i class="fas fa-money-bill-wave me-2"></i>Harga Sewa
                                    </th>
                                    <th class="fw-semibold">
                                        <i class="fas fa-box me-2"></i>Peralatan
                                    </th>
                                    <th class="fw-semibold text-center">
                                        <i class="fas fa-cogs me-2"></i>Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    <div
                                                        class="avatar-sm bg-primary rounded-circle d-flex align-items-center justify-content-center">
                                                        <i class="fas fa-door-open text-white"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0"><?php echo e($room->name); ?></h6>
                                                    <small class="text-muted">ID: <?php echo e($room->id); ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border">
                                                <?php echo e($room->floor); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <span
                                                class="badge
                                                <?php if($room->status === 'tersedia'): ?> bg-success
                                                <?php elseif($room->status === 'dipakai'): ?> bg-warning
                                                <?php else: ?> bg-danger <?php endif; ?>">
                                                <i class="fas fa-circle me-1" style="font-size: 0.6rem;"></i>
                                                <?php echo e(ucfirst($room->status)); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <div class="fw-semibold text-success">
                                                Rp <?php echo e(number_format($room->rental_price, 0, ',', '.')); ?>

                                            </div>
                                            <small class="text-muted">per hari</small>
                                        </td>
                                        <td>
                                            <?php if($room->items->count()): ?>
                                                <div class="d-flex flex-wrap gap-1">
                                                    <?php $__currentLoopData = $room->items->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <span class="badge bg-light text-dark border"
                                                            title="<?php echo e($item->name); ?> (<?php echo e($item->pivot->quantity); ?>)">
                                                            <?php echo e($item->name); ?> (<?php echo e($item->pivot->quantity); ?>)
                                                        </span>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($room->items->count() > 3): ?>
                                                        <span class="badge bg-secondary"
                                                            title="Dan <?php echo e($room->items->count() - 3); ?> item lainnya">
                                                            +<?php echo e($room->items->count() - 3); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            <?php else: ?>
                                                <em class="text-muted">
                                                    <i class="fas fa-minus-circle me-1"></i>Tidak ada peralatan
                                                </em>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="<?php echo e(route('rooms.edit', $room->id)); ?>"
                                                    class="btn btn-sm btn-warning" title="Edit Ruangan">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <button class="btn btn-sm btn-info" title="Lihat Detail"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#detailModal<?php echo e($room->id); ?>">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Detail Modals -->
            <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="modal fade" id="detailModal<?php echo e($room->id); ?>" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    <i class="fas fa-info-circle me-2"></i>Detail Ruangan: <?php echo e($room->name); ?>

                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="text-muted">Informasi Dasar</h6>
                                        <table class="table table-borderless table-sm">
                                            <tr>
                                                <td><strong>Nama:</strong></td>
                                                <td><?php echo e($room->name); ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Lantai:</strong></td>
                                                <td><?php echo e($room->floor); ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Status:</strong></td>
                                                <td>
                                                    <span
                                                        class="badge
                                                        <?php if($room->status === 'tersedia'): ?> bg-success
                                                        <?php elseif($room->status === 'dipakai'): ?> bg-warning
                                                        <?php else: ?> bg-danger <?php endif; ?>">
                                                        <?php echo e(ucfirst($room->status)); ?>

                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Harga Sewa:</strong></td>
                                                <td class="text-success fw-semibold">Rp
                                                    <?php echo e(number_format($room->rental_price, 0, ',', '.')); ?> /hari</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="text-muted">Peralatan</h6>
                                        <?php if($room->items->count()): ?>
                                            <div class="list-group list-group-flush">
                                                <?php $__currentLoopData = $room->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div
                                                        class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                        <span><?php echo e($item->name); ?></span>
                                                        <span
                                                            class="badge bg-primary rounded-pill"><?php echo e($item->pivot->quantity); ?></span>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php else: ?>
                                            <div class="alert alert-info">
                                                <i class="fas fa-info-circle me-2"></i>Belum ada peralatan yang terdaftar
                                                untuk ruangan ini.
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <a href="<?php echo e(route('rooms.edit', $room->id)); ?>" class="btn btn-primary">
                                    <i class="fas fa-edit me-2"></i>Edit Ruangan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <!-- Empty State -->
            <div class="card">
                <div class="card-body text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-building fa-4x text-muted"></i>
                    </div>
                    <h4 class="text-muted">Belum ada ruangan yang terdaftar</h4>
                    <p class="text-muted mb-4">Mulai dengan menambahkan ruangan pertama untuk sistem manajemen Anda</p>
                    <a href="<?php echo e(route('rooms.create')); ?>" class="btn btn-success">
                        <i class="fas fa-plus me-2"></i>Tambah Ruangan Pertama
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <style>
        .avatar-sm {
            width: 40px;
            height: 40px;
        }

        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }

        .card {
            border: 1px solid #e3e6f0;
            border-radius: 0.35rem;
        }

        .card-header {
            border-bottom: 1px solid #e3e6f0;
            padding: 1rem 1.25rem;
        }

        .badge {
            font-size: 0.775em;
        }

        .opacity-75 {
            opacity: 0.75;
        }

        .gap-2 {
            gap: 0.5rem;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            border-radius: 0.25rem;
        }
    </style>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sistem-penyewaan-ruangan\resources\views/rooms/index.blade.php ENDPATH**/ ?>