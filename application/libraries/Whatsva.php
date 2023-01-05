<?php
defined('BASEPATH') or exit('No direct script access allowed');
// versi 2
class Whatsva 
{
    private $_CI;
    public function __construct()
    {
        $this->_CI = & get_instance();
        $this->_CI->load->model('setting_model','sm');
    }


    public function ws_url()
    {
        // return "https://be1.whatsva.id";
        // return "http://103.11.75.213:8001";
        // return "https://backend.https.link";
        return "http://localhost:8000";
        // return "http://143.110.179.252:8081";
        // return "https://be3.whatsva.id";
    }
    public function some_method()
    { 
        return $this->ws_url();
    }
    // package
    public function listPackages()
    {
        $data = [];
        return $this->curlData($this->ws_url() . "/api/packages?id=".$instance_key, $data);
    }
    public function DetailPackage($id)
    {
        $data = [
            "package_id"=>$id
		];
        return $this->curlData($this->ws_url() . "/api/package/detail?id=".$instance_key, $data);
    }
    //transaction
    public function listTransactions($instance_key="")
    {
        $data = [];
        return $this->curlData($this->ws_url() . "/api/transactions?id=".$instance_key, $data);
    }
    public function createTransactions($id_package)
    {
        $data = [
            "package_id"=>$id_package
        ];
        return $this->curlData($this->ws_url() . "/api/transaction/create?id=".$instance_key, $data);
    }
    //client
    public function clientDetail()
    {
        $data = [];
        return $this->curlData($this->ws_url() . "/api/client/detail?id=".$instance_key, $data);
    }
    public function initInstance($device_name,$panel_key)
    {
        $data = [
			"instance_name"=> $device_name,
			"panel_key"=>$panel_key,
            "domain"=> base_url()
		];
        return $this->curlData($this->ws_url() . "/api/initInstance?id=".$instance_key, $data);
    }
    // Instance Data
    public function instancecData($instance_key, $panel_key)
    {
        $data = [
            "instance_key" => $instance_key,
             "panel_key" => $panel_key
        ];
        return $this->curlData($this->ws_url() . "/api/instance?id=".$instance_key, $data);
    }
  
    public function generatedQr($instance_key, $panel_key,$multidevice)
    {
        $data = [
             "id" => $instance_key,
             "isLegacy"=>($multidevice=="0")?false:true,
             "panel_key" => $panel_key,
             "panel_domain"=> base_url()
        ];
       

        return $this->curlData2($this->ws_url() . "/sessions/add?id=".$instance_key, $data);
    }
    public function resetInstance($instance_key, $panel_key)
    {
        $data = [
            "instance_key" => $instance_key
            , "panel_key" => $panel_key];
        return $this->curlData2_delete($this->ws_url() . "/sessions/delete/$instance_key?id=".$instance_key, $data);
    }
    
    
    public function statusInstance($instance_key, $panel_key)
    {
        $data = [
            "instance_key" => $instance_key
            , "panel_key" => $panel_key];
            
        return $this->curlData2_get($this->ws_url() . "/sessions/status/$instance_key?id=".$instance_key, $data);
    }
    
    public function updateMultideviceInstance($instance_key, $panel_key,$multidevice)
    {
        $data = [
            "instance_key" => $instance_key,
            "panel_key" => $panel_key,
            'multidevice'=>$multidevice
        ];
        return $this->curlData($this->ws_url() . "/api/update_multidevice?id=".$instance_key, $data);
    }
    // End Instance
    //chats
    public function listMessages($instance_key)
    {
        $data = [
            "instance_key" => $instance_key ];
        // echo json_encode($data);
        return $this->curlData2_get($this->ws_url() . "/chats?id=".$instance_key, $data);
    }
    public function listMessagesGroup($instance_key)
    {
        $data = [
            "instance_key" => $instance_key ];
        // echo json_encode($data);
        return $this->curlData2_get($this->ws_url() . "/groups?id=".$instance_key, $data);
    }
    public function getImageProfil($instance_key,$id)
    {
        $data = [
            "instance_key" => $instance_key,
            "jid"=>$id
        ];
       
        return $this->curlData($this->ws_url() . "/groups/getImages?id=".$instance_key, $data);
        
    }


