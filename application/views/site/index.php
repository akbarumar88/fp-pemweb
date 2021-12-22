<h3 class="mb-4">Latest Aired</h3>

<div class="row row-cols-lg-5 row-cols-md-4 row-cols-sm-3 row-cols-2">
    <?php foreach ($movies as $movie) :  ?>
        <div class="col px-2 mb-4">
            <a href="">
                <img width="100%" style="height:300px !important" src="<?= base_url('img/thumbnails/'.$movie['id'].'.jpg') ?>" class="img-thumbnail rounded" alt="...">
                <h6 class="text-center"><?= limit($movie['judul'], 7) ?></h6>
            </a>
        </div>
    <?php endforeach; ?>
</div>