<div class="row">
    <div class="col-xs-12"> 
        <div class="box box-info"> 
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <?php echo form_open(null, array("id" => "manage-slider-form", "method" => "post")); ?>
                    <div class="col-lg-7" style="position:relative;">
                        <h4 class="centered"> Upload Image </h4> 
                        <div id="cropContainerMinimal"></div>
                        <input type="hidden" name="image" value="<?php echo isset($data->image) ? $data->image : ""; ?>">
                    </div>	
                    <div class="clearfix"></div>
                    <div class="col-lg-7" style="margin-top:10px;">
                        <div class="form-group <?php echo form_error('title') != "" ? 'has-error' : ''; ?>">
                            <label class="control-label" for="title">Slider Title <em>*</em></label>
                            <?php echo form_input("title", set_value("title", isset($data->title) ? $data->title : "", false), "id='title' class='form-control'"); ?>
                            <?php echo form_error('title'); ?>
                        </div>
                    </div> 

                    <div class="clearfix"></div>
                    <div class="col-lg-7">
                        <div class="form-group <?php echo form_error('description') != "" ? 'has-error' : ''; ?>">
                            <label class="control-label" for="description">Description <em>*</em></label>
                            <?php echo form_textarea("description", set_value("description", isset($data->description) ? $data->description : "", false), "id='description' class='form-control' style='height:100px;'"); ?>
                            <?php echo form_error('description'); ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-7">
                        <div class="form-group <?php echo form_error('link') != "" ? 'has-error' : ''; ?>">
                            <label class="control-label" for="link">Link <em>*</em></label>
                            <?php echo form_input("link", set_value("link", isset($data->link) ? $data->link : "", false), "id='link' class='form-control'"); ?>
                            <?php echo form_error('link'); ?>
                        </div>
                    </div> 

                    <div class="col-lg-8"> 
                        <?php echo form_hidden('id', set_value('id', isset($data->id) ? $data->id : "")); ?>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-default" onclick="window.location.href = '<?php echo site_url("admin/sliders"); ?>'">Cancel</button>
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
<script>
    var cropperHeader = null;
    var cropperOptions = null;
    $(window).on('load', function () {
        var cropImg = '<?php echo (isset($data->image) && $data->image != "") ? $data->image : ''; ?>';
        cropperOptions = {
            rotateControls: false,
            uploadUrl: '<?php echo site_url('admin/sliders/upload_image'); ?>',
            cropUrl: '<?php echo site_url('admin/sliders/crop_image'); ?>',
            onBeforeImgUpload: function () {
                $('#cropContainerMinimal').empty();
            },
            onAfterImgCrop: function (res) {
                $('[name="image"]').val(res.imagename);
            },
            onError: function (errormessage) {
                showMessage('success', {message: 'onError:' + errormessage});
            }
        }
        cropperHeader = new Croppic('cropContainerMinimal', cropperOptions);

        if (cropImg != "") {
            $('#cropContainerMinimal').append($('<img/>').attr('src', '<?php echo (isset($data->image) && $data->image != "") ? base_url("uploads/slider/$data->image?v=" . uniqid()) : ''; ?>'));
            $('.cropControlsUpload').prepend('<i id="cropOrg" class="cropControlCrop"></i>');
            $(document).on('click', '#cropOrg', function (e) {
                e.preventDefault();
                var imagePath = '<?php echo (isset($data->image) && $data->image != "") ? base_url("uploads/slider/big/$data->image") : ''; ?>';
                cropperHeader.destroy();
                cropperOptions.loadPicture = imagePath;
                cropperHeader = new Croppic('cropContainerMinimal', cropperOptions);
            });
        }

    });
</script>
<style> 
    #cropContainerMinimal{ width:740px;height: 385px; position: relative; border:1px solid #ccc;} 
    .cropContainerMinimal_imgUploadForm{position: absolute;}
</style>