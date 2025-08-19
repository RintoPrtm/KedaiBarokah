<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link" href="<?php echo e(url('/admin')); ?>">
                    <div class="sb-nav-link-icon"><i ></i></div>
                    Kategori Menu
                </a>
                <a class="nav-link" href="<?php echo e(url('/menuAdmin')); ?>">
                    <div class="sb-nav-link-icon"><i ></i></div>
                    Menu
                </a>
                <a class="nav-link" href="<?php echo e(url('/pesananAdmin')); ?>">
                    <div class="sb-nav-link-icon"><i ></i></div>
                    Pesanan
                </a>
                <a class="nav-link" href="<?php echo e(url('/warungAdmin')); ?>">
                    <div class="sb-nav-link-icon"><i ></i></div>
                    Kedai
                </a>
            </div>
        </div>
        
        <form action="<?php echo e(url('/logout')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="d-grid pb-3"><button type="submit" class="btn btn-primary">Logout</button></div>
        </form>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Admin
        </div>
    </nav>
</div>
<?php /**PATH D:\User Rinto\Documents\Project\berkah\resources\views/admin/navbarAdmin.blade.php ENDPATH**/ ?>