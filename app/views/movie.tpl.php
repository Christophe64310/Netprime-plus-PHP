<div class="movie-wrapper">

<section class="poster">
    <img src="<?= $movie->getPoster() ?>" alt="<?= $movie->getTitle() ?>">
    <i class="fa-regular fa-circle-play"></i>
</section>
<section class="details">
    <h1 class="movie-title"><?= $movie->getTitle() ?></h1>
    <div class="movie-meta">
        <div class="date"><?= $movie->getYear() ?></div>
        <div class="rating"><i class="fa-solid fa-star"></i> <span><?= $movie->getRating() ?></span> / 10</div>
    </div>
    <div class="movie-synopsis">
        <?= $movie->getSynopsis() ?>
    </div>
    <div class="crew">
        <?php if($director): ?>
            <div class="real">
                <a href="<?= $router->generate('director', ['id' => $director->getId()]) ?>">
                    <h2><i class="fa-solid fa-film"></i> Réalisateur</h2>
                    <img src="<?= $director->getPicture() ?>" alt="<?= $director->getName() ?>">
                    <h3><?= $director->getName() ?></h3>
                </a>
            </div>
        <?php endif; ?>
        <?php if($composer): ?>
            <div class="composer">
                <a href="<?= $router->generate('composer', ['id' => $composer->getId()]) ?>">
                    <h2><i class="fa-solid fa-music"></i> Compositeur</h2>
                    <img src="<?= $composer->getPicture() ?>" alt="<?= $composer->getName() ?>">
                    <h3><?= $composer->getName() ?></h3>
                </a>
            </div>
        <?php endif; ?>
    </div>
    <?php if($actors): ?>
    <div class="actors">
        <h2><i class="fa-solid fa-clapperboard"></i> Acteurs</h2>
        <ul>
            <?php foreach($actors as $actor): ?>
                <?php if($actor->getPictureUrl() !== null) : ?>
                <li>
                    <a href="<?= $router->generate('actor', ['id' => $actor->getId()]) ?>">
                        
                        <img src="<?= $actor->getPicture() ?>" alt="<?= $actor->getName() ?>">
                        <h3><?= $actor->getName() ?></h3>
                        
                    </a>
                </li>
                <?php endif ?>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>
</section>
</div>