# Dictionnaire de données

## Filmes (table `movies`)

Contient la liste des films et leurs caractéristiques.

| Nom | Type | Description |
| --- | --- | --- |
| id | INT | Identifiant unique du film |
| title | VARCHAR(255) | Titre du film |
| synopsis | TEXT | Synopsis du film |
| release_date | date | Date de sortie du film |
| rating | FLOAT | Note du film sur 10 |
| poster_url | VARCHAR(255) | URL de l'affiche du film |
| backdrop_url | VARCHAR(255) | URL de l'image de fond du film |
| director_id | INT | Identifiant du réalisateur du film |
| composer_id | INT | Identifiant du compositeur du film |

## Personnes (table `people`)

Contient la liste des personnes intervenant sur les films (acteurs, réalisateurs, compositeurs) et leurs caractéristiques.

| Nom | Type | Description |
| --- | --- | --- |
| id | INT | Identifiant unique de la personne |
| name | VARCHAR(255) | Nom de la personne |
| picture_url | VARCHAR(255) | URL de la photo de la personne |

## Liaison entre les films et les acteurs (table `movie_actors`)

Table de liaison entre les films et les acteurs. Permet de savoir quels acteurs ont joué dans quel film.

| Nom | Type | Description |
| --- | --- | --- |
| actor_id | INT | Identifiant de l'acteur |
| movie_id | INT | Identifiant du film |
| order | INT | Ordre d'apparition de l'acteur dans le film |