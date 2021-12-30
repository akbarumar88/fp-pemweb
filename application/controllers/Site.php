<?php

class Site extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MMovie', 'movie');
        $this->load->model('MGenre', 'genre');
        $this->load->model('MUser', 'user');
    }

    private function loadView($mainView, $data=[])
    {
        $genres = $this->movie->genres();
        // dd($genres);
        $this->load->view('site/header', [
            'genres' => $genres
        ]);
        $this->load->view($mainView, $data);
        $this->load->view('site/footer');
    }

    public function index()
    {
        $latest_aired = $this->movie->latest_aired();
        $recently_added = $this->movie->recently_added();
        $this->loadView('site/index', [
            'latest_aired' => $latest_aired,
            'recently_added' => $recently_added,
        ]);
    }

    public function search()
    {
        $q = $this->input->get('q');
        $currentPage = !empty($this->input->get('p')) ? $this->input->get('p') : 1;
        // dd($q);
        $itemPerPage = 15;
        $offset = ($currentPage-1) * $itemPerPage;
        $res = $this->movie->search($q, $itemPerPage, $offset);
        $resCount = $this->movie->searchCount($q);
        $totalPage = ceil($resCount / $itemPerPage);
        $this->loadView('site/search', [
            'q'	=> $q,
            'res' => $res,
            'totalPage' => $totalPage,
        ]);
    }

    /**
     * Halaman Detail Film
     */
    public function movie($id)
    {
        # code...
        $res = $this->movie->find($id);
        // Melakukan pengecekan apakah user sudah login? untuk membatasi kualitas videonya.
        if (!$this->session->has_userdata('id')) {
            $res['kualitas'] = array_filter($res['kualitas'], function ($item) {
                return $item['kualitas'] == '480p';
            });
        }
        // dd($res);
        $related_movies = $this->movie->related($id);
        // dd($res);
        if ($this->session->has_userdata('id')) {
            // Tambah histori film user
            $this->user->addhistory(['iduser' => $this->session->id, 'idfilm' => $id]);
        }
        $this->loadView('site/movie', [
            'movie'	=> $res,
            'related_movies' => $related_movies,
        ]);
    }

    public function search_genre($idgenre)
    {
        $genre = $this->genre->find($idgenre);
        $currentPage = !empty($this->input->get('p')) ? $this->input->get('p') : 1;
        // dd($genre);
        $itemPerPage = 15;
        $offset = ($currentPage - 1) * $itemPerPage;
        $res = $this->movie->findByGenre([$idgenre], $itemPerPage, $offset);
        $resCount = $this->movie->findByGenreCount([$idgenre], $itemPerPage, $offset);
        $totalPage = ceil($resCount / $itemPerPage);
        $this->loadView('site/search_genre', [
            'genre' => $genre['genre'],
            'res' => $res,
            'totalPage' => $totalPage,
        ]);
    }

    public function history()
    {
        $history = $this->user->history($this->session->id);
        $this->loadView('site/history', [
            'history' => $history
        ]);
    }
}
