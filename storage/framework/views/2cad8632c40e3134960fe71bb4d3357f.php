<?php $__env->startSection('title', 'Detail Transaksi '); ?>

<?php $__env->startSection('content-user'); ?>
<div class="container px-4 py-5 mt-5">

  
  <div class="mb-4">
    <h2 class="fw-bold">Detail Transaksi</h2>
    <p class="text-muted mb-1">
      <?php echo e(\Carbon\Carbon::parse($pesanan->tanggal_pesanan)->format('d M Y')); ?>,
      <?php echo e(\Carbon\Carbon::parse($pesanan->jam_pesanan)->format('H:i')); ?>

    </p>
    <span class="badge <?php echo e($pesanan->status=='Diproses'   ? 'bg-primary' :
        ($pesanan->status=='Selesai'   ? 'bg-success' :
        ($pesanan->status=='Sudah Siap' ? 'bg-warning' : 'bg-danger'))); ?>">
      <?php echo e($pesanan->status); ?>

    </span>
    <div class="text-end">
      <?php if($pesanan->status == 'Selesai'): ?>
        <a href="<?php echo e(route('invoice.generate', $pesanan->id_pesanan)); ?>"
           target="_blank"
           class="btn btn-success">
          <i class="bi bi-file-earmark-pdf"></i> Cetak Invoice
        </a>
      <?php endif; ?>
    </div>
  </div>

  <?php
    // Hitung total seluruh item dengan harga promo jika ada
    $total = $pesanan->detail->reduce(function($carry, $item) {
        $unitPrice     = $item->menu->harga;
        $promoPrice    = $item->menu->promo;
        $effectivePrice = ($promoPrice && $promoPrice > 0)
                          ? $promoPrice
                          : $unitPrice;
        return $carry + ($effectivePrice * $item->jumlah);
    }, 0);
  ?>

  
  <?php $__currentLoopData = $pesanan->detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
      $unitPrice      = $item->menu->harga;
      $promoPrice     = $item->menu->promo;
      $effectivePrice = ($promoPrice && $promoPrice > 0)
                        ? $promoPrice
                        : $unitPrice;
      $subtotal       = $effectivePrice * $item->jumlah;
    ?>

    <div class="card mb-3 shadow-sm">
      <div class="row g-0 align-items-center">

        
        <div class="col-auto p-3">
          <img src="<?php echo e(asset('style/image/' . $item->menu->foto_menu)); ?>"
               class="rounded"
               style="width: 80px; height: 80px; object-fit: cover;"
               alt="<?php echo e($item->menu->nama_menu); ?>">
        </div>

        
        <div class="col px-3">
          <h5 class="mb-1"><?php echo e($item->menu->nama_menu); ?></h5>

          <p class="mb-1">
            Harga:&nbsp;
            <?php if($promoPrice && $promoPrice > 0): ?>
              <span class="text-secondary text-decoration-line-through">
                Rp <?php echo e(number_format($unitPrice, 0, ',', '.')); ?>

              </span>
              <span class="ms-2 badge bg-success">
                Rp <?php echo e(number_format($promoPrice, 0, ',', '.')); ?>

              </span>
            <?php else: ?>
              Rp <?php echo e(number_format($unitPrice, 0, ',', '.')); ?>

            <?php endif; ?>
          </p>

          <p class="mb-1 text-secondary">
            Jumlah: <?php echo e($item->jumlah); ?>

          </p>

          <p class="mb-0 fw-bold">
            Subtotal: Rp <?php echo e(number_format($subtotal, 0, ',', '.')); ?>

          </p>
        </div>
      </div>
    </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

  
  <div class="mb-4">
    <div class="card-body text-end fs-5 fw-bold">
      Total: Rp <?php echo e(number_format($total, 0, ',', '.')); ?>

    </div>
  </div>

  
  <div class="mt-4">
    <a href="<?php echo e(route('pesanan.index')); ?>" class="btn btn-primary">
      &larr; Kembali
    </a>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.mainUser', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\User Rinto\Documents\Project\berkah\resources\views/pesanan/show.blade.php ENDPATH**/ ?>