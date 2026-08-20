<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * 
 */
class Monitoring extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username') || (int) $this->session->userdata('user_level') !== 1) {
			redirect('login');
			exit;
		}
	}
	
	public function index()
	{

		$data['judul'] =  'Halaman monitoring';
		$data['page'] =  'monitoring/index';
		$this->load->view('tamplate/header', $data);
		$this->load->view('tamplate/footer');
	}
}