    //endchats

    // Messaging
    public function sendMessageText($instance_key, $jid, $message, $panel_key)
    {
        $data = [
            "instance_key" => $instance_key,
            "jid" => $jid,
            "message" => $message,
            "panel_key" => $panel_key];
        return $this->curlData($this->ws_url() . "/chats/sendMessageText?id=".$instance_key, $data);
    }
    public function deleteMessage($instance_key, $jid, $key, $panel_key)
    {
        $data = [
            "instance_key" => $instance_key,
            "jid" => $jid,
            "key" =>["id"=> $key],
            "panel_key" => $panel_key];
        return $this->curlData($this->ws_url() . "/chats/deleteMessage?id=".$instance_key, $data);
    }
    public function sendImageUrl($instance_key, $jid, $imageUrl, $caption, $panel_key)
    {
        $data = [
            "instance_key" => $instance_key,
            "jid" => $jid,
            "imageUrl" => $imageUrl,
            "caption" => $caption
            , "panel_key" => $panel_key];
            
        return $this->curlData($this->ws_url() . "/chats/sendImageUrl?id=".$instance_key, $data);
    }
    public function sendDocumentUrl($instance_key, $jid, $documentUrl, $panel_key)
    {
        $data = [
            "instance_key" => $instance_key,
            "jid" => $jid,
            "documentUrl" => $documentUrl
            , "panel_key" => $panel_key];
        return $this->curlData($this->ws_url() . "/chats/sendDocumentUrl?id=".$instance_key, $data);
    }
    public function sendVideoUrl($instance_key, $jid, $videoUrl, $caption, $panel_key)
    {
        $data = [
            "instance_key" => $instance_key,
            "jid" => $jid,
            "videoUrl" => $videoUrl,
            "caption" => $caption
            , "panel_key" => $panel_key];
        return $this->curlData($this->ws_url() . "/chats/sendVideoUrl?id=".$instance_key, $data);
    }
    public function sendAudioUrl($instance_key, $jid, $audioUrl, $panel_key)
    {
        $data = [
            "instance_key" => $instance_key,
            "jid" => $jid,
            "audioUrl" => $audioUrl,
            "panel_key" => $panel_key];
        return $this->curlData($this->ws_url() . "/chats/sendAudioUrl?id=".$instance_key, $data);
    }
    public function sendLocation($instance_key, $jid, $lat, $long, $panel_key)
    {
        $data = [
            "instance_key" => $instance_key,
            "jid" => $jid,
            "coordinates" => [
                "lat" => $lat,
                "long" => $long,
            ], "panel_key" => $panel_key];
        return $this->curlData($this->ws_url() . "/chats/sendLocation?id=".$instance_key, $data);
    }
    public function sendVCard($instance_key, $jid, $fullname, $organization, $phoneNumber, $panel_key)
    {
        $data = [
            "instance_key" => $instance_key,
            "jid" => $jid,
            "fullname" => $fullname,
            "organization" => $organization,
            "phoneNumber" => $phoneNumber
            , "panel_key" => $panel_key];
        return $this->curlData($this->ws_url() . "/chats/sendVCard?id=".$instance_key, $data);
    }
    public function sendListMessage($instance_key, $jid, $title, $text,$footer, $buttonText, $sections,$imageUrl, $panel_key)
    {
        $data = [
            "instance_key" => $instance_key,
            "jid" => $jid,
            "title"=>$title,
            "text"=>$text,
            "footer"=>$footer, 
            "buttonText" => $buttonText,
            "sections" => $sections,
            "imageUrl"=>$imageUrl,
            "panel_key" => $panel_key];
              
        return $this->curlData($this->ws_url() . "/chats/sendListMessages?id=".$instance_key, $data);
    }
    public function sendButtonMessage($instance_key, $jid, $contentText, $footerText, $imageUrl,$buttons, $panel_key)
    {
        $data = [
            "instance_key" => $instance_key,
            "jid" => $jid,
            "contentText" => $contentText,
            "footerText" => $footerText,
            "buttons" => $buttons,
            "imageUrl"=>$imageUrl,
             "panel_key" => $panel_key];
        // echo json_encode($data);
        return $this->curlData($this->ws_url() . "/chats/sendButtonMessage?id=".$instance_key, $data);
    }
    public function sendTemplateMessages($instance_key, $jid, $text,$footer,$imageUrl, $templateButtons, $panel_key)
    {
     
        $data = [
            "instance_key" => $instance_key,
            "jid" => $jid,
            "text" => $text,
            "footer"=>$footer,
            "templateButtons" => $templateButtons,
            "imageUrl"=> $imageUrl
            , "panel_key" => $panel_key];
        // echo json_encode($data);
        $d = $this->curlData($this->ws_url() . "/chats/sendTemplateMessages?id=".$instance_key, $data);
        
        return $d;
    }
    public function sendButtonLinkMessage($instance_key, $jid, $content, $buttons, $panel_key)
    {
        $data = [
            "instance_key" => $instance_key,
            "jid" => $jid,
            "content" => $content,
            "buttons" => $buttons
            , "panel_key" => $panel_key];
        // echo json_encode($data);
        return $this->curlData($this->ws_url() . "/chats/sendButtonUrlMessages?id=".$instance_key, $data);
    }
    // End Messaging

