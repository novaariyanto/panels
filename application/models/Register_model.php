<?php

class Register_model extends CI_Model
{
	private $_table = "tb_user";
	const SESSION_KEY = 'id';

    public function rules()
	{
		return [
			[
				'field' => 'username',
				'label' => 'Username or Email',
				'rules' => 'required'
			],[
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required|max_length[255]'
			],[
				'field' => 'phone_number',
				'label' => 'Phone Number',
				'rules' => 'required|max_length[255]'
			],
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required|max_length[255]'
			]
		];
	}
	public function getWhere($username)
	{
		$this->db->where('email', $username);
		$query = $this->db->get($this->_table);
	return $query->row();
	
	}

	public function register($username,$email, $phone_number,$password)
	{
		
		$this->db->where('email', $email);
		$query = $this->db->get($this->_table);
		$user = $query->row();
	

		// cek apakah user sudah terdaftar?
		if ($user) {
			return FALSE;
		}
		// cek apakah passwordnya benar?
	
		$data = [
			
			'email'=>$email,
			'password'=> password_hash($password,PASSWORD_DEFAULT),
			'phone_number'=>$phone_number,
			'status'=> '1',
			'level' => '1',
			'start_date'=>date('Y-m-d')
		];
	
		// bikin session
		return $this->db->insert($this->_table,$data);
	}

	
}