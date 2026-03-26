<?php $__env->startSection('content'); ?>
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="mb-0">
                                <i class="fas fa-users me-2"></i>
                                Manajemen User
                            </h3>
                            <a href="<?php echo e(route('admin.users.create')); ?>" class="btn btn-light btn-sm">
                                <i class="fas fa-plus me-1"></i>
                                Tambah User
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <?php if(session('success')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                <?php echo e(session('success')); ?>

                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">
                                            <i class="fas fa-user me-1"></i>
                                            Nama
                                        </th>
                                        <th scope="col">
                                            <i class="fas fa-envelope me-1"></i>
                                            Email
                                        </th>
                                        <th scope="col">
                                            <i class="fas fa-shield-alt me-1"></i>
                                            Role
                                        </th>
                                        <th scope="col" class="text-center">
                                            <i class="fas fa-cogs me-1"></i>
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-circle me-2">
                                                        <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                                                    </div>
                                                    <strong><?php echo e($user->name); ?></strong>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-muted"><?php echo e($user->email); ?></span>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge bg-<?php echo e($user->role === 'admin' ? 'danger' : 'success'); ?> px-2 py-1">
                                                    <?php echo e(ucfirst($user->role)); ?>

                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="<?php echo e(route('admin.users.edit', $user)); ?>"
                                                        class="btn btn-warning btn-sm" title="Edit User">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="4" class="text-center py-4">
                                                <div class="text-muted">
                                                    <i class="fas fa-users fa-3x mb-3"></i>
                                                    <p>Belum ada user yang terdaftar</p>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .avatar-circle {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 14px;
        }

        .card {
            border: none;
            border-radius: 12px;
        }

        .card-header {
            border-radius: 12px 12px 0 0 !important;
            border-bottom: 2px solid rgba(0, 0, 0, 0.1);
        }

        .table thead th {
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .table tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.05);
            transform: translateY(-1px);
            transition: all 0.3s ease;
        }

        .btn-group .btn {
            margin: 0 2px;
        }

        .badge {
            font-size: 0.75rem;
            font-weight: 600;
        }

        .alert {
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .btn {
            border-radius: 6px;
            font-weight: 500;
        }

        .btn-outline-warning:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(255, 193, 7, 0.3);
        }

        .btn-outline-danger:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
        }

        .table-responsive {
            border-radius: 8px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sistem-penyewaan-ruangan\resources\views/admin/users/index.blade.php ENDPATH**/ ?>