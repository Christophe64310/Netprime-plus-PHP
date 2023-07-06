# NetPrime +

NetPrime + est une future plateforme de VOD (Video On Demand) qui permettra de visionner des films en streaming. Elle se veut innovante et simple d'utilisation.
Elle s'axe autour d'un champ de recherche hyper puissant qui permettra à nos clients de trouver facilement les films qu'ils souhaitent visionner.
Le projet est déjà bien avancé et nous avons déjà l'intégration de faite, ainsi que la base de données. Un début d'architecture MVC est déjà en place, que tu devras compléter.

## Installation

1. Cloner le projet
2. Installer les dépendances avec `composer install`
3. Importer la base de données `docs/database.sql`
4. Créer le fichier `app/config.ini` à partir du fichier `app/config.ini.dist` et le compléter avec les informations de connexion à la base de données

## Ce qui est déjà fait

Actuellement, deux pages sont incorporées à l'architecture MVC :

- La page d'accueil
- Le résultat de la recherche

Ces pages sont pour l'instant **statiques**, c'est à dire que les données sont inscrites en dur dans le code HTML. Il te faudra donc les rendre dynamiques en utilisant les données de la base de données.

## Etape 1 : créer les models

Pour commencer, il te faudra créer les models qui permettront de récupérer les données de la base de données.

Pour cela, tu devras créer les classes suivantes :

- `Movie` : qui permettra de récupérer les informations d'un film
- `People` : qui permettra de récupérer les informations d'une personne

Pour savoir quelles propriétés doivent être présentes dans ces classes, il te faudra regarder la structure de la base de données. Pour t'aider, tu as un **dictionnaire de données** et un **MCD** dans le dossier `docs`.

> ⚠️ **Attention** ⚠️, les propriétés des classes doivent s'appeler **exactement** comme les champs de la base de données.

## Etape 2 : la recherche

La page d'accueil contient un champ de recherche qu'il faut maintenant rendre fonctionnel.
Pour cela, il faut faire en sorte que le formulaire de la page d'accueil envoie les données à la page de résultat de recherche.

La méthode de controller `searchAction` gérant la page de résultats est déjà créée, c'est donc dans cette méthode que tu devras récupérer les données du formulaire avec `$_GET` ou `filter_input`.

Une fois les données récupérées, on doit pouvoir les utiliser pour récupérer les films correspondants à la recherche. Pour cela, il faut créer une méthode `searchByTitle` dans le model `Movie`.

Cette méthode devra retourner un tableau d'objets `Movie` correspondant aux films trouvés. Une fois ce tableau obtenu, il faut l'envoyer à la vue `views/result.tpl.php` qui s'occupera de l'afficher.

<details>
<summary>Indices</summary>

- Pour rechercher un film d'après une partie de son nom, il faut utiliser [la clause `LIKE`](https://sql.sh/cours/where/like) dans une requête SQL.

</details>

## Etape 3 : afficher les résultats

Une fois les films trouvés, il faut les afficher dans la page de résultats. Dans l'étape précédente, tu as déjà récupéré les films trouvés et tu les as envoyés à la vue `views/result.tpl.php`.

Il faut maintenant compléter cette vue pour qu'elle affiche les films trouvés. Actuellement, la page affiche une liste de films statiques. Il faut donc remplacer ces films statiques par les films trouvés.

> ℹ️ Seule une partie de l'url des images est stockée dans la base de données. Il faut ajouter le début de l'url pour que les images s'affichent correctement. Pour toutes les images, l'url de base est https://image.tmdb.org/t/p/original/

<details>
<summary>Indices</summary>

- Pour afficher les films trouvés, il faut utiliser une boucle `foreach` sur le tableau d'objets `Movie` obtenu grâce à la méthode `searchByTitle`.
- Utilise le code statique déjà présent dans la vue pour t'aider à afficher les films trouvés.
- Pour récupérer les infos d'un film, tu peux utiliser les getters de la classe `Movie`.
- Pour générer les liens des images, on peut concaténer la propriété `poster_url` avec l'url de base.

</details>

## Etape 4 : afficher les détails d'un film

La page de résultats affiche une liste de films trouvés. Il faut maintenant que l'utilisateur puisse cliquer sur un film pour voir les détails de celui-ci.

Dans un premier temps, on ne va afficher que les infos disponibles dans la table `movies` (donc pas les acteurs, réalisateurs, etc.). Tu trouveras une intégration de la page de détails dans le dossier `docs/integration-html-css/movie.html`.

Voici un petit plan pour cette étape : 

- Créer une route `/movie/{id}` qui permettra d'afficher la page de détails d'un film.
- Créer une méthode `movieAction` dans le controller `MainController` appelée par cette route.
- Modifier la vue `views/result.tpl.php` pour générer un lien vers la page de détails de chaque film.
- Créer une méthode `find` dans le model `Movie` qui permettra de récupérer un film d'après son id.
- Dans la méthode `movieAction`, récupérer le film d'après son id et l'envoyer à la vue `views/movie.tpl.php` (à créer).
- Compléter la vue `views/movie.tpl.php` pour afficher les infos du film.

<details>
<summary>Indices</summary>

