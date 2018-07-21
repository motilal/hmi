<div class="row">
    <div class="col-xs-12"> 
        <div class="box">
            <div class="box-header">
                <i class="fa fa-opencart"></i> 
                <h3 class="box-title"><?php echo isset($pageHeading) ? $pageHeading : '&nbsp;'; ?></h3>

                <div class="box-tools pull-right">
                    <div class="btn-group" data-toggle="btn-toggle">
                        <?php if (is_allow_action('booking-add')) { ?>
                            <a href="<?php echo site_url('admin/bookings/manage'); ?>" class="btn btn-primary btn-sm add_new_item"><i class="fa fa-plus"></i> Add New Booking </a>
                        <?php } ?> 
                        <?php if (is_allow_action('booking-export')) { ?>
                            <a href="<?php echo site_url('admin/bookings?download=report'); ?>" class="btn btn-default btn-sm" id='export-csv'><i class="fa fa-download"></i> Export CSV</a>
                        <?php } ?> 
                    </div>
                </div>

            </div>     
            <!-- /.box-header -->
            <div class="box-body"> 
                <table id="dataTables-grid" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr> 
                            <td>Sr.</td> 
                            <th>User Name</th>
                            <th>Journey Date/Time</th>
                            <th>Guest</th> 
                            <th>Created</th> 
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td colspan="6" align='center'><strong>Loading...</strong></td></tr>
                    </tbody> 
                </table>  
            </div>
            <!-- /.box-body --> 
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div> 

<script>
    var current_url = '<?php echo current_url(); ?>';
    /*
     params 
     1 sorting remove from colomns
     2 default sort order of colomn set default []
     3 default paging 
     */
    var datatbl = dynamic_datatable_init(current_url, [0, 3, 5], [], DEFAULT_PAGING);
    $('#export-csv').on('click', function (e) {
        var data = datatbl.ajax.params();
        $(this).attr("href", this.href + "?" + $.param(data) + '&download=report');
    });
</script>