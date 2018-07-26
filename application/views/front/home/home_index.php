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
                    <?php echo form_open('contact', array("id" => "contact-form", "method" => "post")); ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group"> 
                                <?php echo form_input("name", set_value("name"), "class='form-control' placeholder='*Name'"); ?> 
                            </div></div>
                        <div class="col-sm-6">
                            <div class="form-group"> 
                                <?php echo form_input("email", set_value("email"), "class='form-control' placeholder='*Email'"); ?> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group"> 
                                <?php echo form_input("subject", set_value("subject"), "class='form-control' placeholder='*Subject'"); ?> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group"> 
                                <?php echo form_textarea("message", set_value("message"), "class='form-control' placeholder='*Message'"); ?> 
                            </div>
                        </div>
                    </div>
                    <div class="send_btn">
                        <button type="submit" class="btn-primary" value="Send">Send</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>

                <div class="contact_us">
                    <h3>Contact Us</h3>
                    <ul class="address">
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