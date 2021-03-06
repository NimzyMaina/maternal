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

$('.datepicker').datepicker({
    format: 'mm/dd/yyyy'
})


$(document).ready(function() {

    var zone = "03:00";  //Change this to your timezone

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

    function isElemOverDiv() {
        var trashEl = jQuery('#trash');
        var ofs = trashEl.offset();
        var x1 = ofs.left;
        var x2 = ofs.left + trashEl.outerWidth(true);
        var y1 = ofs.top;
        var y2 = ofs.top + trashEl.outerHeight(true);
        if (currentMousePos.x >= x1 && currentMousePos.x <= x2 &&currentMousePos.y >= y1 && currentMousePos.y <= y2) {
            return true;
        }
        return false;
    }

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
                html: users,
                //type: 'input',
                showCancelButton: true,
                closeOnConfirm: false
            },
                function(inputValue) {
                   var userid = $('#input-field').val();
                    var date = $('#date').val();
                    var time = $('#time').val();
                    var tit = $('#input-field option:selected').text();
                    event.user_id = userid;
                    event.title = tit;
                    var temp = date+' '+time+':00';//new Date(date+'T'+time+':00+'+zone);
                    //event.start = temp;

                   // var start = event.start.format("YYYY-MM-DD[T]HH:MM:SS",date);
                    //alert(temp);
                    $.ajax({
                        url: 'ajax.php',
                        data: 'type=changetitle&title='+tit+'&user_id='+userid+'&startdate='+temp+'&eventid='+event.id,
                        type: 'POST',
                        dataType: 'json',
                        success: function(response){
                            if(response.status == 'success')
                                $('#calendar').fullCalendar('updateEvent',event);
                        },
                        error: function(e){
                            //alert('Error processing your request: '+e.responseText);
                        }
                    });
                    swal('Appointment Has Been Edited');
                });
        },eventDrop: function(event, delta, revertFunc) {
            var title = event.title;
            var id = event.id;
            var user = event.user_id;
            var start = event.start.format();
            var end = (event.end == null) ? start : event.end.format();
            $.ajax({
                url: 'ajax.php',
                data: 'type=resetdate&title='+title+'&start='+start+'&end='+end+'&eventid='+id+'&user_id='+user,
                type: 'POST',
                dataType: 'json',
                success: function(response){
                    if(response.status != 'success')
                        revertFunc();
                },
                error: function(e){
                    revertFunc();
                   // alert('Error processing your request: '+e.responseText);
                }
            });
        },eventDragStop: function (event, jsEvent, ui, view) {
            if (isElemOverDiv()) {
                var con = confirm('Are you sure to delete this event permanently?');
                if(con == true) {
                    $.ajax({
                        url: 'ajax.php',
                        data: 'type=remove&eventid='+event.id+'&user_id='+event.user_id,
                        type: 'POST',
                        dataType: 'json',
                        success: function(response){
                            if(response.status == 'success')
                                $('#calendar').fullCalendar('removeEvents');
                            $('#calendar').fullCalendar('addEventSource', JSON.parse(json_events));
                        },
                        error: function(e){
                            alert('Error processing your request: '+e.responseText);
                        }
                    });
                }
            }
        }
    });
});

