<?= $this->extend('layout/start'); ?>
<?= $this->section('body'); ?>

<div class="container d-flex justify-content-center mt-2">
    <h1>Wellcome To Refvis</h1>
</div>

<div class="gridds mt-2">
    <?php foreach ($foto as $f) : ?>
        <div class="box">
            <img src="/foto_storage/<?= $f['foto']; ?>" alt="">
        </div>
    <?php endforeach; ?>
</div>

<script src="/assets/js/onclick.js"></script>

</div <?= $this->endSection(); ?>