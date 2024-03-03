<?= $this->extend('layout/start'); ?>
<?= $this->section('body'); ?>

<?php

$session = \Config\Services::session();
$pesan = $session->getFlashdata('pesan');

?>

<div class="container form-login mt-5">
    <h1 class="text-center">LOGIN</h1>
    <?php if ($pesan) { ?>
        <p class="ms-3 mt-2 mb-3" style="color: green;"><?php echo $pesan ?></p>
    <?php } ?>
    <form action="/auth/valid_login" class="signup-form" method="post">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Username">
        </div>
        <!-- password -->
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label" placeholder="Password">Password</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="d-grid gap-2">
            <button class="btn btn-primary" type="submit">Login</button>
        </div>
    </form>
    <div class="text-center mt-3">
        <a href="/lupapw">Lupa password akun? Klik disini</a>
    </div>
    <div class="text-center mt-3">
        <a href="/daftar">Belum punya akun? Daftar disini</a>
    </div>
</div>

<script src="/assets/js/onclick.js"></script>

</div <?= $this->endSection(); ?>