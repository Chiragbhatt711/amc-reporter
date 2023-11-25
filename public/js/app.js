// list permission auto select
function permissionListAutoSelect(data) {
    var checkBox = $(data);
    var permissionName = checkBox.attr('data-name');
    var meunName = checkBox.attr('data-menu-name');

    if (permissionName.indexOf("list") <= 0) {
        if (checkBox.is(":checked")) {
            $('#' + meunName + '-list').prop('checked', true);
        }
    }
    if (permissionName.indexOf("list") > 0) {
        if (!checkBox.is(":checked")) {
            $('#' + meunName + '-create').prop('checked', false);
            $('#' + meunName + '-edit').prop('checked', false);
            $('#' + meunName + '-delete').prop('checked', false);
        }
    }
}



function add_group()
{
    let group = $('#add_group').val();
    $.ajax({
        url:$('#group_url').val(),
        type:'POST',
        data:{
                '_token' : $('meta[name="csrf-token"]').attr('content'),
                group:group,
        },
        success:function(data) {
            let html = "<option value='"+data.id+"'>"+data.name+"</option>";
            $('#group').append(html);
            $('#add_group').val('');
            $('#groupModal').modal("hide");
        }
    });
}

function add_brand()
{
    let brand = $('#add_brand').val();
    $.ajax({
        url:$('#brand_url').val(),
        type:'POST',
        data:{
                '_token' : $('meta[name="csrf-token"]').attr('content'),
                brand:brand,
        },
        success:function(data) {
            let html = "<option value='"+data.id+"'>"+data.name+"</option>";
            $('#brand').append(html);
            $('#add_brand').val('');
            $('#brandModal').modal("hide");
        }
    });
}

function add_model()
{
    let model = $('#add_model').val();
    $.ajax({
        url:$('#model_url').val(),
        type:'POST',
        data:{
                '_token' : $('meta[name="csrf-token"]').attr('content'),
                model:model,
        },
        success:function(data) {
            let html = "<option value='"+data.id+"'>"+data.name+"</option>";
            $('#model').append(html);
            $('#add_model').val('');
            $('#modelModal').modal("hide");
        }
    });
}
