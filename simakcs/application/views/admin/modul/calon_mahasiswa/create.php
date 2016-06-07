<?php
	$list_jenis_kelamin = '';
	$list_agama = '';
	$list_warganegara = '';
	$list_provinsi = '';
	$list_kabupaten = '';
	$list_kecamatan = '';
	$list_kps = '';
	$list_jenis_tinggal = '';
	$list_program_studi = '';
	$list_semester = '';

	foreach($data_pelengkap['jenis_kelamin'] as $row){
		$list_jenis_kelamin .= '<option value="'.$row['id'].'" '.set_select('jenis_kelamin', $row['id']).'>'.$row['nama'].'</option>';
	}
	unset($row);

	foreach($data_pelengkap['agama'] as $row){
		$list_agama .= '<option value="'.$row->id_agama.'" '.set_select('agama', $row->id_agama).'>'.$row->nama_agama.'</option>';
	}
	unset($row);

	foreach($data_pelengkap['warganegara'] as $row){
		$list_warganegara .= '<option value="'.$row->id_negara.'" '.set_select('warganegara', $row->id_negara).'>'.$row->nama_negara.'</option>';
	}
	unset($row);

	foreach($data_pelengkap['provinsi'] as $row){
		$list_provinsi .= '<option value="'.$row->id_provinsi.'" '.set_select('provinsi', $row->id_provinsi).'>'.$row->nama_provinsi.'</option>';
	}
	unset($row);

	foreach($data_pelengkap['kabupaten'] as $row){
		$list_kabupaten .= '<option value="'.$row->id_kabupaten.'" '.set_select('kabupaten', $row->id_kabupaten).'>'.$row->nama_kabupaten.'</option>';
	}
	unset($row);

	foreach($data_pelengkap['kecamatan'] as $row){
		$list_kecamatan .= '<option value="'.$row->id_kecamatan.'" '.set_select('kecamatan', $row->id_kecamatan).'>'.$row->nama_kecamatan.'</option>';
	}
	unset($row);

	foreach($data_pelengkap['kps'] as $row){
		$list_kps .= '<option value="'.$row['id'].'" '.set_select('kps', $row['id']).'>'.$row['nama'].'</option>';
	}
	unset($row);

	foreach($data_pelengkap['jenis_tinggal'] as $row){
		$list_jenis_tinggal .= '<option value="'.$row->id_jenis_tinggal.'" '.set_select('jenis_tinggal', $row->id_jenis_tinggal).'>'.$row->nama_jenis_tinggal.'</option>';
	}
	unset($row);

	$list_program_studi .= '<option value="'.$data_pelengkap['program_studi'].'">'.$data_pelengkap['program_studi'].'</option>';

	foreach($data_pelengkap['semester'] as $row){
		$semester = ($row->semester == 0) ? 'Ganjil' : 'Genap';
		$list_semester .= '<option value="'.$row->id_semester.'" '.set_select('semester', $row->id_semester).'>'.$semester.'  '.$row->tahun_ajaran.'</option>';
	}
	unset($row);
