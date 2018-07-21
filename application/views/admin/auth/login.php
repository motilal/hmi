<p class="login-box-msg">Sign in to start your session</p> 
<?php echo form_open(NULL, array("id" => "login-form", "method" => "post")); ?>
<div class="form-group has-feedback <?php echo form_error('identity') != "" ? "has-error" : ""; ?>"> 
    <?php echo form_input("identity", set_value("identity"), "id='identity' class='form-control' required autofocus='true' placeholder='Email'"); ?> 
    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    <?php echo form_error('identity'); ?>
</div>
<div class="form-group has-feedback <?php echo form_error('password') != "" ? "has-error" : ""; ?>"> 
    <?php echo form_password("password", set_value("password"), "id='password' class='form-control' required autofocus='true' placeholder='Password'"); ?> 
    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    <?php echo form_error('password'); ?>
</div>
<div class="row">
    <?php echo form_hidden('request', set_value('request', $request)); ?>
    <div class="col-xs-8">

    </div>
    <!-- /.col -->
    <div class="col-xs-4"> 
        <?php echo form_submit("submit", "Sign In", "class=\"btn btn-primary btn-block btn-flat\""); ?> 
    </div>
    <!-- /.col -->
</div>
<?php echo form_close(); ?>
<a href="<?php echo site_url('admin/auth/forgot_password'); ?>">I forgot my password</a><br>  