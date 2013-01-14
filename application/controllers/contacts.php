<?php
class Contacts extends CI_Controller{
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
		$data['heading'] = 'Overhaul | Add Coupons';
		$data['action'] = site_url('contacts/UploadCsv');

		$this->load->view('common/header',$data);
		$this->load->view('common/nav',$data);
		$this->load->view('contacts/add_contacts_view',$data);
		$this->load->view('common/footer',$data);
	}

	public function UploadCsv(){
		$this->load->model('contactsModel');
		header('Content-Type: application/json');
		////////////////////////////file upload code start here//////////////////////

		$UploadDirectory	= 'uploads/csv/'; 

		if (!@file_exists($UploadDirectory)) {
			//destination folder does not exist
			die("4");
		}
		//print_r($_POST);
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
			   		$insert = $this->contactsModel->insertCoupons($newPath);	
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