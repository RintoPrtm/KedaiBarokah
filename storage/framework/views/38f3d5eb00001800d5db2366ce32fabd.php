<?php $__env->startSection('title', 'Keranjang Belanja'); ?>

<?php $__env->startSection('content-user'); ?>
<div class="container px-4 py-5 mt-5">
  
  <div class="alert alert-primary text-center">
      <h1>Keranjang Belanja</h1>
  </div>

  <?php if(count($keranjangItems)): ?>
    <?php $__currentLoopData = $keranjangItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="card mb-3 shadow-sm">
        <div class="row g-0 align-items-center">

          
          <div class="col-auto p-3">
            <img src="<?php echo e(asset('style/image/'.$item->menu->foto_menu)); ?>"
                  class="rounded"
                  style="width:80px; height:80px; object-fit:cover;"
                  alt="<?php echo e($item->menu->nama_menu); ?>">
          </div>

          
          <div class="col px-3">
            <h5 class="mb-1"><?php echo e($item->menu->nama_menu); ?></h5>
            <p class="mb-1 text-secondary"><?php echo e($item->menu->deskripsi_menu); ?></p>
            <p class="mb-1 text-secondary">
              Harga:
              <?php if($item->menu->promo && $item->menu->promo < $item->menu->harga): ?>
                <span style="text-decoration: line-through; color: #dc3545;">
                  Rp <?php echo e(number_format($item->menu->harga, 0, ',', '.')); ?>

                </span>
                <br>
                <span style="color: #28a745;">
                  Rp <?php echo e(number_format($item->menu->promo, 0, ',', '.')); ?>

                </span>
                <span class="badge bg-warning text-dark ms-2">Promo!</span>
              <?php else: ?>
                <strong>Rp <?php echo e(number_format($item->menu->harga, 0, ',', '.')); ?></strong>
              <?php endif; ?>
            </p>
            <p class="mb-0 text-secondary">
              Jumlah: <strong><?php echo e($item->jumlah); ?></strong>
            </p>
          </div>

          
          <div class="col-auto pe-3 text-end">
            <form action="<?php echo e(route('keranjang.kurangi')); ?>" method="POST" class="d-inline">
              <?php echo csrf_field(); ?>
              <input type="hidden" name="id_menu" value="<?php echo e($item->menu->id_menu); ?>">
              <button type="submit" class="btn btn-outline-primary btn-sm me-1">–</button>
            </form>

            <form action="<?php echo e(route('keranjang.add')); ?>" method="POST" class="d-inline">
              <?php echo csrf_field(); ?>
              <input type="hidden" name="id_menu" value="<?php echo e($item->menu->id_menu); ?>">
              <button type="submit" class="btn btn-outline-primary btn-sm me-2">+</button>
            </form>

            <form action="<?php echo e(route('keranjang.remove', ['id_detail' => $item->id_detail])); ?>"
                  method="POST"
                  class="d-inline">
              <?php echo csrf_field(); ?>
              <?php echo method_field('DELETE'); ?>
              <button type="submit" class="btn btn-outline-danger btn-sm">×</button>
            </form>
          </div>

        </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <div class="mb-2">
      <div class="card-body text-end fs-5 fw-bold">
        Total: Rp <?php echo e(number_format($totalHarga, 0, ',', '.')); ?>

      </div>
    </div>

    
    <form action="<?php echo e(route('keranjang.checkout')); ?>" method="POST">
      <?php echo csrf_field(); ?>
      <div class="text-center">
        <button type="submit" class="btn btn-success w-50 my-4">
          Check Out
        </button>
      </div>
    </form>

  <?php else: ?>
    <div class="alert alert-danger text-center mt-5">
      Oopps... Keranjang Anda masih kosong.
    </div>
  <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.mainUser', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\User Rinto\Documents\Project\berkah\resources\views/keranjang.blade.php ENDPATH**/ ?>