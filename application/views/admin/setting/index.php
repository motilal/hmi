<div class="row">
    <div class="col-xs-12"> 
        <div class="box box-info"> 
            <!-- /.box-header -->
            <div class="box-body"> 
                <div class="row">
                    <?php echo form_open('admin/settings', array("id" => "site-settings", "method" => "post")); ?> 
                    <div class="col-lg-7">
                        <?php
                        if (!empty($settings_data)):
                            foreach ($settings_data as $k => $v):
                                ?>
                                <div class="form-group <?php echo form_error("settings_$v->id") != "" ? 'has-error' : ''; ?>">
                                    <label class="control-label" for="settings_<?php echo $v->id; ?>"><?php echo $v->title; ?><em><?php echo $v->is_required == 1 ? "*" : ""; ?></em></label>

                                    <?php
                                    if ($v->type == "text") {

                                        echo form_input("settings_$v->id", set_value("settings_$v->id", $v->value), "id='$v->field_name' class='form-control'");
                                        echo form_error("settings_$v->id");
                                    } else if ($v->type == "textarea") {

                                        echo form_textarea("settings_$v->id", set_value("settings_$v->id", $v->value), "id='$v->field_name' class='form-control' style='height:100px' ");
                                        echo form_error("settings_$v->id");
                                    } else if ($v->type == "radio") {
                                        ?>
                                        <div class="radio radche-50">
                                            <?php
                                            $options = @explode(",", $v->select_items);
                                            foreach ($options as $key => $value) {
                                                ?> 
                                                <label for="radio_<?php echo $value ?>">
                                                    <?php
                                                    echo form_radio("settings_$v->id", $value, set_radio("settings_$v->id", $value, $v->value == $value ? TRUE : FALSE), "id='radio_{$value}'");
                                                    echo $value;
                                                    ?>
                                                </label> 
                                                <?php
                                            }
                                            ?>
                                        </div>

                                        <?php
                                    } else if ($v->type == "select") {

                                        $options = @explode(",", $v->select_items);
                                        $options = array_combine($options, $options);
                                        echo form_dropdown("settings_$v->id", $options, set_value("settings_$v->id", $v->value), "id='$v->field_name' class='form-control'");
                                    }
                                    ?> 
                                </div> 
                                <?php
                            endforeach;
                        endif;
                        ?>   
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-default" onclick="window.location.href = '<?php echo site_url("admin/dashboard"); ?>'">Cancel</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
        <!-- /.col-lg-6 (nested) --> 
    </div>
</div>
<!-- /.panel-body -->  