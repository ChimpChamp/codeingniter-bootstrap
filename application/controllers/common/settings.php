<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class settings extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->check_isvalidated();
		
	}
	public function index(){
		$this->load->helper('url');
		$data = '';
		$data['heading'] = 'DHALIA | Settings';
		
		$this->load->view('common/header',$data);
		$this->load->view('common/nav',$data);
		$this->load->view('common/settings_view',$data);
		$this->load->view('common/footer',$data);


	}

	private function check_isvalidated(){
		$this->load->helper('url');
		if(! $this->session->userdata('validated')){
			redirect('login/login', 'refresh');
		}
	}
}
?>