<?php $__env->startSection('title', 'Pesanan Sukses'); ?>


<?php $__env->startSection('content-user'); ?>
<div class="container py-5 mt-2">
  
  <div class="text-center">
    <h1 class="display-4 fw-bolder text-success">BERHASIL!</h1>
    <p class="lead text-black-50">Pesanan Anda Sedang Diproses</p>
  </div>

  
  <div class="text-center mb-3">
    <h2 class="fw-bold text-primary">
      Total Harga Pesanan: 
      <span>Rp <?php echo e(number_format($totalHarga, 0, ',', '.')); ?></span>
    </h2>
  </div>

  
  <?php $__currentLoopData = $pesananSukses->detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
      $unitPrice = $item->menu->harga;
      $subtotal  = $unitPrice * $item->jumlah;
    ?>

    <div class="card mb-3  shadow-sm">
      <div class="row g-0 align-items-center">

        
        <div class="col-auto p-3">
          <img src="<?php echo e(asset('style/image/'.$item->menu->foto_menu)); ?>"
                class="rounded"
                style="width:80px; height:80px; object-fit:cover;"
                alt="<?php echo e($item->menu->nama_menu); ?>">
        </div>

        
        <div class="col px-3 py-2">
          <h5 class="mb-1"><?php echo e($item->menu->nama_menu); ?></h5>
          <p class="mb-1 text-secondary"><?php echo e($item->menu->deskripsi_menu); ?></p>

          <p class="mb-1 text-secondary">
            Harga:
            <strong>Rp <?php echo e(number_format($unitPrice, 0, ',', '.')); ?></strong>
          </p>

          <p class="mb-1 text-secondary">
            Jumlah:
            <strong><?php echo e($item->jumlah); ?></strong>
          </p>
          
        </div>

      </div>
    </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

  <div class="mt-4">
    <a href="<?php echo e(url('tampilUser')); ?>" class="btn btn-primary">
      &larr; Kembali
    </a>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.mainUser', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\User Rinto\Documents\Project\berkah\resources\views/pesananSukses.blade.php ENDPATH**/ ?>