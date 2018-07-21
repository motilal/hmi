<div class="row">
    <div class="col-xs-12"> 
        <div class="box box-info"> 
            <!-- /.box-header -->
            <div class="box-body"> 
                <?php if (!empty($data)) { ?> 
                    <table class="table table-bordered table-striped"> 
                        <tbody>  
                            <tr>
                                <th>Title</th>
                                <td colspan="4"><?php echo $data->title; ?></td>
                            </tr>
                            <tr>
                                <th>Subject</th>
                                <td colspan="4"><?php echo $data->subject; ?></td>
                            </tr>
                            <tr>
                                <th>Variables</th>
                                <td colspan="4"><?php echo $data->variable; ?></td>
                            </tr>

                            <tr>
                                <th>Body</th>
                                <td colspan="4"><?php echo $data->body; ?></td>
                            </tr>

                            <tr>
                                <th>Created</th>
                                <td colspan="4"><?php echo date(DATETIME_FORMATE, strtotime($data->created)); ?></td>
                            </tr>  
                            <?php if ($data->updated != ""): ?>
                                <tr>
                                    <th>Updated</th>
                                    <td colspan="4"><?php echo date(DATETIME_FORMATE, strtotime($data->updated)); ?></td>
                                </tr>  
                            <?php endif; ?>

                        </tbody>
                    </table> 

                <?php } ?> 
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->  