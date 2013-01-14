<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class couponsModel extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	public function insertCoupons($file){

		$date = date("Y-m-d H:i:s");
		$row = 1;
		if (($handle = fopen($file, "r")) !== FALSE) {
		    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		        $num = count($data);
		        	$code = $data[0];
		        	$used = $data[1];
		        	$subscriber = $data[2];
		        	$query = $this->db->get_where('coupon', array('coupon_code' => $code));
		        	$rowcount = $query->num_rows();
		        	if($rowcount == 0){
			        	$data = array(
			        		'coupon_code' => $code,
			        		'used' => $used,
			        		'subscriber_email' => $subscriber,
			        		'date_added' => $date
			        		);
			        	$this->db->insert('coupon', $data);
		        	}elseif($rowcount == 1){
		        		$ret = $query->row();
		        		$id = $ret->id;
		        		$data = array(
						            'coupon_code' => $code,
			        				'used' => $used,
			        				'subscriber_email' => $subscriber,
			        				'date_added' => $date
						            );

						$this->db->where('id', $id);
						$this->db->update('coupon', $data); 	
		        	}
		    }
	    fclose($handle);
		}
	}
}
?>