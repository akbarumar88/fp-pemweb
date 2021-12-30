<?php

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MUser', 'user');
        $this->load->model('MMovie', 'movie');
        // Pengecekan Hak Akses, jika bukan admin
        if ($this->session->role != 1) {
            flash('access', "Maaf! Anda tidak memiliki akses untuk mengakses halaman tersebut. Nikmati Film-film menarik hanya di MOOVEE.", "danger");
            redirect('site/index');
        }
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
        $page = $this->input->get('p');
        if (empty($page)) $page = 1; // Set ke halaman 1, jika kosong
        $limit = 50;
        $offset = ($page-1) * $limit;

        $movies = $this->movie->recently_added($limit, $offset);
        $this->loadView('admin/index', [
            'movies' => $movies
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
        $this->loadView('admin/movie', [
            'movie'	=> $res,
        ]);
    }

    public function addmovie()
    {
        if (!$this->input->post()) {
            $genres = $this->movie->genres();
            return $this->loadView('admin/addmovie', [
                'genres' => $genres
            ]);
        }
        // Tambah Film
        // dd($_POST);
        $idfilm = $this->movie->add([
            'judul' => $this->input->post('judul'),
            'sinopsis' => $this->input->post('sinopsis'),
            'tglrilis' => $this->input->post('tglrilis'),
            'durasi' => $this->input->post('durasi'),
            'rating' => $this->input->post('rating'),
            'genre' => $this->input->post('genre'),
        ]);

        // Upload gambar
        $tmp_name = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp_name, "img/thumbnails/$idfilm.jpg"); // Nama file diganti dengan id filmnya

        flash('succadd', "Berhasil menambahkan film ".$this->input->post('judul'), 'success');
        redirect('admin/index');
    }

    public function editmovie($id) {
        if (!$this->input->post()) {
            $genres = $this->movie->genres();
            $movie = $this->movie->find($id);
            // dd($movie);
            return $this->loadView('admin/editmovie', [
                'movie' => $movie,
                'genres' => $genres
            ]);
        }
        // Update Film
        // dd($_POST);
        $idfilm = $this->movie->update([
            'id' => $this->input->post('id'),
            'judul' => $this->input->post('judul'),
            'sinopsis' => $this->input->post('sinopsis'),
            'tglrilis' => $this->input->post('tglrilis'),
            'durasi' => $this->input->post('durasi'),
            'rating' => $this->input->post('rating'),
            'genre' => $this->input->post('genre'),
        ]);

        // dd($_FILES);die;
        if (!empty($_FILES['gambar'])) {
            // Hapus gambar lama terlebih dahulu.
            $resUnlink = unlink("img/thumbnails/$idfilm.jpg");
            // dd($resUnlink);die;
            // Upload gambar, jika diinput
            $tmp_name = $_FILES['gambar']['tmp_name'];
            move_uploaded_file($tmp_name, "img/thumbnails/$idfilm.jpg"); // Nama file diganti dengan id filmnya
        }

        flash('succadd', "Berhasil mengubah film ".$this->input->post('judul'), 'success');
        redirect('admin/index');
    }
}