<?php

class Laporan extends CI_Controller
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
        $this->load->model('nomor_model'); 
        $this->load->library('whatsva');
    }

    public function index()
    {
        $data['setting'] = $this->setting_model->getSetting();
        $data['current_user'] = $this->auth_model->current_user();
        $where = [];  
        $id_user = $data['current_user']->id;
      
        $tanggal = @$_GET['tanggal'];
        if($tanggal == "" || $tanggal == null){
              $startTime = date("Y-m-d ");
            echo $convertedTime = date('Y-m-d ', strtotime('+0 hours', strtotime($startTime)));

            $tanggal = $convertedTime;
        }

        $status = @$_GET['status'];
        if($status != ""){
            $where = ["date(tanggal_periksa)"=>$tanggal,"id_user"=>$id_user,"status"=>$status];
        }else{
            $where = ["date(tanggal_periksa)"=>$tanggal,"id_user"=>$id_user];
        }
      


        $data['devices'] = $this->nomor_model->getWhere($where);
        $data['devices_count']= $this->nomor_model->getCount();

        $this->load->view('layouts/header', $data);
        $this->load->view('client/laporan/list', $data);
        $this->load->view('layouts/footer');

    }
    public function rechecknumber()
    {
        $data['setting'] = $this->setting_model->getSetting();
        $data['current_user'] = $this->auth_model->current_user();

        $tanggal = @$_GET['tanggal'];
        if($tanggal == "" || $tanggal == null){
              $startTime = date("Y-m-d ");
             $convertedTime = date('Y-m-d ', strtotime('+0 hours', strtotime($startTime)));

            $tanggal = $convertedTime;
        }

        $status = @$_GET['status'];
        if(!$status)
        $id_user = $data['current_user']->id;

        $datanumber = $this->nomor_model->getWhere(["date(tanggal_periksa)"=>$tanggal,"id_user"=>$id_user]);
        foreach ($datanumber as $key => $value) {
          
                if($value->status != "Sudah"){
              
                 $user_id = $data['current_user']->id;
                 $queue = $this->addQueue($value->nomor,$user_id);
                             
            }
        }
        redirect("./laporan?tanggal=$tanggal");
     

        
    }
     function addQueue($nomor,$id_user)
    {
    
        // array_push($data);
        $data['url'] = "http://4.194.251.178/panel_dompul/index.php/api/checknumber";
        $data['nomor'] = $nomor;
        $data['id_user']=$id_user;
     
        $curl = curl_init();

        $payload = json_encode($data);
        
        $url = "http://66.42.60.192:3011/add-queue";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
       
        curl_close($ch);
        return $result;
    }

}
