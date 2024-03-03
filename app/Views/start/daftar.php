<?= $this->extend('layout/start'); ?>
<?= $this->section('body'); ?>

<div class="container form-login mt-5">
    <h1 class="text-center">REGISTER</h1>
    <form action="/auth/valid_register" class="signup-form" method="post">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" placeholder="Nama">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Email">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Alamat</label>
            <input type="text" name="alamat" class="form-control" placeholder="Alamat">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Username">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label" placeholder="Password">Password</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label" placeholder="Password">Konfirmasi Password</label>
            <input type="password" name="confirm" class="form-control">
        </div>
        <div class="d-grid gap-2">
            <button class="btn btn-primary" type="submit">Daftar</button>
        </div>
    </form>
    <div class="text-center mt-3">
        <a href="/login">Sudah punya akun? Login disini</a>
    </div>
</div>

<script src="/assets/js/onclick.js"></script>

</div <?= $this->endSection(); ?>