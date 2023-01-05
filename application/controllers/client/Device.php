<?php

class Device extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
        if (!$this->auth_model->current_user()) {
            redirect('auth/login');
        }
        $data_user =$this->auth_model->current_user(); 
        if($data_user->level !== "1"){
            redirect('/dashboard');
        }
        $this->load->model('setting_model');
        $this->load->model('device_model'); 
        $this->load->library('whatsva');
    }

    public function index()
    {
        $data['setting'] = $this->setting_model->getSetting();
        $data['current_user'] = $this->auth_model->current_user();

        $page = @$_GET['page'];
		$limit = 10;
		if(!@$page){
			$start = 0;
		}else{
			$start = $page * $limit;
			
		}

        $data['devices'] = $this->device_model->getAll($start,$limit);
        $data['devices_count']= $this->device_model->getCount();

        $this->load->view('layouts/header', $data);
        $this->load->view('client/device/list', $data);
        $this->load->view('layouts/footer');

    }
    public function add()
    {
        $this->load->library('form_validation');

        $data['setting'] = $this->setting_model->getSetting();
        $data['current_user'] = $this->auth_model->current_user();
        $data['devices'] = $this->device_model->getAlls();

        $rules = $this->device_model->rules();
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == false) {

            $this->load->view('layouts/header', $data);
            $this->load->view('client/device/add', $data);
            $this->load->view('layouts/footer');
            return;
        }
        $devicename = $this->input->post('nomor');
		$datasetting = $this->setting_model->getSetting();
        if ($this->device_model->add($devicename, $datasetting->panel_key)) {
            redirect('./device');
        }
      
        $this->load->view('layouts/header', $data);
        $this->load->view('client/device/add', $data);
        $this->load->view('layouts/footer');

    }

    // ... ada kode lain di sini ...
    public function edit($id)
    {   
        $this->load->library('form_validation');

        $data['setting'] = $this->setting_model->getSetting();
        $data['current_user'] = $this->auth_model->current_user();
        $data['devices'] = $this->device_model->getAlls();
        $data['dserver'] = $this->device_model->getbyId($id);
        
      
       
        $rules = $this->device_model->rules();
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == false) {

            $this->load->view('layouts/header', $data);
            $this->load->view('client/device/edit', $data);
            $this->load->view('layouts/footer');
            return;
        }

        $device = $this->input->post('nomor');
        $token = $this->input->post('token');
        $refresh_token = $this->input->post('refresh_token');
      
   
        $data = [
            "nomor"=>$device,
            "token"=>$token,
            "refresh_token"=>$refresh_token
        ];
      
     
    
		
        if ($this->device_model->update($data,$id)) {
            
            redirect('./device');
        }
      
        $this->load->view('layouts/header', $data);
        $this->load->view('client/device/edit', $data);
        $this->load->view('layouts/footer');
    }
    public function getRefreshToken($id)
    {   
        $this->load->library('form_validation');

        $data['setting'] = $this->setting_model->getSetting();
        $data['current_user'] = $this->auth_model->current_user();
        $data['devices'] = $this->device_model->getAlls();
        $data['dserver'] = $this->device_model->getbyId($id);
        
        $refreshToken = $data['dserver']->refresh_token;
        
        $refresh = $this->refreshToken($refreshToken);
        $response = json_decode($refresh);
        if($response->statusCode == 401){
            $this->session->set_flashdata('message_add_device_error', $response->statusMessage."<br>".$response->result->error);
        }else{
        if($response->statusMessage =="OK"){
            $token_baru = $response->result->accessToken;
            $refresh_token_baru = $response->result->refreshToken;
            $startTime = date("Y-m-d H:i:s");
            $convertedTime = date('Y-m-d H:i:s', strtotime('+102 minutes', strtotime($startTime)));

            $data = [
                "token"=>$token_baru,
                "refresh_token"=>$refresh_token_baru,
                "expired"=>  $convertedTime
            ];
            $this->device_model->update($data,$id);
        }
        }
        // print_r($response);
        // redirect('./device');
          $page = @$_GET['page'];
        $limit = 10;
        if(!@$page){
            $start = 0;
        }else{
            $start = $page * $limit;
            
        }
        $data['setting'] = $this->setting_model->getSetting();
        $data['devices'] = $this->device_model->getAll($start,$limit);
        $data['devices_count']= $this->device_model->getCount();
        $this->load->view('layouts/header', $data);
        $this->load->view('client/device/list', $data);
        $this->load->view('layouts/footer');
       
      
   
    }
    public function refreshToken($refresh_token)
    {
        $url = "http://localhost:3000/api/sidompul/v1/postV1LoginTokenRefresh?58805922-f22b-4f0e-9f9e-76994a5ecc1b";

        $curl = curl_init();
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json','referer:http://localhost:80'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
     
        curl_close($ch);
        return $result;
    }
    public function getToken($id)
    {   
        $this->load->library('form_validation');

        $data['setting'] = $this->setting_model->getSetting();
        $data['current_user'] = $this->auth_model->current_user();
        $data['devices'] = $this->device_model->getAlls();
        $data['dserver'] = $this->device_model->getbyId($id);
        
      
       
        $rules = $this->device_model->rules();
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == false) {

            $this->load->view('layouts/header', $data);
            $this->load->view('client/device/getToken', $data);
            $this->load->view('layouts/footer');
            return;
        }

        $otp = $this->input->post('otp');
      
   
        $data = [
            "otp"=>$otp
        ];
      
     
    
		
        if ($this->device_model->update($data,$id)) {
            
            redirect('./device');
        }
      
        $this->load->view('layouts/header', $data);
        $this->load->view('client/device/edit', $data);
        $this->load->view('layouts/footer');
    }
}
