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
//
//$('#calendar').fullCalendar();


$(document).ready(function() {

    var zone = "Africa/Nairobi";  //Change this to your timezone

    $.ajax({
        url: 'ajax.php',
        type: 'POST',
        data: 'type=fetch',
        async: false,
        success: function(response){
            json_events = response;
        }
    });

    var currentMousePos = {
        x: -1,
        y: -1
    };
    jQuery(document).on("mousemove", function (event) {
        currentMousePos.x = event.pageX;
        currentMousePos.y = event.pageY;
    });

    /* initialize the external events
     -----------------------------------------------------------------*/

    $('#external-events .fc-event').each(function() {

        // store data so the calendar knows to render an event upon drop
        $(this).data('event', {
            title: $.trim($(this).text()), // use the element's text as the event title
            stick: true // maintain when user navigates (see docs on the renderEvent method)
        });

        // make the event draggable using jQuery UI
        $(this).draggable({
            zIndex: 999,
            revert: true,      // will cause the event to go back to its
            revertDuration: 0  //  original position after the drag
        });

    });

    $('#calendar').fullCalendar({
        events: JSON.parse(json_events),
        utc: true,
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        editable: true,
        droppable: true,
        slotDuration: '00:30:00',
        eventReceive: function(event){
            var title = event.title;
            var start = event.start.format("YYYY-MM-DD[T]HH:MM:SS");
            $.ajax({
                url: 'ajax.php',
                data: 'type=new_appointment&title='+title+'&startdate='+start+'&zone='+zone,
                type: 'POST',
                dataType: 'json',
                success: function(response){
                    event.id = response.eventid;
                    $('#calendar').fullCalendar('updateEvent',event);
                },
                error: function(e){
                    console.log(e.responseText);
                }
            });
            $('#calendar').fullCalendar('updateEvent',event);
        },
        eventClick: function(event, jsEvent, view) {
            swal({   title: 'Edit Appointment',
                html: '<div class="form-group">' +
                '<label>Patient Name</label>' +
                '<input class="form-control" id="input-field" value="'+event.title+'">' +
                '</div>',
                showCancelButton: true,
                closeOnConfirm: false
            },
                function() {
                   var tit = $('#input-field').val();
                    event.title = tit;
                    //alert(tit);
                    $.ajax({
                        url: 'ajax.php',
                        data: 'type=changetitle&title='+tit+'&eventid='+event.id,
                        type: 'POST',
                        dataType: 'json',
                        success: function(response){
                            if(response.status == 'success')
                                $('#calendar').fullCalendar('updateEvent',event);
                        },
                        error: function(e){
                            alert('Error processing your request: '+e.responseText);
                        }
                    });
                    swal('Appointment Has Been Edited');
                });
            //var title = prompt('Event Title:', event.title, { buttons: { Ok: true, Cancel: false} });
            //if (title){
            //    event.title = title;
            //    $.ajax({
            //        url: 'ajax.php',
            //        data: 'type=changetitle&title='+title+'&eventid='+event.id,
            //        type: 'POST',
            //        dataType: 'json',
            //        success: function(response){
            //            if(response.status == 'success')
            //                $('#calendar').fullCalendar('updateEvent',event);
            //        },
            //        error: function(e){
            //            alert('Error processing your request: '+e.responseText);
            //        }
            //    });
            //}
        }
    });
});
