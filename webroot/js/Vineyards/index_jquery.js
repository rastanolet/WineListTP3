
// Update the vineyards data list
function getVineyards() {
    $.ajax({
        type: 'GET',
        url: urlToRestApi,
        dataType: "json",
        success:
                function (data) {
                    var vineyardTable = $('#vineyardData');
                    vineyardTable.empty();
                    $.each(data.vineyards, function (key, value)
                    {
                        var editDeleteButtons = '</td><td>' +
                                '<a href="javascript:void(0);" class="btn btn-warning" rowID="' +
                                    value.id + 
                                    '" data-type="edit" data-toggle="modal" data-target="#modalVineyardAddEdit">' + 
                                    'edit</a>' +
                                '<a href="javascript:void(0);" class="btn btn-danger"' +
                                    'onclick="return confirm(\'Are you sure to delete data?\') ?' + 
                                    'vineyardAction(\'delete\', \'' + 
                                    value.id + 
                                    '\') : false;">delete</a>' +
                                '</td></tr>';
                        vineyardTable.append('<tr><td>' + value.id + '</td><td>' + value.name + editDeleteButtons);
 
                    });

                }

    });
}

 /* Function takes a jquery form
 and converts it to a JSON dictionary */
function convertFormToJSON(form) {
    var array = $(form).serializeArray();
    var json = {};

    $.each(array, function () {
        json[this.name] = this.value || '';
    });

    return json;
}


function vineyardAction(type, id) {
    id = (typeof id == "undefined") ? '' : id;
    var statusArr = {add: "added", edit: "updated", delete: "deleted"};
    var requestType = '';
    var vineyardData = '';
    var ajaxUrl = urlToRestApi;
    frmElement = $("#modalVineyardAddEdit");
    if (type == 'add') {
        requestType = 'POST';
        vineyardData = convertFormToJSON(frmElement.find('form'));
    } else if (type == 'edit') {
        requestType = 'PUT';
        ajaxUrl = ajaxUrl + "/" + id;
        vineyardData = convertFormToJSON(frmElement.find('form'));
    } else {
        requestType = 'DELETE';
        ajaxUrl = ajaxUrl + "/" + id;
    }
    frmElement.find('.statusMsg').html('');
    $.ajax({
        type: requestType,
        url: ajaxUrl,
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        data: JSON.stringify(vineyardData),
        success: function (msg) {
            if (msg) {
                frmElement.find('.statusMsg').html('<p class="alert alert-success">Vineyard data has been ' + statusArr[type] + ' successfully.</p>');
                getVineyards();
                if (type == 'add') {
                    frmElement.find('form')[0].reset();
                }
            } else {
                frmElement.find('.statusMsg').html('<p class="alert alert-danger">Some problem occurred, please try again.</p>');
            }
        }
    });
}

// Fill the vineyard's data in the edit form
function editVineyard(id) {
    $.ajax({
        type: 'GET',
        url: urlToRestApi + "/" + id,
        dataType: 'JSON',
  //      data: 'action_type=data&id=' + id,
        success: function (data) {
            $('#id').val(data.vineyard.id);
            $('#name').val(data.vineyard.name);
        }
    });
}

// Actions on modal show and hidden events
$(function () {
    $('#modalVineyardAddEdit').on('show.bs.modal', function (e) {
        var type = $(e.relatedTarget).attr('data-type');
        var vineyardFunc = "vineyardAction('add');";
        $('.modal-title').html('Add new vineyard');
        if (type == 'edit') {
            var rowId = $(e.relatedTarget).attr('rowID');
            vineyardFunc = "vineyardAction('edit'," + rowId + ");";
            $('.modal-title').html('Edit vineyard');
            editVineyard(rowId);
        }
        $('#vineyardSubmit').attr("onclick", vineyardFunc);
    });

    $('#modalVineyardAddEdit').on('hidden.bs.modal', function () {
        $('#vineyardSubmit').attr("onclick", "");
        $(this).find('form')[0].reset();
        $(this).find('.statusMsg').html('');
    });
});



