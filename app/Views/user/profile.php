<?= $this->extend('layout/user'); ?>
<?= $this->section('body'); ?>

<div class="container mt-5">
    <img src="/user_pp/<?= $userProfile['foto'] ?>" alt="foto" width="150" height="150" class="rounded-circle d-flex justify-content-center mx-auto">
    <div class="row text-center">
        <h1><?= $userProfile['nama'] ?></h1>
    </div>
    <div class="row text-center">
        <h5>@<?= $userProfile['username'] ?></h5>
    </div>
    <div class="row text-center d-flex justify-content-center mx-auto mt-3">
    <?php if ($userTake == $userProfile['id_user']) : ?>
        <div class="col-2">
            <button class="prof-btn" type="button" onclick="redirectToPage('/editprofile/<?= $userProfile['id_user'] ?>')">Edit Profile</button>
        </div>
        <div class="col-2">
            <button class="prof-btn" type="button" onclick="redirectToPage('/logout')">logout</button>
        </div>
    <?php endif; ?>
    </div>
    <div class="row text-center d-flex justify-content-center mx-auto mt-3">
        <div class="col-2">
            <button class="prof-btn1 actv" type="button" onclick="redirectToPage('/profile/<?= $userProfile['id_user'] ?>')">Album</button>
        </div>
        <div class="col-2">
            <button class="prof-btn1" type="button" onclick="redirectToPage('/profile-like/<?= $userProfile['id_user'] ?>')">Like</button>
        </div>
        <div class="col-2">
            <button class="prof-btn1" type="button" onclick="redirectToPage('/profile-post/<?= $userProfile['id_user'] ?>')">Post</button>
        </div>
    </div>
    <div class="row text-center d-flex justify-content-center mx-auto mt-3">
    <?php if ($userTake == $userProfile['id_user']) : ?>
        <div class="col-2">
            <button class="prof-btn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Buat Album</button>
        </div>
    <?php endif; ?>
    </div>
</div>

<div class="gridds mt-5">
    <?php foreach ($album as $a) : ?>
        <div class="box">
            <a href="/album/<?= $a['id_album']; ?>">
                <img src="/album_cover/<?= $a['foto']; ?>" alt="">
            </a>
            <h5 class="text-center mt-3" >Album : <?= $a['nama']; ?></h5>
        </div>
    <?php endforeach; ?>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">BUAT ALBUM BARU</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="/album/create" class="signup-form" method="post" enctype="multipart/form-data">
                        <div class="row mt-2">
                            <label for="exampleFormControlInput1" class="form-label">Nama Album</label>
                            <input type="text" name="nama" class="form-control">
                        </div>
                        <div class="row mt-2">
                            <label for="exampleFormControlInput1" class="form-label">Deskripsi Album</label>
                            <input type="text" name="desk" class="form-control">
                        </div>
                        <div class="row mt-2">
                            <label for="exampleFormControlInput1" class="form-label">Foto Album</label>
                            <input type="file" name="foto" class="form-control">
                        </div>
                        <div class="row mt-2">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="/assets/js/onclick.js"></script>

</div <?= $this->endSection(); ?>