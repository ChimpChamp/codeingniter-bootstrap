<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class settings extends CI_Controller{
	private $mckey = '';
	private $mcList = '';
	function __construct(){
		parent::__construct();
		$this->check_isvalidated();

		$this->load->model('SettingsModel');
		$this->mckey = $this->SettingsModel->GetMailchimpApi();
		$this->mcList = $this->SettingsModel->GetMailchimpList();
	}
	public function index(){
		if($this->mckey && $this->mcList){
			$config1 = array(
		    	'apikey' => $this->mckey,      // Insert your api key
	            'secure' => FALSE   // Optional (defaults to FALSE)
			);
			$this->load->library('MCAPI', $config1, 'mail_chimp1');
			$retval = $this->mail_chimp1->lists();
			foreach ($retval['data'] as $list) {
				if($list['id'] == $this->mcList){
					$listname = $list['name'];
				}
			}
		}else{
			$listname = '';
		}

		///var_dump($retval['data'][0]['id']);
		$this->load->helper('url');
		$data = '';

		if($listname){
			$data['McList'] = $listname;
		}else{
			$data['McList'] = '';
		}
		// GET MAILCHIMP API
		if($this->mckey == '0'){
			$data['MCkey'] = '';
		}else{
			$data['MCkey'] = $this->mckey;
		}
		// GET SHOPIFY DATA
		$data['getShop'] = '';
		$data['getApi'] = '';
		$shopifyInfo = $this->SettingsModel->GetShopifyInfo();
		if($shopifyInfo){
			foreach ($shopifyInfo as $values) {
				$name = $values->name;
				$value = $values->value;
				if($name == 'shop'){
					$data['getShop'] = $value;
				}
				if($name == 'api'){
					$data['getApi'] = $value;
				}
			}
		}

		$data['heading'] = 'DHALIA | Settings';
		$data['actionMC'] =	site_url('common/settings/MailchimpKey');
		$data['actionShopify'] = site_url('common/settings/InsertShopify');

		$this->load->view('common/header',$data);
		$this->load->view('common/nav',$data);
		$this->load->view('common/settings_view',$data);
		$this->load->view('common/footer',$data);


	}

	public function MailchimpKey(){
		
		$this->load->model('SettingsModel');
		header('Content-Type: application/json');
		if($_POST['key']){
			$config = array('apikey' =>$_POST['key'], 'secure' => FALSE);
			$this->load->library('MCAPI', $config, 'mail_chimp');
			$lists = $this->mail_chimp->lists();
			if($lists){
				$this->SettingsModel->InsertMC($_POST);
				echo "true";
			}else{
				echo "false";
			}
		}else{
			echo "null";	
		}
		
	}
	public function getList(){
		$key =$_POST['key'];
		$config1 = array(
	    	'apikey' => $key,      // Insert your api key
            'secure' => FALSE   // Optional (defaults to FALSE)
		);
		
		$this->load->library('MCAPI', $config1, 'mail_chimp1');

		$retval = $this->mail_chimp1->lists();
		$list1 = array();
		if($retval){
			foreach ($retval['data'] as $lists) {
				$list1[] = array($lists['id'] => $lists['name']);	
			}
		}
		if($list1){
			header('Content-Type: application/json');
			echo $json = json_encode($list1);	
		}else{
			echo "0";
		}
		
		//echo $json;
		//return $json;
	}
	public function InsertShopify(){
		$this->load->model('SettingsModel');
		header('Content-Type: application/json');
		if($_POST){
			$isnert = $this->SettingsModel->InsertSHInfo($_POST);
		}
		echo 1;
	}

	public function downloadCSV(){
		header('Content-Type: application/json');

		//output headers so that the file is downloaded rather than displayed
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=data.csv');
		$MFname = $_POST['MF'];

		// create a file pointer connected to the output stream
		$output = fopen('php://output', 'w');

		// fetch the data
		$rows = mysql_query('SELECT * FROM contacts');
		$fields = array();
		$i = 0;
		while ($i < mysql_num_fields($rows)) {
			$field = mysql_fetch_field($rows,$i);
			$fields[] = $field->name;
			$i++;
		}
		
		// output the column headings
		fputcsv($output, $fields);

		// loop over the rows, outputting them
		while ($row = mysql_fetch_assoc($rows)){
			$row['mf_file'] = $MFname;
			if($row['name'] == ''){
				$row = false;
			}
			if($row){
				fputcsv($output, $row);
			}
			
		}
	}

	private function check_isvalidated(){
		$this->load->helper('url');
		if(! $this->session->userdata('validated')){
			redirect('login/login', 'refresh');
		}
	}


}
?>