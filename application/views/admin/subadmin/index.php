<div class="row">
    <div class="col-xs-12"> 
        <div class="box">
            <div class="box-header">
                <i class="fa fa-user-secret"></i> 
                <h3 class="box-title"><?php echo isset($pageHeading) ? $pageHeading : '&nbsp;'; ?></h3>
                <div class="box-tools pull-right">
                    <div class="btn-group" data-toggle="btn-toggle">
                        <a href="<?php echo site_url('admin/subadmins/add'); ?>" class="btn btn-primary btn-sm add_new_item" id="export-csv"><i class="fa fa-plus"></i> Add New SubAdmin </a>
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
                            <th>Phone</th>
                            <th>Created</th>
                            <th>Last Login</th>
                            <th>Status</th>
                            <th>Action</th>
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
    var datatbl = dynamic_datatable_init(current_url, [0, 7], [], DEFAULT_PAGING); 
</script>