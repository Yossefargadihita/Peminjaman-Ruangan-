<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Edit User</h1>
        <form action="<?php echo e(route('admin.users.update', $user)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" required value="<?php echo e(old('name', $user->name)); ?>">
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required value="<?php echo e(old('email', $user->email)); ?>">
            </div>

            <div class="mb-3">
                <label>Role</label>
                <select name="role" class="form-control" required>
                    <option value="umum" <?php echo e($user->role === 'umum' ? 'selected' : ''); ?>>Umum</option>
                    <option value="kategorial" <?php echo e($user->role === 'kategorial' ? 'selected' : ''); ?>>Kategorial</option>
                    <option value="admin" <?php echo e($user->role === 'admin' ? 'selected' : ''); ?>>Admin</option>
                </select>
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sistem-penyewaan-ruangan\resources\views/admin/users/edit.blade.php ENDPATH**/ ?>