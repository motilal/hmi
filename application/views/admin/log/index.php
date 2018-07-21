<div class="row">
    <div class="col-xs-12"> 
        <div class="box">
            <div class="box-header">
                <i class="fa fa-bug"></i> 
                <h3 class="box-title"><?php echo isset($pageHeading) ? $pageHeading : '&nbsp;'; ?></h3> 
            </div>     
            <!-- /.box-header -->
            <div class="box-body">    
                <table id="dataTables-grid" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <td>Sr.</td>
                            <th>File Name</th>
                            <th>Created</th>
                            <th>File Size</th> 
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($logFiles)) { ?>
                            <?php foreach ($logFiles as $key => $row): ?>
                                <?php $encfile = base64_encode($row['filename']); ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $row['filename']; ?></td>
                                    <td><?php echo date(DATETIME_FORMATE, strtotime($row['created'])); ?></td>
                                    <td data-order='<?php echo $row['filesize']; ?>'><?php echo human_filesize($row['filesize']); ?></td> 
                                    <td>   
                                        <?php echo $this->layout->element('admin/element/_module_action', array('id' => $encfile, 'deleteUrl' => "admin/logs/delete", 'viewUrl' => 'admin/logs/detail/?file=' . $encfile), true); ?>
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
    var datatbl = datatable_init([0, 4], [[1, 'desc']], DEFAULT_PAGING, 1);
</script>