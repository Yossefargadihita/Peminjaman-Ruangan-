<?php $__env->startSection('content'); ?>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white py-3">
                        <h2 class="mb-0 text-center">
                            <i class="fas fa-calendar-alt me-2"></i>
                            <?php echo e(ucfirst($type)); ?> Ruangan: <?php echo e($room->name); ?>

                        </h2>
                    </div>

                    <div class="card-body p-4">
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Terjadi kesalahan!</strong>
                                <ul class="mb-0 mt-2">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="<?php echo e(route('bookings.store', $room)); ?>" class="needs-validation"
                            novalidate>
                            <?php echo csrf_field(); ?>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="start_date" class="form-label fw-bold">
                                        <i class="fas fa-calendar-plus text-success me-1"></i>
                                        Tanggal Mulai
                                    </label>
                                    <input type="date" name="start_date" id="start_date"
                                        class="form-control form-control-lg" value="<?php echo e(old('start_date')); ?>"
                                        min="<?php echo e(date('Y-m-d')); ?>" required>
                                    <div class="invalid-feedback">
                                        Silakan pilih tanggal mulai.
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="end_date" class="form-label fw-bold">
                                        <i class="fas fa-calendar-minus text-danger me-1"></i>
                                        Tanggal Selesai
                                    </label>
                                    <input type="date" name="end_date" id="end_date"
                                        class="form-control form-control-lg" value="<?php echo e(old('end_date')); ?>"
                                        min="<?php echo e(date('Y-m-d')); ?>" required>
                                    <div class="invalid-feedback">
                                        Silakan pilih tanggal selesai.
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="no_hp" class="form-label fw-bold">
                                        <i class="fas fa-phone text-info me-1"></i>
                                        Nomor HP
                                    </label>
                                    <input type="tel" name="no_hp" id="no_hp" class="form-control form-control-lg"
                                        value="<?php echo e(old('no_hp')); ?>" placeholder="08xxxxxxxxxx" pattern="[0-9]{10,13}"
                                        required>
                                    <div class="invalid-feedback">
                                        Masukkan nomor HP yang valid (10-13 digit).
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="jumlah_peserta" class="form-label fw-bold">
                                        <i class="fas fa-users text-warning me-1"></i>
                                        Jumlah Peserta
                                    </label>
                                    <input type="number" name="jumlah_peserta" id="jumlah_peserta"
                                        class="form-control form-control-lg" value="<?php echo e(old('jumlah_peserta')); ?>"
                                        min="1" max="1000" placeholder="Contoh: 50" required>
                                    <div class="invalid-feedback">
                                        Jumlah peserta minimal 1 orang.
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="alamat" class="form-label fw-bold">
                                    <i class="fas fa-map-marker-alt text-secondary me-1"></i>
                                    Alamat
                                </label>
                                <textarea name="alamat" id="alamat" class="form-control form-control-lg" rows="3"
                                    placeholder="Masukkan alamat lengkap..." required><?php echo e(old('alamat')); ?></textarea>
                                <div class="invalid-feedback">
                                    Alamat tidak boleh kosong.
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="keterangan" class="form-label fw-bold">
                                    <i class="fas fa-sticky-note text-muted me-1"></i>
                                    Keterangan <span class="text-muted">(opsional)</span>
                                </label>
                                <textarea name="keterangan" id="keterangan" class="form-control form-control-lg" rows="3"
                                    placeholder="Tambahkan keterangan jika diperlukan..."><?php echo e(old('keterangan')); ?></textarea>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Anda dapat menambahkan informasi tambahan tentang acara atau kebutuhan khusus.
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-outline-secondary btn-lg me-md-2">
                                    <i class="fas fa-arrow-left me-1"></i>
                                    Kembali
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg px-4">
                                    <i class="fas fa-paper-plane me-1"></i>
                                    Konfirmasi <?php echo e(ucfirst($type)); ?>

                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Bootstrap form validation
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        // Date validation
        document.getElementById('start_date').addEventListener('change', function() {
            const startDate = this.value;
            const endDateInput = document.getElementById('end_date');
            endDateInput.min = startDate;

            if (endDateInput.value && endDateInput.value < startDate) {
                endDateInput.value = startDate;
            }
        });

        // Phone number formatting
        document.getElementById('no_hp').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 13) {
                value = value.substring(0, 13);
            }
            e.target.value = value;
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sistem-penyewaan-ruangan\resources\views/bookings/create.blade.php ENDPATH**/ ?>