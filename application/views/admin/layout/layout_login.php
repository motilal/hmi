<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo isset($title) ? $title : ''; ?></title> 
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"> 
        <link href="<?php echo base_url('asset/admin/plugin/bootstrape/css/bootstrap.min.css'); ?>" rel="stylesheet">  
        <link rel="stylesheet" href="<?php echo base_url('asset/admin/css/font-awesome.min.css'); ?>"> 
        <link rel="stylesheet" href="<?php echo base_url('asset/admin/css/ionicons.min.css'); ?>"> 
        <link rel="stylesheet" href="<?php echo base_url('asset/admin/plugin/toastr/toastr.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('asset/admin/css/admin.min.css'); ?>">   
        <script src="<?php echo base_url('asset/admin/js/jquery.min.js'); ?>"></script> 
        <script src="<?php echo base_url('asset/admin/plugin/bootstrape/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('asset/admin/plugin/toastr/toastr.min.js'); ?>"></script>  
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <script>
            var SITE_URL = '<?php echo site_url(); ?>';
            var BASE_URL = '<?php echo base_url(); ?>';
            var SUCCESS_NOTIFICATION = <?php echo json_encode($this->session->flashdata("success")); ?>;
            var ERROR_NOTIFICATION = <?php echo json_encode($this->session->flashdata("error")); ?>;
            var WARNING_NOTIFICATION = <?php echo json_encode($this->session->flashdata("warning")); ?>;
            var INFO_NOTIFICATION = <?php echo json_encode($this->session->flashdata("notification")); ?>;
            $(document).ready(function () {
                if (SUCCESS_NOTIFICATION != "" && SUCCESS_NOTIFICATION != null) {
                    showMessage('success', {message: SUCCESS_NOTIFICATION});
                } else if (ERROR_NOTIFICATION != "" && ERROR_NOTIFICATION != null) {
                    showMessage('error', {message: ERROR_NOTIFICATION});
                } else if (WARNING_NOTIFICATION != "" && WARNING_NOTIFICATION != null) {
                    showMessage('warning', {message: WARNING_NOTIFICATION});
                } else if (INFO_NOTIFICATION != "" && INFO_NOTIFICATION != null) {
                    showMessage('info', {message: INFO_NOTIFICATION});
                }
            });
            function showMessage(type, params) {
                toastr.remove();
                toastr.options = {
                    positionClass: 'toast-top-right'
                };
                if (type == 'success') {
                    toastr.success(params.message);
                } else if (type == 'error') {
                    toastr.error(params.message);
                } else if (type == 'warning') {
                    toastr.warning(params.message);
                } else if (type == 'info') {
                    toastr.info(params.message);
                }
            }
        </script>
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="<?php echo site_url(); ?>"><b>HM</b>International</a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <?php echo $content_for_layout; ?>  
            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box --> 
    </body>
</html>
