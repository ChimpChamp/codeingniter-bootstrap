<?php
class Coupons extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->check_isvalidated();
	}

	public function index(){
		//redirect('coupons/add', 'refresh');
	}

	public function update(){
		$data = '';
		$data['heading'] = 'DHALIA | Update';
		
		$this->load->view('common/header',$data);
		$this->load->view('common/nav',$data);
		$this->load->view('coupons/updateCoupon_view',$data);
		$this->load->view('common/footer',$data);
	}
	
	public function add(){
		$data = '';
		$data['heading'] = 'DHALIA | Add Coupons';
		
		$this->load->view('common/header',$data);
		$this->load->view('common/nav',$data);
		$this->load->view('coupons/addCoupon_view',$data);
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