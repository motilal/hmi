<div class="row">
    <div class="col-xs-12">  
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right"> 
                <li><a href="<?php echo site_url("admin/subadmins/permissions/$data->id"); ?>">Manage Permission</a></li> 
                <li class="active"><a href="#profile_tab" data-toggle="tab">Update Profile</a></li>
                <li class="pull-left header"><i class="fa fa-user-secret"></i> <?php echo isset($pageHeading) ? $pageHeading : ''; ?></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="profile_tab">
                    <div class="row">                     
                        <?php echo form_open(null, array("id" => "manage-form", "method" => "post")); ?>

                        <div class="col-lg-4">
                            <div class="form-group <?php echo form_error('first_name') != "" ? 'has-error' : ''; ?>">
                                <label class="control-label" for="first_name">First Name <em>*</em></label>
                                <?php echo form_input("first_name", set_value("first_name", isset($data->first_name) ? $data->first_name : "", FALSE), "id='first_name' class='form-control'"); ?>
                                <?php echo form_error('first_name'); ?>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group <?php echo form_error('last_name') != "" ? 'has-error' : ''; ?>">
                                <label class="control-label" for="title">Last Name</label>
                                <?php echo form_input("last_name", set_value("last_name", isset($data->last_name) ? $data->last_name : "", FALSE), "id='last_name' class='form-control'"); ?>
                                <?php echo form_error('last_name'); ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-lg-4">
                            <div class="form-group <?php echo form_error('email') != "" ? 'has-error' : ''; ?>">
                                <label class="control-label" for="email">Email <em>*</em></label>
                                <?php echo form_input("email", set_value("email", isset($data->email) ? $data->email : ""), "id='email' class='form-control' disabled='disabled'"); ?>
                                <?php echo form_error('email'); ?>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group <?php echo form_error('phone') != "" ? 'has-error' : ''; ?>">
                                <label class="control-label" for="phone">Phone</label>
                                <?php echo form_input("phone", set_value("phone", isset($data->phone) ? $data->phone : ""), "id='phone' class='form-control'"); ?>
                                <?php echo form_error('phone'); ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-lg-4">
                            <input type="text" style="display:none;">
                            <div class="form-group <?php echo form_error('password') != "" ? 'has-error' : ''; ?>">
                                <label class="control-label" for="password">Password</label>
                                <?php echo form_password("password", set_value("password"), "id='password' class='form-control' autocomplete='off'"); ?>
                                <?php echo form_error('password'); ?>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group <?php echo form_error('cpassword') != "" ? 'has-error' : ''; ?>">
                                <label class="control-label" for="cpassword">Confirm Password</label>
                                <?php echo form_password("cpassword", set_value("cpassword"), "id='cpassword' class='form-control'"); ?>
                                <?php echo form_error('cpassword'); ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="col-lg-4"> 
                            <div class="form-group">
                                <label class="control-label" for="two_step_authentication">2-Step Authentication</label>  
                                <div> 
                                    <label style="font-weight:normal;">
                                        <input name="two_step_authentication" id="two_step_authentication_on" value="1" type="radio" <?php echo set_value("two_step_authentication", isset($data->two_step_authentication) ? $data->two_step_authentication : "") === '1' ? 'checked' : ''; ?>>
                                        On
                                    </label> 
                                    <label style="font-weight:normal;margin-left:15px;">
                                        <input name="two_step_authentication" id="two_step_authentication_off" value="0" type="radio" <?php echo set_value("two_step_authentication", isset($data->two_step_authentication) ? $data->two_step_authentication : "") === '0' ? 'checked' : ''; ?>>
                                        Off
                                    </label> 
                                </div>
                            </div> 
                        </div>

                        <div class="col-lg-4"> 
                            <div class="form-group">
                                <label class="control-label" for="multi_session">Allow Multiple Session</label>  
                                <div> 
                                    <label style="font-weight:normal;">
                                        <input name="multi_session" id="multi_session_yes" value="1" type="radio" <?php echo set_value("multi_session", isset($data->multi_session) ? $data->multi_session : "") === '1' ? 'checked' : ''; ?>>
                                        Yes
                                    </label> 
                                    <label style="font-weight:normal;margin-left:15px;">
                                        <input name="multi_session" id="multi_session_no" value="0" type="radio" <?php echo set_value("multi_session", isset($data->multi_session) ? $data->multi_session : "") === '0' ? 'checked' : ''; ?>>
                                        No
                                    </label> 
                                </div>
                            </div> 
                        </div>


                        <div class="clearfix"></div>
                        <div class="col-lg-8">  
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-default" onclick="window.location.href = '<?php echo site_url("admin/subadmins"); ?>'">Cancel</button>
                        </div>

                        <?php echo form_close(); ?>
                    </div>
                    <!-- /.row (nested) -->
                </div> 
            </div>
            <!-- /.tab-content -->
        </div>
        <!-- nav-tabs-custom --> 
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->  