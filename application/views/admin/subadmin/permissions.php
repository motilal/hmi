<div class="row">
    <div class="col-xs-12">  
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right"> 
                <li class="active"><a href="#profile_tab" data-toggle="tab">Manage Permission</a></li> 
                <li><a href="<?php echo site_url("admin/subadmins/edit/$data->id"); ?>">Update Profile</a></li>
                <li class="pull-left header"><i class="fa fa-key"></i> <?php echo isset($pageHeading) ? $pageHeading : ''; ?></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="profile_tab">
                    <div class="row">                     
                        <?php echo form_open(null, array("id" => "manage-form", "method" => "post")); ?>
                        <?php foreach ($permission_data as $key => $row) { ?>
                            <div class="col-lg-12">
                                <div class="box box-primary box-solid">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><label><input type="checkbox" class="group_checkbox"> <?php echo $key; ?> Manager</label></h3>

                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <!-- /.box-tools -->
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <?php foreach ($row as $row1) { ?>
                                            <div class="col-sm-3">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permission[]" value="<?php echo $row1->id; ?>" <?php echo (in_array($row1->id, $user_permissions)) ? 'checked' : ''; ?>> <?php echo $row1->name; ?>
                                                    </label>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                            </div>
                        <?php } ?> 
                        <div class="clearfix"></div>
                        <div class="col-lg-12">  
                            <div class="pull-right">                                
                                <button type="button" class="btn btn-default" onclick="window.location.href = '<?php echo site_url("admin/subadmins"); ?>'">Cancel</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                    <input type='hidden' name="flag" value="1"> 
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

<script type="text/javascript">
    $('.group_checkbox').on('click', function () {
        if ($(this).is(':checked')) {
            $(this).closest('.box').find('input[type="checkbox"]').prop('checked', true);
        } else {
            $(this).closest('.box').find('input[type="checkbox"]').prop('checked', false);
        }
    });
</script>