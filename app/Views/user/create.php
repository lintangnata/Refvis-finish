<?= $this->extend('layout/user'); ?>
<?= $this->section('body'); ?>

<div class="container form-login mt-5">
    <h1 class="text-center">CREATE</h1>
    <form action="/create/save" class="signup-form" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label" required>Judul Foto</label>
            <input type="text" name="judul" class="form-control" placeholder="Judul Foto">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label" required>Deskripsi Foto</label>
            <textarea name="desk" class="form-control" placeholder="Deskripsi Foto"></textarea>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label" required>Foto</label>
            <input type="file" name="foto" class="form-control">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Kategori</label>
            <select class="form-select" aria-label="Default select example" id="kategori" name="kategori" required>
                        <option selected disabled>Pilih Kategori</option>
                        <option value="1">Karya</option>
                        <option value="2">Desain</option>
                        <option value="3">Anime</option>
                        <option value="4">Cars</option>
                        <option value="5">Games</option>
                        <option value="6">Movies</option>
                        <option value="7">Nature</option>
                        <option value="8">Outfit</option>
                        <option value="9">Sports</option>
                        <option value="10">Technology</option>
                        <option value="11">Travel</option>
                        <option value="12">Aesthetic</option>
                        <option value="13">Food</option>
                        <option value="14">Quotes</option>
                        <option value="15">Music</option>
                        <option value="16">Others</option>
                    </select>
        </div>
        <div class="d-grid gap-2">
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
    </form>
</div>

<script src="/assets/js/onclick.js"></script>

</div <?= $this->endSection(); ?>