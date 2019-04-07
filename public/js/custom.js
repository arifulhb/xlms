$(document).ready(function(){
    console.log('document');


    // get csrf token in header
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
     });

    $('.btn-delete-user').click(function() {

        var data = {
            id : $(this).attr('data-id'),
            name: $(this).attr('data-name')
        } ;


        $('#row_'+data.id).addClass('bg-warning');

        $('#user_delete_modal .btn-danger').attr('data-id', data.id);
        $('#user_delete_modal .modal-body').html("Are you sure to delete <strong class='text-danger'>"+data.name+"</strong>?");

    });


    $('#user_delete_modal .btn-danger').click(function(){

        $(this).attr('disabled', 'disabled');
        var id = $(this).attr('data-id');
        $('#row_'+id).addClass('bg-danger');

        $.ajax({
            url: '/admin/users/'+id,
            type: 'post',
            data: {
                "_method": 'DELETE',
            },
        }).done(function(response, textStatus, xhr){

            if (xhr.status === 204){
                $('#user_delete_modal').modal('hide');
                setTimeout(function(){
                    $('#row_'+id).remove();
                }, 1000);
            }

            $('#user_delete_modal .btn-danger').removeAttr('disabled');

        }).fail(function(xhr, textStatus, errorThrown){

            $('#row_'+id).removeClass('bg-warning');
            $('#user_delete_modal .btn-danger').removeProp('disabled');

        }).always(function(){

            $('#user_delete_modal .btn-danger').removeAttr('disabled');

        });


    });



});
