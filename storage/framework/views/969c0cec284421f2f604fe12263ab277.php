<?php $__env->startSection('content'); ?>
    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="text-dark fw-bold mb-0">Daftar Pemesanan Ruangan</h2>
                    <div class="text-muted">
                        <small>Total: <?php echo e(count($bookings)); ?> pemesanan</small>
                    </div>
                </div>

                <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo e(session('success')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="mb-0 text-muted">Daftar Pemesanan</h6>
                            </div>
                            <div class="col-auto">
                                <div class="btn-group" role="group">
                                    <input type="radio" class="btn-check" name="filter" id="all" checked>
                                    <label class="btn btn-outline-primary btn-sm" for="all">Semua</label>

                                    <input type="radio" class="btn-check" name="filter" id="active">
                                    <label class="btn btn-outline-primary btn-sm" for="active">Aktif</label>

                                    <input type="radio" class="btn-check" name="filter" id="finished">
                                    <label class="btn btn-outline-primary btn-sm" for="finished">Selesai</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="py-3 px-4">Ruangan</th>
                                        <th class="py-3 px-4">Pemesan</th>
                                        <th class="py-3 px-4">Jenis</th>
                                        <th class="py-3 px-4">Tanggal</th>
                                        <th class="py-3 px-4">No. HP</th>
                                        <th class="py-3 px-4">Alamat</th>
                                        <th class="py-3 px-4">Peserta</th>
                                        <th class="py-3 px-4">Total Harga</th>
                                        <th class="py-3 px-4">Pembayaran</th>
                                        <th class="py-3 px-4">Status</th>
                                        <th class="py-3 px-4 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr class="booking-row"
                                            data-status="<?php echo e($booking->is_finished ? 'finished' : 'active'); ?>">
                                            <td class="px-4 py-3">
                                                <strong><?php echo e($booking->room->name); ?></strong><br>
                                            </td>
                                            <td class="px-4 py-3">
                                                <strong><?php echo e($booking->user->name); ?></strong><br>
                                            </td>
                                            <td class="px-4 py-3">
                                                <span
                                                    class="badge <?php echo e($booking->type === 'sewa' ? 'bg-warning' : 'bg-info'); ?> text-white">
                                                    <?php echo e(ucfirst($booking->type)); ?>

                                                </span>
                                            </td>
                                            <td class="px-4 py-3">
                                                <strong><?php echo e(\Carbon\Carbon::parse($booking->start_date)->format('d M Y')); ?></strong><br>
                                                <small class="text-muted">s.d
                                                    <?php echo e(\Carbon\Carbon::parse($booking->end_date)->format('d M Y')); ?></small>
                                            </td>
                                            <td class="px-4 py-3"><?php echo e($booking->no_hp); ?></td>
                                            <td class="px-4 py-3"><?php echo e($booking->alamat); ?></td>
                                            <td class="px-4 py-3"><?php echo e($booking->jumlah_peserta); ?></td>
                                            <td class="px-4 py-3">
                                                <?php if($booking->type === 'sewa'): ?>
                                                    <?php
                                                        $start = \Carbon\Carbon::parse($booking->start_date);
                                                        $end = \Carbon\Carbon::parse($booking->end_date);
                                                        $duration = $start->diffInDays($end) + 1;
                                                        $total = $duration * $booking->room->rental_price;
                                                    ?>
                                                    Rp<?php echo e(number_format($total, 0, ',', '.')); ?>

                                                <?php else: ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            </td>

                                            <td class="px-4 py-3">
                                                <?php if($booking->type === 'sewa'): ?>
                                                    <?php if($booking->is_paid): ?>
                                                        <span class="badge bg-success">Sudah Bayar</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-danger">Belum Bayar</span>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary">Tidak Perlu</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-4 py-3">
                                                <?php if($booking->is_finished): ?>
                                                    <span class="badge bg-success">Selesai</span>
                                                <?php else: ?>
                                                    <span class="badge bg-warning">Aktif</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-4 py-3 text-center">
                                                <?php if(auth()->id() === $booking->user_id): ?>
                                                    <?php if($booking->type === 'sewa' && !$booking->is_paid): ?>
                                                        <a href="<?php echo e(route('bookings.invoice', $booking->id)); ?>"
                                                            class="btn btn-success btn-sm">
                                                            Bayar
                                                        </a>
                                                    <?php elseif(!$booking->is_finished || auth()->user()->role === 'admin'): ?>
                                                        <form action="<?php echo e(route('bookings.finish', $booking->id)); ?>"
                                                            method="POST"
                                                            onsubmit="return confirm('Selesaikan booking dan kembalikan ruangan?')"
                                                            class="d-inline">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PATCH'); ?>
                                                            <button type="submit" class="btn btn-primary btn-sm">
                                                                Selesai
                                                            </button>
                                                        </form>
                                                    <?php else: ?>
                                                        <span class="text-muted">-</span>
                                                    <?php endif; ?>
                                                <?php elseif(auth()->user()->role === 'admin' && !$booking->is_finished): ?>
                                                    <form action="<?php echo e(route('bookings.finish', $booking->id)); ?>"
                                                        method="POST"
                                                        onsubmit="return confirm('Selesaikan booking dan kembalikan ruangan?')"
                                                        class="d-inline">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('PATCH'); ?>
                                                        <button type="submit" class="btn btn-primary btn-sm">
                                                            Selesai
                                                        </button>
                                                    </form>
                                                <?php else: ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="11" class="text-center py-5">
                                                <div class="text-muted">
                                                    <p class="mb-0">Tidak ada data pemesanan</p>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <?php if(count($bookings) > 0): ?>
                        <div class="card-footer bg-white py-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <small class="text-muted">
                                        Menampilkan <?php echo e(count($bookings)); ?> dari <?php echo e(count($bookings)); ?> pemesanan
                                    </small>
                                </div>
                                
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Filter functionality
        document.querySelectorAll('input[name="filter"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const filterValue = this.id;
                const rows = document.querySelectorAll('.booking-row');

                rows.forEach(row => {
                    if (filterValue === 'all') {
                        row.style.display = '';
                    } else {
                        const status = row.getAttribute('data-status');
                        row.style.display = status === filterValue ? '' : 'none';
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sistem-penyewaan-ruangan\resources\views/bookings/index.blade.php ENDPATH**/ ?>