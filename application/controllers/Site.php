<?php

class Site extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MMovie', 'movie');
    }

    private function loadView($mainView, $data=[])
    {
        $this->load->view('site/header');
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
        // dd($q);
        $res = $this->movie->search($q);
        $this->loadView('site/search', [
            'q'	=> $q,
            'res' => $res,
        ]);
    }

    /**
     * Halaman Detail Film
     */
    public function movie($id)
    {
        # code...
        $res = $this->movie->find($id);
        // dd($res);
        $related_movies = $this->movie->related($id);
        // dd($res);
        $this->loadView('site/movie', [
            'movie'	=> $res,
            'related_movies' => $related_movies,
        ]);
    }
}