?>
<form class="form-horizontal" action="<?php echo site_url('Calon_Mahasiswa/create'); ?>" method="POST">
<div class="row">
<!--Kotak Untuk Biodata Calon Mahasiswa paling kiri-->
    <div class="col-xs-5 pull-left">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Biodata Calon Mahasiswa</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label for="noreg" class="col-sm-3 control-label">No. Registrasi*</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="noreg" name="noreg" value="<?php echo $data_pelengkap['last_id']; ?>" readonly="readonly" />
                    </div>
                </div>
            	
            	<div class="form-group">
                    <label for="tgl_reg" class="col-sm-3 control-label">Tgl. Registrasi*</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tgl_reg" name="tgl_reg" value="<?php echo (form_error('tgl_reg')) ? set_value('tgl_reg') : $data_pelengkap['tanggal_sekarang']; ?>" />
                        <?php echo form_error('tgl_reg'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="nama_mhs" class="col-sm-3 control-label">Nama Mahasiswa*</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama_mhs" name="nama_mhs" value="<?php echo set_value('nama_mhs'); ?>" placeholder="Nama Mahasiswa" />
                        <?php echo form_error('nama_mhs'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="tempat_lahir" class="col-sm-3 control-label">Tempat Lahir*</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?php echo set_value('tempat_lahir'); ?>" placeholder="Tempat Lahir" />
                        <?php echo form_error('tempat_lahir'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="tgl_lahir" class="col-sm-3 control-label">Tanggal Lahir*</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?php echo set_value('tgl_lahir'); ?>" placeholder="YYYY-MM-DD" />
                        <?php echo form_error('tgl_lahir'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="jenis_kelamin" class="col-sm-3 control-label">Jenis Kelamin*</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                        	<?php echo $list_jenis_kelamin; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="agama" class="col-sm-3 control-label">Agama*</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="agama" name="agama">
                        	<?php echo $list_agama; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="box-footer">
            </div>
        </div>        
    </div>

    <!--Kotak Paling Kanan-->
    <div class="col-xs-7 pull-right">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Alamat Calon Mahasiswa</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label for="nik" class="col-sm-2 control-label">NIK*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK" value="<?php echo set_value('nik'); ?>" />
                        <?php echo form_error('nik'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="alamat" class="col-sm-2 control-label">Alamat*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" value="<?php echo set_value('alamat'); ?>" />
                        <?php echo form_error('alamat'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="warganegara" class="col-sm-2 control-label">Warga Negara*</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="warganegara" name="warganegara">
                        	<?php echo $list_warganegara; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="provinsi" class="col-sm-2 control-label">Provinsi*</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="provinsi" name="provinsi">
                        	<?php echo $list_provinsi; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="kabupaten" class="col-sm-2 control-label">Kabupaten*</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="kabupaten" name="kabupaten">
                        	<?php echo $list_kabupaten; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="kecamatan" class="col-sm-2 control-label">Kecamatan*</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="kecamatan" name="kecamatan">
                        	<?php echo $list_kecamatan; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="kelurahan" class="col-sm-2 control-label">Kelurahan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="kelurahan" name="kelurahan" placeholder="Kelurahan" value="<?php echo set_value('kelurahan'); ?>" />
                    	<?php echo form_error('kelurahan'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="dusun" class="col-sm-2 control-label">Dusun</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="dusun" name="dusun" placeholder="Dusun" value="<?php echo set_value('dusun'); ?>" />
                        <?php echo form_error('dusun'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="rt" class="col-sm-2 control-label">RT</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="rt" name="rt" placeholder="RT" value="<?php echo set_value('rt'); ?>" />
                        <?php echo form_error('rt'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="rw" class="col-sm-2 control-label">RW</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="rw" name="rw" placeholder="RW" value="<?php echo set_value('rw'); ?>" />
                        <?php echo form_error('rw'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="kode_pos" class="col-sm-2 control-label">Kode Pos</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="kode_pos" name="kode_pos" placeholder="Kode Pos" value="<?php echo set_value('kode_pos'); ?>" />
                        <?php echo form_error('kode_pos'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="jenis_tinggal" class="col-sm-2 control-label">Jenis Tinggal*</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="jenis_tinggal" name="jenis_tinggal">
                        	<?php echo $list_jenis_tinggal; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="telephone" class="col-sm-2 control-label">Telephone</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Telephone" value="<?php echo set_value('telephone'); ?>" />
                        <?php echo form_error('telephone'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="handphone" class="col-sm-2 control-label">Handphone</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="handphone" name="handphone" placeholder="Handphone" value="<?php echo set_value('handphone'); ?>" />
                        <?php echo form_error('handphone'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>" />
                        <?php echo form_error('email'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="kps" class="col-sm-2 control-label">Penerima KPS ?*</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="kps" name="kps">
                        	<?php echo $list_kps; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="no_kps" class="col-sm-2 control-label">No. KPS**</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="no_kps" name="no_kps" placeholder="Nomor KPS" value="<?php echo set_value('no_kps'); ?>" />
                    </div>
                </div>
            </div>
            <div class="box-footer"></div>
        </div>
    </div>

<!--Kotak Paling Terakhir Dibawah-->
    <div class="col-xs-5 pull-left">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Akademik Calon Mahasiswa</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label for="program_studi" class="col-sm-2 control-label">Program Studi*</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="program_studi" name="program_studi">
                        	<?php echo $list_program_studi; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="semester" class="col-sm-2 control-label">Semester*</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="semester" name="semester">
                        	<?php echo $list_semester; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="asal_sma" class="col-sm-2 control-label">Asal SMA/SMK</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="asal_sma" name="asal_sma" placeholder="Asal SMA/SMK" value="<?php echo set_value('asal_sma'); ?>" />
                        <?php echo form_error('asal_sma'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="angkatan" class="col-sm-2 control-label">Angkatan*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="angkatan" name="angkatan" placeholder="Angkatan" value="<?php echo set_value('angkatan'); ?>" />
                        <?php echo form_error('angkatan'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-5 pull-left">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Submit Data Calon Mahasiswa</h3>
            </div>
            <div class="box-footer">
                <div class="col-sm-12">
                	<center>
                    <input class="btn btn-primary btn-lg" type="submit" name="submit" value="Tambah Data" />&nbsp;&nbsp;&nbsp;
                    <input class="btn btn-default btn-lg" type="reset" name="reset" value="Reset" />&nbsp;&nbsp;&nbsp;
                    <a class="btn btn-default btn-lg" href="<?php echo site_url('Calon_Mahasiswa'); ?>">Kembali</a>
                	</center>
                </div>
            </div>
        </div>
    </div>
</div>
</form>