- Pour créer le lien vers la page de détails du film, il faut utiliser la méthode `generate` de `$router` qui est disponible dans la vue.
- La méthode `find` de la classe `Movie` doit retourner un objet `Movie` correspondant au film trouvé.

</details>

<details>
<summary>Bonus image de fond</summary>

Si tu regardes attentivement l'intégration fournie, la page d'un film possède une image de fond. Celle-ci est appliquée sur la balise `body`. 
Chaque film possède sa propre image de fond. Elle est stockée dans la base de données dans la colonne `background_url`.

Tu peux essayer d'ajouter cette image de fond à la page de détails d'un film. Pour cela, dans le template `views/header.tpl.php`, tu peux ajouter un attribut `style` à la balise `body` avec l'url de l'image de fond.

ℹ️**Astuce** : analyse le code CSS de la balise `body` pour voir comment l'image de fond est appliquée. Il y a **deux** valeurs dans la propriété `background-image`. Une pour le dégradé sombre dans les angles et une pour l'image. Il faudra reconstruire cette propriété en PHP en modifiant l'url de l'image.

Exemple de modification de CSS depuis PHP : 

```php
<body style="color: <?= $color ?>">
```

</details>


## Etape 5 : afficher les détails d'un film (suite)

Maintenant que la page de détails d'un film affiche les infos du film, il faut ajouter les infos du réalisateur et compositeur.

Pour cela, on va ajouter dans le model `Movie` une méthode `getDirector` et une méthode `getComposer` qui permettront de récupérer le réalisateur et le compositeur d'un film. Ces deux méthodes doivent retourner **un objet `People`**.

Une fois ces deux rôles récupérés, il faut les envoyer à la vue `views/movie.tpl.php` pour qu'ils soient affichés.

> ⚠️ Certains films ne possèdent pas de réalisateur ou de compositeur. Pense à ne les afficher que s'ils existent.

<details>
<summary>Indices</summary>

- Pour récupérer un réalisateur, il faut faire une requête SQL qui récupère un enregistrement de la table `people` d'après l'id du réalisateur du film.
- L'id du réalisateur est stocké dans la propriété `director_id` de l'objet `Movie` courant. 
- Même chose pour le compositeur, mais avec  la propriété `composer_id` de l'objet `Movie` courant.
- `$this` représente l'objet courant dans une méthode de classe.

</details>

## Bonus 1 : afficher les acteurs 

Maintenant que les infos du réalisateur et du compositeur sont affichées, il faut afficher les acteurs du film.

Pour cela, on va ajouter dans le model `Movie` une méthode `getActors` qui permettra de récupérer les acteurs d'un film. Cette méthode doit retourner **un tableau d'objets `People`**.

Pour savoir quels acteurs sont dans un film, il faut regarder dans la table `movie_actors` qui contient les relations entre les films et les personnes. Cette table contient une colonne `movie_id` qui contient l'id du film et une colonne `actor_id` qui contient l'id de la personne.

La méthode `getActors` doit donc faire une requête SQL qui récupère tous les enregistrements de la table `people` qui ont un id qui correspond à un `actor_id` de la table `movie_actors` pour le film courant.

<details>
<summary>Indices</summary>

- Pour récupérer les acteurs d'un film, [une jointure](https://sql.sh/cours/jointures/inner-join) peut être pratique :wink:
- Il faut récupérer des infos depuis la table `people` et y joindre les infos de la table `movie_actors`. On peut alors filtrer les résultats pour ne récupérer que les acteurs du film courant (dont le champ `movie_id` vaut l'id du film courant).
- La table de jointure `movie_actors` contient un champ `order` qui permet de savoir dans quel ordre afficher les acteurs. Il faut donc [trier](https://sql.sh/cours/order-by) les résultats de la requête SQL par ce champ.
- Le mot `order` est un mot réservé en SQL, pense à donc bien entourer le nom du champ par des backticks (`` ` ``) pour éviter les erreurs.

</details>

## Bonus 2 : films d'un acteur/réalisateur/compositeur

Pour aller plus loin, tu peux faire en sorte qu'au clic sur un acteur/réalisateur/compositeur, on affiche la liste des films dans lesquels il a joué.

### Pour les acteurs 

Pour cela, il faut ajouter dans le model `People` une méthode `moviesPlayedIn` qui permettra de récupérer les films d'un acteur. Cette méthode doit retourner **un tableau d'objets `Movie`**.

La requête SQL pour récupérer les films d'un acteur est la même que celle pour récupérer les acteurs d'un film, mais en inversant l'info récupérée (on récupérait des acteurs, maintenant on veut des films).

### Pour les réalisateurs et compositeurs

Pour les réalisateurs et compositeurs, il faut ajouter dans le model `People` une méthode `moviesDirected` et une méthode `moviesComposed` qui permettront de récupérer les films réalisés et composés par une personne. Ces deux méthodes doivent retourner **un tableau d'objets `Movie`**.

Pour récupérer les films réalisés par une personne, il faut faire une requête SQL qui récupère tous les enregistrements de la table `movie` qui ont  un `director_id` qui correspond à l'id du réalisateur. Pour le compositeur, il faut faire la même chose mais avec la colonne `composer_id`.