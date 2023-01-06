<?php

class Checknumber extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
      
        $this->load->model('setting_model');
        $this->load->model('device_model'); 
        $this->load->model('nomor_model'); 
        
        $this->load->library('whatsva');
    }

    public function index()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);
    
        if (!@$data->nomor) {
            $response = ["success" => false, "message" => "nomor empty"];
        } if (!@$data->id_user) {
            $response = ["success" => false, "message" => "id_user empty"];
        } else {
            $user_id = $data->id_user;
            $token = $this->device_model->getWhere(['id_user'=>  $user_id]);
            $cek = $this->cekNomor($data->nomor,@$token->token);
             $tanggal_aktif = "";
            $rp = json_decode($cek);

            if($rp->statusCode == 200){
                if(@$rp->result->data->dukcapil){
                   // $url = "http://localhost:3000/api/sidompul/v1/getV2PackageCheckBalance?msisdn=".$nomor;
                    $cektanggalaktif = $this->cektanggalaktif($data->nomor);
                 $data_tanggal = json_decode($cektanggalaktif);
                 $tanggal_aktif = $data_tanggal->result->data->expDate;

                    $this->nomor_model->update_where(["status"=>$rp->result->data->dukcapil,"proses"=>"Done","tanggal_aktif"=>$tanggal_aktif,"tanggal_periksa"=>date('Y-m-d h:i:s')],["nomor"=>$data->nomor]);
                }else{
                    $this->nomor_model->update_where(["status"=>"Belum","proses"=>"Done","tanggal_periksa"=>date('Y-m-d h:i:s')],["nomor"=>$data->nomor]);
                }
                 $response = ["success" => true, "message" => "","data"=>$rp];
            }else if($rp->statusCode == 401){
                 $response = ["success" => false, "message" => "session dompul expired","response"=>$rp];

                $this->addQueue($data->nomor,$user_id);
            }
        }
        echo json_encode($response);

    }
     function addQueue($nomor,$id_user)
    {
    
        
        // array_push($data);
        $data['url'] = "http://103.162.60.183:9314/panels/index.php/api/checknumber";
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
    public function cekNomor($nomor,$token)
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
}