<?= $this->extend('layout/user'); ?>
<?= $this->section('body'); ?>

<h1 class="text-center mt-3">ALBUM : <?= $album['nama']; ?></h1>

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