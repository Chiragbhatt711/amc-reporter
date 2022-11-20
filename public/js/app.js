document.addEventListener("DOMContentLoaded", function(){
    // make it as accordion for smaller screens
    if (window.innerWidth < 992) {

      // close all inner dropdowns when parent is closed
      document.querySelectorAll('.navbar .dropdown').forEach(function(everydropdown){
        everydropdown.addEventListener('hidden.bs.dropdown', function () {
          // after dropdown is hidden, then find all submenus
            this.querySelectorAll('.submenu').forEach(function(everysubmenu){
              // hide every submenu as well
              everysubmenu.style.display = 'none';
            });
        })
      });

      document.querySelectorAll('.dropdown-menu a').forEach(function(element){
        element.addEventListener('click', function (e) {
            let nextEl = this.nextElementSibling;
            if(nextEl && nextEl.classList.contains('submenu')) {
              // prevent opening link if link needs to open dropdown
              e.preventDefault();
              if(nextEl.style.display == 'block'){
                nextEl.style.display = 'none';
              } else {
                nextEl.style.display = 'block';
              }

            }
        });
      })
    }
    // end if innerWidth

});

$(document).ready(function(){
    $('.dynamic-data-table').DataTable({
        // ordering: false,
        "order": [],
        responsive: false,
        paging: false,
        "info": false,
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, 'All'],
        ]
    });
});

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
        url:'/add-group',
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
        url:'/add-brand',
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
        url:'/add-model',
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
$('.datepicker').datepicker({
    format: "yyyy-mm-dd",
    // startDate: '0d',
    weekStart: 0,
    calendarWeeks: true,
    autoclose: true,
    todayHighlight: true,
    // rtl: true,
    orientation: "auto"
});


function product_add()
{
    let product_id = $('#product_id').val();
    let qty = $('#qty').val();
    let note = $('#note').val();

    $.ajax({
        url:'/product-add',
        type:'POST',
        data:{
                '_token' : $('meta[name="csrf-token"]').attr('content'),
                product_id:product_id,
                qty:qty,
                note:note,
        },
        success:function(data) {
            data = $.parseJSON(data)
            $('#product_body').append(data.html);
        }
    });
}

function productRemove(id)
{
    $('#row_'+id).remove();
}

function setService()
{
    $('#serviceE').html('');
    let noOFService = $('#no_of_service').val();
    let serviceDay = $('#service_day').val();
    let startDate = new Date($('#start_date').val());
    let lastDate = new Date($('#end_date').val());

    var millisBetween = startDate.getTime() - lastDate.getTime();
    var days = millisBetween / (1000 * 3600 * 24);

    let totalDays =  Math.round(Math.abs(days));
    if(!noOFService)
    {
        $('#serviceE').html('Please enter no of service');
        return false;
    }
    if(serviceDay == '' || serviceDay == 'Auto')
    {
        if(noOFService > totalDays-1)
        {
            $('#serviceE').html('Please enter Max '+ parseInt(otalDays-1));
            return false;
        }

        let day = parseInt(totalDays / noOFService);

        let date = startDate;
        let html = '';
        html += '<tr>'+
                    '<td>'+
                        '1'+
                    '</td>'+
                    '<td>'+
                        date.toISOString().split('T')[0] +
                        '<input type="hidden" name="service_1" value="'+date.toISOString().split('T')[0]+'">'+
                    '</td>'+
                    '<td>'+
                        '1 Free Service'+
                    '</td>'+
                '</tr>';
        // console.log(date.toISOString().split('T')[0]);
        for(i=2; i <= noOFService; i++)
        {
            date.setDate(date.getDate() + day);
            html += '<tr>'+
                    '<td>'+
                        i +
                    '</td>'+
                    '<td>'+
                        date.toISOString().split('T')[0] +
                        '<input type="hidden" name="service_'+i+'" value="'+date.toISOString().split('T')[0]+'">'+
                    '</td>'+
                    '<td>'+
                        i+' Free Service'+
                    '</td>'+
                '</tr>';
            $('#service_body').html(html);

        }

    }
    else
    {
        let totalMonth = lastDate.getMonth() - startDate.getMonth() +
        (12 * (lastDate.getFullYear() - startDate.getFullYear()))
        console.log(totalMonth);
        if(noOFService > totalMonth)
        {
            $('#serviceE').html('Please enter Max '+totalMonth);
            return false;
        }
        else
        {
            let date = startDate
            date.setDate(serviceDay);
            let curruntDay = new Date().getDate();
            let servicedate = '';
            if(serviceDay < curruntDay)
            {
                date.setMonth(date.getMonth() + 1);
                servicedate =new Date(date);


            }
            else
            {
                servicedate = date;
            }

            if(servicedate)
            {
                let html = '';
                html += '<tr>'+
                            '<td>'+
                                '1'+
                            '</td>'+
                            '<td>'+
                                servicedate.toISOString().split('T')[0] +
                                '<input type="hidden" name="service_1" value="'+servicedate.toISOString().split('T')[0]+'">'+
                            '</td>'+
                            '<td>'+
                                '1 Free Service'+
                            '</td>'+
                        '</tr>';
                for(i=2; i <= noOFService; i++)
                {
                    servicedate.setMonth(servicedate.getMonth() + 1);
                    html += '<tr>'+
                            '<td>'+
                                i +
                            '</td>'+
                            '<td>'+
                            servicedate.toISOString().split('T')[0] +
                                '<input type="hidden" name="service_'+i+'" value="'+servicedate.toISOString().split('T')[0]+'">'+
                            '</td>'+
                            '<td>'+
                                i+' Free Service'+
                            '</td>'+
                        '</tr>';
                    $('#service_body').html(html);
                }
            }
        }
    }
}

