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
    public function search($q = '')
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
    public function latest_aired($limit=15, $offset=0)
    {
        $movies = $this
            ->db
            ->query("SELECT * FROM film ORDER BY tglrilis DESC LIMIT $limit OFFSET $offset")
            ->result_array();
        // dd($movies);
        return $movies;
    }

    public function recently_added($limit=15, $offset=0)
    {
        $movies = $this
            ->db
            ->query("SELECT * FROM film ORDER BY id DESC LIMIT $limit OFFSET $offset")
            ->result_array();
        // dd($movies);
        return $movies;
    }

    public function find($id)
    {
        $movie = $this
            ->db
            ->query("SELECT * FROM film WHERE id = $id")
            ->row_array();
        $kualitas = $this
            ->db
            ->query("SELECT * FROM film_kualitas where idfilm = $id")
            ->result_array();
        $genre = $this
            ->db
            ->query("SELECT idgenre, g.genre from film_genre fg 
                inner join genre g on fg.idgenre = g.id 
                where idfilm = $id")
            ->result_array();
        $movie['kualitas'] = $kualitas;
        $movie['genre'] = $genre;
        // dd($movie);
        return $movie;
    }

    public function related($id)
    {
        // Mengambil data film terkait berdasarkan genrenya.
        $genre = $this
            ->db
            ->query("SELECT idgenre, g.genre from film_genre fg 
                inner join genre g on fg.idgenre = g.id 
                where idfilm = $id")
            ->result_array();
        $idgenres = array_map(function ($genre) {
            return $genre['idgenre'];
        }, $genre);
        // dd($idgenres);
        $movieByGenre = $this
            ->db
            ->distinct()
            ->select('f.*')
            ->from('film_genre fg')
            ->join('film f', 'fg.idfilm=f.id')
            ->where_in('idgenre', $idgenres) //Mencari dengan genre terkait
            ->where_not_in('f.id', [$id]) //Film saat ini tidak ikut ter-select
            ->get()
            ->result_array();
        // dd($movieByGenre);
        return ($movieByGenre);
    }

    public function findByGenre($idgenres)
    {
        // Mengambil data film berdasarkan genrenya.
        $movieByGenre = $this
            ->db
            ->distinct()
            ->select('f.*')
            ->from('film_genre fg')
            ->join('film f', 'fg.idfilm=f.id')
            ->where_in('idgenre', $idgenres)
            ->get()
            ->result_array();
        // dd($movieByGenre);
        return ($movieByGenre);
    }

    public function genres()
    {
        $genres = $this
            ->db
            ->get('genre')
            ->result_array();
        return $genres;
    }
}
