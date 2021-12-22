<?php

class Site extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    private function loadView($mainView)
    {
        $this->load->view('site/header');
        $this->load->view($mainView);
        $this->load->view('site/footer');
    }

    public function index()
    {
        $this->loadView('site/index');
    }
}
