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
