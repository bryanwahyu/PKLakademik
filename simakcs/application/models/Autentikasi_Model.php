<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autentikasi_Model extends MY_Model {
	public function cek_login($username, $password){
		//override atribut superkelas
		$this->_tabel = 'admin';

		//Konfigurasi read data
		$kondisi = array(
			'username' => $username,
			'password' => md5($password)
		);
		
		//read data dan simpan pada variabel objek $data
		$data = $this->get_one($kondisi);

		if($data){
			return $data;
		} else {
			return FALSE;
		}
	}
}