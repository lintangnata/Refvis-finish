<?= $this->extend('layout/start'); ?>
<?= $this->section('body'); ?>

<div class="container form-login mt-5">
    <h1 class="text-center">LOGIN</h1>
    <form action="/auth/lupapw" class="signup-form" method="post">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Email">
        </div>
        <div class="d-grid gap-2">
            <button class="btn btn-primary" type="submit">Reset Pw</button>
        </div>
    </form>
</div>

<script src="/assets/js/onclick.js"></script>

</div <?= $this->endSection(); ?>