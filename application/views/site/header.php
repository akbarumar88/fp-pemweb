<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link rel="shortcut icon" href="<?= base_url('img/movie-icon-png.jpg') ?>" type="image/x-icon">
    <title>MOOVEE</title>
    <!-- Font Awesome Script -->
    <script src="https://kit.fontawesome.com/bc14fa0285.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="<?= base_url() ?>">MOOVEE</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Genre</a>
                    <div class="dropdown-menu">
                        <div class="" style="display:flex;flex-wrap:wrap;width:600px">
                            <?php foreach ($genres as $genre) : ?>
                                <a style="width:25%" class="dropdown-item" href="<?= base_url('site/search_genre/'.$genre['id']) ?>"><?= $genre['genre'] ?></a>
                            <?php endforeach; ?>
                        </div>
                        <div class="dropdown-divider"></div>
                    </div>
                </li>

                <?php if (!$this->session->has_userdata('id')): ?>
                    <li class="nav-item">
                        <a href="<?= base_url('auth/login') ?>" class="nav-link">Login</a>
                    </li>
    
                    <li class="nav-item">
                        <a href="<?= base_url('auth/register') ?>" class="nav-link">Register</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link"><?= $this->session->nama_lengkap ?></a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('auth/logout') ?>" class="nav-link">Logout</a>
                    </li>
                <?php endif; ?>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="<?= base_url('site/search')  ?>">
                <input class="form-control mr-sm-2" type="text" name="q" placeholder="Search" value="<?= $this->input->get('q') ?>" required>
                <button class="btn btn-danger my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <!-- Opening Tag Container -->
    <div class="container pt-5 pb-5">