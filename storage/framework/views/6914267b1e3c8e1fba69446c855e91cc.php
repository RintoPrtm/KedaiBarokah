<?php $__env->startSection('content-admin'); ?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Daftar Pesanan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><?php echo e($warung->first()->nama_warung); ?></li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Data Pesanan
            </div>
            <div class="card-body">
                <table class="table table-striped" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Pelanggan</th>
                            <th>Nomer Telpon</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Status</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $pesanan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($item->id_pesanan); ?>.</td>
                            <td><?php echo e($item->users->username); ?></td>
                            <td><?php echo e($item->users->telp_user); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($item->tanggal_pesanan)->format('d F Y')); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($item->jam_pesanan)->format('H:i')); ?></td>
                            <td><span class="badge <?php echo e($item->status=='Diproses' ? 'bg-danger' : 
                                    ($item->status=='Selesai' ? 'bg-success' : ($item->status=='Sudah Siap' ? 'bg-warning' : 'bg-secondary'))); ?>"><?php echo e($item->status); ?></span></td>
                            <td>
                                <button type="button"
                                        class="btn btn-sm btn-info"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalDetail<?php echo e($item->id_pesanan); ?>">
                                    Detail
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php $__currentLoopData = $pesanan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <!-- Modal Detail -->
                <div class="modal fade" id="modalDetail<?php echo e($item->id_pesanan); ?>" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-info text-white">
                                <h5 class="modal-title">Detail Pesanan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Nama Pelanggan:</strong> <?php echo e($item->users->username); ?></p>
                                <p><strong>Tanggal:</strong> <?php echo e(\Carbon\Carbon::parse($item->tanggal_pesanan)->format('d F Y')); ?></p>
                                <p><strong>Jam:</strong> <?php echo e(\Carbon\Carbon::parse($item->jam_pesanan)->format('H:i')); ?></p>
                                <p><strong>Status:</strong> 
                                <span class="badge <?php echo e($item->status=='Diproses' ? 'bg-danger' : 
                                    ($item->status=='Selesai' ? 'bg-success' : ($item->status=='Sudah Siap' ? 'bg-warning' : 'bg-secondary'))); ?>"><?php echo e(ucfirst($item->status)); ?></span></p>
                                <table class="table table-sm table-bordered mt-3">
                                <thead>
                                    <tr>
                                        <th>Menu</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Promo</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $item->detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($d->menu->nama_menu); ?></td>
                                        <td><?php echo e($d->jumlah); ?></td>
                                        <td>Rp <?php echo e(number_format($d->menu->harga)); ?></td>
                                        <td>
                                            <?php if($d->menu->promo && $d->menu->promo > 0): ?>
                                                <span class="badge bg-success">
                                                    Rp <?php echo e(number_format($d->menu->promo, 0, ',', '.')); ?>

                                                </span>
                                            <?php else: ?>
                                                <span class="text-muted">—</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>Rp <?php echo e(number_format($d->jumlah * $d->menu->effective_price,0, ',', '.')); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                </table>
                                <?php
                                  $total = $item->detail->sum(fn($d) => $d->jumlah * $d->menu->effective_price);
                                ?>
                                <h5 class="text-end">Total Harga: Rp <?php echo e(number_format($total)); ?></h5>

                                <form action="<?php echo e(route('admin.pesanan.updateStatus', $item->id_pesanan)); ?>"
                                        method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <?php if($item->status === 'Selesai'): ?>
                                    <div class="d-flex justify-content-end mt-3">
                                            <a href="<?php echo e(route('invoice.generate', $item->id_pesanan)); ?>"
                                                    target="_blank"
                                                    class="btn btn-primary">
                                                <i class="bi bi-file-earmark-pdf"></i> Cetak Invoice
                                            </a>
                                        </div>
                                    <?php else: ?>
                                        <div class="row mt-2">
                                            <div class="col-md-6">
                                                <label class="form-label">Ubah Status Pesanan</label>
                                                <select name="status" class="form-select" required>
                                                    <option value="Sudah Siap">Sudah Siap</option>
                                                    <option value="Selesai">Selesai</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 d-flex align-items-end">
                                                <button type="submit" class="btn btn-success ms-auto">Ubah Status</button>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\User Rinto\Documents\Project\berkah\resources\views/pesananAdmin.blade.php ENDPATH**/ ?>