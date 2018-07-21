<div class="row">
    <div class="col-xs-12"> 
        <div class="box">
            <div class="box-header">
                <i class="fa fa-lock"></i> 
                <h3 class="box-title"><?php echo isset($pageHeading) ? $pageHeading : '&nbsp;'; ?></h3>
                <div class="box-tools pull-right">
                    <div class="btn-group" data-toggle="btn-toggle">
                        <a href="<?php echo site_url('admin/flash_messages/manage'); ?>" class="btn btn-primary btn-sm add_new_item"><i class="fa fa-plus"></i> Add Flash Message </a>
                        <?php if (isset($IsLangFileNeedWrite) && $IsLangFileNeedWrite === true) { ?>
                            <a href="<?php echo site_url('admin/flash_messages/updatelangfile'); ?>" class="btn btn-danger btn-sm add_new_item"><i class="fa fa-refresh"></i> Write Language File </a>
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
                            <th>Group</th>
                            <th>Key</th> 
                            <th>Message</th>                           
                            <th width="10%">Order</th>
                            <th width="8%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows() > 0) { ?>
                            <?php foreach ($result->result() as $key => $row): ?>
                                <tr>  
                                    <td><?php echo $key + 1; ?></td>                                    
                                    <td><?php echo $row->group; ?></td>
                                    <td><?php echo $row->key; ?></td>  
                                    <td><?php echo $row->value; ?></td>                                   
                                    <td><?php echo $row->order; ?></td>
                                    <td>  
                                        <?php echo $this->layout->element('admin/element/_module_action', array('id' => $row->id, 'deleteUrl' => "admin/flash_messages/delete/$row->id", 'editUrl' => "admin/flash_messages/manage/$row->id"), true); ?>
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

<script type="text/javascript">
    /*
     params 
     1 sorting remove from colomns
     2 default sort order of colomn set default []
     3 default paging
     4 show sr. number or not
     */
    var datatbl = datatable_init([0, 5], [[1, 'asc']], DEFAULT_PAGING, 1);
</script>