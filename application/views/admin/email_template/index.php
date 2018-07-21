<div class="row">
    <div class="col-xs-12"> 
        <div class="box">

            <!-- /.box-header -->
            <div class="box-body"> 
                <table id="dataTables-grid" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <td>Sr.</td>
                            <th>Title</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows() > 0) { ?>
                            <?php foreach ($result->result() as $key => $row): ?>
                                <tr id="row_<?php echo $row->id; ?>">
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $row->title; ?></td>
                                    <td><?php echo $row->subject; ?></td>
                                    <td>
                                        <?php echo $this->layout->element('admin/element/_module_status', array('status' => $row->status, 'id' => $row->id, 'url' => "admin/email_templates/changestatus", 'permissionKey' => 'email_templates-status'), true); ?>
                                    </td>
                                    <td>  
                                        <?php echo $this->layout->element('admin/element/_module_action', array('id' => $row->id, 'editUrl' => "admin/email_templates/manage/$row->id", 'viewUrl' => "admin/email_templates/view/$row->id", 'editPermissionKey' => 'email_templates-edit', 'deletePermissionKey' => 'email_templates-delete'), true); ?>
                                    </td>  
                                </tr>
                            <?php endforeach; ?>
                        <?php } ?> 
                    </tbody> 
                </table> 

                <?php echo form_close(); ?>
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