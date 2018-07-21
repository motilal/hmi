<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo SITE_TITLE; ?> | <?php echo isset($title) ? $title : ''; ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"> 
        <link rel="shortcut icon" href="<?php echo base_url('asset/admin/images/favicon.ico'); ?>" type="image/x-icon">
        <link rel="stylesheet" href="<?php echo base_url('asset/admin/plugin/bootstrape/css/bootstrap.min.css'); ?>"> 
        <link rel="stylesheet" href="<?php echo base_url('asset/admin/css/font-awesome.min.css'); ?>"> 
        <link rel="stylesheet" href="<?php echo base_url('asset/admin/css/ionicons.min.css'); ?>">  
        <link rel="stylesheet" href="<?php echo base_url('asset/admin/css/skins/skin-blue.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('asset/admin/plugin/pace/pace.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('asset/admin/plugin/select2/css/select2.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('asset/admin/plugin/datatables/css/dataTables.bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('asset/admin/plugin/toastr/toastr.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('asset/admin/css/admin.min.css'); ?>">  
        <link rel="stylesheet" href="<?php echo base_url('asset/admin/css/common.css'); ?>">       
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]--> 
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">  

        <script type="text/javascript">window.paceOptions = {ajax: true, startOnPageLoad: true};</script>
        <script src="<?php echo base_url('asset/admin/plugin/pace/pace.min.js'); ?>"></script>  
        <script src="<?php echo base_url('asset/admin/js/jquery.min.js'); ?>"></script> 
        <script src="<?php echo base_url('asset/admin/plugin/bootstrape/js/bootstrap.min.js'); ?>"></script>  
        <script src="<?php echo base_url('asset/admin/js/fastclick.js'); ?>"></script>  
        <script src="<?php echo base_url('asset/admin/plugin/select2/js/select2.min.js'); ?>"></script>  
        <script src="<?php echo base_url('asset/admin/plugin/datetimepicker/moment-with-locales.js'); ?>"></script>  
        <script src="<?php echo base_url('asset/admin/plugin/toastr/toastr.min.js'); ?>"></script>  
        <script src="<?php echo base_url('asset/admin/js/adminlte.min.js'); ?>"></script>    

        <?php if (isset($ckeditor_asset) && $ckeditor_asset) { ?>
            <script type="text/javascript" src="<?php echo base_url("asset/admin/plugin/ckeditor/ckeditor.js") ?>"></script>
            <script type="text/javascript" src="<?php echo base_url("asset/admin/plugin/ckfinder/ckfinder.js") ?>"></script>
            <script type="text/javascript">
                $(function () {
                    $('textarea.editor').each(function (e) {
                        CKEDITOR.replace(this.id, {
                            filebrowserBrowseUrl: '<?php echo base_url('asset/admin/plugin/ckfinder/ckfinder.html'); ?>',
                            filebrowserImageBrowseUrl: '<?php echo base_url('asset/admin/plugin/ckfinder/ckfinder.html?type=Images'); ?>',
                            filebrowserFlashBrowseUrl: '<?php echo base_url('asset/admin/plugin/ckfinder/ckfinder.html?type=Flash'); ?>',
                            filebrowserUploadUrl: '<?php echo base_url('asset/admin/plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'); ?>',
                            filebrowserImageUploadUrl: '<?php echo base_url('asset/admin/plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'); ?>',
                            filebrowserFlashUploadUrl: '<?php echo base_url('asset/admin/plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'); ?>'
                        });
                    });
                });
            </script>
        <?php } ?>

        <?php if (isset($datatable_asset) && $datatable_asset) { ?>    
            <script src="<?php echo base_url('asset/admin/plugin/datatables/js/jquery.dataTables.min.js'); ?>"></script> 
            <script src="<?php echo base_url('asset/admin/plugin/datatables/js/dataTables.bootstrap.min.js'); ?>"></script>
        <?php } ?>

        <?php if (isset($croppic_asset) && $croppic_asset) { ?>               
            <link rel="stylesheet" href="<?php echo base_url('asset/admin/plugin/croppic/css/croppic.css'); ?>" type="text/css" media="screen" /> 
            <script src="<?php echo base_url('asset/admin/plugin/croppic/js/croppic.js'); ?>"></script>  
            <script src="<?php echo base_url('asset/admin/plugin/croppic/js/jquery.mousewheel.min.js'); ?>"></script>  
        <?php } ?>

        <?php if (isset($datetimepicker_asset) && $datetimepicker_asset) { ?>    
            <script src="<?php echo base_url('asset/admin/plugin/datetimepicker/jquery.datetimepicker.full.min.js'); ?>"></script> 
            <link rel="stylesheet" href="<?php echo base_url('asset/admin/plugin/datetimepicker/jquery.datetimepicker.min.css'); ?>" type="text/css" media="screen" /> 
        <?php } ?>  
        <script type="text/javascript">
            var DEFAULT_PAGING = <?php echo DEFAULT_PAGING; ?>;
            var SITE_URL = '<?php echo site_url(); ?>';
            var BASE_URL = '<?php echo base_url(); ?>';
            var SUCCESS_NOTIFICATION = <?php echo json_encode($this->session->flashdata("success")); ?>;
            var ERROR_NOTIFICATION = <?php echo json_encode($this->session->flashdata("error")); ?>;
            var WARNING_NOTIFICATION = <?php echo json_encode($this->session->flashdata("warning")); ?>;
            var INFO_NOTIFICATION = <?php echo json_encode($this->session->flashdata("notification")); ?>;
        </script>
        <script src="<?php echo base_url('asset/admin/js/common.js'); ?>"></script>   
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="page-loader-wrapper" style="display: none;">
            <div class="loader">
                <div class="preloader">
                    <div class="spinner-layer pl-blue">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
                <p>Please wait...</p>
            </div>
        </div>
        <?php echo $this->layout->element('admin/element/_info_msg_element'); ?>
        <div class="wrapper"> 
            <header class="main-header">
                <!-- Logo -->
                <a href="<?php echo site_url('admin/dashboard'); ?>" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>HM</b>I</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>HM</b> International</span>
                </a>

                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav"> 
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo gravatar_url($_UserAuth->email); ?>" class="user-image" alt="User Image">
                                    <span class="hidden-xs"><?php echo $_UserAuth->first_name . ' ' . $_UserAuth->last_name ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="<?php echo gravatar_url($_UserAuth->email); ?>" class="img-circle" alt="User Image">
                                        <p>
                                            <?php echo $_UserAuth->first_name . ' ' . $_UserAuth->last_name ?> - <?php echo $this->ion_auth->is_subadmin() ? 'Sub Admin' : 'Administrator'; ?>
                                            <small>Member since <?php echo date('M. Y', $_UserAuth->created_on); ?></small>
                                        </p>
                                    </li>                                      
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="<?php echo site_url('admin/settings/profile'); ?>" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?php echo site_url('admin/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                            <?php if (is_allow_action('settings-index')) { ?>
                                <li>
                                    <a href="<?php echo site_url('admin/settings/index'); ?>"><i class="fa fa-gears"></i></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </nav>
            </header>

            <?php echo $this->layout->element("admin/element/_sidebar"); ?>


            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?php echo isset($pageModule) ? $pageModule : ''; ?>
                    </h1>
                    <?php if (!empty($breadcrumb)): ?>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                            <?php foreach ($breadcrumb as $k => $v): ?>
                                <li class="<?php echo $v == "" ? 'active' : ''; ?>">
                                    <?php if ($v != "") { ?>
                                        <a href="<?php echo site_url($v); ?>"><?php echo $k; ?></a>
                                    <?php } else { ?>
                                        <?php echo $k; ?>
                                    <?php } ?>
                                </li>
                            <?php endforeach; ?> 
                        </ol>
                    <?php endif; ?>
                </section>

                <!-- Main content -->
                <section class="content">
                    <?php echo sanitize_output($content_for_layout); ?> 
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper --> 
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> <?php echo PROJECT_VERSION; ?>
                </div>
                <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="javascript:;"><?php echo SITE_TITLE; ?></a>.</strong> All rights
                reserved.
            </footer>

        </div>
        <!-- ./wrapper --> 
    </body>
</html>
