<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calon_Mahasiswa_Model extends MY_Model {
	protected $_tabel 		= 'calon_mahasiswa';
	protected $_offset 		= 0;
	protected $_per_page 	= 10;

	public function get_tanggal_sekarang(){
		date_default_timezone_set('Asia/Makassar');
		return date('Y-m-d H:i:s');
	}

	public function get_last_id(){
		//parameter
		date_default_timezone_set('Asia/Makassar');
		$prefix	  = '00000000';
		$year_now = date('Y');
		$etc 	  = 'CMHS';
		$bind 	  = '-';

		//get_last_id
		$query = $this->db->query('CALL get_last_id()');
		$result = $query->result();

		//jika tahun berubah maka pake id ini
		if($year_now != $result[0]->tahun || $result==NULL){
			$new_id = '00000001'.$bind.$etc.$bind.$year_now;
			return $new_id;
		}

		$len = strlen($result[0]->urutan);
		$new_id = substr_replace($prefix, ((int) $result[0]->urutan + 1), (0-$len), $len).$bind.$etc.$bind.$result[0]->tahun;

		return $new_id;
	}

	public function get_agama(){
		$this->_tabel = 'agama';
		return $this->get();
	}

	public function get_semester(){
		$this->_tabel = 'semester';
		return $this->get();
	}

	public function get_negara(){
		$this->_tabel = 'negara';
		return $this->get();
	}

	public function get_provinsi(){
		$this->_tabel = 'provinsi';
		return $this->get();
	}
	
	public function get_kabupaten(){
		$this->_tabel = 'kabupaten';
		return $this->get();
	}

	public function get_kecamatan(){
		$this->_tabel = 'kecamatan';
		return $this->get();
	}

	public function get_jenis_tinggal(){
		$this->_tabel = 'jenis_tinggal';
		return $this->get();
	}

	public function get_with_search($order = array(), $attribute = array(), $offset = 0){
		$this->get_real_offset($offset);

		$kunci = $this->input->get('kata_kunci', TRUE);
		$kunci = strtolower($kunci);
		$statement = array();

		$k = 0;

		foreach($attribute as $value){
			if(strpos($kunci, 'laki') || strpos($kunci, 'perempuan')){
				$jenis = 0;
				if(strpos($kunci, 'perempuan')){
					$jenis = 1;
				}
				$statement[++$k] = '`'.'jenis_kelamin'.'` = '.$jenis;	
			} else {
				$statement[++$k] = '`'.$value.'` LIKE \'%'.$kunci.'%\'';
			}
		}
		$or_statement = implode(' OR ', $statement);

		$search = $this->db->where("(".$or_statement.")")
						   ->limit($this->_per_page, $this->_offset)
						   ->order_by($order['by'], $order['sort'])
						   ->get($this->_tabel)
						   ->result();

		return $search;
	}

	public function create($data_biodata, $data_alamat){
		$this->_tabel = 'biodata_calon_mahasiswa';
		$insert_biodata = $this->db->insert($this->_tabel, $data_biodata);

		$this->_tabel = 'alamat_calon_mahasiswa';
		$insert_alamat = $this->db->insert($this->_tabel, $data_alamat);
		
		return ($insert_biodata && $insert_alamat);
	}

	public function edit($id, $data_biodata, $data_alamat, $limit = 1){
		//seleksi data
		$this->db->where($id);

		//limit data
		$this->db->limit($limit);

		//update data
		$this->_tabel = 'biodata_calon_mahasiswa';
		$update_biodata = $this->db->update($this->_tabel, $data_biodata);
		
		$this->_tabel = 'alamat_calon_mahasiswa';
		$update_alamat = $this->db->update($this->_tabel, $data_alamat);

		return ($update_biodata && $update_alamat);
	}

	public function del($id, $limit = 1){
		//seleksi data
		$this->db->where($id);

		//limit data
		$this->db->limit($limit);

		//delete data
		$this->_tabel = 'alamat_calon_mahasiswa';
		$delete_alamat = $this->db->delete($this->_tabel);
		
		$this->_tabel = 'biodata_calon_mahasiswa';
		$delete_biodata = $this->db->delete($this->_tabel);

		//return data
		return ($delete_alamat && $delete_biodata);
	}
}