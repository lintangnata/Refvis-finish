<?= $this->extend('layout/user'); ?>
<?= $this->section('body'); ?>

<div class="container form-login mt-5">
    <h1 class="text-center">EDIT PROFILE</h1>
    <div class="container">
        <form action="/profile/save/<?= $user['id_user'] ?>" class="signup-form" method="post" enctype="multipart/form-data">
            <div class="row mt-2">
                <label for="exampleFormControlInput1" class="form-label" >Nama</label>
                <input type="text" name="nama" class="form-control" value="<?= $user['nama'] ?>">
            </div>
            <div class="row mt-2">
                <label for="exampleFormControlInput1" class="form-label" >Username</label>
                <input type="text" name="username" class="form-control" value="<?= $user['username'] ?>" disabled>
            </div>
            <div class="row mt-2">
                <label for="exampleFormControlInput1" class="form-label" >Email</label>
                <input type="text" name="email" class="form-control" value="<?= $user['email'] ?>">
            </div>
            <div class="row mt-2">
                <label for="exampleFormControlInput1" class="form-label" >Alamat</label>
                <input type="text" name="alamat" class="form-control" value="<?= $user['alamat'] ?>">
            </div>
            <!-- foto -->
            <div class="row mt-2">
                <label for="exampleFormControlInput1" class="form-label" >Foto Profile</label>
                <input type="file" name="foto" class="form-control">
            </div>
            <div class="row mt-2">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </div>
</div>

<script src="/assets/js/onclick.js"></script>

</div <?= $this->endSection(); ?>