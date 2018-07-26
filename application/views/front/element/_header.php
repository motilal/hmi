<header>
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-xs-6">
                <div class="logo"><a href="<?php echo site_url(); ?>"><img src="<?php echo base_url('asset/front/images/logo.png'); ?>" alt="logo"></a></div>            
            </div>
            <div class="col-sm-8 col-xs-6">
                <div class="right_menu">
                    <ul>
                        <li><span class="call"><img src="<?php echo base_url('asset/front/images/phone.png'); ?>" alt="call">+91 12345 67890</span></li>
                        <?php if ($this->ion_auth->logged_in() && $this->ion_auth->is_general_user()) { ?>
                            <li><figure class="user_profile"><img src="<?php echo base_url('asset/front/images/user_profile.jpg'); ?>" alt="user"></figure></li>
                        <?php } else { ?>
                            <li><a href="#" data-toggle="modal" data-target="#LoginModal" class="login_register_btn btn btn-default">Login/Register</a></li>
                        <?php } ?>  
                        <li><a href="javascript:void(0)" class="toggle_menu"><span></span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>