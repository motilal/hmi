<div class="row">
    <div class="col-xs-12"> 
        <div class="box">
            <div class="box-header">
                <i class="fa fa-phone"></i> 
                <h3 class="box-title"><?php echo isset($pageHeading) ? $pageHeading : '&nbsp;'; ?></h3>
                <div class="box-tools pull-right">
                    <div class="btn-group" data-toggle="btn-toggle">
                        <?php if (is_allow_action('contact-export')) { ?>
                            <a href="<?php echo site_url('admin/contacts?download=report'); ?>" class="btn btn-default btn-sm" id='export-csv'><i class="fa fa-download"></i> Export CSV</a>
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Date</th> 
                            <th>Status</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td colspan="8" align='center'><strong>Loading...</strong></td></tr>
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
    var datatbl = dynamic_datatable_init(current_url, [0,5], [], DEFAULT_PAGING);
    $('#export-csv').on('click', function (e) {
        var data = datatbl.ajax.params();
        $(this).attr("href", this.href + "?" + $.param(data) + '&download=report');
    });
</script>