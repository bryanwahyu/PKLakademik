<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Admin_Controller {

	public function index()
	{
		$this->_data['content'] = 'home/home';
		$this->load->view($this->_layout, $this->_data);
	}
}