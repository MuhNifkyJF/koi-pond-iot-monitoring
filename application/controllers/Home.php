<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Home extends CI_Controller
{

	public function __construct()
	{
        parent::__construct();
        $this->load->model('M_Home');
    }
	
	public function index()
	{
		// $data['judul'] =  'Halaman Utama';
		// $this->load->view('tamplate/header', $data);
		// $this->load->view('home/index'); 
		// $this->load->view('tamplate/footer');

		$data['judul'] =  'Halaman utama';
		$data['page'] =  'home/index';
		$this->load->view('tamplate/header', $data);
		$this->load->view('tamplate/footer');

	}



	public function ceksuhu()
	{
		//panggil function getDataSensor
        $recordSensor = $this->M_Home->getDataSensor();
        $data = array('data_sensor' => $recordSensor);
        //kirim ke tampilan ceksuhu
        $this->load->view('suhu/ceksuhu', $data);
	}

	public function cekph()
	{
		//panggil function getDataSensor
        $recordSensor = $this->M_Home->getDataSensor();
        $data = array('data_sensor' => $recordSensor);
        //kirim ke tampilan cekph
        $this->load->view('ph/cekph', $data);
	}

	public function cektanggal()
	{
		//panggil function getDataSensor
        $recordSensor = $this->M_Home->getDataSensor();
        $data = array('data_sensor' => $recordSensor);
        //kirim ke tampilan cekph
        $this->load->view('tanggal/cektanggal', $data);
	}

	public function kirimdata()
	{
		//baca nilai suhu dan ph di segment 3 dan 4
		$suhu = $this->uri->segment(3);
		$kadar_ph = $this->uri->segment(4);

		//Insert tabel 
		$DataInsert = array(
			'suhu' => $suhu,
			'kadar_ph' => $kadar_ph,
			
		);

		//Insert data
		$this->M_Home->InsertDate($DataInsert);
	}



	// data realtime
	public function realtimedata() {

		$this->load->model('M_home');

		// load model 
		$data = $this->M_Home->getDataSensor();
		echo json_encode( $data );
	}
}

