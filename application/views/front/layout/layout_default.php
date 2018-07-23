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
        <div class="top_banner"> 
            <?php echo $this->layout->element('front/element/_header'); ?>
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
        </div>

        <div class="category_bg">
            <div class="container">
                <div class="heading"><h2><span>C</span>ategories</h2></div>
                <ul class="categories">
                    <li class="side_category"><figure><img src="<?php echo base_url('asset/front/images/plane.jpg'); ?>" alt="plane"></figure><div class="yatch_side"><span>Yacths</span></div></li>
                    <li class="center_category"><figure><img src="<?php echo base_url('asset/front/images/home.jpg'); ?>" alt="home"></figure>
                        <figure><img src="<?php echo base_url('asset/front/images/car.jpg'); ?>" alt="car"></figure></li>
                    <li class="side_category"><figure><img src="<?php echo base_url('asset/front/images/couple.jpg'); ?>" alt="couple"></figure></li>
                </ul>
            </div>

            <div class="trending">
                <div class="trending_slider">
                    <div class="container"><div class="heading"><h2><span>t</span>rending Holiday Package</h2></div></div>
                    <div class="owl-carousel trending-carousel owl-theme">
                        <div class="item">
                            <div class="trending_box">
                                <figure><img src="<?php echo base_url('asset/front/images/plane1.jpg'); ?>" alt="img"></figure>
                                <div class="trending_content">
                                    <h4>DUBAI</h4>
                                    <p>There is no better way to experience an incomparable taste of  freedom, elegance</p>
                                    <span>Packages Starting from <br/> AED 15000 for 50 Guest</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="trending_box">
                                <figure><img src="<?php echo base_url('asset/front/images/girl1.jpg'); ?>" alt="img"></figure>
                                <div class="trending_content">
                                    <h4>DUBAI</h4>
                                    <p>There is no better way to experience an incomparable taste of  freedom, elegance</p>
                                    <span>Packages Starting from <br/> AED 15000 for 50 Guest</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="trending_box">
                                <figure><img src="<?php echo base_url('asset/front/images/boat.jpg'); ?>" alt="img"></figure>
                                <div class="trending_content">
                                    <h4>DUBAI</h4>
                                    <p>There is no better way to experience an incomparable taste of  freedom, elegance</p>
                                    <span>Packages Starting from <br/> AED 15000 for 50 Guest</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="trending_box">
                                <figure><img src="<?php echo base_url('asset/front/images/tables.jpg'); ?>" alt="img"></figure>
                                <div class="trending_content">
                                    <h4>DUBAI</h4>
                                    <p>There is no better way to experience an incomparable taste of  freedom, elegance</p>
                                    <span>Packages Starting from <br/> AED 15000 for 50 Guest</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="get_touch_bg">
            <div class="get_in_touch">
                <div class="container">
                    <div class="heading"><h2><span>G</span> et in Touch</h2></div>
                    <div class="contact_form"> 
                        <div class="touch_form">
                            <form>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="*Name">
                                        </div></div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="*Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="*Subject">
                                        </div></div></div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <textarea class="form-control" placeholder="*Message"></textarea>
                                        </div></div></div>
                                <div class="send_btn">
                                    <button type="button" class="btn-primary" value="Send">Send</button>
                                </div>
                            </form>
                        </div>

                        <div class="contact_us">
                            <h3>Contact Us</h3>
                            <ul>
                                <li><img src="<?php echo base_url('asset/front/images/phone.png'); ?>" alt="call"><span>+91 12345 67890</span><span>+91 12345 67890</span></li>
                                <li><img src="<?php echo base_url('asset/front/images/mail.png'); ?>" alt="mail"><a href="mailto:info@mids.com">info@mids.com</a></li>
                                <li><img src="<?php echo base_url('asset/front/images/earth.png'); ?>" alt="earth"><a href="mailto:mids.com">mids.com</a></li>
                                <li><img src="<?php echo base_url('asset/front/images/location.png'); ?>" alt="location">Lorem Ipsum 35/2 Arial font 
                                    amit cross, 9th Ipsum street 
                                    (map)</li>
                            </ul>

                            <ul class="social_icon">

                                <li><a href="javascript:void(0)"><img src="<?php echo base_url('asset/front/images/facebook.png'); ?>" alt="facebook"></a></li>
                                <li><a href="javascript:void(0)"><img src="<?php echo base_url('asset/front/images/twitter.png'); ?>" alt="twitter"></a></li>
                                <li><a href="javascript:void(0)"><img src="<?php echo base_url('asset/front/images/google_plus.png'); ?>" alt="google_plus"></a></li>
                                <li><a href="javascript:void(0)"><img src="<?php echo base_url('asset/front/images/instagram.png'); ?>" alt="instagram"></a></li>
                            </ul>
                        </div>
                    </div></div>
            </div>

            <div class="about_us_section">
                <div class="container">
                    <div class="about_hm">
                        <figure><img src="<?php echo base_url('asset/front/images/girl2.jpg'); ?>" alt="girl"></figure>
                        <div class="title_box"><h3>About HM International</h3></div>
                        <p>We are HMI Dubai! We are here to give you the
                            best holiday experiences while you are in dubai.
                            At HMI we have understood the special needs
                            of the tourists to dubai and have tailored packages 
                            to suit every tourist who is looking at a memorable
                            holiday</p>
                        <p>We are HMI Dubai! We are here to give you the
                            best holiday experiences while you are in dubai.
                            At HMI we have understood the special needs
                            of the tourists to dubai and have tailored packages 
                            to suit every tourist who is looking at a memorable
                            holiday</p>
                        <p>We are HMI Dubai! We are here to give you the
                            best holiday experiences while you are in dubai.
                            At HMI we have understood the special needs
                            of the tourists to dubai and have tailored packages 
                            to suit every tourist who is looking at a memorable
                            holiday</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bluebg">
            <div class="testimonial_slider">
                <div class="container">
                    <div class="heading"><h2><span>t</span>estimonals</h2></div>
                    <div class="owl-carousel testimonial-carousel owl-theme">
                        <div class="item">
                            <div class="testimonial_box">
                                <figure><img src="<?php echo base_url('asset/front/images/profile.jpg'); ?>" alt="img"></figure>
                                <div class="testimonial_content">
                                    <p>One of the best trips I've had so far. The Destination Manager was simply superb and the limo &amp; yacht cruise 
                                        with my family had been the highlight. Marina reminded me of Hudson and the live arabian</p>
                                    <a href=""><img src="<?php echo base_url('asset/front/images/star.png'); ?>" alt="img"></a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimonial_box">
                                <figure><img src="<?php echo base_url('asset/front/images/profile1.jpg'); ?>" alt="img"></figure>
                                <div class="testimonial_content">
                                    <p>One of the best trips I've had so far. The Destination Manager was simply superb and the limo &amp; yacht cruise 
                                        with my family had been the highlight. Marina reminded me of Hudson and the live arabian</p>
                                    <a href=""><img src="<?php echo base_url('asset/front/images/star.png'); ?>" alt="img"></a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimonial_box">
                                <figure><img src="<?php echo base_url('asset/front/images/profile2.jpg'); ?>" alt="img"></figure>
                                <div class="testimonial_content">
                                    <p>One of the best trips I've had so far. The Destination Manager was simply superb and the limo &amp; yacht cruise 
                                        with my family had been the highlight. Marina reminded me of Hudson and the live arabian</p>
                                    <a href=""><img src="<?php echo base_url('asset/front/images/star.png'); ?>" alt="img"></a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimonial_box">
                                <figure><img src="<?php echo base_url('asset/front/images/profile2.jpg'); ?>" alt="img"></figure>
                                <div class="testimonial_content">
                                    <p>One of the best trips I've had so far. The Destination Manager was simply superb and the limo &amp; yacht cruise 
                                        with my family had been the highlight. Marina reminded me of Hudson and the live arabian</p>
                                    <a href=""><img src="<?php echo base_url('asset/front/images/star.png'); ?>" alt="img"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="newsletter">
                <div class="container">
                    <h3>Subcribe For Newsletter</h3>
                    <p>Let us help you plan a privately quided, stress-free family tour and give your children a lifelong memory of fun and adventure</p>
                    <div class="form-group">
                        <input type="text" placeholder="You Email" class="form-control">
                        <button type="button" class="btn btn-primary">send</button>
                    </div>
                </div>
            </div>
        </div>

        <?php echo $this->layout->element('front/element/_footer'); ?>   
        <?php echo $this->layout->element('front/element/_login_register_popup'); ?>   


        <div class="nav_menu">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="javascript:void(0)">Offers</a></li>
                <li><a href="javascript:void(0)">Packages</a></li>
                <li><a href="#" data-toggle="modal" data-target="#LoginModal" class="login_register_menu">Login/Sign Up</a></li>
                <li><a href="javascript:void(0)">Contact Us</a></li>
            </ul>
        </div>
        <div class="overlay"></div>  
    </body>
</html>
