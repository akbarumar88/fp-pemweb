<!-- <h3 class="mb-4">Hasil Pencarian untuk</h3> -->
<?php

$tglrilisObj = new DateTime($movie['tglrilis']);
$tglRilis = $tglrilisObj->format("M d, Y");

?>

<?php if (!empty($movie['kualitas'])) : ?>
    <div class="row">
        <div class="col">
            <iframe id="videoplayer" src="<?= $movie['kualitas'][0]['url']  ?>" width="100%" height="640" allow="autoplay" allowfullscreen frameborder="0"></iframe>
        </div>
    </div>

    <!-- Kualitas Film -->
    <div class="dropdown mt-2 mb-2">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownKualitas" data-toggle="dropdown" aria-expanded="false">
            <?= $movie['kualitas'][0]['kualitas'] ?>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownKualitas">
            <?php foreach ($movie['kualitas'] as $qu) : ?>
                <button class="dropdown-item" data-value="<?= $qu['url'] ?>" type="button"><?= $qu['kualitas'] ?></button>
            <?php endforeach; ?>
        </div>
    </div>
<?php else : ?>
    <h2>Mohon maaf, film ini masih sedang dalam proses. Tim MOOVEE akan menyelesaikannya sesegera mungkin.</h2>
<?php endif; ?>

<h2 class="mt-4"><?= $movie['judul'] ?></h2>
<p>Released on <?= $tglRilis ?></p>
<p class=""><?= $movie['sinopsis'] ?></p>

<h2 class="mt-4">Informasi Film</h2>