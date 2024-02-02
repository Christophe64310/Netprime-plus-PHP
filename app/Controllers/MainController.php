<?php

namespace App\Controllers;

use App\Controllers\CoreController;
use App\Models\Movie;
use App\Models\People;

class MainController extends CoreController {

    /**
     * Method that displays the home page
     *
     * @return void
     */
    public function homeAction()
    {
        $this->show('home');
    }

    /**
     * Method that displays the search results page
     *
     * @return void
     */
    public function searchAction()
    {
        // Get the value of the search field
        $search = filter_input(INPUT_GET, 'search');

        // Get the movies corresponding to the search
        $movieModel = new Movie();
        $movies = $movieModel->searchByTitle($search);

        // Set the page title
        $title = "Search results for:";

        // Pass the movies to the view along with the search term
        $this->show('result', [
            'movies' => $movies,
            'search' => $search,
            'title' => $title
        ]);
    }


    /**
     * Method that displays the detail page of a movie
     *
     * @return void
     */
    public function movieAction($urlParams)
    {
        // Get the movie id
        $id = $urlParams['id'];

        // Get the movie corresponding to the id
        $movieModel = new Movie();
        $movie = $movieModel->find($id);

        // Get the director of the movie
        $director = $movie->getDirector();

        // Get the composer of the movie
        $composer = $movie->getComposer();

        // Bonus: get the actors of the movie
        $actors = $movie->getActors();

        // Pass the data to the view
        $this->show('movie', [
            'movie' => $movie,
            'director' => $director,
            'composer' => $composer,
            'actors' => $actors
        ]);
    }

    /**
     * Method that displays all movies of a director
     * 
     * @param array $urlParams
     * @return void
     */
    public function directorAction($urlParams)
    {
        // Get the director id
        $id = $urlParams['id'];

        // Get the director corresponding to the id
        $peopleModel = new People();
        $director = $peopleModel->find($id);

        // Get the movies of the director
        $movies = $director->getMoviesDirected();

        // Generate the page title
        $title = "Movies directed by ";

        // Store the name in a variable $search to use it in the page title
        $search = $director->getName();

        // Pass the data to the view
        // Since the arrangement is the same as the result page, we reuse the result view
        $this->show('result', [
            'director' => $director,
            'movies' => $movies,
            'title' => $title,
            'search' => $search
        ]);
    }

    /**
     * Method that displays all movies of a composer
     * 
     * @param array $urlParams
     * @return void
     */

    public function composerAction($urlParams)
    {
        // Get the composer id
        $id = $urlParams['id'];

        // Get the composer corresponding to the id
        $peopleModel = new People();
        $composer = $peopleModel->find($id);

        // Get the movies of the composer
        $movies = $composer->getMoviesComposed();

        // Generate the page title
        $title = "Movies composed by ";

        // Store the name in a variable $search to use it in the page title
        $search = $composer->getName();

        // Pass the data to the view
        // Since the arrangement is the same as the result page, we reuse the result view
        $this->show('result', [
            'composer' => $composer,
            'movies' => $movies,
            'title' => $title,
            'search' => $search
        ]);
    }

    /**
     * Method that displays all movies of an actor
     * 
     * @param array $urlParams
     * @return void
     */

    public function actorAction($urlParams)
    {
        // Get the actor id
        $id = $urlParams['id'];

        // Get the actor corresponding to the id
        $peopleModel = new People();
        $actor = $peopleModel->find($id);

        // Get the movies of the actor
        $movies = $actor->getMoviesPlayed();

        // Generate the page title
        $title = "Movies played by ";

        // Store the name in a variable $search to use it in the page title
        $search = $actor->getName();

        // Pass the data to the view
        // Since the arrangement is the same as the result page, we reuse the result view
        $this->show('result', [
            'actor' => $actor,
            'movies' => $movies,
            'title' => $title,
            'search' => $search
        ]);
    }
}
