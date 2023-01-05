<?php

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		if(!$this->auth_model->current_user()){
			redirect('/login');
		}
        $this->load->model('setting_model');
      $this->load->model('nomor_model');
	}
    public function index()
    {
        
		
        $data['setting'] = $this->setting_model->getSetting();
         $data['current_user'] = $this->auth_model->current_user();
       
        $id_user = $data['current_user']->id;
		// header("Content-Type: application/json");
		// print_r(json_encode($data['package']));
		// die;
	
        $data["nomor_aktif"] = $this->nomor_model->getWhere_count(["id_user"=>$id_user,"status"=>"Sudah"]);
		$data["nomor_belum"] = $this->nomor_model->getWhere_count(["id_user"=>$id_user,"status"=>"Belum"]);
		$data["all"] = $this->nomor_model->getWhere_count(["id_user"=>$id_user]);
		$data["nomor_checking"] = $data["all"] - ($data["nomor_aktif"]+$data["nomor_belum"]);
    	$this->load->view('layouts/header',$data);
	
		$this->load->view('client/dashboard/index',$data);
    	$this->load->view('layouts/footer');
    }
	// ... ada kode lain di sini ...
}