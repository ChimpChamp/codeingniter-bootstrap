<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class SettingsModel extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	public function GetMailchimpApi(){

		$where = "type = 'MC' AND name = 'key'";
		$this->db->where($where);
		$query = $this->db->get('tbl_key');
		$result = $query->row();
		$rowcount = $query->num_rows();
		if($rowcount == 0){
			return 0;
		}else{
			return $result->value;
		}
	}
	public function InsertMC($key){
		if($key){
			$this->db->delete('tbl_key', array('type' => 'MC'));

			$data = array(
			   'type' => 'MC' ,
			   'name' => 'key' ,
			   'value' => $key
			); 
			$this->db->insert('tbl_key', $data); 
		}
	}

	public function InsertSHInfo($params){
		if($params){
			$this->db->delete('tbl_key', array('type' => 'SH'));
			foreach ($params as $key => $value) {
				if($key != "type"){
					$data  = array(
							'type' => 'SH' ,
					   		'name' => mysql_real_escape_string($key) ,
					   		'value' =>  mysql_real_escape_string($value)
						); 
					$this->db->insert('tbl_key', $data);
				}
			}	
		}
	}

	public function GetShopifyInfo(){
		$this->db->where('type','SH');
		$query = $this->db->get('tbl_key');
		$rowcount = $query->num_rows();
		if($rowcount == 0){
			return 0;
		}else{
			return $query->result();
		}
	}
}
?>