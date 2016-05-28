<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autentikasi extends CI_Controller {
	private $_data		 = array('title' => 'SIMAK CS | LOGIN');
	private $_layout	 = 'autentikasi_view';
	private $_model 	 = 'Autentikasi_Model';
	private $_nama_model = 'autentikasi';
	
	public function __construct(){
		parent::__construct();
		
		//autentikasi jika masih dalam session
		$is_login  = $this->session->userdata('logged_in');
		$is_logout = uri_string();
		if($is_login == 1 && $is_logout != 'Autentikasi/logout'){
			redirect(site_url('home'));
		}
	}

	public function index()
	{
		$this->load->view($this->_layout, $this->_data);
	}

	public function login(){
		//get input
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		//get data database
		$this->load->model($this->_model, $this->_nama_model);
		$data = $this->autentikasi->cek_login($username, $password);

		if($data){
			//konfigurasi session
			$session = array(
				'logged_in'		=> TRUE,
				'id_admin'		=> $data->id_admin,
				'nama_admin'	=> $data->nama_admin
			);
			$this->session->set_userdata($session);

			//redirect
			redirect(site_url('home'));
		} else {
			$this->session->set_flashdata('error', 'Username dan Password salah.');
			redirect(site_url());
		}
	}

	public function logout(){
		//is there any user login?
		if(!$this->session->userdata('logged_in')){
			redirect(site_url());
		}
		$session = array('logged_in', 'id_admin', 'nama_admin');
		$this->session->unset_userdata($session);
		$this->session->sess_destroy();
		redirect(site_url());
	}
}