    // Group Messaging 

    public function sendMessageTextGroup($instance_key, $jid, $message, $panel_key)
    {
        $data = [
            "instance_key" => $instance_key,
            "jid" => $jid,
            "message" => $message
            , "panel_key" => $panel_key];
           
        return $this->curlData($this->ws_url() . "/groups/sendMessageText?id=".$instance_key, $data);
    }
    public function sendImageUrlGroup($instance_key, $jid, $imageUrl, $caption, $panel_key)
    {
        $data = [
            "instance_key" => $instance_key,
            "jid" => $jid,
            "imageUrl" => $imageUrl,
            "caption" => $caption
            , "panel_key" => $panel_key];
        return $this->curlData($this->ws_url() . "/groups/sendImageUrl?id=".$instance_key, $data);
    }
    public function sendDocumentUrlGroup($instance_key, $jid, $documentUrl, $panel_key)
    {
        $data = [
            "instance_key" => $instance_key,
            "jid" => $jid,
            "documentUrl" => $documentUrl
            , "panel_key" => $panel_key];
        return $this->curlData($this->ws_url() . "/groups/sendDocumentUrl?id=".$instance_key, $data);
    }
    public function sendVideoUrlGroup($instance_key, $jid, $videoUrl, $caption, $panel_key)
    {
        $data = [
            "instance_key" => $instance_key,
            "jid" => $jid,
            "videoUrl" => $videoUrl,
            "caption" => $caption
            , "panel_key" => $panel_key];
        return $this->curlData($this->ws_url() . "/groups/sendVideoUrl?id=".$instance_key, $data);
    }
    public function sendLocationGroup($instance_key, $jid, $lat, $long, $panel_key)
    {
        $data = [
            "instance_key" => $instance_key,
            "jid" => $jid,
            "coordinates" => [
                "lat" => $lat,
                "long" => $long,
            ], "panel_key" => $panel_key];
        return $this->curlData($this->ws_url() . "/groups/sendLocation?id=".$instance_key, $data);
    }
    public function sendVCardGroup($instance_key, $jid, $fullname, $organization, $phoneNumber, $panel_key)
    {
        $data = [
            "instance_key" => $instance_key,
            "jid" => $jid,
            "fullname" => $fullname,
            "organization" => $organization,
            "phoneNumber" => $phoneNumber
            , "panel_key" => $panel_key];
        return $this->curlData($this->ws_url() . "/groups/sendVCard?id=".$instance_key, $data);
    }
    public function sendListMessageGroup($instance_key, $jid, $title, $text,$footer, $buttonText, $sections,$imageUrl, $panel_key)
    {
        $data = [
            "instance_key" => $instance_key,
            "jid" => $jid,
            "title"=>$title,
            "text"=>$text,
            "footer"=>$footer, 
            "buttonText" => $buttonText,
            "sections" => $sections,
            "imageUrl"=>$imageUrl,
            "panel_key" => $panel_key];
             
        return $this->curlData($this->ws_url() . "/groups/sendListMessages?id=".$instance_key, $data);
    }
    public function sendButtonMessageGroup($instance_key, $jid, $contentText, $footerText, $buttons, $panel_key)
    {
        $data = [
            "instance_key" => $instance_key,
            "jid" => $jid,
            "contentText" => $contentText,
            "footerText" => $footerText,
            "buttons" => $buttons
            , "panel_key" => $panel_key];
        // echo json_encode($data);
        return $this->curlData($this->ws_url() . "/groups/sendButtonMessage?id=".$instance_key, $data);
    }

