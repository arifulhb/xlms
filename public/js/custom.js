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


    /**
     * From User browser page
     * admin can do it
     */
    $('.btn-reset-password').click(function(){

        var email = $(this).attr('data-email');

        console.log('reset for ', email);

        $.ajax({
            url: '/admin-reset-password',
            type: 'post',
            data: {
                "email": email,
            },
        }).done(function(response, textStatus, xhr){

            if (xhr.status === 200){
                $.toast({
                    heading: 'Success',
                    text: 'Password Reset Mail Sent',
                    position: 'top-right',
                    icon: 'success',
                    showHideTransition: 'slide',
                    loader: true,        // Change it to false to disable loader
                    loaderBg: '#383b3d'  // To change the background
                });
            }

        }).fail(function(xhr, textStatus, errorThrown){

            $.toast({
                heading: 'Error',
                text:  errorThrown,
                icon: 'error',
                loader: true,        // Change it to false to disable loader
                loaderBg: '#9EC600'  // To change the background
            });
        });

    });



    $('.btn-delete-dept').click(function() {

        var data = {
            id : $(this).attr('data-id'),
            name: $(this).attr('data-name')
        } ;

        console.log('data ', data);

        $('#row_'+data.id).addClass('bg-warning');

        $('#dept_delete_modal .btn-danger').attr('data-id', data.id);
        $('#dept_delete_modal .modal-body').html("Are you sure to delete <strong class='text-danger'>"+data.name+"</strong>?");

    });

    /**
     * Department Delete
     */
    $('#dept_delete_modal .btn-danger').click(function(){

        $(this).attr('disabled', 'disabled');
        var id = $(this).attr('data-id');
        $('#row_'+id).addClass('bg-danger');

        $.ajax({
            url: '/admin/departments/'+id,
            type: 'post',
            data: {
                "_method": 'DELETE',
            },
        }).done(function(response, textStatus, xhr){

            if (xhr.status === 204){
                $('#dept_delete_modal').modal('hide');
                setTimeout(function(){
                    $('#row_'+id).remove();
                }, 1000);
            }
            $('#dept_delete_modal .btn-danger').removeAttr('disabled');

        }).fail(function(xhr, textStatus, errorThrown){
            $('#row_'+id).removeClass('bg-warning');
            $('#dept_delete_modal .btn-danger').removeProp('disabled');
        }).always(function(){
            $('#dept_delete_modal .btn-danger').removeAttr('disabled');
        });


    });


    /**
     * Job Role Delete Menu button
     */
    $('.btn-delete-job-role').click(function() {

        var data = {
            id : $(this).attr('data-id'),
            name: $(this).attr('data-name')
        } ;
        console.log('data ', data);

        $('#row_'+data.id).addClass('bg-warning');
        $('#jobroles_delete_modal .btn-danger').attr('data-id', data.id);
        $('#jobroles_delete_modal .modal-body').html("Are you sure to delete <strong class='text-danger'>"+data.name+"</strong>?");

    });

    /**
     * Department Delete
     */
    $('#jobroles_delete_modal .btn-danger').click(function(){

        $(this).attr('disabled', 'disabled');
        var id = $(this).attr('data-id');
        $('#row_'+id).addClass('bg-danger');

        $.ajax({
            url: '/admin/job-roles/'+id,
            type: 'post',
            data: {
                "_method": 'DELETE',
            },
        }).done(function(response, textStatus, xhr){

            if (xhr.status === 204){
                $('#jobroles_delete_modal').modal('hide');
                setTimeout(function(){
                    $('#row_'+id).remove();
                }, 1000);
            }
            $('#jobroles_delete_modal .btn-danger').removeAttr('disabled');

        }).fail(function(xhr, textStatus, errorThrown){
            $('#row_'+id).removeClass('bg-warning');
            $('#jobroles_delete_modal .btn-danger').removeProp('disabled');
        }).always(function(){
            $('#jobroles_delete_modal .btn-danger').removeAttr('disabled');
        });


    });

    $('.modal').on('hidden.bs.modal', function () {
        $('tr').removeClass('bg-warning');
    });


    /**
     * Change the department and role for teacher
     */

     $('#role').change(function(){

        var user_role = $('#role option:selected').val();

        console.log('role ', user_role);

        if (user_role === 'Admin' || user_role=== 'Trainee'){
            $('.js-admin,  .js-student').removeClass('d-none');
            $('.js-instructor').addClass('d-none');
        } else if (user_role === 'Instructor'){
            $('.js-admin,  .js-student').addClass('d-none');
            $('.js-instructor').removeClass('d-none');
        }


     });



});
