<?php

class MUser extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function login($username, $pass)
    {
        $user = $this
            ->db
            ->get_where('user', [
                'username' => $username,
                'password'	=> md5($pass)
            ])
            ->row_array();
        return $user;
    }

    public function register($data)
    {
        $user = $this
            ->db
            ->get_where('user', [
                'username' => $data['username'],
            ])
            ->row_array();
        if (!empty($user)) {
            // Username sudah dipakai
            return[
                'status' => 0,
                'message' => "Username sudah dipakai, silakan menggunakan username yang lainnya."
            ];
        }
        // Eksekusi register
        $this
            ->db
            ->insert('user', [
                'username' => $data['username'],
                'nama_lengkap'	=> $data['nama_lengkap'],
                'password' => md5($data['pass']),
                'role' => 2 // Sebagai user biasa.
            ]);
        return [
            'status' => 1,
            'message' => 'Berhasil register, silakan melakukan login untuk masuk ke akun anda.'
        ];
    }
}