    public function sendTemplateMessagesGroup($instance_key, $jid, $text,$footer,$imageUrl, $templateButtons, $panel_key)
    {
     
        $data = [
            "instance_key" => $instance_key,
            "jid" => $jid,
            "text" => $text,
            "footer"=>$footer,
            "templateButtons" => $templateButtons,
            "imageUrl"=> $imageUrl
            , "panel_key" => $panel_key];
        // echo json_encode($data);
        $d = $this->curlData($this->ws_url() . "/groups/sendTemplateMessages?id=".$instance_key, $data);
        
        return $d;
    }
   



    // End Group Messaging

    // Group Event

    public function createGroup($instance_key, $groupName, $participants)
    {
       
        $data = [
            "instance_key" => $instance_key,
            "groupName" => $groupName,
            "participants" => $participants];
        echo json_encode($data);
        return $this->curlData($this->ws_url() . "/groups/createGroup?id=".$instance_key, $data);
    }
    public function makeAdminGroup($instance_key, $jid, $participants)
    {
        $data = [
            "instance_key" => $instance_key,
            "jid" => $jid,
            "participants" => $participants];
        // echo json_encode($data);
        return $this->curlData($this->ws_url() . "/groups/makeAdmin?id=".$instance_key, $data);
    }
    public function demoteAdminGroup($instance_key, $jid, $participants)
    {
        $data = [
            "instance_key" => $instance_key,
            "jid" => $jid,
            "participants" => $participants];
        // echo json_encode($data);
        return $this->curlData($this->ws_url() . "/api/demoteAdmin?id=".$instance_key, $data);
    }
    public function addParticipants($instance_key, $jid, $participants)
    {
        $data = [
            "instance_key" => $instance_key,
            "jid" => $jid,
            "participants" => $participants];
        // echo json_encode($data);
        return $this->curlData($this->ws_url() . "/api/addParticipants?id=".$instance_key, $data);
    }
    public function removeParticipants($instance_key, $jid, $participants)
    {
        $data = [
            "instance_key" => $instance_key,
            "jid" => $jid,
            "participants" => $participants];
        // echo json_encode($data);
        return $this->curlData($this->ws_url() . "/api/removeParticipants?id=".$instance_key, $data);
    }

    public function updateSubjectGroup($instance_key, $jid, $subject)
    {
        $data = [
            "instance_key" => $instance_key,
            "jid" => $jid,
            "groupName" => $subject];
        // echo json_encode($data);
        return $this->curlData($this->ws_url() . "/groups/setGroupName?id=".$instance_key, $data);
    }

