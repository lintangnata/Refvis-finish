<?= $this->extend('layout/user'); ?>
<?= $this->section('body'); ?>

<?php

use App\Models\UserModel;

$UserModel = new UserModel();

$session = \Config\Services::session();

?>

<div class="container form-login mt-5">
    <div class="row">
        <div class="col-8">
            <div class="row">
                <div class="col-1 d-flex justify-content-end">
                    <img src="/user_pp/<?= $uploader['foto']; ?>" alt="" class="foto-profil" onclick="redirectToPage('/profile/<?= $uploader['id_user'] ?>')">
                </div>
                <div class="col-11">
                    <h5 onclick="redirectToPage('/profile/<?= $uploader['id_user'] ?>')"><?= $uploader['username']; ?></h5>
                </div>
            </div>

            <div class="row ms-2 mt-3">
                <h1><?= $foto['judul']; ?></h1>
                <h5><?= $foto['desk']; ?></h5>
            </div>

            <div class="row ms-2 mt-3">
                <?php if ($liked) : ?>
                    <div class="col-1 d-flex justify-content-center">
                        <form action="/foto/unlike/<?= $foto['id_foto']; ?>" method="post">
                            <button class="btn-foto fa-solid fa-heart fa-xl" style="color: red;"></button>
                        </form>
                    </div>
                <?php else : ?>
                    <div class="col-1 d-flex justify-content-center">
                        <form action="/foto/like/<?= $foto['id_foto']; ?>" method="post">
                            <button class="btn-foto fa-solid fa-heart fa-xl" style="color: black;"></button>
                        </form>
                    </div>
                <?php endif; ?>
                
                <div class="col-1 d-flex justify-content-center">
                        <form action="/foto/download/<?= $foto['id_foto']; ?>" method="post">
                            <button class="btn-foto fa-solid fa-download fa-xl" style="color: black;"></button>
                        </form>
                </div>
                
                <?php if ($userTake == $foto['id_user']) : ?>
                    <div class="col-1 d-flex justify-content-center">
                        <button class="btn-foto fa-solid fa-bookmark fa-xl" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"></button>
                    </div>
                <?php endif; ?>
                
                <?php if ($userTake == $foto['id_user']) : ?>
                    <div class="col-1 d-flex justify-content-center">
                        <form action="/foto/edit/<?= $foto['id_foto']; ?>" method="post">
                            <button class="btn-foto fa-solid fa-pen fa-xl fa-xl"></button>
                        </form>
                    </div>
                <?php endif; ?>
                <?php if ($userTake == $foto['id_user']) : ?>
                    <div class="col-1 d-flex justify-content-center">
                        <form action="/foto/delete/<?= $foto['id_foto']; ?>" method="post" id="deleteForm" onsubmit="return confirm('Hapus Postingan Ini?');">
                            <button class="btn-foto fa-solid fa-trash fa-xl"></button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>

            <div class="row ms-2 mt-1">
                <div class="col-1">
                    <p class="text-center"><?= $jumlahLike ?> Like</p>
                </div>
                
                <div class="col-1">
                    <p class="text-center">Unduh</p>
                </div>
                
                <?php if ($userTake == $foto['id_user']) : ?>
                <div class="col-1">
                    <p class="text-center">Album</p>
                </div>
                <?php endif; ?>
            </div>

            <div class="row ms-2 mt-3">
                <div class="col-12">
                    <h5>Komentar</h5>
                </div>
            </div>

            <div class="row ms-2">
                <div class="scroll-foto">
                    <?php foreach ($komen as $k) : ?>
                        <?php $user = $UserModel->where('id_user', $k['id_user'])->first(); ?>
                        <div class="row">
                            <div class="col-1 d-flex justify-content-end">
                                <img src="/user_pp/<?= $user['foto']; ?>" alt="" class="foto-profil" onclick="redirectToPage('/profile/<?= $user['id_user'] ?>')">
                            </div>
                            <div class="col-11">
                                <div class="row">
                                    <h5 onclick="redirectToPage('/profile/<?= $user['id_user'] ?>')"><?= $user['username']; ?> :</h5>
                                </div>
                                <div class="row">
                                    <h5><?= $k['isi_komen']; ?></h5>
                                </div>
                                <?php if ($k['id_user'] == session()->get('id_user')) : ?>
                                    <div class="row">
                                        <form action="/komentar/delete/<?= $k['id_komen']; ?>" method="post" onsubmit="return confirm('Hapus Komentar Ini?');">
                                            <button class="btn-foto" style="color: red;" type="submit">Delete Komentar</button>
                                        </form>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <form action="/komentar/save/<?= $foto['id_foto']; ?>" method="post" enctype="multipart/form-data">
                <div class="row ms-2 mt-3">
                    <div class="col-9">
                        <input type="text" class="form-control" name="komentar" placeholder="Tulis Komentar">
                    </div>
                    <div class="col-3">
                        <button class="btn btn-primary">Kirim</button>
                    </div>
                </div>
            </form>
        </div>
        
        <div class="col-4 d-flex justify-content-center">
            <img src="/foto_storage/<?= $foto['foto']; ?>" alt="" class="foto-foto">
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">BUAT ALBUM BARU</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="/album/saveto/<?= $foto['id_foto']; ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-2">
                            <label for="saveto" class="form-label text-white">Tambahkan Ke Album</label>
                            <select class="form-select" aria-label="Default select example" id="saveto" name="saveto">
                                <option selected disabled>Pilih Album :</option>
                                <?php foreach ($albumAdd as $a) : ?>
                                    <option value="<?= $a['id_album']; ?>"><?= $a['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mb-3">Submit</button>
                    </form>
                </div>
                <div class="container">
                    <form action="/album/delfrom/<?= $foto['id_foto']; ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-2">
                            <label for="delfrom" class="form-label text-white">Hapus Dari Album</label>
                            <select class="form-select" aria-label="Default select example" id="delfrom" name="delfrom">
                                <option selected disabled>Pilih Album :</option>
                                <?php foreach ($albumDel as $d) : ?>
                                    <option value="<?= $d['id_album']; ?>"><?= $d['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mb-3">Submit</button>
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
<script src="https://kit.fontawesome.com/9b5ad81b89.js" crossorigin="anonymous"></script>

</div <?= $this->endSection(); ?>