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
            ->query("SELECT id, judul, sinopsis, tglrilis, durasi FROM film")
            ->result_array();
        // dd($movies);
        return $movies;
    }
}
