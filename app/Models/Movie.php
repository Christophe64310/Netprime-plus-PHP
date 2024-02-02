<?php 

namespace App\Models;

use PDO;
use App\Utils\Database;

class Movie {

    /** 
     * Properties of the Movie class
     */
    private $id;
    private $title; 
    private $synopsis;
    private $release_date;
    private $rating;
    private $poster_url;
    private $background_url;
    private $director_id;
    private $composer_id;

     /**
     * Method to retrieve a Movie object based on its ID
     *
     * @param int $id ID of the movie to find
     * @return Movie
     */
    public function find($id)
    {
        // Connect to the database using our Database tool. It returns an instance of PDO connected to the database.
        $pdo = Database::getPDO();
            
        // SQL query
        $sql = "SELECT * FROM `movies`
        WHERE `id` = " . $id;

        // Execute the query using PDO
        $pdoStatement = $pdo->query($sql);

        // Fetch the result as a Movie object using fetchObject, which automatically instantiates the Movie class and fills the properties with the database information.
        $movie = $pdoStatement->fetchObject(Movie::class);

        return $movie;
    }

    /**
     * Method to retrieve a Movie object based on its title
     *
     * @param string $title Title or part of the movie title to find
     * @return Movie[]
     */
    public function searchByTitle($search)
    {
        $pdo = Database::getPDO();

        // SQL query using LIKE to search for any movie whose title contains the string passed as a parameter
        $sql = "SELECT * FROM `movies`
        WHERE `title` LIKE '%" . $search . "%'";

        $pdoStatement = $pdo->query($sql);

        // Fetch the result as an array of Movie objects using fetchAll, which automatically instantiates the Movie class and fills the properties with the database information.
        $movies = $pdoStatement->fetchAll(PDO::FETCH_CLASS, Movie::class);

        return $movies;
    }
    
    /**
     * Method to retrieve a People object representing the movie director
     * 
     * @return People
     */
    public function getDirector()
    {
        $director = new People();
        $director = $director->find($this->director_id);

        return $director;
    }

    /**
     * Method to retrieve a People object representing the movie composer
     * 
     * @return People
     */
    public function getComposer()
    {
        $composer = new People();
        $composer = $composer->find($this->composer_id);

        return $composer;
    }

    /** 
     * Method to retrieve a list of People objects representing the movie actors
     *
     * @return People[]
     */
    public function getActors()
    {
        $pdo = Database::getPDO();

        // SQL query that retrieves the actors who played in the movie using the `movie_actors` pivot table.
        $sql = "SELECT `people`.*
        FROM `people`
        JOIN `movie_actors` ON `people`.`id` = `movie_actors`.`actor_id`
        WHERE `movie_id` = " . $this->id;

        $pdoStatement = $pdo->query($sql);

        // Fetch an array of People objects
        $actors = $pdoStatement->fetchAll(PDO::FETCH_CLASS, People::class);

        return $actors;
    }

    /**
     * Method to retrieve the year of the movie based on its release date
    */
    public function getYear()
    {
        $year = date('Y', strtotime($this->release_date));

        return $year;
    }

    /**
     * Method generating a URL to display the movie poster
     */ 
    public function getPoster()
    {
        return "https://image.tmdb.org/t/p/original" . $this->poster_url;
    }

    /**
     * Method generating a URL to display the movie background image
     */
    public function getBackground()
    {
        return "https://image.tmdb.org/t/p/original". $this->background_url;
    }

    /**
     * Getters and setters
     */
    public function getId()
    {
        return $this->id;
    }
    

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of synopsis
     */ 
    public function getSynopsis()
    {
        return $this->synopsis;
    }

    /**
     * Set the value of synopsis
     *
     * @return  self
     */ 
    public function setSynopsis($synopsis)
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    /**
     * Get the value of release_date
     */ 
    public function getReleaseDate()
    {
        return $this->release_date;
    }

    /**
     * Set the value of release_date
     *
     * @return  self
     */ 
    public function setReleaseDate($releaseDate)
    {
        $this->release_date = $releaseDate;

        return $this;
    }

    /**
     * Get the value of rating
     */ 
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set the value of rating
     *
     * @return  self
     */ 
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get the value of poster_url
     */ 
    public function getPosterUrl()
    {
        return  $this->poster_url;
    }

    /**
     * Set the value of poster_url
     *
     * @return  self
     */ 
    public function setPosterUrl($posterUrl)
    {
        $this->poster_url = $posterUrl;

        return $this;
    }

    /**
     * Get the value of background_url
     */
    public function getBackgroundUrl()
    {
        return $this->background_url;
    }

    /**
     * Set the value of background_url
     *
     * @return  self
     */ 
    public function setBackgroundUrl($backgroundUrl)
    {
        $this->background_url = $backgroundUrl;

        return $this;
    }

    /**
     * Get the value of director_id
     */ 
    public function getDirectorId()
    {
        return $this->director_id;
    }

    /**
     * Set the value of director_id
     *
     * @return  self
     */ 
    public function setDirectorId($directorId)
    {
        $this->director_id = $directorId;

        return $this;
    }

    /**
     * Get the value of composer_id
     */ 
    public function getComposerId()
    {
        return $this->composer_id;
    }

    /**
     * Set the value of composer_id
     *
     * @return  self
     */ 
    public function setComposerId($composerId)
    {
        $this->composer_id = $composerId;

        return $this;
    }
}
