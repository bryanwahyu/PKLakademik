<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends CI_Controller {
	//atribut class
	protected $_model 		= '';
	protected $_nama_model	= '';
	protected $_layout		= 'admin/master/Master_layout_view';
	protected $_data		= array(
		'title'		=> 'SIMAK Computer Science',
		'header'	=> 'Ilmu Komputer',
		'footer'	=> '<strong>Copyright &copy; 2016 <a href="#">Ilmu Komputer</a>.</strong> All rights reserved.',
		'content'	=> '',
		'id_admin'  => NULL,
		'nama_admin'=> NULL,
		'logged_in' => NULL
	);

	public function __construct(){
		parent::__construct();

		//otomatis loading model
		if(!empty($this->_model) && !empty($this->_nama_model)){
			$this->load->model($this->_model, $this->_nama_model);
		}
		
		//periksa user
		$this->_data['logged_in'] = $this->session->userdata('logged_in');
		if(!$this->_data['logged_in']){
			redirect(site_url());
		}

		//load nama user session
		$this->_data['id_admin']  = $this->session->userdata('id_admin');
		$this->_data['nama_admin'] = $this->session->userdata('nama_admin');
	}
}