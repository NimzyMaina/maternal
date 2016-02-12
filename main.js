/**
 * Created by nimzy on 2/8/2016.
 */

$(document).on('click', '.delete-object', function(){

    var id = $(this).attr('delete-id');
    var del = $(this).attr('delete-type');

    swal({
            title: 'Are you Sure?',
            text: 'You will not be able to recover this Item!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel please!',
            confirmButtonClass: 'confirm-class',
            cancelButtonClass: 'cancel-class',
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm){
            if(isConfirm) {
                //ajax
                $.post(ajax_url, {
                    object_id: id,
                    type : del
                }, function(data){
                    swal('Deleted!',
                        'Your Item has been Deleted.',
                        'success');
                    location.reload();
                }).fail(function() {
                    swal('Unable to delete.');
                });
            }else{
                swal(
                    'Cancelled',
                    'Your Item Is Safe :)',
                    'error'
                );
            }

        });

    return false;
});

$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'pdf', 'print'
        ]
    } );
} );

$(document).on('click', '.toog', function(){
    var id = $(this).attr('data-id');
    var status = $(this).attr('data-status');
    var type = $(this).attr('data-type');

    $.post(ajax_url, {
        object_id: id,
        type : type,
        status : status
    }, function(data){
        swal('Changed!',
            'The Item Status has been changed.',
            'success');
        location.reload();
    }).fail(function() {
        swal('Unable to Change.');
    });
    return false;
});

//edit on user datatable

$(function(){
    //acknowledgement message
    var message_status = $("#status");
    $("#example1 td[contenteditable=true]").blur(function(){
        var field_userid = $(this).attr("id") ;
        var value = $(this).text() ;
        $.post( update_user ,field_userid + "=" + encodeURIComponent(value),function(data){
            if(data != '')
            {
                swal({   title: 'Success!',   text: data,   timer: 10000 });
            }
        });
    });
});


 $(document).ready(function() {
        $('#registerForm').formValidation({
            message: 'This value is not valid',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                first_name: {
                    validators: {
                        notEmpty: {
                            message: 'The First Name is required'
                        }
                    }
                },
                last_name: {
                    validators: {
                        notEmpty: {
                            message: 'The Last Name is required'
                        }
                    }
                },
                phone: {
                    validators: {
                        notEmpty: {
                            message: 'The Phone is required'
                        }
                    }
                },
                email: {
                    threshold: 5,
                    validators: {
                        notEmpty: {
                            message: 'The email address is required'
                        },
                        emailAddress: {
                            message: 'The input is not a valid email address'
                        },
                        remote: {
                            message: 'The email is in use',
                            url: ajax_url,
                            data: {
                                type: 'email'
                            },
                            type: 'POST',
                            delay: 4000
                        }
                    }
                }
            }
        });
    });