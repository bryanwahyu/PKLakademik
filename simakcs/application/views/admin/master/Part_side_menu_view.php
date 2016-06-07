<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <section class="sidebar">\
        <ul class="sidebar-menu">
            <li class="header">MAIN MENU</li>
            <!--<li><a href="#"><i class="fa fa-link"></i> <span>Link</span></a></li>-->
            <li><a href="<?php echo site_url('Home'); ?>"><i class="fa fa-link"></i> <span>Home</span></a></li>
            <li class="treeview">
                <a href="#"><i class="fa fa-link"></i> <span>Pendaftaran Mahasiswa</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('Calon_Mahasiswa'); ?>">Pendaftaran Calon Mahasiswa</a></li>
                    <li><a href="<?php echo site_url('Mahasiswa_Lolos'); ?>">Mahasiswa Lolos Seleksi</a></li>
                </ul>
            </li>
        </ul>        
    </section>
</aside>