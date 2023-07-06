<header class="home-header">
        <h1 class="logo">NetPrime <span>+</span></h1>
        <p class="subtitle">Tous vos films, depuis votre canapé !</p>
</header>
<section>
    <form class="home-search searchbar" action="<?= $router->generate('search') ?>">
        <label for="search">Rechercher un film</label>
        <div class="search-container">
            <input placeholder="Exemple : Le voyage de Chihiro" type="text" name="search" id="search">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </form>
</section>