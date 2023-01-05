<?php

class Package_model extends CI_Model
{
    private $_table = "tb_package";
    const SESSION_KEY = 'id';

    public function rules()
    {
        return [
            [
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required',
            ],
            [
                'field' => 'price',
                'label' => 'Price',
                'rules' => 'required',
            ], [
                'field' => 'device_max',
                'label' => 'Device_max',
                'rules' => 'required',
            ], [
                'field' => 'day_value',
                'label' => 'Day Value',
                'rules' => 'required',
            ]
        ];
    }
	

    public function insert($name,$price,$device_max,$day_value)
    {
        $data = [
            'name' => $name,
            'price' => $price,
            'device_max' => $device_max,
            'day_value'=> $day_value,
            'status'=> "1"
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
        $this->db->where('status','1');
		$this->db->order_by("id","desc");
        $query = $this->db->get();

        
	
        return 	$query->num_rows();
	}
    public function getAll()
    {
        if (!$this->session->has_userdata(self::SESSION_KEY)) {
            return null;
        }
        $user_id = $this->session->userdata(self::SESSION_KEY);

        // $query = $this->db->get_where($this->_table, ['id_user' => $user_id]);
        $this->db->select("*");
		$this->db->from($this->_table);
        $this->db->where("status","1");
		$this->db->order_by("id","desc");
        $query = $this->db->get();
		return $query->result();
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
	public function update($data,$id)
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
    public function delete($id)
	{
		return $this->db->update($this->_table, ['status'=>'0'], ['id' => $id]);
	}

}
