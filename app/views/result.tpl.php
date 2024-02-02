<h1 class="result-title"><?= $title ?> <span><?= $search ?></span></h1>
<section class="results">
    <?php foreach($movies as $movie) : ?>
        <a href="<?= $router->generate('movie', ['id' => $movie->getId()]) ?>" class="movie-result">
            <img src="<?= $movie->getPoster() ?>" alt="<?= $movie->getTitle() ?>">
            <h3>
                <?= $movie->getTitle() ?>
            </h3>
        </a>
    <?php endforeach; ?>

</section>