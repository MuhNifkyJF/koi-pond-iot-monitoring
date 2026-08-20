<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Login extends CI_Model
{
    public function findByUsername($username)
    {
        return $this->db->get_where('tb_user', ['username' => $username])->row_array();
    }
}
