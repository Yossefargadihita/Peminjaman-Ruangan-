<?php $__env->startSection('content'); ?>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="d-flex align-items-center mb-4">
                    <i class="fas fa-file-invoice-dollar text-primary me-3" style="font-size: 2rem;"></i>
                    <h2 class="mb-0 text-primary fw-bold">Invoice Pemesanan</h2>
                </div>

                <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        <?php echo e(session('success')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-gradient-primary text-white py-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="mb-0 fw-bold">
                                    <i class="fas fa-door-open me-2"></i>
                                    <?php echo e($booking->room->name); ?>

                                </h4>
                            </div>
                            <div class="col-auto">
                                <span class="badge bg-light text-dark fs-6">
                                    <i class="fas fa-calendar-alt me-1"></i>
                                    ID: #<?php echo e($booking->id); ?>

                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <!-- Customer Information -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="bg-light rounded-3 p-3 h-100">
                                    <h6 class="text-primary fw-bold mb-3">
                                        <i class="fas fa-user-circle me-2"></i>
                                        Informasi Pemesan
                                    </h6>
                                    <div class="mb-2">
                                        <strong class="text-muted">Nama:</strong>
                                        <span class="ms-2"><?php echo e($booking->user->name); ?></span>
                                    </div>
                                    <div class="mb-2">
                                        <strong class="text-muted">No. HP:</strong>
                                        <span class="ms-2"><?php echo e($booking->no_hp); ?></span>
                                    </div>
                                    <div class="mb-2">
                                        <strong class="text-muted">Alamat:</strong>
                                        <span class="ms-2"><?php echo e($booking->alamat); ?></span>
                                    </div>
                                    <div>
                                        <strong class="text-muted">Jumlah Peserta:</strong>
                                        <span class="ms-2 badge bg-info"><?php echo e($booking->jumlah_peserta); ?> orang</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-light rounded-3 p-3 h-100">
                                    <h6 class="text-primary fw-bold mb-3">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Detail Pemesanan
                                    </h6>
                                    <div class="mb-2">
                                        <strong class="text-muted">Jenis:</strong>
                                        <span class="ms-2 badge bg-secondary"><?php echo e(ucfirst($booking->type)); ?></span>
                                    </div>
                                    <div class="mb-2">
                                        <strong class="text-muted">Tanggal:</strong>
                                        <span class="ms-2"><?php echo e($booking->start_date); ?> s.d <?php echo e($booking->end_date); ?></span>
                                    </div>
                                    <div class="mb-2">
                                        <strong class="text-muted">Lama Sewa:</strong>
                                        <span class="ms-2 badge bg-warning text-dark"><?php echo e($duration); ?> hari</span>
                                    </div>
                                    <div>
                                        <strong class="text-muted">Status Pembayaran:</strong>
                                        <?php if($booking->is_paid): ?>
                                            <span class="ms-2 badge bg-success">
                                                <i class="fas fa-check-circle me-1"></i>
                                                Sudah Dibayar
                                            </span>
                                        <?php else: ?>
                                            <span class="ms-2 badge bg-danger">
                                                <i class="fas fa-exclamation-circle me-1"></i>
                                                Belum Dibayar
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pricing Details -->
                        <div class="card bg-gradient-light border-0 mb-4">
                            <div class="card-body p-4">
                                <h6 class="text-primary fw-bold mb-3">
                                    <i class="fas fa-calculator me-2"></i>
                                    Rincian Biaya
                                </h6>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span class="text-muted">Harga per Hari:</span>
                                            <span
                                                class="fw-bold">Rp<?php echo e(number_format($booking->room->rental_price, 0, ',', '.')); ?></span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span class="text-muted">Lama Sewa:</span>
                                            <span class="fw-bold"><?php echo e($duration); ?> hari</span>
                                        </div>
                                        <hr class="my-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="h6 text-dark mb-0">Total Harga:</span>
                                            <span class="h5 fw-bold text-success mb-0">
                                                Rp<?php echo e(number_format($totalPrice, 0, ',', '.')); ?>

                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <div class="bg-white rounded-3 p-3 border">
                                            <i class="fas fa-money-bill-wave text-success" style="font-size: 3rem;"></i>
                                            <div class="mt-2 text-muted small">Total Pembayaran</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-3 flex-wrap">
                            <?php if(!$booking->is_paid): ?>
                                <button id="pay-button" class="btn btn-success btn-lg px-4 py-2 flex-grow-1">
                                    <i class="fas fa-credit-card me-2"></i>
                                    Bayar Sekarang
                                </button>
                            <?php endif; ?>
                            <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-outline-secondary btn-lg px-4 py-2">
                                <i class="fas fa-arrow-left me-2"></i>
                                Kembali ke Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <?php if(!$booking->is_paid): ?>
        
        <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="<?php echo e(env('MIDTRANS_CLIENT_KEY')); ?>"></script>

        <script type="text/javascript">
            const payButton = document.getElementById('pay-button');
            if (payButton) {
                payButton.addEventListener('click', function() {
                    // Add loading state
                    const originalText = payButton.innerHTML;
                    payButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
                    payButton.disabled = true;

                    snap.pay('<?php echo e($snapToken); ?>', {
                        onSuccess: function(result) {
                            // Kirim POST ke route bookings.pay
                            fetch("<?php echo e(route('bookings.pay', $booking->id)); ?>", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
                                },
                                body: JSON.stringify({}) // bisa dikosongkan karena hanya trigger
                            }).then(response => {
                                if (response.ok) {
                                    // Show success message
                                    payButton.innerHTML =
                                        '<i class="fas fa-check me-2"></i>Berhasil!';
                                    payButton.className =
                                        'btn btn-success btn-lg px-4 py-2 flex-grow-1';
                                    setTimeout(() => {
                                        window.location.href =
                                            "<?php echo e(route('bookings.index')); ?>";
                                    }, 1500);
                                } else {
                                    alert("Gagal update status pembayaran.");
                                    payButton.innerHTML = originalText;
                                    payButton.disabled = false;
                                }
                            });
                        },
                        onPending: function(result) {
                            alert("Menunggu pembayaran...");
                            payButton.innerHTML = originalText;
                            payButton.disabled = false;
                        },
                        onError: function(result) {
                            alert("Pembayaran gagal.");
                            payButton.innerHTML = originalText;
                            payButton.disabled = false;
                        },
                        onClose: function() {
                            // Reset button when payment popup is closed
                            payButton.innerHTML = originalText;
                            payButton.disabled = false;
                        }
                    });
                });
            }
        </script>
    <?php endif; ?>

    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        }

        .bg-gradient-light {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .card {
            transition: transform 0.2s ease-in-out;
        }

        .card:hover {
            transform: translateY(-2px);
        }

        .btn {
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .badge {
            font-size: 0.8rem;
            padding: 0.5rem 0.8rem;
        }

        .alert {
            border: none;
            border-radius: 10px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sistem-penyewaan-ruangan\resources\views/bookings/invoice.blade.php ENDPATH**/ ?>