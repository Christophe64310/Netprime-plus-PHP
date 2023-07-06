<?php 


// On commence par inclure le fichier autoload.php. Ce fichier se charge d'inclure toutes les classes téléchargées via composer.
require __DIR__.'/../vendor/autoload.php';


// On utilise la classe AltoRouter pour gérer nos routes. 
// On doit donc commencer par l'instancier

$router = new AltoRouter();

// On configure AltoRouter pour qu'il ne prenne pas en compte la partie fixe de l'url (le chemin vers notre dossier)
//! ATTENTION, si la partie fixe (BASE_URI) contient des caractères spéciaux ou des espaces, AltoRouter ne fonctionne pas ! 
$router->setBasePath($_SERVER['BASE_URI']);


// On crée notre routeur dans lequel on fait l'association entre une URL et une méthode d'un controller.

// On crée une route pour la page d'accueil
$router->map(
    'GET',  // Méthode HTTP de la requete (get ou post)
    '/',  // url de la route (/ = home)
    // Tableau contenant le controller et la méthode liée à la page
    [    
        'controller' => 'MainController',
        'method' => 'homeAction'
    ],
    'home'
);


// On crée une route pour la page de résultats de recherche
$router->map(
    'GET',
    '/results',
    [
        'controller' => 'MainController',
        'method' => 'searchAction'
    ],
    'search'
);


// La méthode match permet à AltoRouter de savoir si la page demandée existe dans la liste des routes
// $match contient un tableau avec les informations de la route actuelle (controller, méthode, nom, etc)
// Si la route actuelle n'existe pas, $match contient false
$match = $router->match();

// Décommenter la ligne suivante pour voir le contenu de $match
// dump($match);


// ---- DISPATCHER ----- 
// On vérifie que la page demandée fait partie des routes existantes. Si $match ne contient pas false, on est sur une route existante
if($match !== false) {
  
    // On récupère le nom du controller dans lequel est rangé notre méthode qui gère la page demandée
    $controllerToUse = 'App\Controllers\\' . $match['target']['controller'];

    // On récupère dans le tableau des routes le nom de la méthode à exécuter. 
    $methodToUse = $match['target']['method'];


    // On récupère les paramètres dynamiques de l'url (exemple : id)
    $params = $match['params'];

    // On instancie le controller dans lequel est rangé la méthode
    // Si $controllerToUse contient "MainController", ça revient à écrire "new MainController()"
    $controller = new $controllerToUse();

    // On utilise la variable $methodToUse pour exécuter la méthode de controller dont le nom est stocké dedans.
    // Si  $methodToUse contient "homeAction", c'est comme si on écrivait "$controller->homeAction($params)"
    $controller->$methodToUse($params);

} else {
    echo "Erreur 404 - la page n'existe pas";
}