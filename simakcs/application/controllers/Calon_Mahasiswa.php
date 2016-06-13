<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calon_Mahasiswa extends Admin_Controller {
	protected $_model 	 = 'Calon_Mahasiswa_Model';
	protected $_nama_model = 'mahasiswa';
	
	public function __construct(){
		parent::__construct();
		$this->_data['content'] = 'calon_mahasiswa/calon_mahasiswa_view';
		$this->_data['content_header'] = 'Data Calon Mahasiswa';
	}

	public function index($offset = 0){
		//var for view
		$this->_data['description'] = 'Tabel Data Calon Mahasiswa';
		$this->_data['page'] = 'read';
		$this->_data['link_search'] = site_url('Calon_Mahasiswa/search/');
		$this->_data['link_create'] = site_url('Calon_Mahasiswa/create');
		$this->_data['link_paging'] = $this->mahasiswa->paging('Calon_Mahasiswa/index', 3);
		if($offset == 0){
			$this->_data['offset_number'] = 0;
		} else {
			$this->_data['offset_number'] = $this->mahasiswa->offset_number($offset);
		}
		
		//get data
		if($data = $this->mahasiswa->get_with_paging($offset)){
			$this->_data['data_calon_mahasiswa'] = $data;
		} else {
			$this->_data['data_calon_mahasiswa'] = array();
		}

		//load view
		$this->load->view($this->_layout, $this->_data);
	}

	public function search($offset = 0){
		//var for view
		$this->_data['description'] = 'Pencarian Data Calon Mahasiswa';
		$this->_data['page'] = 'read';
		$this->_data['link_search'] = site_url('Calon_Mahasiswa/search/');
		$this->_data['link_create'] = site_url('Calon_Mahasiswa/create');
		$this->_data['link_back'] = site_url('Calon_Mahasiswa');
		if($offset == 0){
			$this->_data['offset_number'] = 0;
		} else {
			$this->_data['offset_number'] = $this->mahasiswa->offset_number($offset);
		}
		
		//set parameter
		$collumn = array(
			'no_reg',
			'nama_mahasiswa',
			'tgl_reg',
			'jenis_kelamin',
			'asal_sma',
			'angkatan',
			'alamat',
			'no_telp',
			'email'
		);

		$order = array(
			'by'	=> 'nomor',
			'sort'	=> 'ASC'
		);

		//get data
		if($data = $this->mahasiswa->get_with_search($order, $collumn, $offset)){
			$this->_data['data_calon_mahasiswa'] = $data;
		} else {
			$this->_data['data_calon_mahasiswa'] = array();
		}

		//paging link
		$this->_data['link_paging'] = $this->mahasiswa->paging('Calon_Mahasiswa/search', 3, 'pencarian', $collumn);
				
		//load view
		$this->load->view($this->_layout, $this->_data);	
	}

	public function create(){
		//submit data
		if($this->input->post('submit') == 'Tambah Data'){
			if($this->form_validation->run()){
				$biodata = array(
					'no_reg' => $this->input->post('noreg'),
					'id_agama' => $this->input->post('agama'),
					'id_semester' => $this->input->post('semester'),
					'tgl_reg' => $this->input->post('tgl_reg'),
					'nama_mahasiswa' => $this->input->post('nama_mhs'),
					'tempat_lahir' => $this->input->post('tempat_lahir'),
					'tanggal_lahir' => $this->input->post('tgl_lahir'),
					'jenis_kelamin' => $this->input->post('jenis_kelamin'),
					'prodi' => $this->input->post('program_studi'),
					'asal_sma' => $this->input->post('asal_sma'),
					'angkatan' => $this->input->post('angkatan')
				);
				
				$alamat = array(
					'no_reg' => $this->input->post('noreg'),
					'id_kewarganegaraan' => $this->input->post('warganegara'),
					'id_provinsi' => $this->input->post('provinsi'),
					'id_kabupaten' => $this->input->post('kabupaten'),
					'id_kecamatan' => $this->input->post('kecamatan'),
					'id_jenis_tinggal' => $this->input->post('jenis_tinggal'),
					'nik' => $this->input->post('nik'),
					'alamat' => $this->input->post('alamat'),
					'kelurahan' => $this->input->post('kelurahan'),
					'dusun' => $this->input->post('dusun'),
					'rt' => $this->input->post('rt'),
					'rw' => $this->input->post('rw'),
					'kode_pos' => $this->input->post('kode_pos'),
					'no_telp' => $this->input->post('telephone'),
					'no_hp' => $this->input->post('handphone'),
					'email' => $this->input->post('email'),
					'kps' => $this->input->post('kps'),
					'no_kps' => $this->input->post('no_kps')
				);

				if($this->mahasiswa->create($biodata, $alamat)){
					$this->session->set_flashdata('success', 'Data calon mahasiswa berhasil ditambahkan.');
				} else {
					$this->session->set_flashdata('error', 'Data calon mahasiswa gagal ditambahkan.');
				}
				redirect('Calon_Mahasiswa');
			}
		}

		//var for view
		$this->_data['description'] = 'Create Data Calon Mahasiswa';
		$this->_data['page'] = 'create';

		//data passing
		$this->_data['data_pelengkap'] = array(
			'tanggal_sekarang' => $this->mahasiswa->get_tanggal_sekarang(),
			'agama' => $this->mahasiswa->get_agama(),
			'warganegara' => $this->mahasiswa->get_negara(),
			'provinsi' => $this->mahasiswa->get_provinsi(),
			'kabupaten' => $this->mahasiswa->get_kabupaten(),
			'kecamatan' => $this->mahasiswa->get_kecamatan(),
			'jenis_tinggal' => $this->mahasiswa->get_jenis_tinggal(),
			'program_studi' => 'S1 Teknik Informatika',
			'semester' => $this->mahasiswa->get_semester(),
			'last_id' => $this->mahasiswa->get_last_id(),
			'kps' => 	array(
				array('id' => 0,'nama' => 'Tidak'),
				array('id' => 1,'nama' => 'Ya')
			),
			'jenis_kelamin' => 	array(
				array('id' => 0,'nama' => 'Laki - Laki'),
				array('id' => 1,'nama' => 'Perempuan')
			)
		);
		
		$this->load->view($this->_layout, $this->_data);
	}

	public function update($id){
		//submit data
		if($this->input->post('submit') == 'Update Data'){
			if($this->form_validation->run()){
				$clause = array(
					'no_reg' => $this->input->post('noreg')
				);

				$biodata = array(
					'id_agama' => $this->input->post('agama'),
					'id_semester' => $this->input->post('semester'),
					'tgl_reg' => $this->input->post('tgl_reg'),
					'nama_mahasiswa' => $this->input->post('nama_mhs'),
					'tempat_lahir' => $this->input->post('tempat_lahir'),
					'tanggal_lahir' => $this->input->post('tgl_lahir'),
					'jenis_kelamin' => $this->input->post('jenis_kelamin'),
					'prodi' => $this->input->post('program_studi'),
					'asal_sma' => $this->input->post('asal_sma'),
					'angkatan' => $this->input->post('angkatan')
				);
				
				$alamat = array(
					'id_kewarganegaraan' => $this->input->post('warganegara'),
					'id_provinsi' => $this->input->post('provinsi'),
					'id_kabupaten' => $this->input->post('kabupaten'),
					'id_kecamatan' => $this->input->post('kecamatan'),
					'id_jenis_tinggal' => $this->input->post('jenis_tinggal'),
					'nik' => $this->input->post('nik'),
					'alamat' => $this->input->post('alamat'),
					'kelurahan' => $this->input->post('kelurahan'),
					'dusun' => $this->input->post('dusun'),
					'rt' => $this->input->post('rt'),
					'rw' => $this->input->post('rw'),
					'kode_pos' => $this->input->post('kode_pos'),
					'no_telp' => $this->input->post('telephone'),
					'no_hp' => $this->input->post('handphone'),
					'email' => $this->input->post('email'),
					'kps' => $this->input->post('kps'),
					'no_kps' => $this->input->post('no_kps')
				);

				if($this->mahasiswa->edit($clause, $biodata, $alamat)){
					$this->session->set_flashdata('success', 'Data calon mahasiswa berhasil diupdate.');
				} else {
					$this->session->set_flashdata('error', 'Data calon mahasiswa gagal diupdate.');
				}
				redirect('Calon_Mahasiswa');
			}
		}

		//var for view
		$this->_data['description'] = 'Update Data Calon Mahasiswa';
		$this->_data['page'] = 'update';

		//data update
		if(!($data_update = $this->mahasiswa->get_data_update($id))){
			$this->session->set_flashdata('error', 'Data calon mahasiswa tidak ditemukan.');
			redirect('Calon_Mahasiswa');
		}
		$this->_data['data_update'] = $data_update;

		//data passing
		$this->_data['data_pelengkap'] = array(
			'agama' => $this->mahasiswa->get_agama(),
			'warganegara' => $this->mahasiswa->get_negara(),
			'provinsi' => $this->mahasiswa->get_provinsi(),
			'kabupaten' => $this->mahasiswa->get_kabupaten(),
			'kecamatan' => $this->mahasiswa->get_kecamatan(),
			'jenis_tinggal' => $this->mahasiswa->get_jenis_tinggal(),
			'program_studi' => 'S1 Teknik Informatika',
			'semester' => $this->mahasiswa->get_semester(),
			'kps' => 	array(
				array('id' => 0,'nama' => 'Tidak'),
				array('id' => 1,'nama' => 'Ya')
			),
			'jenis_kelamin' => 	array(
				array('id' => 0,'nama' => 'Laki - Laki'),
				array('id' => 1,'nama' => 'Perempuan')
			)
		);
		
		$this->load->view($this->_layout, $this->_data);
	}

	public function delete($id){
		if(!$this->mahasiswa->get(array('no_reg' => $id), 1)){
			$this->session->set_flashdata('error', 'Data calon mahasiswa tidak ditemukan.');
			redirect('Calon_Mahasiswa');
		}

		if($this->mahasiswa->del($id)){
			$this->session->set_flashdata('success', 'Data calon mahasiswa berhasil dihapus.');
		} else {
			$this->session->set_flashdata('error', 'Data calon mahasiswa gagal dihapus.');
		}

		redirect('Calon_Mahasiswa');
	}
}
