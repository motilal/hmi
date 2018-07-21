<div class="row">
    <div class="col-xs-12"> 
        <div class="box">
            <div class="box-header">
                <i class="fa fa-file-text-o"></i> 
                <h3 class="box-title"><?php echo isset($pageHeading) ? $pageHeading : '&nbsp;'; ?></h3>
                <?php if (is_allow_action('page-add')) { ?>
                    <div class="box-tools pull-right">
                        <div class="btn-group" data-toggle="btn-toggle">
                            <a href="<?php echo site_url('admin/pages/manage'); ?>" class="btn btn-primary btn-sm add_new_item"><i class="fa fa-plus"></i> Add New Page </a>
                        </div>
                    </div>
                <?php } ?>
            </div>     
            <!-- /.box-header -->
            <div class="box-body"> 
                <table id="dataTables-grid" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr> 
                            <td>Sr.</td>
                            <th>Title</th>
                            <th>Created</th>
                            <th>Status</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows() > 0) { ?>
                            <?php foreach ($result->result() as $key => $row): ?>
                                <tr>  
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $row->title; ?></td>
                                    <td><?php echo date(DATE_FORMATE, strtotime($row->created)); ?></td>
                                    <td>
                                        <?php echo $this->layout->element('admin/element/_module_status', array('status' => $row->status, 'id' => $row->id, 'url' => "admin/pages/changestatus", 'permissionKey' => 'page-status'), true); ?>
                                    </td>
                                    <td class="action-link">  
                                        <?php echo $this->layout->element('admin/element/_module_action', array('id' => $row->id, 'editUrl' => "admin/pages/manage/$row->id", 'editPermissionKey' => 'page-edit', 'deleteUrl' => 'admin/pages/delete', 'deletePermissionKey' => 'page-delete'), true); ?>
                                    </td> 
                                </tr> 
                            <?php endforeach; ?>
                        <?php } ?> 
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
    /*
     params 
     1 sorting remove from colomns
     2 default sort order of colomn set default []
     3 default paging
     4 show sr. number or not
     */
    var datatbl = datatable_init([0, 4], [[1, 'asc']], DEFAULT_PAGING, 1);
</script>