<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * 
 */
class Beranda extends CI_Controller
{

   public function __construct()
	{
		parent::__construct();
		$this->load->model('m_history','tampil');
	}


	public function index()
	{
		//$tampil = $this->m_history->get_all()->result();
		$data['tampil'] =  $this->tampil->GET_ALL();
		$this->load->view( $data);
	}


}