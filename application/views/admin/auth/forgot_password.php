<p class="login-box-msg">Forgot Your password ?</p>
<div class="text-danger"><?php echo isset($validation_message) ? $validation_message : ''; ?></div>
<?php echo form_open(NULL, array("id" => "login-form", "method" => "post")); ?>
<div class="form-group has-feedback <?php echo form_error('identity') != "" ? "has-error" : ""; ?>"> 
    <?php echo form_input("email", set_value("email"), "id='email' class='form-control' required autofocus='true' placeholder='Email'"); ?> 
    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    <?php echo form_error('identity'); ?>
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