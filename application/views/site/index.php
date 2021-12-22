<h3 class="mb-4">Latest Aired</h3>

<div class="row row-cols-sm-5">
    <?php foreach ($movies as $movie) :  ?>
        <div class="col-sm pr-2 pl-2">
            <a href="">
                <img width="100%" style="height:350px !important" src="<?= base_url('img/thumbnails/'.$movie['id'].'.jpg') ?>" class="img-thumbnail rounded" alt="...">
                <h6 class="text-center"><?= limit($movie['judul'], 7) ?></h6>
            </a>
        </div>
    <?php endforeach; ?>
</div>