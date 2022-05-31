<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * 
 */
class Monitoring extends CI_Controller
{
	
	public function index()
	{
		// $data['judul'] =  'Halaman Monitoring';
		// $this->load->view('tamplate/header', $data);
		// $this->load->view('monitoring/index'); 
		// $this->load->view('tamplate/footer');

		$data['judul'] =  'Halaman monitoring';
		$data['page'] =  'monitoring/index';
		$this->load->view('tamplate/header', $data);
		$this->load->view('tamplate/footer');
	}
}