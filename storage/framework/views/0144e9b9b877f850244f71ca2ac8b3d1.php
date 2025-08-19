<?php $__env->startSection('title', 'Daftar Transaksi'); ?>

<?php $__env->startSection('content-user'); ?>
<div class="container px-4 py-5 mt-5">
  <div class="alert alert-primary text-center mb-4">
    <h1>Daftar Transaksi</h1>
  </div>

  <?php $__empty_1 = true; $__currentLoopData = $pesanan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pesanan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <?php
      $first = $pesanan->detail->first();
      $rest  = $pesanan->detail->count() - 1;
      $tanggal = Carbon\Carbon::parse($pesanan->tanggal_pesanan)->format('d M Y');
      $jam     = Carbon\Carbon::parse($pesanan->jam_pesanan)->format('H:i');
    ?>

    <div class="card mb-3 shadow-sm">
      <div class="row g-0 align-items-center">
        
        
        <div class="col-auto p-3">
          <img src="<?php echo e(asset('style/image/'.$first->menu->foto_menu)); ?>"
              class="rounded" 
              style="width: 80px; height:80px; object-fit:cover;"
              alt="<?php echo e($first->menu->nama_menu); ?>">
        </div>

        <div class="col px-3">
          <div>
            <h5 class="mb-1"><?php echo e($first->menu->nama_menu); ?> </h5>
            <p class="mb-1 text-secondary">
              Jumlah: <?php echo e($first->jumlah); ?>

            </p>
          </div>
          <p class="mb-1 text-secondary">
            <?php if($rest > 0): ?>
              +<?php echo e($rest); ?> menu lainnya
            <?php endif; ?>
          </p>
          <p class="mb-0 small text-muted">
            <?php echo e($tanggal); ?>, <?php echo e($jam); ?>

            <span class="badge <?php echo e($pesanan->status=='Diproses' ? 'bg-primary' : 
                ($pesanan->status=='Selesai' ? 'bg-success' : ($pesanan->status=='Sudah Siap' ? 'bg-warning' : 'bg-danger'))); ?>">
              <?php echo e($pesanan->status); ?>

            </span>
          </p>
        </div>

        <div class="col-auto pe-3">
          <a href="<?php echo e(route('pesanan.show', $pesanan)); ?>"
              class="btn btn-outline-primary btn-sm">
            Detail
          </a>
        </div>

      </div>
    </div>

  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="alert alert-info">
      Belum ada transaksi.
    </div>
  <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('user.mainUser', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\User Rinto\Documents\Project\berkah\resources\views/pesanan/index.blade.php ENDPATH**/ ?>