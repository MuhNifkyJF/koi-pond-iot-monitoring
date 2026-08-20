<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login Extends CI_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_Login');
	}

	public function index()
	{
		if ($this->session->userdata('username')) {
			if ((int) $this->session->userdata('user_level') === 1) {
				redirect('home');
				return;
			}
			$this->session->sess_destroy();
		}

		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == false){
			$data['title'] = 'Halaman Login';
			$this->load->view('tamplates/login_header', $data);
			$this->load->view('login/index');
			$this->load->view('tamplates/login_footer');
		}else{
			//validasi succes 
			$this->_login();
		}
		
	}



	private function _login()
	{
		$username = trim((string) $this->input->post('username', true));
		$password = $this->input->post('password');

		$user = $this->M_Login->findByUsername($username);
		
		//jika user ada
		if($user){
			//Cek password   
			if (password_verify($password, $user['password'])) {
				$data1 = [
						'username' => $user['username'],
						'user_level' => $user['user_level']
				];

				$this->session->sess_regenerate(true);
				$this->session->set_userdata($data1);
				if ($user['user_level'] == 1){
					redirect('home');
					return;

				}

				$this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert">Level pengguna tidak dikenali.</div>');
				redirect('login');
				return;

			}else{
			$this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert">Password Salah!</div>');
			redirect('login');
			return;
			}
				
		}else{
			$this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert">Username belum terdaftar.</div>');
			redirect('login');
			return;
			
		}	

  }

	public function keluar()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert">Berhasil Keluar Akun!</div>');
		redirect('login');
	}

}
