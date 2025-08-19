<?php $__env->startSection('content-admin'); ?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Kategori Menu</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><?php echo e($warung->first()->nama_warung); ?></li>
        </ol>
        <div class="row">
            <div class=" w-100 col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <form class="CreateKategori" action="" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="button" class="btn btn-primary w-100"
                                data-bs-toggle="modal" data-bs-target="#TambahKategoriModal">
                            + Tambah Kategori
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Data Kategori Menu
            </div>
            <div class="card-body">
                <table class="table table-striped" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?>.</td>
                                <td><?php echo e($item->nama_kategori); ?></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <!-- Button Edit -->
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editKategoriModal<?php echo e($item->id_kategori); ?>">
                                            Edit
                                        </button>
                                        <!-- Button Hapus -->
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#HapusKategoriModal<?php echo e($item->id_kategori); ?>">
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Edit Kategori -->
                            <div class="modal fade" id="editKategoriModal<?php echo e($item->id_kategori); ?>" tabindex="-1" aria-labelledby="editKategoriLabel<?php echo e($item->id_kategori); ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="<?php echo e(route('admin.kategori.update', $item->id_kategori)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="editKategoriLabel<?php echo e($item->id_kategori); ?>">
                                                Edit Kategori <?php echo e($item->nama_kategori); ?>

                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="nama_kategori_<?php echo e($item->id_kategori); ?>" class="form-label">
                                                        Nama Kategori
                                                    </label>
                                                    <input
                                                        type="text"
                                                        name="nama_kategori"
                                                        id="nama_kategori_<?php echo e($item->id_kategori); ?>"
                                                        class="form-control <?php $__errorArgs = ['nama_kategori','edit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                        placeholder="Masukkan Nama Kategori">
                                                        <?php $__errorArgs = ['nama_kategori','edit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Batal
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    Simpan
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Modal Hapus Kategori -->
                            <div class="modal fade" id="HapusKategoriModal<?php echo e($item->id_kategori); ?>" tabindex="-1" aria-labelledby="HapusKategoriModal<?php echo e($item->id_kategori); ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="<?php echo e(route('admin.kategori.destroy', $item->id_kategori)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="fs-4 fw-bolder modal-title" id="HapusKategoriModal<?php echo e($item->id_kategori); ?>">
                                                    <span class="text-danger">!!!</span>
                                                    HAPUS KATEGORI
                                                    <span class="text-danger">!!!</span>
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="nama_kategori_<?php echo e($item->id_kategori); ?>" class="form-label">
                                                        Semua menu yang ada di <span class="fw-bolder text-decoration-underline"><?php echo e($item->nama_kategori); ?></span> akan dihapus. 
                                                        yakin ingin menghapus kategori ini?
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success" data-bs-dismiss="modal">
                                                    Batal
                                                </button>
                                                <button type="submit" class="btn btn-danger">
                                                    Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<!-- Modal Tambah Kategori -->
<div class="modal fade" id="TambahKategoriModal" tabindex="-1" role="dialog" aria-labelledby="TambahKategoriModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?php echo e(route('admin.kategori.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TambahKategoriModalLabel">Tambah Kategori Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_kategori" class="form-label">Nama Kategori</label>
                        <input 
                            type="text"
                            name="nama_kategori"
                            id="nama_kategori_<?php echo e($item->id_kategori ?? 'new'); ?>"
                            class="form-control <?php $__errorArgs = ['nama_kategori'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="Masukkan Nama Kategori">
                            <?php $__errorArgs = ['nama_kategori'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
      // 1) Jika named‐bag "edit" punya error, buka modal edit dengan ID yang kita flash
        <?php if($errors->hasBag('edit')): ?>
            let id = "<?php echo e(session('editKategoriId')); ?>";
            let editModal = document.getElementById('editKategoriModal' + id);
            new bootstrap.Modal(editModal).show();

      // 2) Jika default bag punya error (add), buka modal tambah
        <?php elseif($errors->default->has('nama_kategori')): ?>
            let addModal = document.getElementById('TambahKategoriModal');
            new bootstrap.Modal(addModal).show();
        <?php endif; ?>
    });
</script>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\User Rinto\Documents\Project\berkah\resources\views/admin.blade.php ENDPATH**/ ?>