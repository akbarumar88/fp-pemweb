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
}