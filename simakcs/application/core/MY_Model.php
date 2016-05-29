<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {
	protected $_tabel		= '';
	protected $_offset		= 0;
	protected $_per_page	= 0;

	public function __construct(){
		parent::__construct();
	}

	/*
	 |----------------------------------------------------
	 |
	 | CREATE, READ, UPDATE, DELETE CORE FUNCTION MODEL 
	 |
	 |----------------------------------------------------
	 */
	//Read multiple data (limit, all, kondisi)
	public function get($kondisi = NULL, $limit = NULL){
		//seleksi data
		if(is_array($kondisi) && !is_null($kondisi)){
			$this->db->where($kondisi);
		}

		//limit data
		if(!is_null($limit)){
			$this->db->limit($limit);
		}

		//return query data
		return $this->db->get($this->_tabel)->result();
	}

	//Read single data (limit, kondisi)
	public function get_one($kondisi = array(), $limit = 1){
		//kondisi tidak diisi
		if(is_null($kondisi)){
			return FALSE;
		}

		//seleksi data
		$this->db->where($kondisi);
		
		//limit data
		$this->db->limit($limit);

		//return query data
		return $this->db->get($this->_tabel)->row();
	}

	//Read data with paging
	public function get_with_paging($offset = 0, $kondisi = NULL){
		//seleksi with kondisi
		if(!is_null($kondisi) && is_array($kondisi)){
			$this->get_real_offset($offset);
			$this->db->where($kondisi);
			$this->db->limit($this->_per_page, $this->_offset);
		}

		//seleksi without kondisi
		if(is_null($kondisi) || empty($kondisi)){
			$this->get_real_offset($offset);
			$this->db->limit($this->_per_page, $this->_offset);
		}

		//get data
		$this->db->cache_delete_all();
		return $this->db->get($this->_tabel)->result();
	}

	//Read data with searching
	public function get_with_search($order = array(), $attribute = array(), $offset = 0){
		$this->get_real_offset($offset);

		$kunci = $this->input->get('kata_kunci', TRUE);
		$statement = array();

		$k = 0;
		foreach($attribute as $value){
			$statement[++$k] = '`'.$value.'` LIKE \'%'.$kunci.'%\'';
		}
		$or_statement = implode(' OR ', $statement);

		$search = $this->db->where("(".$or_statement.")")
						   ->limit($this->_per_page, $this->_offset)
						   ->order_by($order['by'], $order['sort'])
						   ->get($this->_tabel)
						   ->result();

		return $search;
	}

	//Insert data
	public function insert($data = array()){
		return $this->db->insert($this->_tabel, $data);
	}

	//Update data
	public function update($kondisi = array(), $data = array(), $limit = 1){
		//seleksi data
		$this->db->where($kondisi);

		//limit data
		$this->db->limit($limit);

		//update data
		return $this->db->update($this->_tabel, $data);
	}

	//Delete data
	public function delete($kondisi = array(), $limit = 1){
		//seleksi data
		$this->db->where($kondisi);

		//limit data
		$this->db->limit($limit);

		//delete data
		$this->db->delete($this->_tabel);

		//return data
		if($this->db->affected_rows() > 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}

	/*
	 |----------------------------------------------------
	 |
	 | SUPPORT CORE FUNCTION MODEL 
	 |
	 |----------------------------------------------------
	 */
	//get real offset
	public function get_real_offset($offset = NULL){
		if(is_null($offset) || empty($offset)){
			$this->_offset = 0;
		} else {
			$this->_offset = ($offset*$this->_per_page)-$this->_per_page;
		}
	}

	//Mengurutkan data berdasarkan kolom....dengan urutan....
	public function sort($field, $order = 'ASC'){
		$this->db->order_by($field, $order);
		
		return $this;
	}

	//Jumlah data yang dicari
	public function cari_num_rows($attribute = array()){
		$kunci = $this->input->get('kata_kunci', TRUE);
		$statement = array();

		$k = 0;
		foreach($attribute as $value){
			$statement[++$k] = '`'.$value.'` LIKE \'%'.$kunci.'%\'';
		}
		$or_statement = implode(' OR ', $statement);

		$rows = $this->db->where($or_statement)->get($this->_tabel)->num_rows();

		return $rows;
	}

	//Menghitung offset number untuk penomoran baris data
	public function offset_number($offset){
		return ($offset * $this->_per_page - $this->_per_page);
	}

	//Membuat paging.
	public function paging($base_url, $uri_segment, $tipe = 'biasa', $kondisi = array()){
		//Konfigurasi.
		$config = array(
			'base_url' 			=> site_url($base_url),
			'uri_segment' 		=> $uri_segment,
			'per_page' 			=> $this->_per_page,
			'use_page_numbers' 	=> TRUE,
			'num_links' 		=> 2,
			'first_link' 		=> '&lt;&lt; First',
			'last_link' 		=> 'Last &gt;&gt;',
			'next_link' 		=> 'Next &gt;',
			'prev_link' 		=> '&lt; Prev',

            //Menyesuaikan untuk Twitter Bootstrap 3.2.0.
			'full_tag_open' 	=> '<ul class="pagination pagination-sm">',
			'full_tag_close' 	=> '</ul>',
			'num_tag_open' 		=> '<li>',
			'num_tag_close' 	=> '</li>',
			'cur_tag_open' 		=> '<li class="disabled"><li class="active"><a href="#">',
			'cur_tag_close' 	=> '<span class="sr-only"></span></a></li>',
			'next_tag_open' 	=> '<li>',
			'next_tagl_close' 	=> '</li>',
			'prev_tag_open' 	=> '<li>',
			'prev_tagl_close' 	=> '</li>',
			'first_tag_open' 	=> '<li>',
			'first_tagl_close' 	=> '</li>',
			'last_tag_open' 	=> '<li>',
			'last_tagl_close' 	=> '</li>',
		);

		//Jika paging digunakan untuk "pencarian", tambahkan / tampilkan $_GET di URL.
		//Caranya dengan memanipulasi $config['suffix'].
		if ($tipe == 'pencarian'){
			if (count($_GET) > 0){
				$config['suffix'] = '?' . http_build_query($_GET, '', "&");
			}
			$config['first_url']  = $config['base_url'] . '/1?' . http_build_query($_GET);
			$config['total_rows'] = $this->cari_num_rows($kondisi);
		} else {
			$config['first_url']  = '1';
			$config['total_rows'] = $this->db->get($this->_tabel)->num_rows();
		}

		// Set konfigurasi.
		$this->pagination->initialize($config);

		// Buat link dan kembalikan link paging yang sudah jadi.
		return $this->pagination->create_links();
	}
}