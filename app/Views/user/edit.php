<?= $this->extend('layout/user'); ?>
<?= $this->section('body'); ?>

<?php

use App\Models\UserModel;

$UserModel = new UserModel();

$session = \Config\Services::session();

?>

<div class="container form-login mt-5">
    <div class="row">
        <div class="col-4 d-flex justify-content-center">
            <img src="/foto_storage/<?= $foto['foto']; ?>" alt="" class="foto-foto">
        </div>
        <div class="col-8">
            <div class="row">
                <div class="col-1 d-flex justify-content-end">
                    <img src="/assets/img/<?= $uploader['foto']; ?>" alt="" class="foto-profil">
                </div>
                <div class="col-11">
                    <h5><?= $uploader['username']; ?></h5>
                </div>
            </div>
            <form action="/foto/update/<?= $foto['id_foto']; ?>" method="post" enctype="multipart/form-data">
                <div class="row mt-3">
                    <div class="col-12 mb-2">
                        <label for="exampleFormControlInput1" class="form-label" required>Judul Foto</label>
                        <input type="text" name="judul" class="form-control" value="<?= $foto['judul']; ?>">
                    </div>
                    <div class="col-12 mb-2">
                        <label for="exampleFormControlInput1" class="form-label" required>Deskripsi Foto</label>
                        <textarea name="desk" class="form-control"><?= $foto['desk']; ?></textarea>
                    </div>
                    <div class="col-12 mb-2">
                        <label for="exampleFormControlInput1" class="form-label">Kategori</label>
                        <select class="form-select" aria-label="Default select example" id="kategori" name="kategori" required>
                            <option selected disabled>Pilih Kategori</option>
                            <option <?php if ($foto['kategori'] == 1) echo 'selected'; ?> value="1">Karya</option>
                            <option <?php if ($foto['kategori'] == 2) echo 'selected'; ?> value="2">Desain</option>
                            <option <?php if ($foto['kategori'] == 3) echo 'selected'; ?> value="3">Anime</option>
                            <option <?php if ($foto['kategori'] == 4) echo 'selected'; ?> value="4">Cars</option>
                            <option <?php if ($foto['kategori'] == 5) echo 'selected'; ?> value="5">Games</option>
                            <option <?php if ($foto['kategori'] == 6) echo 'selected'; ?> value="6">Movies</option>
                            <option <?php if ($foto['kategori'] == 7) echo 'selected'; ?> value="7">Nature</option>
                            <option <?php if ($foto['kategori'] == 8) echo 'selected'; ?> value="8">Outfit</option>
                            <option <?php if ($foto['kategori'] == 9) echo 'selected'; ?> value="9">Sports</option>
                            <option <?php if ($foto['kategori'] == 10) echo 'selected'; ?> value="10">Technology</option>
                            <option <?php if ($foto['kategori'] == 11) echo 'selected'; ?> value="11">Travel</option>
                            <option <?php if ($foto['kategori'] == 12) echo 'selected'; ?> value="12">Aesthetic</option>
                            <option <?php if ($foto['kategori'] == 13) echo 'selected'; ?> value="13">Food</option>
                            <option <?php if ($foto['kategori'] == 14) echo 'selected'; ?> value="14">Quotes</option>
                            <option <?php if ($foto['kategori'] == 15) echo 'selected'; ?> value="15">Music</option>
                            <option <?php if ($foto['kategori'] == 16) echo 'selected'; ?> value="16">Others</option>
                        </select>
                    </div>
                    <div class="col-12 mb-2">
                        <label for="exampleFormControlInput1" class="form-label" required>Ganti Foto</label>
                        <input type="file" name="foto" class="form-control" value="<?= $foto['foto']; ?>">
                    </div>

                    <div class="col-12 mb-2">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="/assets/js/onclick.js"></script>
<script src="https://kit.fontawesome.com/9b5ad81b89.js" crossorigin="anonymous"></script>

</div <?= $this->endSection(); ?>