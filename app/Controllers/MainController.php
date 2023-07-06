<?php

namespace App\Controllers;

use App\Controllers\CoreController;

class MainController extends CoreController {

    /**
     * Méthode qui se charge d'afficher la page d'accueil
     *
     * @return void
     */
    public function homeAction()
    {
        $this->show('home');
    }

    /**
     * Méthode qui se charge d'afficher la page de résultats de recherche
     *
     * @return void
     */
    public function searchAction()
    {
        $this->show('result');
    }



}