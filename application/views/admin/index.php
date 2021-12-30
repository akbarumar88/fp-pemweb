<?php flash('succadd') ?>

<h3 class="mb-4">Daftar Film MOOVEE</h3>

<a class="btn btn-primary" href="<?= base_url('admin/addmovie') ?>" role="button"><i class="fas fa-plus"></i> Tambah Film</a>

<div class="mb-4"></div>
<div class="row row-cols-lg-12 row-cols-md-12 row-cols-sm-12 row-cols-12">
    <?php foreach ($movies as $movie) :  ?>
        <div class="col pr-0 mb-4">

            <a href="<?= base_url('admin/movie/' . $movie['id']) ?>">
                <div class="thumbnail-wrap">
                    <!-- Durasi -->
                    <div class="durasi py-1 px-2">
                        <i class="fas fa-clock"></i>
                        <b><?= $movie['durasi'] ?>m</b>
                    </div>
                    <!-- Rating -->
                    <div class="rating py-1 px-2">
                        <i class="fas fa-star"></i>
                        <b><?= $movie['rating'] ?></b>
                    </div>
                    <!-- HD Badge -->
                    <div class="hd py-1 px-2"><b>HD</b></div>
                    <!-- Image Overlay -->
                    <div class="overlay">
                        <i style="font-size: 48px;color:white" class="fas fa-play-circle"></i>
                    </div>
                    <img width="100%" style="height:150px !important;padding: 0" src="<?= base_url('img/thumbnails/' . $movie['id'] . '.jpg') ?>" class="img-thumbnail rounded" alt="...">
                </div>
                <p class="text-center mt-2"><?= limit($movie['judul'], 4) ?></p>
            </a>
        </div>
    <?php endforeach; ?>
</div>