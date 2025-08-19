<?php $__env->startSection('title', 'Pilihan Menu ' . $kategori->nama_kategori); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5 mt-5">
    <div class="alert alert-success text-center">
        <h2 class="text-center fw-bold">Pilihan Menu <?php echo e($kategori->nama_kategori); ?></h2>
    </div>
    
    <div class="row">
        <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="mt-4 mb-2 col-lg-6 col-xl-4">
                <div class="card text-white" style="height: 50vh; overflow: hidden;">
                    <?php
                        $flayerPath = asset('style/image/'.$warung->flayer);
                    ?>
                    <img 
                        src="<?php echo e($item->foto_menu ? asset('style/image/' .$item->foto_menu) : $flayerPath); ?>" 
                        class="card-img object-fit-cover" 
                        alt="<?php echo e($item->nama_menu); ?>"
                        style="height: 100%; width: 100%; object-fit: cover; object-position: center;">
                    
                    <div class="card-img-overlay d-flex flex-column justify-content-end" style="background: rgba(0, 0, 0, 0.3);">
                        <h5 class="fs-4 fw-bolder card-title" style="text-shadow: 0 1px 3px rgba(0,0,0,0.6);">
                            <?php echo e($item->nama_menu); ?>

                        </h5>
                        <p class="card-text" style="text-shadow: 0 1px 3px rgba(0,0,0,0.6);">
                            <?php echo e($item->deskripsi_menu); ?>

                        </p>
                        <p class="fs-5 card-text fw-bold" style="text-shadow: 0 1px 3px rgba(0,0,0,0.6);">
                            <?php if($item->promo && $item->promo < $item->harga): ?>
                                <span style="text-decoration: line-through; font-size:0.9em; color: #dc3545;">
                                    Rp <?php echo e(number_format($item->harga, 0, ',', '.')); ?>

                                </span>
                                <br>
                                <span class="ms-2">
                                    Rp <?php echo e(number_format($item->promo, 0, ',', '.')); ?>

                                </span>
                                <span class="badge bg-warning text-dark ms-2">Promo!</span>
                            <?php else: ?>
                                Rp <?php echo e(number_format($item->harga, 0, ',', '.')); ?>

                            <?php endif; ?>
                        </p>
                        <button type="button" class="fw-bold btn btn-light w-100"
                                data-toggle="modal" data-target="#modalmenu">
                            Pilih Menu
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    
</div>

<!-- Modal -->
<div class="modal fade" id="modalmenu" tabindex="-1" role="dialog" aria-labelledby="modalmenuLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="fs-4 fw-bolder text-danger" id="modalmenuLabel">LOGIN SEKARANG!</h4>
            </div>
            <div class="modal-body">
                <p class="fs-5 fw-bolder">Tidak Bisa Pilih Menu Karena Anda Belum Login!!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\User Rinto\Documents\Project\berkah\resources\views/menu.blade.php ENDPATH**/ ?>