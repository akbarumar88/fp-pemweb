<?php

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MUser', 'user');
        $this->load->model('MMovie', 'movie');
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

    public function login()
    {
        // Jika user telah login, maka arahkan ke halaman index.
        if ($this->session->has_userdata('id')) {
            return redirect('site/index');
        }

        if (!$this->input->post()) {
            // Render view login user.
            return $this->loadView('auth/login');
        }
        // Jika user sudah submit form.
        $uname = $this->input->post('username');
        $pass = $this->input->post('pass');
        // dd([$uname,$pass]);
        $user = $this->user->login($uname, $pass);
        if (empty($user)) {
            // Data user tidak ditemukan.
            flash('errlogin', 'Kombinasi username dan password tidak ditemukan dalam database. Harap periksa kembali data yang anda masukkan.', 'warning');
            return $this->loadView('auth/login');
        }
        // dd($user);
        // Data user ditemukan, set session & redirect ke site/login
        $this->session->set_userdata([
            'id' => $user['id'],
            'username' => $user['username'],
            'nama_lengkap' => $user['nama_lengkap'],
            'role' => $user['role'],
        ]);
        redirect('site/index');
    }

    public function logout()
    {
        // Kosongkan session, redirect ke halaman login.
        $this->session->unset_userdata(['id', 'username', 'nama_lengkap', 'role']);
        redirect('auth/login');
    }
}