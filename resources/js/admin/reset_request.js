$('#reset_request_form').on("submit",function(e){
    e.preventDefault();

    $('#reset_request_search').addClass('disabled');
    $('#reset_request_search').html('Getting Information ......');

    $.ajax({
        type : 'POST',
        url : 'reset-requests-data',
        dataType : "json",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data : $('#reset_request_form').serialize(),
        success : function (data){
            
            document.getElementById('reset_request_results_div').style.display='block';
            $('#reset_request_search').removeClass('disabled');
            $('#reset_request_search').html('Search');
            $('#reset_request_results').empty();
            $('#table_data').empty();
            $('#reset_request_results').append('<h4 class="card-title text-center">Reset Request Search Result</h4><table id="datatable-reset-request" class="table table-striped dt-responsive nowrap table-bordered"><thead class="bg-primary text-white"><tr><th>ID</th><th>Name</th><th>Email</th><th>Approved By</th><th>Request Time</th><th>Approved Time</th><th>Action</th><th>User details</th></tr></thead><tbody id="table_data">');
            
            $.each(data,function(key,value){
                let rtime = new Date(value.created_at);
                let rmonth = rtime.getMonth()+1;
                if(rmonth<10){
                    rmonth = '0'+rmonth
                }
                let rday= rtime.getDate();
                if(rday<10){
                    rday = '0'+rday
                }
                let request_date =rmonth +'/'+rday+'/'+rtime.getFullYear();
                let atime = new Date(value.updated_at);
                let amonth = atime.getMonth()+1;
                if(amonth<10){
                    amonth = '0'+amonth
                }
                let aday= atime.getDate();
                if(aday<10){
                    aday = '0'+aday
                }
                let approved_date =amonth +'/'+aday+'/'+atime.getFullYear();
                let rst_btn = '';
                if(value.reset_status=='No'){
                    rst_btn = '<button type="button"  data-id="'+value.reset_id+'" class="btn btn-sm btn-info approve">Approve</button>';
                }else{
                    rst_btn = '<button class="btn btn-success">Approved &nbsp;&nbsp; <i class="fas fa-check"></i></button>';
                }
                $('#table_data').append('<tr><td>'+value.reset_id+'</td><td>'+value.name+'</td><td>'+value.email+'</td><td>'+value.reset_approved_by+'</td><td>'+request_date+'</td><td>'+approved_date+'</td><td>'+rst_btn+'</td><td><strong> Phone : </strong>'+value.phone+'<br><strong> Status : </strong>'+value.status+'</td></tr>');
            })

            $('#reset_request_results').append('</tbody></table>');

            $('#datatable-reset-request').DataTable({
                fnCreatedRow : function(nRow, aData, iDataIndex) {
                    $(nRow).attr('id', aData[0]);
                  },
                dom: 'Blfrtip',
                lengthChange: true,
                destroy: true, 
                buttons: ['copy', 'print', 'pdf'],
                "language": {
                    "paginate": {
                        "previous": "<i class='mdi mdi-chevron-left'>",
                        "next": "<i class='mdi mdi-chevron-right'>"
                    }
                },
                "drawCallback": function () {
                    $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
                }
            });
        },
        error : function(err){
            console.log(err);
        }
    })

});

$(document).on("click",".approve",function(){
    var id = $(this).data('id');
    $(this).attr('id','td-'+id);
    var tdid = 'td-'+id;
    document.getElementById(tdid).classList.add("disabled");
    document.getElementById(tdid).innerHTML='Approving &nbsp; &nbsp; <i class="fas fa-spinner fa-pulse"></i>';
    var trid = $(this).closest('tr').attr('id');
    $.ajax({
        type : 'get',
        url : 'reset-requests-data-update/'+id,
        dataType : "json",
        success : function(data){
            document.getElementById(tdid).innerHTML='Approve';
            var value = data.reset_requests;
            var table = $('#datatable-reset-request').DataTable();
            let rtime = new Date(value.created_at);
            let rmonth = rtime.getMonth()+1;
            if(rmonth<10){
                rmonth = '0'+rmonth
            }
            let rday= rtime.getDate();
            if(rday<10){
                rday = '0'+rday
            }
            let request_date =rmonth +'/'+rday+'/'+rtime.getFullYear();
            let atime = new Date(value.updated_at);
            let amonth = atime.getMonth()+1;
            if(amonth<10){
                amonth = '0'+amonth
            }
            let aday= atime.getDate();
            if(aday<10){
                aday = '0'+aday
            }
            let approved_date =amonth +'/'+aday+'/'+atime.getFullYear();
            var button = '<td><button class="btn btn-success">Approved &nbsp;&nbsp; <i class="fas fa-check"></i></button></td>';
            var details = '<td><strong> Phone : </strong>'+value.phone+'<br><strong> Status : </strong>'+value.status+'</td>';
            var row = table.row("[id='" + trid + "']");
            row.row("[id='" + trid + "']").data([value.reset_id,value.name, value.email, value.reset_approved_by, request_date, approved_date, button ,details]);
            Swal.fire({
                position: 'top-mid',
                type: 'success',
                title: 'Request Approved Successfully . A reset password mail send to '+value.email,
                showConfirmButton: false,
                timer: 1500
            })
        },
        error : function(){

        }
    })
});

