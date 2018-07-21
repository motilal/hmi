<div class="row">
    <div class="col-xs-12"> 
        <div class="box box-info"> 
            <!-- /.box-header -->
            <div class="box-body">

                <div class="row">
                    <?php echo form_open(null, array("id" => "manage-form", "method" => "post")); ?>
                    <div class="col-lg-4">
                        <div class="form-group <?php echo form_error('group') != "" ? 'has-error' : ''; ?>">
                            <label class="control-label" for="group">Group</label> 
                            <?php echo form_dropdown('group', $group_options, set_value("group", isset($data->group) ? $data->group : "", false), 'class="form-control" id="group" style="width:100%;"'); ?> 
                            <?php echo form_error('group'); ?>
                        </div>
                    </div> 
                    <div class="clearfix"></div>
                    <div class="col-lg-4">
                        <div class="form-group <?php echo form_error('name') != "" ? 'has-error' : ''; ?>">
                            <label class="control-label" for="title">Name <em>*</em></label>
                            <?php echo form_input("name", set_value("name", isset($data->name) ? $data->name : "", false), "id='name' class='form-control'"); ?>
                            <?php echo form_error('name'); ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-4">
                        <div class="form-group <?php echo form_error('key') != "" ? 'has-error' : ''; ?>">
                            <label class="control-label" for="key">Key <em>*</em></label>
                            <?php echo form_input("key", set_value("key", isset($data->key) ? $data->key : "", false), "id='key' class='form-control'"); ?>
                            <?php echo form_error('key'); ?>
                        </div>
                    </div> 

                    <div class="clearfix"></div>
                    <div class="col-lg-4">
                        <div class="form-group <?php echo form_error('order') != "" ? 'has-error' : ''; ?>">
                            <label class="control-label" for="order">Order</label>
                            <?php echo form_input(array('type' => 'number', 'name' => 'order', 'value' => set_value("order", isset($data->order) ? $data->order : "", false), 'id' => 'order', 'class' => 'form-control')); ?>
                            <?php echo form_error('order'); ?>
                        </div>
                    </div>



                    <div class="col-lg-12">
                        <?php echo form_hidden('id', set_value('id', isset($data->id) ? $data->id : "")); ?>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-default" onclick="window.location.href = '<?php echo site_url("admin/permissions"); ?>'">Cancel</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->  

<script type="text/javascript">
    $("#group").select2({
        tags: true
    });
</script>