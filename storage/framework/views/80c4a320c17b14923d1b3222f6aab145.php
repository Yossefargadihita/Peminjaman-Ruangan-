<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Tambah User</h1>
        <form action="<?php echo e(route('admin.users.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" required value="<?php echo e(old('name')); ?>">
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required value="<?php echo e(old('email')); ?>">
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Role</label>
                <select name="role" class="form-control" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="umum">Umum</option>
                    <option value="kategorial">Kategorial</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sistem-penyewaan-ruangan\resources\views/admin/users/create.blade.php ENDPATH**/ ?>