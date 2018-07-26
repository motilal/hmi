<!DOCTYPE html> 
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="<?php echo empty($meta_description) == FALSE ? $meta_description : get_site_setting('default_meta_description'); ?>">
        <meta name="keywords" content="<?php echo empty($meta_keywords) == FALSE ? $meta_keywords : get_site_setting('default_meta_keywords'); ?>">
        <meta name="author" content="<?php echo get_site_setting('default_meta_author'); ?>">
        <?php if (!empty($og_title)) { ?>
            <meta property="og:title" content="<?php echo $og_title; ?>" />
        <?php } ?>
        <?php if (!empty($og_description)) { ?>
            <meta property="og:description" content="<?php echo $og_description; ?>" />
        <?php } ?>
        <?php if (!empty($og_image)) { ?>
            <meta property="og:image" content="<?php echo $og_image; ?>" /> 
        <?php } ?>
        <meta name="google-site-verification" content="DifEMwipL28eDz20upwq7SD2tLb5uTur3CPYNtdJEbI" />
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"> 
        <title><?php echo SITE_TITLE; ?> | <?php echo empty($title) == FALSE ? $title : ''; ?></title>  
        <link rel="shortcut icon" href="<?php echo base_url('asset/front/images/favicon.ico'); ?>" type="image/x-icon">
        <link href="<?php echo base_url('asset/front/css/bootstrap.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('asset/front/css/custom.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('asset/front/css/developer.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('asset/front/css/animate.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('asset/front/css/owl.carousel.min.css'); ?>" rel="stylesheet">  
        <link rel="stylesheet" href="<?php echo base_url('asset/admin/plugin/toastr/toastr.min.css'); ?>">
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]--> 
        <script src="<?php echo base_url('asset/front/js/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('asset/front/js/bootstrap.min.js'); ?>"></script> 
        <script src="<?php echo base_url('asset/front/js/owl.carousel.min.js'); ?>"></script> 
        <script src="<?php echo base_url('asset/admin/plugin/toastr/toastr.min.js'); ?>"></script>  
        <script src="<?php echo base_url('asset/front/js/common.js'); ?>"></script>
        <script type="text/javascript">
            var SITE_URL = '<?php echo site_url(); ?>';
            var BASE_URL = '<?php echo base_url(); ?>';
            var SUCCESS_NOTIFICATION = <?php echo json_encode($this->session->flashdata("success")); ?>;
            var ERROR_NOTIFICATION = <?php echo json_encode($this->session->flashdata("error")); ?>;
            var WARNING_NOTIFICATION = <?php echo json_encode($this->session->flashdata("warning")); ?>;
            var INFO_NOTIFICATION = <?php echo json_encode($this->session->flashdata("notification")); ?>;
        </script>
    </head>
    <body> 
        <?php $segment1 = $this->uri->segment(1); ?>
        <div class="top_banner"> 
            <?php echo $this->layout->element('front/element/_header'); ?>
            <?php if ($segment1 == 'home' || $segment1 == "") { ?>
                <div class="banner">
                    <div class="banner_content">
                        <div class="welcome_content">
                            <h1>Welcome To HMI</h1>
                            <p>We are here to give you the best holiday <br />
                                experiences while you are in dubai.</p>
                        </div>
                        <div class="search_filter">
                            <ul>
                                <li class="filter_box"><div class="country"><select class="form-control">
                                            <option>India</option>
                                            <option>India</option>
                                        </select></div></li>
                                <li class="filter_box"><div><select class="form-control">
                                            <option>Travel type</option>
                                            <option>Travel type</option>
                                        </select></div></li>
                                <li class="filter_category"><div><select class="form-control">
                                            <option>Categories</option>
                                            <option>Categories</option>
                                        </select></div></li>
                                <li class="search_btn">
                                    <div classs="search_btn">
                                        <button type="button" class="btn-default" value="Search">Search</button>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>	
                </div>
            <?php } else if ($segment1 == 'contact') { ?>
                <div class="banner contact_banner">
                    <div class="contact_text">
                        <h2>CONTACT US</h2>
                        <span>GET IN TOUCH</span>
                    </div>	
                </div>
            <?php } ?>
        </div>

        <?php echo $content_for_layout; ?>  

        <?php echo $this->layout->element('front/element/_footer'); ?>   
        <?php echo $this->layout->element('front/element/_login_register_popup'); ?>   


        <div class="nav_menu">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="javascript:void(0)">Offers</a></li>
                <li><a href="javascript:void(0)">Packages</a></li> 
                <li><a href="<?php echo site_url('contact'); ?>">Contact Us</a></li> 
            </ul>
        </div>
        <div class="overlay"></div>  
    </body>
</html>
