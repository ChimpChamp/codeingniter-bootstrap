<?php
class Coupons extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->check_isvalidated();
	}

	public function index(){
		redirect('coupons/add', 'refresh');
	}

	public function add(){
		$this->load->helper('url');
		$data = '';
		$data['heading'] = 'DHALIA | Add Coupons';
		$data['action'] = site_url('coupons/UploadCsv');

		$this->load->view('common/header',$data);
		$this->load->view('common/nav',$data);
		$this->load->view('coupons/addCoupon_view',$data);
		$this->load->view('common/footer',$data);
	}
	public function update(){
		$this->load->helper('url');
		$data = '';
		$data['heading'] = 'DHALIA | Update';
		
		$this->load->view('common/header',$data);
		$this->load->view('common/nav',$data);
		$this->load->view('coupons/updateCoupon_view',$data);
		$this->load->view('common/footer',$data);
	}

	public function UploadCsv(){
		$this->load->model('couponsModel');
		header('Content-Type: application/json');

		////////////////////////////file upload code start here//////////////////////

		$UploadDirectory	= 'uploads/csv/'; //Upload Directory, ends with slash & make sure folder exist

		if (!@file_exists($UploadDirectory)) {
			//destination folder does not exist
			die("4");
		}

		if($_POST)
		{	
			
			if(!isset($_FILES['mFile']))
			{
				//required variables are empty
				die("2");
			}

			
			if($_FILES['mFile']['error'])
			{
				//File upload error encountered
				die(upload_errors($_FILES['mFile']['error']));
			}
			$time = time();
			$FileName			= strtolower($_FILES['mFile']['name']); //uploaded file name
			$ImageExt			= substr($FileName, strrpos($FileName, '.')); //file extension
			$FileType			= $_FILES['mFile']['type']; //file type
			$FileSize			= $_FILES['mFile']["size"]; //file size
			$RandNumber   		= rand(0, 9999999999); //Random number to make each filename unique.
			$uploaded_date		= date("Y-m-d H:i:s");
			
			$NewFileName = $time.$FileName;
		   //Rename and save uploded file to destination folder.
			if($ImageExt == '.csv'){
			   if(move_uploaded_file($_FILES['mFile']["tmp_name"], $UploadDirectory . $NewFileName ))
			   {	
			   		$newPath = $UploadDirectory.$NewFileName;
			   		$insert = $this->couponsModel->insertCoupons($newPath);	
					die('1');
			   }else{
			   		die('2');
			   }
			}else{
				echo "3";
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