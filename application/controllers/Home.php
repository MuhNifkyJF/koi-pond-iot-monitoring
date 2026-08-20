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
		$this->requireLogin();

		$data['judul'] =  'Halaman utama';
		$data['page'] =  'home/index';
		$this->load->view('tamplate/header', $data);
		$this->load->view('tamplate/footer');

	}



	public function ceksuhu()
	{
		$this->requireLogin();
		//panggil function getDataSensor
        $recordSensor = $this->M_Home->getDataSensor();
        $data = array('data_sensor' => $recordSensor);
        //kirim ke tampilan ceksuhu
        $this->load->view('suhu/ceksuhu', $data);
	}

	public function cekph()
	{
		$this->requireLogin();
		//panggil function getDataSensor
        $recordSensor = $this->M_Home->getDataSensor();
        $data = array('data_sensor' => $recordSensor);
        //kirim ke tampilan cekph
        $this->load->view('ph/cekph', $data);
	}

	public function cekdht()
	{
		$this->requireLogin();
		//panggil function getDataSensor
        $recordSensor = $this->M_Home->getDataSensor();
        $data = array('data_sensor' => $recordSensor);
        //kirim ke tampilan cekdht
        $this->load->view('dht/cekdht', $data);
	}

	public function cektanggal()
	{
		$this->requireLogin();
		//panggil function getDataSensor
        $recordSensor = $this->M_Home->getDataSensor();
        $data = array('data_sensor' => $recordSensor);
        //kirim ke tampilan cekph
        $this->load->view('tanggal/cektanggal', $data);
	}

	public function kirimdata()
	{
		$expectedKey = getenv('SENSOR_API_KEY');
		if ($expectedKey !== false && $expectedKey !== '') {
			$providedKey = $this->input->get_request_header('X-Sensor-Key', true);
			if (!$providedKey) {
				$providedKey = $this->input->get('key', true);
			}

			if (!$providedKey || !hash_equals($expectedKey, $providedKey)) {
				return $this->jsonResponse(401, ['success' => false, 'message' => 'Sensor key tidak valid.']);
			}
		}

		$values = [
			'suhu' => $this->uri->segment(3),
			'kadar_ph' => $this->uri->segment(4),
			'sensor_dht' => $this->uri->segment(5)
		];

		foreach ($values as $name => $value) {
			if (!is_numeric($value) || !is_finite((float) $value)) {
				return $this->jsonResponse(422, ['success' => false, 'message' => $name . ' harus berupa angka.']);
			}
			$values[$name] = (float) $value;
		}

		if ($values['suhu'] < -10 || $values['suhu'] > 60) {
			return $this->jsonResponse(422, ['success' => false, 'message' => 'Suhu air harus berada pada rentang -10 sampai 60 °C.']);
		}
		if ($values['kadar_ph'] < 0 || $values['kadar_ph'] > 14) {
			return $this->jsonResponse(422, ['success' => false, 'message' => 'Nilai pH harus berada pada rentang 0 sampai 14.']);
		}
		if ($values['sensor_dht'] < -40 || $values['sensor_dht'] > 100) {
			return $this->jsonResponse(422, ['success' => false, 'message' => 'Suhu lingkungan harus berada pada rentang -40 sampai 100 °C.']);
		}

		$values['tanggal'] = date('Y-m-d H:i:s');
		if (!$this->M_Home->InsertDate($values)) {
			return $this->jsonResponse(500, ['success' => false, 'message' => 'Data sensor gagal disimpan.']);
		}

		return $this->jsonResponse(201, ['success' => true, 'timestamp' => $values['tanggal']]);
	}



	// data realtime
	public function realtimedata() {
		$this->requireLogin();
		$data = $this->M_Home->getDataSensor();
		if (!$data) {
			return $this->jsonResponse(404, ['success' => false, 'message' => 'Belum ada data sensor.']);
		}

		return $this->jsonResponse(200, $data);
	}

	private function requireLogin()
	{
		if (!$this->session->userdata('username') || (int) $this->session->userdata('user_level') !== 1) {
			redirect('login');
			exit;
		}
	}

	private function jsonResponse($statusCode, $payload)
	{
		return $this->output
			->set_status_header($statusCode)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($payload));
	}
}

