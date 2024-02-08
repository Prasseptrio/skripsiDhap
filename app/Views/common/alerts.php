<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    </div>
<?php endif ?>
<?php if (session()->getFlashdata('warning')) : ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('warning'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    </div>
<?php endif ?>
<?php if (session()->getFlashdata('primary')) : ?>
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('primary'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    </div>
<?php endif ?>
<?php if (session()->getFlashdata('info')) : ?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('info'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    </div>
<?php endif ?>
<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    </div>
<?php endif ?>
<?php if (session()->getFlashdata('warningSwall')) : ?>
    <script src="<?= base_url('plugins/sweetalert/sweet/sweetalert2.min.js'); ?>"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 0,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
            icon: 'warning',
            title: '<?= session()->getFlashdata('warningSwall'); ?>'
        })
    </script>
<?php endif ?>
<?php if (session()->getFlashdata('successSwal')) : ?>
    <script src="<?= base_url('plugins/sweetalert/sweet/sweetalert2.min.js'); ?>"></script>
    <script>
        const Toasted = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (Toasted) => {
                Toasted.addEventListener('mouseenter', Swal.stopTimer)
                Toasted.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toasted.fire({
            icon: 'success',
            title: '<?= session()->getFlashdata('successSwal'); ?>'
        })
    </script>
<?php endif ?>
<?php if (session()->getFlashdata('errorSwal')) : ?>
    <script>
        Swal.fire(
            'Gagal!',
            '<?= session()->getFlashdata('errorSwal'); ?>',
            'error'
        )
    </script>
<?php endif ?>