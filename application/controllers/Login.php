<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login Extends CI_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');

	}

	public function index()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
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
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('tb_user', ['email' => $email])->row_array();
		
		//jika user ada
		if($user){
			//Cek password   
			if (password_verify($password, $user['password'])) {
				$data1 = [
						'email' => $user['email'],
						'user_level' => $user['user_level']
				];

				$this->session->set_userdata($data1);
				if ($user['user_level'] == 1){
					redirect('home');

				}

			}else{
			$this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert">Password Salah!</div>');
			redirect('login');
			}


			echo $user['password'];
				
		}else{
			$this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert">Email Belum Ada!</div>');
			redirect('login');
			
		}	

  }

	public function passwordku() {


		$password = "1234";

		echo password_hash($password, PASSWORD_BCRYPT);


	}

	  	public function keluar()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('user_level');
		$this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert">Berhasil Keluar Akun!</div>');
		redirect('login');
	}

}