<?php 

class MMovie extends CI_Model 
{

    function __construct()
    {
        parent::__construct();
    }

    /**
     * @param
     */
    public function search($q='')
    {
        $movies = $this
            ->db
            ->query("SELECT * FROM film WHERE judul LIKE '%$q%'")
            ->result_array();
        // dd($movies);
        return $movies;
    }

    /**
     * @param
     */
    public function latest_aired()
    {
        $movies = $this
            ->db
            ->query("SELECT * FROM film ORDER BY tglrilis DESC")
            ->result_array();
        // dd($movies);
        return $movies;
    }

    public function recently_added()
    {
        $movies = $this
            ->db
            ->query("SELECT * FROM film ORDER BY id DESC")
            ->result_array();
        // dd($movies);
        return $movies;
    }
}
