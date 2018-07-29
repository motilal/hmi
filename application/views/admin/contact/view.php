<div class="row">
    <div class="col-xs-12"> 
        <div class="box box-info"> 
            <!-- /.box-header -->
            <div class="box-body"> 
                <?php if (!empty($data)) { ?> 
                    <table class="table table-bordered table-striped"> 
                        <tbody>  
                            <tr>
                                <th>Name</th>
                                <td colspan="4"><?php echo $data->name; ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td colspan="4"><?php echo $data->email; ?></td>
                            </tr>
                            <tr>
                                <th>Subject</th>
                                <td colspan="4"><?php echo $data->subject; ?></td>
                            </tr>
                            <tr>
                                <th>Message</th>
                                <td colspan="4"><?php echo $data->message; ?></td>
                            </tr> 

                            <tr>
                                <th>Created</th>
                                <td colspan="4"><?php echo date(DATETIME_FORMATE, strtotime($data->created)); ?></td>
                            </tr>   

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