<div class="row">
    <div class="col-xs-12"> 
        <div class="box">
            <div class="box-header">
                <i class="fa fa-institution"></i> 
                <h3 class="box-title"><?php echo isset($pageHeading) ? $pageHeading : '&nbsp;'; ?></h3>
                <div class="box-tools pull-right">
                    <div class="btn-group" data-toggle="btn-toggle">
                        <?php if (is_allow_action('city-add')) { ?>
                            <a href="#" data-toggle="modal" data-target="#modal-manage" class="btn btn-primary btn-sm add_new_item"><i class="fa fa-plus"></i> Add New City </a>
                        <?php } ?> 
                        <a href="<?php echo site_url('admin/cities?download=report'); ?>" class="btn btn-default btn-sm"><i class="fa fa-download"></i> Export CSV</a>
                    </div>
                </div>
            </div>     
            <!-- /.box-header -->
            <div class="box-body"> 
                <div class="table-responsive">
                    <table id="dataTables-grid" class="table table-bordered table-striped" width="100%">
                        <thead>
                            <tr>
                                <td>Sr.</td> 
                                <th>Name</th> 
                                <th>Created</th> 
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result->num_rows() > 0) { ?>
                                <?php foreach ($result->result() as $key => $row): ?> 
                                    <tr id="row_<?php echo $row->id; ?>">
                                        <td><?php echo $key + 1; ?></td> 
                                        <td><?php echo $row->name; ?></td> 
                                        <td><?php echo date(DATE_FORMATE, strtotime($row->created)); ?></td>
                                        <td>
                                            <?php echo $this->layout->element('admin/element/_module_status', array('status' => $row->is_active, 'id' => $row->id, 'url' => "admin/cities/changestatus", 'permissionKey' => "city-status"), true); ?>
                                        </td>
                                        <td>  
                                            <?php echo $this->layout->element('admin/element/_module_action', array('id' => $row->id, 'editUrl' => "admin/cities/manage", 'deleteUrl' => 'admin/cities/delete', 'editPermissionKey' => 'city-edit', 'deletePermissionKey' => 'city-delete'), true); ?>
                                        </td>  
                                    </tr>
                                <?php endforeach; ?>
                            <?php } ?> 
                        </tbody> 
                    </table>
                </div>
            </div>
            <!-- /.box-body --> 
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div> 

<div class="modal fade" id="modal-manage">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php echo form_open('admin/cities/manage', array("id" => "manage-form", "method" => "post")); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New City</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="control-label" for="name">City Name <em>*</em></label>
                            <?php echo form_input("name", '', "id='name' class='form-control'"); ?>
                        </div>  
                        <?php echo form_hidden('id'); ?> 
                    </div>
                </div>
            </div>
            <div class="modal-footer"> 
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <?php echo form_close(); ?> 
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<script>
    /*
     params 
     1 sorting remove from colomns
     2 default sort order of colomn set default []
     3 default paging
     4 show sr. number or not
     */
    var datatbl = datatable_init([0, 4], [[2, 'asc']], DEFAULT_PAGING, 1);

    $('#manage-form').submit(function (e) {
        var _this = $(this);
        _this.find("[type='submit']").prop('disabled', true);
        $('.form-group .help-block').remove();
        $('.form-group').removeClass('has-error');
        e.preventDefault();
        $.ajax({
            url: _this.attr('action'),
            type: "POST",
            data: $('#manage-form').serialize(),
            success: function (res)
            {
                _this.find("[type='submit']").prop('disabled', false);
                if (res.validation_error) {
                    $.each(res.validation_error, function (index, value) {
                        var elem = _this.find('[name="' + index + '"]');
                        var error = '<div class="help-block">' + value + '</div>';
                        elem.closest('.form-group').append(error);
                        elem.closest('.form-group').addClass('has-error');
                    });
                } else if (res.success && res.msg && res.data) {
                    if (res.mode == 'add') {
                        datatbl.row.add([0, res.data.name, res.data.created, res.data.statusButtons, res.data.actionButtons]).draw();
                        $('.changestatus[data-id="' + res.data.id + '"]').closest('tr').attr('id', 'row_' + res.data.id);
                    } else if (res.mode == 'edit') {
                        $('#row_' + res.data.id).find('td:nth-child(2)').text(res.data.name);
                    }
                    showMessage('success', {message: res.msg});
                    $('#modal-manage').modal('hide');
                } else if (res.error) {
                    showMessage('error', {message: res.error});
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                _this.find("[type='submit']").prop('disabled', false);
                showMessage('error', 'Internal error: ' + jqXHR.responseText);
            }
        });
    });

    $('#modal-manage').on('hidden.bs.modal', function (e) {
        $('.form-group .help-block').remove();
        $('.form-group').removeClass('has-error');
        $('#manage-form')[0].reset();
        $('#manage-form').find('[name="id"]').val('');
        $('.modal-title').text('Add New City');
    });

    $(document).on('click', 'a.edit-row', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var name = $.trim($(this).closest('tr').find('td:nth-child(2)').text());
        $('#manage-form').find('[name="name"]').val(name);
        $('#manage-form').find('[name="id"]').val(id);
        $('.modal-title').text('Edit City');
        $('#modal-manage').modal('show');
    });

</script>