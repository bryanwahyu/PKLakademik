<!DOCTYPE html>
<html>
<head>
    <!--Meta Web-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?php echo $title; ?></title>
    
    <!--CSS Web-->
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/adminLTE/css/AdminLTE.min.css'); ?>" />
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="<?php echo base_url('assets/html5shiv/html5shiv.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/respond/respond.min'); ?>"></script>
    <![endif]-->
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?php echo site_url('Autentikasi'); ?>"><b>SIMAK</b> Computer Science</a>
        </div>
        <?php $this->load->view('messages_view'); ?>
        <div class="login-box-body">
            <p class="login-box-msg">Login Untuk Akses Ke SIMAK Computer Science</p>
            <form action="<?php echo site_url('Autentikasi/login'); ?>" method="POST">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Username" name="username" />
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password" />
                </div>
                <div class="row">
                    <div class="col-xs-4 col-xs-offset-8">
                        <input type="submit" class="btn btn-primary btn-block btn-flat" value="Sign In" name="signin" />
                    </div>
                </div>
            </form>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <!--JS-->
    <script src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.2.0.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
</body>
</html>