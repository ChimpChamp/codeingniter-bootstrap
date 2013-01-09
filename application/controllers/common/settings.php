<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class settings extends CI_Controller{
	private $mckey = '';
	function __construct(){
		parent::__construct();
		$this->check_isvalidated();

		$this->load->model('SettingsModel');
		$this->mckey = $this->SettingsModel->GetMailchimpApi();
	}
	public function index(){
		$this->load->helper('url');
		$data = '';

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
				$this->SettingsModel->InsertMC($_POST['key']);
				echo "true";
			}else{
				echo "false";
			}
		}else{
			echo "null";	
		}
		
	}

	public function InsertShopify(){
		$this->load->model('SettingsModel');
		header('Content-Type: application/json');
		if($_POST){
			$isnert = $this->SettingsModel->InsertSHInfo($_POST);
		}
		echo 1;
	}
	private function check_isvalidated(){
		$this->load->helper('url');
		if(! $this->session->userdata('validated')){
			redirect('login/login', 'refresh');
		}
	}
}
?>