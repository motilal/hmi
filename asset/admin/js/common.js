$(document).ready(function () {
    $(document).ajaxStart(function () {
        Pace.restart();
    });
    $("#notification_pop").show();
    $("#notification_pop").click(function () {
        hideAllMessages();
    });
    $('.select2dropdown').select2();

    if (SUCCESS_NOTIFICATION != "" && SUCCESS_NOTIFICATION != null) {
        showMessage('success', {message: SUCCESS_NOTIFICATION});
    } else if (ERROR_NOTIFICATION != "" && ERROR_NOTIFICATION != null) {
        showMessage('error', {message: ERROR_NOTIFICATION});
    } else if (WARNING_NOTIFICATION != "" && WARNING_NOTIFICATION != null) {
        showMessage('warning', {message: WARNING_NOTIFICATION});
    } else if (INFO_NOTIFICATION != "" && INFO_NOTIFICATION != null) {
        showMessage('info', {message: INFO_NOTIFICATION});
    }

    $('[data-toggle="tooltip"]').tooltip();

    $(document).on('click', 'a.changestatus', function (e) {
        e.preventDefault();
        var _this = $(this);
        var status = _this.data('status');
        var changeaction = status == 0 ? "Active" : "Inactive";
        if (confirm('Are you sure to wants ' + changeaction + ' this?')) {
            $.ajax({
                url: _this.attr('href'),
                type: "POST",
                dataType: "json",
                data: {id: _this.data('id'), status: status},
                success: function (response) {
                    if (response.success) {
                        if (status == 0) {
                            _this.data('status', 1);
                            _this.removeClass('label-danger').addClass('label-success').text('Active');
                        } else {
                            _this.data('status', 0);
                            _this.removeClass('label-success').addClass('label-danger').text('Inactive');
                        }
                        showMessage('success', {message: response.success});
                    } else if (response.error) {
                        showMessage('error', {message: response.error});
                    }
                },
                error: function (jqXHR, exception) {
                    showMessage('error', {message: 'Uncaught Error.\n' + jqXHR.responseText});
                }
            });
        }
    });

    $(document).on('click', 'a.delete-row', function (e) {
        e.preventDefault();
        var _this = $(this);
        if (confirm("Are you sure to wants delete this?")) {
            $.ajax({
                url: _this.attr('href'),
                type: "POST",
                dataType: "json",
                data: {id: _this.data('id')},
                success: function (response) {
                    if (response.success) {
                        datatbl.row(_this.parents('tr')).remove().draw();
                        showMessage('success', {message: response.success});
                    } else if (response.error) {
                        showMessage('error', {message: response.error});
                    }
                },
                error: function (jqXHR, exception) {
                    showMessage('error', {message: 'Uncaught Error.\n' + jqXHR.responseText});
                }
            });
        }
    });

});

function datatable_init(notsortable, defaultorder, displaylength, showsr) {
    var datatbl = $('#dataTables-grid').DataTable({
        order: defaultorder,
        "columnDefs": [
            {"orderable": false, "targets": notsortable}
        ],
        "language": {
            "paginate": {
                "previous": "Prev"
            }
        },
        "iDisplayLength": displaylength,
        "fnRowCallback": function (nRow, aData, iDisplayIndex) {

        }
    });
    if (showsr == 1) {
        datatbl.on('order.dt search.dt', function () {
            datatbl.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
    }
    return datatbl;
}

function dynamic_datatable_init(url_ajax, notsortable, defaultorder, displaylength, showsr) {
    var datatbl = $('#dataTables-grid').DataTable({
        order: defaultorder,
        processing: true,
        serverSide: true,
        ajax: url_ajax,
        "columnDefs": [
            {"orderable": false, "targets": notsortable}
        ],
        "language": {
            "paginate": {
                "previous": "Prev"
            }
        },
        "iDisplayLength": displaylength
    });
    return datatbl;
}


var Time_Interval = null;
function hideAllMessages() {
    var messagesHeights = new Array(); /* this array will store height for each */
    var myMessages = ['info', 'warning', 'error', 'success'];
    for (i = 0; i < myMessages.length; i++) {
        messagesHeights[i] = $('#notification_pop > .' + myMessages[i]).outerHeight(); /* fill array */
        $('#notification_pop > .' + myMessages[i]).animate({top: -messagesHeights[i]}, 500);
    }
    if (Time_Interval !== null) {
        clearInterval(Time_Interval);
    }
}
function showMessage(type, params) {
    toastr.remove()
    if (type == 'success') {
        toastr.success(params.message);
    } else if (type == 'error') {
        toastr.error(params.message);
    } else if (type == 'warning') {
        toastr.warning(params.message);
    } else if (type == 'info') {
        toastr.info(params.message);
    }
}
 