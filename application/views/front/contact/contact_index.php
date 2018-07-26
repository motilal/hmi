<!--contact-->        
<div class="innerbg contact_page">
    <div class="container">
        <div class="leave_info">
            <h3>Leave us your info</h3>
            <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. 
                I am alone, and feel the  charm of existence in this spot, which was created for the bliss of souls like mine.</p>
            <?php echo form_open('contact', array("id" => "contact-form", "method" => "post")); ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group"> 
                        <?php echo form_input("name", set_value("name"), "class='form-control' placeholder='Name*'"); ?> 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group"> 
                        <?php echo form_input("email", set_value("email"), "class='form-control' placeholder='Email ID*'"); ?> 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group"> 
                        <?php echo form_input("subject", set_value("subject"), "class='form-control' placeholder='Subject*'"); ?> 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group"> 
                        <?php echo form_textarea("message", set_value("message"), "class='form-control' placeholder='Your Message*'"); ?> 
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" value="Send">Submit</button>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
        <div class="location_info">
            <h3>Location</h3>
            <p>HM INTERNATIONAL DXB HOLIDAYS <br/> Marina, Dubai <br/> Dubai 191392, AE</p>
            <ul>
                <li><figure><img src="<?php echo base_url('asset/front/images/mail-blck.png'); ?>" alt="img"></figure><a href="mailto:info@hmi.com">info@hmi.com</a></li>
                <li><figure><img src="<?php echo base_url('asset/front/images/call-blck.png'); ?>" alt="img"></figure>+971 50 6914466</li>
                <li><figure><img src="<?php echo base_url('asset/front/images/website-blck.png'); ?>" alt="img"></figure><a href="javascript:void(0)">http://hmidubai.com</a></li>
            </ul>
            <h3>Map</h3>
            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10220.52878425777!2d55.14267971442126!3d25.084842336437525!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f6b59e60e0fed%3A0x34d170002a74c3b1!2sMarina+Pharmacy!5e0!3m2!1sen!2sin!4v1532370099623" width="100%" height="230" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!--contact-->

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