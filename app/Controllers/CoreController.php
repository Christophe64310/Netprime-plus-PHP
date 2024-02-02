<?php

namespace App\Controllers;


// Cette classe sert de base aux autres controllers. Tous les controllers de ce projet étendent cette classe afin d'hériter de ses méthodes/propriétés.
class CoreController {

    /**
     * Fonction qui se charge d'afficher une page donnée
     *
     * @param string $viewName Nom du template de page à afficher
     * @param array $viewData Tableau contenant les différentes informations qu'on veut passer à notre vue
     * @return void
     */
    // Pour sécuriser encore plus notre code, on peut obliger les paramètres à avoir un certain type. Ici, en écrivant "array" devant $viewData, on oblige le 2ème paramètre à etre un tableau.
    public function show($viewName, array $viewData = [])
    {
       
        // On demande à PHP d'aller chercher la variable $router pour pouvoir l'utiliser dans nos templates.
        //! C'est une mauvaise pratique. Elle passe outre les différents principes mis en place avec notre architecture. Donc on verra plus tard comment procéder autrement.
        global $router;

        $absoluteUrl = $_SERVER['BASE_URI'];

        extract($viewData);

        require_once __DIR__ . '/../views/header.tpl.php';
        require_once __DIR__ . '/../views/' . $viewName . '.tpl.php';
        require_once __DIR__ . '/../views/footer.tpl.php';
    }
    
}