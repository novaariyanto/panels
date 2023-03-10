<?php

class Registers extends CI_Controller
{

	public function index()
	{
		show_404();
	}
	public function signup()
	{
		$this->load->model('register_model');

		$this->load->library('form_validation');

		$rules = $this->register_model->rules();
		$valid = $this->form_validation->set_rules($rules);
		
		if($this->form_validation->run() === FALSE){
			return $this->load->view('register_form');
		}

		 $username = $this->input->post('username');
		 $email = $this->input->post('email');
		 $phone_number = $this->input->post('phone_number');
		 $password = $this->input->post('password');
		
		
		if($this->register_model->register($username,$email,$phone_number, $password)){
			$data_user = $this->register_model->getWhere($username);
				
		
			$id_user = $data_user->id;
		
			$this->session->set_flashdata('message_register_success', 'Register has been successful, You can login now!');
			redirect('/login');
		} else {
			$this->session->set_flashdata('message_login_error', 'Register failure!');
		}

		$this->load->view('register_form');
	}
}