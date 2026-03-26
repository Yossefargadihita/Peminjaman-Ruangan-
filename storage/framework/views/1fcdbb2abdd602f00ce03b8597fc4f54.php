<?php $__env->startSection('content'); ?>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-eye me-2"></i>
                            Detail Peralatan
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="text-primary"><?php echo e($item->name); ?></h5>
                                <p class="text-muted"><?php echo e($item->description ?? 'Tidak ada deskripsi'); ?></p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="<?php echo e(route('items.index')); ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i>
                                Kembali
                            </a>
                            <div>
                                <a href="<?php echo e(route('items.edit', $item->id)); ?>" class="btn btn-warning">
                                    <i class="fas fa-edit me-1"></i>
                                    Edit
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sistem-penyewaan-ruangan\resources\views/items/show.blade.php ENDPATH**/ ?>