<?php

class Ceknomor extends CI_Controller
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
        $this->load->library('form_validation');

        $data['setting'] = $this->setting_model->getSetting();
        $data['current_user'] = $this->auth_model->current_user();
        $data['devices'] = $this->device_model->getAlls();

        $rules = $this->device_model->rules();
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == false) {

            $this->load->view('layouts/header', $data);
            $this->load->view('client/ceknomor/singlenomor', $data);
            $this->load->view('layouts/footer');
            return;
        }
         $tanggal_aktif = "";
        $devicename = $this->input->post('nomor');
       $ceklokal = $this->nomor_model->getWhere_count(["nomor"=>$devicename]);
  
      if($ceklokal < 1){
        $user_id = $data['current_user']->id;
        $token = $this->device_model->getWhere(['id_user'=>  $user_id]);
      
             $cek = $this->cekNomor($devicename,@$token->token);

           
            $response = json_decode($cek);
            $this->session->set_flashdata('message_add_device_error', $response->result->data->dukcapil." Terdaftar");
            if($response->statusCode == 200){
                 $cektanggalaktif = $this->cektanggalaktif($devicename);
                 $data_tanggal = json_decode($cektanggalaktif);
                 $tanggal_aktif = $data_tanggal->result->data->expDate;
                
                if(@$response->result->data->dukcapil){
                $status = 1;
            }else{
                $status = 0;
            }
            $this->nomor_model->add($devicename, $cek,$response->result->data->dukcapil,"Done",$tanggal_aktif);    
            }else if($response->statusCode == 401){
                 $this->session->set_flashdata('message_add_device_error', "Session dompul expired ");
            
            }
      }else{
        $user_id = $data['current_user']->id;
        $token = $this->device_model->getWhere(['id_user'=>  $user_id]);
      
             $cek = $this->cekNomor($devicename,@$token->token);

           
            $response = json_decode($cek);
            $this->session->set_flashdata('message_add_device_error', $response->result->data->dukcapil." Terdaftar");
            if($response->statusCode == 200){
                 $cektanggalaktif = $this->cektanggalaktif($devicename);
                 $data_tanggal = json_decode($cektanggalaktif);
                 $tanggal_aktif = $data_tanggal->result->data->expDate;
                
                if(@$response->result->data->dukcapil){
                $status = 1;
            }else{
                $status = 0;
            }
             
            }else if($response->statusCode == 401){
                 $this->session->set_flashdata('message_add_device_error', "Session dompul expired ");
            
            }
      }
        
            
       
       
      
        $this->load->view('layouts/header', $data);
        $this->load->view('client/ceknomor/singlenomor', $data);
        $this->load->view('layouts/footer');

    }
    function gantiformat($nomorhp) {
        //Terlebih dahulu kita trim dl
        $nomorhp = trim($nomorhp);
       //bersihkan dari karakter yang tidak perlu
        $nomorhp = strip_tags($nomorhp);     
       // Berishkan dari spasi
       $nomorhp= str_replace(" ","",$nomorhp);
       // bersihkan dari bentuk seperti  (022) 66677788
        $nomorhp= str_replace("(","",$nomorhp);
       // bersihkan dari format yang ada titik seperti 0811.222.333.4
        $nomorhp= str_replace(".","",$nomorhp); 
   
        //cek apakah mengandung karakter + dan 0-9
        if(!preg_match('/[^+0-9]/',trim($nomorhp))){
            // cek apakah no hp karakter 1-3 adalah +62
            if(substr(trim($nomorhp), 0, 3)=='+62'){
                $nomorhp= trim($nomorhp);
            }
            // cek apakah no hp karakter 1 adalah 0
           elseif(substr($nomorhp, 0, 1)=='0'){
                $nomorhp= '62'.substr($nomorhp, 1);
            }
        }
        return $nomorhp;
    }
    function cekNomor($nomor,$token)
    {

        $nomor = $this->gantiformat($nomor);
        // $url = "https://srg-txl-utility-service.ext.dp.xl.co.id/v2/package/check/dukcapil/".$nomor;
        $url = "http://localhost:3000/api/sidompul/v1/getV2PackageCheckDukcapil?msisdn=".$nomor;

        $curl = curl_init();
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json','referer:http://localhost:80','authorization:Bearer '.$token));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
     
        curl_close($ch);
        return $result;
    }
     public function resetnumber()
    {
        $data['setting'] = $this->setting_model->getSetting();
        $data['current_user'] = $this->auth_model->current_user();

        $id_user = $data['current_user']->id;
        $getdata =  $this->nomor_model->getWhere(["view"=>"1","id_user"=>$id_user]);
        foreach ($getdata as $key => $value) {
            // code...
            // print_r($value->nomor);
            $cek =  $this->nomor_model->getWhere_count(["view"=>"0","nomor"=>$value->nomor,"id_user"=>$id_user]);
            if($cek >= 1){
               $this->nomor_model->delete(["id_user"=>$id_user,"nomor"=>$value->nomor,"view"=>"1"]);    
            }else{
              $this->nomor_model->update_where(["view"=>"0"],["id_user"=>$id_user,"nomor"=>$value->nomor]);
            }
            // echo "<br>";
        }
        // print_r($getdata);
      
        
       
        redirect("./multinomor");
     

        
    }
    public function cektanggalaktif($nomor)
    {
        $nomor = $this->gantiformat($nomor);
        // $url = "http://localhost:3000/api/sidompul/v1/getV2PackageCheckSpexpdate?msisdn=".$nomor;
        $url = "http://localhost:3000/api/sidompul/v1/getV2PackageCheckBalance?msisdn=".$nomor;

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
    public function multinomor()
    {
        $this->load->library('form_validation');

        $data['setting'] = $this->setting_model->getSetting();
        $data['current_user'] = $this->auth_model->current_user();
        $data['devices'] = $this->device_model->getAlls();

           $where = [];  
        $id_user = $data['current_user']->id;
      
        $tanggal = @$_GET['tanggal'];
        if($tanggal == "" || $tanggal == null){
              $startTime = date("Y-m-d ");
            echo $convertedTime = date('Y-m-d ', strtotime('+0 hours', strtotime($startTime)));

            $tanggal = $convertedTime;
        }

        $where = ["id_user"=>$id_user,"view"=>1];


        $data['devicesa'] = $this->nomor_model->getWhere($where);
        $data['devices_count']= $this->nomor_model->getCount();

        $rules = $this->device_model->rules();
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == false) {

            $this->load->view('layouts/header', $data);
            $this->load->view('client/ceknomor/multinomor', $data);
            $this->load->view('layouts/footer');
            return;
        }
        $devicename = $this->input->post('nomor');
        $str_arr = preg_split ("/\,/", $devicename); 
      
        foreach($str_arr as $value){
            $ceklokal = $this->nomor_model->getWhere_count(["nomor"=>$value,]);
            // if($ceklokal < 1){
                 $this->nomor_model->add($value,"","Menunggu di Check","Queue","");
                 $user_id = $data['current_user']->id;
                $this->addQueue($value,$user_id);
            // }
        }
        redirect('./multinomor');
  
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
            $this->load->view('client/ceknomor/add', $data);
            $this->load->view('layouts/footer');
            return;
        }
        $devicename = $this->input->post('nomor');
		$datasetting = $this->setting_model->getSetting();
        if ($this->device_model->add($devicename, $datasetting->panel_key)) {
            redirect('./device');
        }
      
        $this->load->view('layouts/header', $data);
        $this->load->view('client/ceknomor/add', $data);
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
            $this->load->view('client/ceknomor/edit', $data);
            $this->load->view('layouts/footer');
            return;
        }

        $device = $this->input->post('nomor');
      
   
        $data = [
            "nomor"=>$device
        ];
      
     
    
		
        if ($this->device_model->update($data,$id)) {
            
            redirect('./device');
        }
      
        $this->load->view('layouts/header', $data);
        $this->load->view('client/ceknomor/edit', $data);
        $this->load->view('layouts/footer');
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
            $this->load->view('client/ceknomor/getToken', $data);
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
        $this->load->view('client/ceknomor/edit', $data);
        $this->load->view('layouts/footer');
    }
}
