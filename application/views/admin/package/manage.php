<div class="row">
    <div class="col-xs-12"> 
        <div class="box box-info"> 
            <!-- /.box-header -->
            <div class="box-body">

                <div class="row">
                    <?php echo form_open_multipart(null, array("id" => "manage-form", "method" => "post")); ?>

                    <div class="col-lg-12 padding0">
                        <div class="col-lg-6">
                            <div class="form-group <?php echo form_error('name') != "" ? 'has-error' : ''; ?>">
                                <label class="control-label" for="name">Package Name <em>*</em></label>
                                <?php echo form_input("name", set_value("name", isset($data->name) ? $data->name : "", false), "id='name' class='form-control'"); ?>
                                <?php echo form_error('name'); ?>
                            </div>
                        </div> 


                        <div class="col-lg-6">
                            <div class="form-group <?php echo form_error('category') != "" ? 'has-error' : ''; ?>">
                                <label class="control-label" for="category">Category <em>*</em></label> 
                                <?php echo form_dropdown('category', $categories_options, set_value("category", isset($data->category) ? $data->category : "", false), 'class="form-control" id="category" style="width:100%;"'); ?> 
                                <?php echo form_error('category'); ?>
                            </div>
                        </div>   
                    </div> 

                    <div class="col-lg-12 padding0">
                        <div class="col-lg-6">
                            <div class="form-group <?php echo form_error('days') != "" ? 'has-error' : ''; ?>">
                                <label class="control-label" for="days">No. of days</label>
                                <?php echo form_input("days", set_value("days", isset($data->days) ? $data->days : "", false), "id='days' class='form-control'"); ?>
                                <?php echo form_error('days'); ?>
                            </div>
                        </div> 

                        <div class="col-lg-6">
                            <div class="form-group <?php echo form_error('age_limit') != "" ? 'has-error' : ''; ?>">
                                <label class="control-label" for="age_limit">No. of age_limit</label>
                                <?php echo form_input("age_limit", set_value("age_limit", isset($data->age_limit) ? $data->age_limit : "", false), "id='age_limit' class='form-control'"); ?>
                                <?php echo form_error('age_limit'); ?>
                            </div>
                        </div> 
                    </div>
                    <div class="col-lg-12 padding0">
                        <div class="col-lg-6">
                            <div class="form-group <?php echo form_error('city') != "" ? 'has-error' : ''; ?>">
                                <label class="control-label" for="city">City</label> 
                                <?php echo form_dropdown('city', $cities_options, set_value("city", isset($data->city) ? $data->city : "", false), 'class="form-control" id="city" style="width:100%;"'); ?> 
                                <?php echo form_error('city'); ?>
                            </div>
                        </div>
                        <div class="col-lg-6"> 
                            <div class="form-group pull-left">
                                <label class="control-label" for="image">Image</label>
                                <?php echo form_upload("image", '', "id='image'"); ?>  
                            </div> 
                            <?php
                            if (isset($data->image) && $data->image != "") {
                                echo img(getPackageImage($data->image, array('width' => 100, 'height' => 100)), FALSE, array('width' => 100));
                            }
                            ?>
                        </div>
                    </div>

                    <div class="col-lg-12 padding0">
                        <div class="col-lg-8">
                            <div class="form-group <?php echo form_error('description') != "" ? 'has-error' : ''; ?>">
                                <label class="control-label" for="description">Description <em>*</em></label>
                                <?php echo form_textarea("description", set_value("description", isset($data->description) ? $data->description : "", false), "id='description' class='form-control editor' style='height:100px;'"); ?>
                                <?php echo form_error('description'); ?>
                            </div> 
                        </div>

                        <div class="col-lg-8">
                            <div class="form-group <?php echo form_error('detail_itinerary') != "" ? 'has-error' : ''; ?>">
                                <label class="control-label" for="detail_itinerary">Detail Itinerary for the day</label>
                                <?php echo form_textarea("detail_itinerary", set_value("detail_itinerary", isset($data->detail_itinerary) ? $data->detail_itinerary : "", false), "id='detail_itinerary' class='form-control editor' style='height:100px;'"); ?>
                                <?php echo form_error('detail_itinerary'); ?>
                            </div> 
                        </div>



                        <div class="col-lg-8">
                            <div class="form-group <?php echo form_error('places_covered') != "" ? 'has-error' : ''; ?>">
                                <label class="control-label" for="places_covered">Places Covered</label>
                                <?php echo form_textarea("places_covered", set_value("places_covered", isset($data->places_covered) ? $data->places_covered : "", false), "id='places_covered' class='form-control editor' style='height:100px;'"); ?>
                                <?php echo form_error('places_covered'); ?>
                            </div> 
                        </div> 

                        <div class="col-lg-8">
                            <div class="form-group <?php echo form_error('tourist_places') != "" ? 'has-error' : ''; ?>">
                                <label class="control-label" for="tourist_places">Details about Tourist Places</label>
                                <?php echo form_textarea("tourist_places", set_value("tourist_places", isset($data->tourist_places) ? $data->tourist_places : "", false), "id='tourist_places' class='form-control editor' style='height:100px;'"); ?>
                                <?php echo form_error('tourist_places'); ?>
                            </div> 
                        </div> 



                        <div class="col-lg-8">
                            <div class="form-group <?php echo form_error('inclusions') != "" ? 'has-error' : ''; ?>">
                                <label class="control-label" for="inclusions">Inclusions</label>
                                <?php echo form_textarea("inclusions", set_value("inclusions", isset($data->inclusions) ? $data->inclusions : "", false), "id='inclusions' class='form-control editor' style='height:100px;'"); ?>
                                <?php echo form_error('inclusions'); ?>
                            </div> 
                        </div> 

                        <div class="col-lg-8">
                            <div class="form-group <?php echo form_error('exclusions') != "" ? 'has-error' : ''; ?>">
                                <label class="control-label" for="exclusions">Exclusions</label>
                                <?php echo form_textarea("exclusions", set_value("exclusions", isset($data->exclusions) ? $data->exclusions : "", false), "id='exclusions' class='form-control editor' style='height:100px;'"); ?>
                                <?php echo form_error('exclusions'); ?>
                            </div> 
                        </div>   

                        <div class="col-lg-8">
                            <div class="form-group <?php echo form_error('terms_conditions') != "" ? 'has-error' : ''; ?>">
                                <label class="control-label" for="terms_conditions">Terms and Conditions</label>
                                <?php echo form_textarea("terms_conditions", set_value("terms_conditions", isset($data->terms_conditions) ? $data->terms_conditions : "", false), "id='terms_conditions' class='form-control editor' style='height:100px;'"); ?>
                                <?php echo form_error('terms_conditions'); ?>
                            </div> 
                        </div>

                        <div class="col-lg-8">
                            <div class="form-group <?php echo form_error('cancellation_refund_policy') != "" ? 'has-error' : ''; ?>">
                                <label class="control-label" for="cancellation_refund_policy">Cancellation and Refund Policy</label>
                                <?php echo form_textarea("cancellation_refund_policy", set_value("cancellation_refund_policy", isset($data->cancellation_refund_policy) ? $data->cancellation_refund_policy : "", false), "id='cancellation_refund_policy' class='form-control editor' style='height:100px;'"); ?>
                                <?php echo form_error('cancellation_refund_policy'); ?>
                            </div> 
                        </div>  
                    </div>

                    <div class="clearfix"></div>
                    <div class="col-lg-6">
                        <?php echo form_hidden('id', set_value('id', isset($data->id) ? $data->id : "")); ?>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-default" onclick="window.location.href = '<?php echo site_url("admin/packages"); ?>'">Cancel</button>
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
    $("#category").select2();
</script>