<?php 

class admin extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('m_JPHotel');
		if($this->session->userdata('status') != "login"){
			redirect(base_url("index.php/adminlogin"));
		}
	}
	function hapus($id){
		$where = array('id' => $id);
		$this->m_JPHotel->hapus_data($where,'JPHBook');
		redirect('index.php/admin');
	}
	function edit($id){
		$where = array('id' => $id);
		$data['JPHBook'] = $this->m_JPHotel->edit_data($where,'JPHBook')->result();
		$this->load->view('editBook',$data);
	}

	function edit_data($where,$table){		
		return $this->db->get_where($table,$where);
	}
	
	function update(){
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

		$where = array(
			'id' => $id
		);

		$this->admin->update_data($where,$data,'JPHBook');
		redirect('crud/admin');
	
	}
	function update_data($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}	
	
	function index(){
		$this->load->helper('url');
		$data['JPHBook'] = $this->m_JPHotel->tampil_data()->result();	
		$this->load->view('admin',$data);
		
	}
}	
	