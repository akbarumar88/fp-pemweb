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
}
