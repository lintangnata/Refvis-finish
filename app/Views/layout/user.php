<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refvis</title>
    <link rel="stylesheet" href="/assets/css/user.css">
    <link rel="stylesheet" href="/assets/css/grids.css">
    <link rel="stylesheet" href="/assets/css/foto.css">
    <link rel="stylesheet" href="/assets/css/profile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <img src="/assets/img/refvis.png" alt="logo" width="40" height="40" class="d-inline-block align-text-top">
            <a class="navbar-brand" href="/home">REFVIS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item me-2">
                    <form class="d-flex" role="search" action="/search" method="post" enctype="multipart/form-data">
                        <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn-nav" type="submit">Search</button>
                    </form>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item me-2">
                    <button class="btn-nav" type="button" onclick="redirectToPage('/home')">Home</button>
                </li>
                <li class="nav-item me-2">
                    <button class="btn-nav" type="button" onclick="redirectToPage('/create')">Create</button>
                </li>
                <li class="nav-item">
                    <button class="btn-prof" type="button" onclick="redirectToPage('/profile/<?= $user['id_user'] ?>')"><img src="/user_pp/<?= $user['foto'] ?>" alt="foto" width="40" height="40" class="d-inline-block align-text-top rounded-circle"></button>
                </li>
            </ul>
            </div>
        </div>
    </nav>

    <?php $this->renderSection('body') ?>

    <script src="/assets/js/onclick.js"></script>

</body>

</html>