<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?php echo $title; ?></title>

    <!--Link CSS-->
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/font-awesome-4.3.0/css/font-awesome.min.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/ionicons-2.0.1/css/ionicons.min.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/adminLTE/css/AdminLTE.min.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/adminLTE/css/skins/skin-blue.min.css'); ?>" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="<?php echo base_url('assets/html5shiv/html5shiv.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/respond/respond.min'); ?>"></script>
    <![endif]-->
</head>

<body class="skin-blue fixed">
<div class="wrapper">
    <!--HEADER-->
  	<?php $this->load->view('admin/master/Part_header_view'); ?>

    <!--SIDE MENU-->
    <?php $this->load->view('admin/master/Part_side_menu_view'); ?>

    <!--DYNAMIC CONTENT-->
    <?php $this->load->view('admin/modul/'.$content); ?>

    <!--FOOTER-->
    <?php $this->load->view('admin/master/Part_footer_view'); ?>
</div>

<!-- REQUIRED JS SCRIPTS -->
<script src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.2.0.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/adminLTE/js/app.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/fastclick/fastclick.min.js'); ?>"></script>
</body>
</html>