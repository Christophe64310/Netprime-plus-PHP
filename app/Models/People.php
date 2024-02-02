<?php

namespace App\Models;

use PDO;
use App\Utils\Database;

class People
{
    /**
     * Class People Properties
     */
    private $id;
    private $name;
    private $picture_url;

    /**
     * Methods of the People class
     */

    /**
    * Method to retrieve a People object based on its ID
    *
    * @param int $id ID of the person to find
    * @return People
    */
    public function find($id)
    {
        // If the ID does not exist, we stop everything
        if($id === null) {
            return false;
        }

        // Connect to the database using our Database tool. It returns an instance of PDO connected to the database.
        $pdo = Database::getPDO();

        // SQL query
        $sql = "SELECT * FROM `people`
        WHERE `id` = " . $id;

        // Execute the query using PDO
        $pdoStatement = $pdo->query($sql);

        // Fetch the result as a People object using fetchObject, which automatically instantiates the People class and fills the properties with the database information.
        $people = $pdoStatement->fetchObject(People::class);

        return $people;
    }

    /**
     * Method to retrieve all movies directed by the current person.
     *
     * @return Movie[]
     */
    public function getMoviesDirected()
    {
        // Connect to the database using our Database tool. It returns an instance of PDO connected to the database.
        $pdo = Database::getPDO();

        // SQL query retrieving all movies where the director is the current person
        $sql = "SELECT * FROM `movies`
        WHERE `director_id` = " . $this->id;

        // Execute the query using PDO
        $pdoStatement = $pdo->query($sql);

        // Fetch the result as an array of Movie objects using fetchAll, which automatically instantiates the Movie class and fills the properties with the database information.
        $movies = $pdoStatement->fetchAll(PDO::FETCH_CLASS, Movie::class);

        return $movies;
    }

    /**
     * Method to retrieve all movies composed by the current person.
     *
     * @return Movie[]
     */
    public function getMoviesComposed()
    {
        // Connect to the database using our Database tool. It returns an instance of PDO connected to the database.
        $pdo = Database::getPDO();

        // SQL query retrieving all movies where the composer is the current person
        $sql = "SELECT * FROM `movies`
            WHERE `composer_id` = " . $this->id;

        // Execute the query using PDO
        $pdoStatement = $pdo->query($sql);

        // Fetch the result as an array of Movie objects using fetchAll, which automatically instantiates the Movie class and fills the properties with the database information.
        $movies = $pdoStatement->fetchAll(PDO::FETCH_CLASS, Movie::class);

        return $movies;
    }

    /**
     * Method to retrieve all movies played by the current person.
     *
     * @return Movie[]
     */
    public function getMoviesPlayed()
    {
        // Connect to the database using our Database tool. It returns an instance of PDO connected to the database.
        $pdo = Database::getPDO();

        // SQL query retrieving all movies where the actor is the current person
        $sql = "SELECT * FROM `movies`
            INNER JOIN `movie_actors` ON `movies`.`id` = `movie_actors`.`movie_id`
            WHERE `movie_actors`.`actor_id` = " . $this->id;

        // Execute the query using PDO
        $pdoStatement = $pdo->query($sql);

        // Fetch the result as an array of Movie objects using fetchAll, which automatically instantiates the Movie class and fills the properties with the database information.
        $movies = $pdoStatement->fetchAll(PDO::FETCH_CLASS, Movie::class);

        return $movies;
    }

    /**
     * General method for the complete URL to the person's image
     *
     * @return string
     */
    public function getPicture()
    {
        return  "https://image.tmdb.org/t/p/original" . $this->picture_url;
    }

    /**
     * Getters and setters
     */


    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of picture_url
     */
    public function getPictureUrl()
    {
        return $this->picture_url;
    }

    /**
     * Set the value of picture_url
     *
     * @return  self
     */
    public function setPictureUrl($picture_url)
    {
        $this->picture_url = $picture_url;

        return $this;
    }
}
