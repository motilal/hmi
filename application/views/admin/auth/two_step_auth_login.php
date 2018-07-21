<p class="login-box-msg">Enter code, We have sent on your email.</p> 
<?php echo form_open(NULL, array("id" => "auth-login-form", "method" => "post")); ?>
<div class="form-group has-feedback <?php echo form_error('code') != "" ? "has-error" : ""; ?>"> 
    <?php echo form_input("code", set_value("code"), "id='code' class='form-control' required autofocus='true' placeholder='Code'"); ?> 
    <span class="fa fa-key form-control-feedback"></span>
    <?php echo form_error('code'); ?>
</div> 
<div class="row"> 
    <div class="col-xs-8">

    </div>
    <!-- /.col -->
    <div class="col-xs-4"> 
        <?php echo form_submit("submit", "Submit", "class=\"btn btn-primary btn-block btn-flat\""); ?> 
    </div>
    <!-- /.col -->
</div>
<?php echo form_close(); ?>
<a href="<?php echo site_url('admin'); ?>">Back to Login</a><br>  