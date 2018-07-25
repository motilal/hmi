<div class="modal fade signup" id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="LoginModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Close</span></button>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#signin" aria-controls="signin" role="tab" data-toggle="tab">Sign In</a></li>
                    <li role="presentation"><a href="#signup" aria-controls="signup" role="tab" data-toggle="tab">Sign Up</a></li>  
                </ul>
            </div>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="signin">
                    <div class="modal-body">
                        <?php echo form_open('auth/login', array("id" => "login-form", "method" => "post")); ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email ID</label> 
                                    <?php echo form_input("identity", set_value("identity"), "id='identity' class='form-control' placeholder='hmi@gmail.com'"); ?> 
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <?php echo form_password("password", set_value("password"), "id='password' class='form-control' placeholder='****'"); ?>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Sign In</button>
                            <p><a href="#forgot_password" aria-controls="forgot_password" role="tab" data-toggle="tab">Forgot Password</a></p>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="signup">
                    <div class="modal-body">
                        <?php echo form_open('auth/register', array("id" => "register-form", "method" => "post")); ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>First Name*</label> 
                                    <?php echo form_input("first_name", set_value("first_name"), "id='first_name' class='form-control'"); ?> 
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Last Name*</label>
                                    <?php echo form_input("last_name", set_value("last_name"), "id='last_name' class='form-control'"); ?> 
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email ID*</label> 
                                    <?php echo form_input("email", set_value("email"), "id='email' class='form-control'"); ?> 
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Phome No*</label>
                                    <?php echo form_input("phone", set_value("phone"), "id='phone' class='form-control'"); ?> 
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Password*</label>
                                    <?php echo form_password("password", set_value("password"), "class='form-control'"); ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Confirm Password*</label>
                                    <?php echo form_password("cpassword", set_value("cpassword"), "class='form-control'"); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>State*</label>
                                    <?php echo form_input("state", set_value("state"), "id='state' class='form-control'"); ?> 
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>City*</label>
                                    <?php echo form_input("city", set_value("city"), "id='city' class='form-control'"); ?> 
                                </div>
                            </div>
                        </div> 
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Sign Up</button>
                            <p>* By Creating an account  you're Agreeing to our Terms of Service and Privacy Statement.</p>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane fade" id="forgot_password">
                    <div class="modal-body">
                        <?php echo form_open('auth/register', array("id" => "forgot-password-form", "method" => "post")); ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Email ID</label>
                                    <?php echo form_input("email", set_value("email"), "class='form-control' required"); ?> 
                                </div>
                            </div> 
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <p><a href="#signin" aria-controls="signin" role="tab" data-toggle="tab">Back To Login</a></p>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>