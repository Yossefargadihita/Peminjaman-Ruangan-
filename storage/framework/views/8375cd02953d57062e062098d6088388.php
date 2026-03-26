<?php $__env->startSection('content'); ?>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-plus-circle me-2"></i>
                            Tambah Peralatan Baru
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Terjadi kesalahan:</strong>
                                <ul class="mb-0 mt-2">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <form action="<?php echo e(route('items.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="mb-4">
                                <label for="name" class="form-label fw-bold">
                                    <i class="fas fa-tag me-1"></i>
                                    Nama Peralatan <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="name" id="name" class="form-control form-control-lg"
                                    placeholder="Contoh: Proyektor Epson EB-X41" value="<?php echo e(old('name')); ?>" required>
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
                                <textarea name="description" id="description" class="form-control" rows="4"
                                    placeholder="Contoh: Proyektor LCD dengan resolusi XGA (1024x768), brightness 3600 lumens, dilengkapi dengan kabel HDMI dan VGA. Kondisi baik, tahun pembelian 2023."><?php echo e(old('description')); ?></textarea>
                                <div class="form-text">
                                    <i class="fas fa-lightbulb me-1"></i>
                                    Opsional: Tambahkan informasi seperti merk, spesifikasi, kondisi, atau catatan penting
                                    lainnya
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="<?php echo e(route('items.index')); ?>" class="btn btn-outline-secondary btn-lg me-md-2">
                                    <i class="fas fa-arrow-left me-1"></i>
                                    Kembali
                                </a>
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="fas fa-save me-1"></i>
                                    Simpan Peralatan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .card {
            border-radius: 10px;
            border: none;
        }

        .card-header {
            border-radius: 10px 10px 0 0 !important;
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%) !important;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #dee2e6;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            transform: translateY(-1px);
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
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sistem-penyewaan-ruangan\resources\views/items/create.blade.php ENDPATH**/ ?>