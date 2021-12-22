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
        $movies = $this->movie->search();
        $this->loadView('site/index', [
            'movies' => $movies
        ]);
    }
}
