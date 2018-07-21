<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_MAP_KEY; ?>&libraries=places&callback=initAutocomplete" async defer></script>
<div class="row">
    <div class="col-xs-12"> 
        <div class="box box-info"> 
            <!-- /.box-header -->
            <div class="box-body">

                <div class="row">
                    <?php echo form_open(null, array("id" => "manage-form", "method" => "post")); ?>

                    <div class="col-lg-6">
                        <div class="form-group <?php echo form_error('user') != "" ? 'has-error' : ''; ?>">
                            <label class="control-label" for="user">User <em>*</em></label> 
                            <?php echo form_dropdown('user', $users_options, set_value("user", isset($data->user_id) ? $data->user_id : "", false), 'class="form-control select2dropdown" id="user" style="width:100%;"'); ?> 
                            <?php echo form_error('user'); ?>
                        </div>
                    </div>  
                    <div class="clearfix"></div>

                    <div class="col-lg-6">
                        <div class="form-group <?php echo form_error('package') != "" ? 'has-error' : ''; ?>">
                            <label class="control-label" for="package">Package <em>*</em></label> 
                            <?php echo form_dropdown('package', $packages_options, set_value("package", isset($data->package_id) ? $data->package_id : "", false), 'class="form-control select2dropdown" id="package" style="width:100%;"'); ?> 
                            <?php echo form_error('package'); ?>
                        </div>
                    </div>  
                    <div class="clearfix"></div>

                    <div class="col-lg-4">  
                        <div class="form-group <?php echo form_error('journey_date') != "" ? 'has-error' : ''; ?>">
                            <label class="control-label" for="journey_date">Journey Date <em>*</em></label> 
                            <?php echo form_input("journey_date", set_value("journey_date", isset($data->journey_date) ? date('d-m-Y', strtotime($data->journey_date)) : ""), "id='journey_date' class='form-control' placeholder='Date'"); ?>
                            <?php echo form_error('journey_date'); ?>
                        </div> 
                    </div>
                    <div class="col-lg-2">  
                        <div class="form-group <?php echo form_error('journey_time') != "" ? 'has-error' : ''; ?>">
                            <label class="control-label" for="journey_time">Journey Time <em>*</em></label> 
                            <?php echo form_input("journey_time", set_value("journey_time", isset($data->journey_time) ? date('H:i', strtotime($data->journey_time)) : ""), "id='journey_time' class='form-control' placeholder='Time'"); ?>
                            <?php echo form_error('journey_time'); ?>
                        </div> 
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-lg-2">
                        <?php isset($data->guest_adult) ? $data->guest_adult = $data->guest_adult : ""; ?>     
                        <div class="form-group <?php echo form_error('guest_adult') != "" ? 'has-error' : ''; ?>">
                            <label class="control-label" for="guest_adult">Guest Adult</label> 
                            <?php echo form_input("guest_adult", set_value("guest_adult", isset($data->guest_adult) ? $data->guest_adult : ""), "id='guest_adult' class='form-control'"); ?>
                        </div> 
                    </div>
                    <div class="col-lg-2">
                        <?php isset($data->guest_child) ? $data->guest_child = $data->guest_child : ""; ?>     
                        <div class="form-group <?php echo form_error('guest_child') != "" ? 'has-error' : ''; ?>">
                            <label class="control-label" for="guest_child">Guest Child</label> 
                            <?php echo form_input("guest_child", set_value("guest_child", isset($data->guest_child) ? $data->guest_child : ""), "id='guest_child' class='form-control'"); ?>
                        </div> 
                    </div>
                    <div class="col-lg-2">
                        <?php isset($data->guest_infant) ? $data->guest_infant = $data->guest_infant : ""; ?>     
                        <div class="form-group <?php echo form_error('guest_infant') != "" ? 'has-error' : ''; ?>">
                            <label class="control-label" for="guest_infant">Guest Infant</label> 
                            <?php echo form_input("guest_infant", set_value("guest_infant", isset($data->guest_infant) ? $data->guest_infant : ""), "id='guest_infant' class='form-control'"); ?>
                        </div> 
                    </div>

                    <div class="clearfix"></div>
                    <div class="col-lg-6">
                        <div class="form-group <?php echo form_error('pickup_location') != "" ? 'has-error' : ''; ?>">
                            <label class="control-label" for="pickup_location">Pickup Location</label>
                            <?php echo form_input("pickup_location", set_value("pickup_location", isset($data->pickup_location) ? $data->pickup_location : "", false), "id='pickup_location' class='form-control'"); ?>
                            <?php echo form_error('pickup_location'); ?>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="col-lg-6">
                        <div class="form-group <?php echo form_error('message') != "" ? 'has-error' : ''; ?>">
                            <label class="control-label" for="message">Message</label>
                            <?php echo form_textarea("message", set_value("message", isset($data->message) ? $data->message : ""), "id='message' class='form-control' style='height:100px;'"); ?>
                            <?php echo form_error('message'); ?>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="col-lg-6">
                        <?php echo form_hidden('id', set_value('id', isset($data->id) ? $data->id : "")); ?>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-default" onclick="window.location.href = '<?php echo site_url("admin/bookings"); ?>'">Cancel</button>
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
    $('#journey_date').datetimepicker({
        format: 'd-m-Y',
        mask: '39-19-9999',
        timepicker: false
    });
    $('#journey_time').datetimepicker({
        format: 'H:i',
        mask: '24:59',
        timepicker: true,
        datepicker: false
    });
    var placeSearch, autocomplete;
    var componentForm = {
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
    };

    function initAutocomplete() {
        autocomplete = new google.maps.places.Autocomplete((document.getElementById('pickup_location')), {types: ['geocode']});
        autocomplete.addListener('place_changed', fillInAddress);
    }

    function fillInAddress() {
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;
        }
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                document.getElementById(addressType).value = val;
            }
        }
    }
    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
            });
        }
    }
</script>