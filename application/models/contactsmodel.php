<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class contactsModel extends CI_Model{

	private $mckey = '';
	private $mcList = '';
	function __construct(){
		parent::__construct();

		$this->load->model('SettingsModel');
		$this->mckey = $this->SettingsModel->GetMailchimpApi();
		$this->mcList = $this->SettingsModel->GetMailchimpList();
		$config1 = array(
		    	'apikey' => $this->mckey,      // Insert your api key
	            'secure' => FALSE   // Optional (defaults to FALSE)
			);
			$this->load->library('MCAPI', $config1, 'mail_chimp');
	}

	public function insertCoupons($file){

		$date = date("Y-m-d H:i:s");
		$row = 1;
		$batch = array();
		if (($handle = fopen($file, "r")) !== FALSE) {
		    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		    	if($row == 1){
		    		$data = false;
		    	}
		        $num = count($data);
		        	$name = $data[1];
		        	$email = $data[2];
		        	if(isset($data[4])){
		        		$mfFile = $data[4];
		        	}else{
		        		$mfFile = '';
		        	}
		        	if($email){
			        	$batch[] = array(
			        		'EMAIL' => $email,
			        		'FNAME' => $name,
			        		'MFNAME'=> $mfFile	
			        		);
		        	}
		        	$query = $this->db->get_where('contacts', array('email' => $email));
		        	$rowcount = $query->num_rows();
		        	if($rowcount == 0){
		        		if($email){
				        	$data = array(
				        		'name' => $name,
				        		'email' => $email,
				        		'date_added' => $date,
				        		'mf_file' => $mfFile

				        		);
				        	$this->db->insert('contacts', $data);
			        	}
		        	}elseif($rowcount == 1){
		        		$ret = $query->row();
		        		$id = $ret->id;
		        		$data = array(
						            'name' => $name,
			        				'email' => $email,
			        				'date_added' => $date,
			        				'mf_file' => $mfFile
						            );

						$this->db->where('id', $id);
						$this->db->update('contacts', $data); 	
		        	}
		        	$row ++;
		    }
	    fclose($handle);
	    $this->Mailchimp_add_batch($batch);
		}
	}

	public function Mailchimp_add_batch($batch){

		// print_r($batch);
		// echo $this->mcList;
		$optin = true; //yes, send optin emails
		$double_optin = false;
		$up_exist = true; // yes, update currently subscribed users
		$replace_int = false; // no, add interest, don't replace
		$vals = $this->mail_chimp->listBatchSubscribe($this->mcList,$batch,$optin, $double_optin, $up_exist, $replace_int);

		// if ($this->mail_chimp->errorCode){
		//     echo "Batch Subscribe failed!\n";
		// 	echo "code:".$this->mail_chimp->errorCode."\n";
		// 	echo "msg :".$this->mail_chimp->errorMessage."\n";
		// } else {
		// 	echo "added:   ".$vals['add_count']."\n";
		// 	echo "updated: ".$vals['update_count']."\n";
		// 	echo "errors:  ".$vals['error_count']."\n";
		// 	foreach($vals['errors'] as $val){
		// 		echo $val['email_address']. " failed\n";
		// 		echo "code:".$val['code']."\n";
		// 		echo "msg :".$val['message']."\n";
		// 	}
		// }
	}
}
?>