<?php 

class JPHotel extends CI_Controller{

	function __construct(){
		parent::__construct();		
		$this->load->model('m_JPHotel');
		$this->load->helper('url');
	}

	function index(){
		$this->load->view('home');
	}

	function aksi_login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'username' => $username,
			'password' => $password,
			);
		$cek = $this->m_JPHotel->cek_login("JPHAdmin",$where)->num_rows();
		if($cek > 0){
			$data_session = array(
				'status' => "login",
				'uname' => $username,
				);

			$this->session->set_userdata($data_session);
			
			redirect(base_url("index.php/adminlogin"));

		}else{
			echo "Username dan password salah !";
		}
	}
	
	function book(){
		$this->load->view('booking');
	}

	function input_data(){
		$firstName = $this->input->post('firstName');
		$lastName = $this->input->post('lastName');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$pcode = $this->input->post('pcode');
		$city = $this->input->post('city');
		$region = $this->input->post('region');
		$address = $this->input->post('address');
		$comp = $this->input->post('comp');
		
		$data = array(
			'firstName' => $firstName
			'lastName' => $lastName
			'email' => $email
			'phone' => $phone
			'pcode' => $pcode
			'city' => $city
			'region' => $region
			'address' => $address
			'comp' => $comp
		);
		$this->m_JPHotel->input_data($data,'JPHBook');
		redirect('index.php/detail');
	}
	
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('index.php/adminlogin'));	
	}
}	