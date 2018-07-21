<div class="row">
    <div class="col-xs-12">  
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">  
                <li class="active"><a href="#profile_tab" data-toggle="tab">Update Profile</a></li>
                <li class="pull-left header"><i class="fa fa-user"></i> <?php echo isset($pageHeading) ? $pageHeading : ''; ?></li>
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
                            <div class="form-group <?php echo form_error('state') != "" ? 'has-error' : ''; ?>">
                                <label class="control-label" for="state">State</label>
                                <?php echo form_input("state", set_value("state", isset($data->state) ? $data->state : "", FALSE), "id='state' class='form-control'"); ?>
                                <?php echo form_error('state'); ?>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group <?php echo form_error('city') != "" ? 'has-error' : ''; ?>">
                                <label class="control-label" for="city">City</label>
                                <?php echo form_input("city", set_value("city", isset($data->city) ? $data->city : "", FALSE), "id='city' class='form-control'"); ?>
                                <?php echo form_error('city'); ?>
                            </div>
                        </div>  

                        <div class="clearfix"></div>
                        <div class="col-lg-8">  
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-default" onclick="window.location.href = '<?php echo site_url("admin/users"); ?>'">Cancel</button>
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