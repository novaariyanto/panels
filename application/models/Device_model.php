<?php

class Device_model extends CI_Model
{
    private $_table = "tb_dompul";
    const SESSION_KEY = 'id';

    public function rules()
    {
        return [
            [
                'field' => 'nomor',
                'label' => 'Nomor',
                'rules' => 'required',
            ],
        ];
    }

    public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
 
    public function add($device_name, $panel_key)
    {
        $this->load->library('whatsva');
        $data_user = $this->auth_model->current_user();
      
        $user_id = $this->session->userdata(self::SESSION_KEY);

       
        // if ($this->getCount() >= $datapackage->device_max) {
        //     $this->session->set_flashdata('message_add_device_error', "Device has reached the maximum package limit");
        //     return false;
        // }

        $user_id = $this->session->userdata(self::SESSION_KEY);
        $data = [
            'nomor' => $device_name,
       
            'id_user' => $user_id
        ];

        return $this->db->insert($this->_table, $data);

    }

    public function getCount()
    {
        if (!$this->session->has_userdata(self::SESSION_KEY)) {
            return null;
        }
        $user_id = $this->session->userdata(self::SESSION_KEY);

        // $query = $this->db->get_where($this->_table, ['id_user' => $user_id]);
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->where("id_user", $user_id);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();

        return $query->num_rows();
    }
    public function getCount2($code_guest)
    {

        // $query = $this->db->get_where($this->_table, ['id_user' => $user_id]);
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->where("code_guest", $code_guest);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();

        return $query->num_rows();
    }
    public function getAllsLevel($level)
    {
        if (!$this->session->has_userdata(self::SESSION_KEY)) {
            return null;
        }
        $user_id = $this->session->userdata(self::SESSION_KEY);
        if ($level === "1") {
            $query = $this->db->get_where($this->_table, ['id_user' => $user_id]);

            return $query->result();
        } else {
            $query = $this->db->get($this->_table);
            return $query->result();
        }

    }
    public function getAll($limit, $start)
    {
        if (!$this->session->has_userdata(self::SESSION_KEY)) {
            return null;
        }
        $user_id = $this->session->userdata(self::SESSION_KEY);

        // $query = $this->db->get_where($this->_table, ['id_user' => $user_id]);
        $this->db->select("*");
        $this->db->from($this->_table);
        // $this->db->where("id_user", $user_id);
        $this->db->order_by("id", "desc");
        $this->db->limit($start, $limit);
        $query = $this->db->get();
        return $query->result();
    }
    public function ngab()
    {
        return ["sds"=>"asdf"];
    }
    public function getAll2($limit, $start, $code_guest)
    {

        // $query = $this->db->get_where($this->_table, ['id_user' => $user_id]);
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->where("code_guest", $code_guest);
        $this->db->order_by("id", "desc");
        $this->db->limit($start, $limit);
        $query = $this->db->get();
        $d = $query->result_array();

        return $d;
    }
    public function getAlls()
    {
        if (!$this->session->has_userdata(self::SESSION_KEY)) {
            return null;
        }
        $user_id = $this->session->userdata(self::SESSION_KEY);

        $query = $this->db->get_where($this->_table, ['id_user' => $user_id]);

        return $query->result();
    }
    public function getbyId($id)
    {
        $query = $this->db->get_where($this->_table, ['id' => $id]);
        return $query->row();
    }
    public function getWhere($where)
    {
        $query = $this->db->get_where($this->_table, $where);
        return $query->row();
    }
    public function getSetting()
    {
        $query = $this->db->get_where($this->_table, ['id' => "1"]);
        return $query->row();
    }
    public function update_where($data, $where)
    {
        return $this->db->update($this->_table, $data, $where);
    }
    public function update($data, $id)
    {
        return $this->db->update($this->_table, $data, ['id' => $id]);
    }
    public function update_($app_name, $domain, $panel_key)
    {
        $data = [
            'app_name' => $app_name,
            'domain' => $domain,
            'panel_key' => $panel_key,
        ];

        return $this->db->update($this->_table, $data, ['id' => $id]);
    }

}
