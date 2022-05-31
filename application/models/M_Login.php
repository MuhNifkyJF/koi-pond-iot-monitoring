<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 /**
  * 
  */
 class
 
$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('tb_user', ['email' => $email])->row_array();