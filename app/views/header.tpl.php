<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NetPrime +</title>
    <link rel="stylesheet" href="<?= $absoluteUrl ?>/css/reset.css">
    <link rel="stylesheet" href="<?= $absoluteUrl ?>/css/fontawesome/css/fontawesome.css">
    <link rel="stylesheet" href="<?= $absoluteUrl ?>/css/fontawesome/css/solid.css">
    <link rel="stylesheet" href="<?= $absoluteUrl ?>/css/style.css">
</head>

<?php

$style = ""; 

if(isset($movie)) {
    $style = "background-image: var(--gradient),  url(" . $movie->getBackground() . ")";
}
?>
<body class="<?= $viewName ?>" style="<?= $style ?>" >
    <header class="classic-header">
        <a href="<?= $router->generate('home') ?>">
            <p class="logo">NetPrime <span>+</span></p>
        </a>
        <form class="searchbar" action="<?= $router->generate('search') ?>">
            <label for="search">Rechercher un film</label>
            <div class="search-container">
                <input placeholder="Exemple : Le voyage de Chihiro" type="text" name="search" id="search">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </form>
    </header>
    <main>
        <div class="container">