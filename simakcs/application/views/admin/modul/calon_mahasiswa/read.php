<?php
$tbody = '';
foreach($data_calon_mahasiswa as $data){
    $id = $data->no_reg;
    $link_detail = '
        <a href="'.site_url('Calon_Mahasiswa/detail/'.$id).'" class="btn btn-primary" title="Detail Data ID : '.$id.'">
        <span class="glyphicon glyphicon-book"></span>
        <span class="sr-only">Detail</span>
        </a>
    ';
    $link_update = '
        <a href="'.site_url('Calon_Mahasiswa/update/'.$id).'" class="btn btn-success" title="Update Data ID : '.$id.'">
        <span class="glyphicon glyphicon-edit"></span>
        <span class="sr-only">Update</span>
        </a>
    ';
    $link_delete = '
        <a href="'.site_url('Calon_Mahasiswa/delete/'.$id).'" class="btn btn-danger" data-confirm="Apakah anda yakin menghapus data ID : '.$id.' ?"  title="Delete Data ID : '.$id.'">
        <span class="glyphicon glyphicon-trash"></span>
        <span class="sr-only">Delete</span>
        </a>
    ';
    $jenis_kelamin = ($data->jenis_kelamin == 0) ? 'Laki - Laki' : 'Perempuan';
    $tbody .= '
        <tr>
            <td align="center">'.$link_detail.'</td>
            <td align="center">'.$link_update.'</td>
            <td align="center">'.$link_delete.'</td>
            <td>'.++$offset_number.'</td>
            <td>'.$id.'</td>
            <td>'.$data->nama_mahasiswa.'</td>
            <td>'.$data->tgl_reg.'</td>
            <td>'.$jenis_kelamin.'</td>
            <td>'.$data->asal_sma.'</td>
            <td>'.$data->angkatan.'</td>
            <td>'.$data->alamat.'</td>
            <td>'.$data->no_telp.'</td>
            <td>'.$data->email.'</td>
        </tr>
    ';
}
$search_view = $this->load->view('admin/modul/Search_view_part', '', true);

echo '
    <div class="box box-primary">
        <div class="box-header with-border">
            '.$search_view.'
        </div>
        <div class="box-body">
            <table class="table table-hover table-striped table-bordered table-condensed">
            <thead>
            <tr>
                <th colspan="3">Opsi</th>
                <th>No.</th>
                <th>No. Registrasi</th>
                <th>Nama Mahasiswa</th>
                <th>Tgl. Registrasi</th>
                <th>Jenis Kelamin</th>
                <th>Asal SMA</th>
                <th>Angkatan</th>
                <th>Alamat</th>
                <th>No. Telp</th>
                <th>Email</th>
            </tr>
            </thead>
            <tbody>
                '.$tbody.'
            </tbody>
            </table>
        </div>
    </div>
';
