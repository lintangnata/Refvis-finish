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
            <button class="prof-btn1" type="button" onclick="redirectToPage('/profile/<?= $userProfile['id_user'] ?>')">Album</button>
        </div>
        <div class="col-2">
            <button class="prof-btn1 actv" type="button" onclick="redirectToPage('/profile-like/<?= $userProfile['id_user'] ?>')">Like</button>
        </div>
        <div class="col-2">
            <button class="prof-btn1" type="button" onclick="redirectToPage('/profile-post/<?= $userProfile['id_user'] ?>')">Post</button>
        </div>
    </div>
</div>

<div class="gridds mt-5">
    <?php foreach ($foto as $f) : ?>
        <div class="box">
            <a href="/foto/<?= $f['id_foto']; ?>">
                <img src="/foto_storage/<?= $f['foto']; ?>" alt="">
            </a>
        </div>
    <?php endforeach; ?>
</div>

<script src="/assets/js/onclick.js"></script>

</div <?= $this->endSection(); ?>