    public function updateDescriptionGroup($instance_key, $jid, $description)
    {
        $data = [
            "instance_key" => $instance_key,
            "jid" => $jid,
            "description" => $description];
        // echo json_encode($data);
        return $this->curlData($this->ws_url() . "/api/updateDescription?id=".$instance_key, $data);
    }

    public function leaveGroup($instance_key, $jid)
    {
        $data = [
            "instance_key" => $instance_key,
            "jid" => $jid];
        // echo json_encode($data);
        return $this->curlData($this->ws_url() . "/api/leave?id=".$instance_key, $data);
    }
    public function inviteCode($instance_key, $jid)
    {
        $data = [
            "instance_key" => $instance_key,
            "jid" => $jid];
        // echo json_encode($data);
        return $this->curlData($this->ws_url() . "/api/inviteCode?id=".$instance_key, $data);
    }
    public function listParticipants($instance_key, $jid)
    {
        $data = [
            "instance_key" => $instance_key,
            "jid" => $jid];
        // echo json_encode($data);
        return $this->curlData($this->ws_url() . "/api/listParticipants?id=".$instance_key, $data);
    }
    public function groupInfo($instance_key, $jid)
    {
        $data = [
            "instance_key" => $instance_key,
            "jid" => $jid];
        // echo json_encode($data);
        return $this->curlData($this->ws_url() . "/api/listParticipants?id=".$instance_key, $data);
    }

    public function listGroup($instance_key)
    {
        $data = [
            "instance_key" => $instance_key ];
        // echo json_encode($data);
        return $this->curlData2_get($this->ws_url() . "/groups?id=".$instance_key, $data);
    }

    // End Group Event
    
    // tools
    public function checkNumber($instance_key,$jid)
    {
       
        $data = [
            "instance_key" => $instance_key,
            "jid" => $jid
        ];
        return $this->curlData($this->ws_url() . "/chats/checkNumber?id=".$instance_key, $data);
    }
    public function checkNumber_server($jid)
    {
        $instance_key = "CR8Uz5m7T8tk";
        $data = [
            "instance_key" => $instance_key,
            "jid" => $jid
        ];
    
        return $this->curlData($this->ws_url() . "/chats/checkNumber?id=".$instance_key, $data);
    }
    // end tools
    
    // Core of the Core
    public function curlData($url, $data)
    {
       
        $datasetting = $this->_CI->sm->getSetting();
        
        // array_push($data);
        $data['panel_key'] = $datasetting->panel_key;
        $data['panel_domain'] = $datasetting->domain;

        $curl = curl_init();

        $payload = json_encode($data);
    

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','referer:http://localhost:8088'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
     
        curl_close($ch);
        return $result;

    }
    public function curlData2($url, $data)
    {
    
        $datasetting = $this->_CI->sm->getSetting();
        
        // array_push($data);
        $data['panel_key'] = $datasetting->panel_key;
        $data['panel_domain'] = $datasetting->domain;

        $curl = curl_init();

        $payload = json_encode($data);
     

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type:application/json','referer:http://localhost:8088'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
       
        curl_close($ch);
        return $result;

    }
    public function curlData2_get($url, $data)
    {
        $datasetting = $this->_CI->sm->getSetting();
        
        // array_push($data);
        $data['panel_key'] = $datasetting->panel_key;
        $data['panel_domain'] = $datasetting->domain;

        $curl = curl_init();

        $payload = http_build_query($data);
      

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/x-www-form-urlencoded','referer:http://localhost:8088'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
     
        curl_close($ch);
        return $result;

    }
    public function curlData2_delete($url, $data)
    {
        $datasetting = $this->_CI->sm->getSetting();
        
        // array_push($data);
        $data['panel_key'] = $datasetting->panel_key;
        $data['panel_domain'] = $datasetting->domain;

        $curl = curl_init();

        $payload = http_build_query($data);
      

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/x-www-form-urlencoded','referer:http://localhost:8088'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
     
        curl_close($ch);
        return $result;

    }
   
    // End Core of the Core
}