function cleareService()
{
    $('#service_body').html('');
}

async function amcTotalPrice(){
    let contractAmount = 0;
    contractAmount = $('#contract_amount').val();
    let tax_id = $('#tax_id').val();
    let tax = 0;
    let totalAmount = contractAmount;
    let taxAmount = 0;
    let taxVal = 0;
    if(tax_id)
    {
        await $.ajax({
            url:'/get-tex',
            type:'POST',
            data:{
                    '_token' : $('meta[name="csrf-token"]').attr('content'),
                    tax_id:tax_id,
            },
            success:function(data) {
                if(data)
                {
                    tax = data+' %';
                    taxVal = data;

                }
                else
                {
                    $('#tax').val(0);
                }
            }
        });
    }
    $('#tax').val(tax);
    if(contractAmount && tax && taxVal)
    {
        taxAmount = contractAmount * taxVal;
        taxAmount = taxAmount / 100 ;
        totalAmount = +totalAmount + +taxAmount;
    }
    $('#total').val(totalAmount);
    $('#total_amount').val(totalAmount);
    $('#tax_amount').val(taxAmount);
}

function setSchedulePayment()
{
    let installment = $('#no_of_installment').val();
    let totalAmount = 0;
    let startDate = new Date($('#start_date').val());
    let lastDate = new Date($('#end_date').val());
    var millisBetween = startDate.getTime() - lastDate.getTime();
    var days = millisBetween / (1000 * 3600 * 24);
    let totalDays =  Math.round(Math.abs(days));
    if(installment)
    {
        console.log(totalDays-1);
        if(installment > totalDays-1)
        {
            $('#no_of_installmentE').html('Please enter Max '+ parseInt(totalDays - 1));
            return false;
        }

        let day = parseInt(totalDays / installment);
        totalAmount = $('#total_amount').val();
        let perInstallmentAmount = totalAmount / installment;
        let date = startDate;
        let html = '';
        html += '<tr>'+
                    '<td>'+
                        '1'+
                    '</td>'+
                    '<td>'+
                        date.toISOString().split('T')[0] +
                        '<input type="hidden" name="installmetn_1" value="'+date.toISOString().split('T')[0]+'">'+
                    '</td>'+
                    '<td>'+
                    perInstallmentAmount +
                        '<input type="hidden" name="amount_1" value="'+perInstallmentAmount+'">'+
                    '</td>'+
                    '<td>'+
                        '1 Installment'+
                    '</td>'+
                '</tr>';
        // console.log(date.toISOString().split('T')[0]);
        for(i=2; i <= installment; i++)
        {
            date.setDate(date.getDate() + day);
            html += '<tr>'+
                    '<td>'+
                        i +
                    '</td>'+
                    '<td>'+
                        date.toISOString().split('T')[0] +
                        '<input type="hidden" name="installmetn_'+i+'" value="'+date.toISOString().split('T')[0]+'">'+
                    '</td>'+
                    '<td>'+
                    perInstallmentAmount +
                        '<input type="hidden" name="amount_'+i+'" value="'+perInstallmentAmount+'">'+
                    '</td>'+
                    '<td>'+
                        i+' Installment'+
                    '</td>'+
                '</tr>';
        }
        $('#schedule_payment_body').html(html);

    }
    else
    {
        $('#no_of_installmentE').html('Please enter no of installment');
    }
}

function cleareSchedulePayment()
{
    $('#schedule_payment_body').html('');
}

function productDitailsShow(id)
{
    $("#productShow_"+id).hide();
    $('#productHide_'+id).show();
    $('.child_row_'+id).show();
}
function productDitailsHide(id)
{
    $('#productShow_'+id).show();
    $('#productHide_'+id).hide();
    $('.child_row_'+id).hide();
}
// $('.table').DataTable( {
//     responsive: true,
// } );
