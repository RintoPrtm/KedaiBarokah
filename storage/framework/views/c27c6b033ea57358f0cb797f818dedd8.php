<?php $__env->startSection('content-admin'); ?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Profile kedai</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><?php echo e($warung->first()->nama_warung); ?></li>
        </ol>
        <div class="row">
            <div class=" w-100 col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <button type="button"
                            class="btn btn-primary w-100"
                            data-bs-toggle="modal"
                            data-bs-target="#editWarungModal">
                        Edit Informasi Kedai
                    </button>
                </div>
            </div>
        </div>
        <div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Warung</th>
                            <th>Alamat Warung</th>
                            <th>Deskripsi Warung</th>
                            <th>Foto</th>
                            <th>Flayer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo e($warung->nama_warung); ?>.</td>
                            <td><?php echo e($warung->alamat_warung); ?></td>
                            <td><?php echo e($warung->deskripsi_warung); ?></td>
                            <td><img src="<?php echo e(asset('style/image/' .$warung->foto_warung)); ?>"
                                    class="img-thumbnail" width="150"></td>
                            <td><img src="<?php echo e(asset('style/image/' .$warung->flayer)); ?>"
                                    class="img-thumbnail" width="150"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Edit Kedai -->
    <div class="modal fade" id="editWarungModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-sm">

            <!-- header -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-store-alt me-2"></i>
                    Edit Informasi Kedai
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

                <form action="<?php echo e(route('admin.warung.update', $warung->id_warung)); ?>"
                        method="POST"
                        enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <!-- body -->
                    <div class="modal-body">
                        <div class="row g-3">

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text"
                                        class="form-control <?php $__errorArgs = ['nama_warung'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        id="nama_warung"
                                        name="nama_warung"
                                        placeholder="Nama Warung"
                                        value="<?php echo e(old('nama_warung', $warung->nama_warung)); ?>">
                                    <label for="nama_warung">Nama Warung</label>
                                    <?php $__errorArgs = ['nama_warung'];
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

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <textarea class="form-control <?php $__errorArgs = ['alamat_warung'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            placeholder="Alamat Warung"
                                            id="alamat_warung"
                                            name="alamat_warung"
                                            style="height: 60px"><?php echo e(old('alamat_warung', $warung->alamat_warung)); ?></textarea>
                                    <label for="alamat_warung">Alamat Warung</label>
                                    <?php $__errorArgs = ['alamat_warung'];
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

                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control <?php $__errorArgs = ['deskripsi_warung'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            placeholder="Deskripsi Warung"
                                            id="deskripsi_warung"
                                            name="deskripsi_warung"
                                            style="height: 100px"><?php echo e(old('deskripsi_warung', $warung->deskripsi_warung)); ?></textarea>
                                    <label for="deskripsi_warung">Deskripsi Warung</label>
                                    <?php $__errorArgs = ['deskripsi_warung'];
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

                            <div class="col-md-6">
                                <label for="foto_warung" class="form-label">Foto Warung</label>
                                <input class="mb-2 form-control form-control-sm <?php $__errorArgs = ['foto_warung'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    type="file"
                                    id="foto_warung"
                                    name="foto_warung">
                                <?php $__errorArgs = ['foto_warung'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <?php if($warung->foto_warung): ?>
                                    <small class="text-muted">Current: <img src="<?php echo e(asset('style/image/' .$warung->foto_warung)); ?>"width="80" class="rounded mb-2"></small>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-6">
                                <label for="flayer" class="form-label">Flayer</label>
                                <input class="mb-2 form-control form-control-sm <?php $__errorArgs = ['flayer'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    type="file"
                                    id="flayer"
                                    name="flayer">
                                <?php $__errorArgs = ['flayer'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <?php if($warung->flayer): ?>
                                    <small class="text-muted">Current: <img src="<?php echo e(asset('style/image/' .$warung->flayer)); ?>"width="80" class="rounded mb-2"></small>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>

                    <!-- footer -->
                    <div class="modal-footer bg-light">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-1"></i>Simpan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            <?php if($errors->default->any()): ?>
                let addModal = document.getElementById('editWarungModal');
                new bootstrap.Modal(addModal).show();
            <?php endif; ?>
        });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\User Rinto\Documents\Project\berkah\resources\views/warungAdmin.blade.php ENDPATH**/ ?>