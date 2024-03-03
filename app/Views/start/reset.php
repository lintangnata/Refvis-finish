<?= $this->extend('layout/start'); ?>
<?= $this->section('body'); ?>

<div class="container form-login mt-5">
    <h1 class="text-center">LOGIN</h1>
    <form action="/auth/newpw" class="signup-form" method="post">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Konfirmasi Password</label>
            <input type="password" name="confirm" class="form-control" placeholder="Konfirmasi Password">
        </div>
        <div class="d-grid gap-2">
            <button class="btn btn-primary" type="submit">Reset Pw</button>
        </div>
    </form>
</div>

<script src="/assets/js/onclick.js"></script>

</div <?= $this->endSection(); ?>