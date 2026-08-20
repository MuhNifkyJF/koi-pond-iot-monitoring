<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * 
 */
class History extends CI_Controller
{

   public function __construct()
	{
		parent::__construct();
		$this->load->model('m_history','tampil');
		if (!$this->session->userdata('username') || (int) $this->session->userdata('user_level') !== 1) {
			redirect('login');
			exit;
		}
	}


	public function index()
	{
		//$tampil = $this->m_history->get_all()->result();
		$data['tampil'] =  $this->tampil->GET_ALL();
		$data['judul'] =  'Halaman History';
		$data['page'] =  'history/index';
		$this->load->view('tamplate/header', $data);
		$this->load->view('tamplate/footer');
	}


}
