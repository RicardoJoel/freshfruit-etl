$(function() {
    $('body').loadingModal({
        text:'Un momento, por favor...',
        animation:'wanderingCubes'
    });
    $.ajax({
        type: 'get',
        url: 'activities.projects',
        data: {'customer_id':$('#customer_id').val()},
        success: (data) => {
            $('#project_id').empty();
            $('#project_id').append('<option selected value="">Todos los proyectos</option>');
            $(JSON.parse(data)).each(function() {
                var option = $(document.createElement('option'));
                option.val(this.id);
                option.text(this.name);
                $('#project_id').append(option);
            });
            var aux = $('#aux-project_id').val();
            if (aux !== '') $('#project_id option[value=' + aux + ']').attr('selected', true);
            $('body').loadingModal('destroy');
        },
        error: (msg) => {
            alert(msg.responseJSON['message']);
            $('body').loadingModal('destroy');
        }
    });

    $('body').loadingModal({
        text:'Un momento, por favor...',
        animation:'wanderingCubes'
    });
    $.ajax({
        type: 'get',
        url: 'activities.status',
        data: {'customer_id':$('#customer_id').val(),'project_id':$('#aux-project_id').val()},
        success: (data) => {
            $('#status').empty();
            $('#status').append('<option selected value="">Todos los estados</option>');
            $(JSON.parse(data)).each(function() {
                var option = $(document.createElement('option'));
                option.val(this.id);
                option.text(this.name);
                $('#status').append(option);
            });
            var aux = $('#aux-status').val();
            if (aux !== '') $('#status option[value=' + aux + ']').attr('selected', true);
            $('body').loadingModal('destroy');
        },
        error: (msg) => {
            alert(msg.responseJSON['message']);
            $('body').loadingModal('destroy');
        }
    });

    $('body').loadingModal({
        text:'Un momento, por favor...',
        animation:'wanderingCubes'
    });
    $.ajax({
        type: 'get',
        url: 'activities.users',
        data: {'customer_id':$('#customer_id').val(),'project_id':$('#aux-project_id').val(),'status':$('#aux-status').val()},
        success: (data) => {
            $('#user_id').empty();
            $('#user_id').append('<option selected value="">Todos los colaboradores</option>');
            $(JSON.parse(data)).each(function() {
                var option = $(document.createElement('option'));
                option.val(this.id);
                option.text(this.name);
                $('#user_id').append(option);
            });
            var aux = $('#aux-user_id').val();
            if (aux !== '') $('#user_id option[value=' + aux + ']').attr('selected', true);
            $('body').loadingModal('destroy');
        },
        error: (msg) => {
            alert(msg.responseJSON['message']);
            $('body').loadingModal('destroy');
        }
    });

    $('#customer_id').change(function() {
        $('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });
        $.ajax({
            type: 'get',
            url: 'activities.projects',
            data: {'customer_id':$('#customer_id').val()},
            success: (data) => {
                $('#project_id').empty();
                $('#project_id').append('<option selected value="">Todos los proyectos</option>');
                $(JSON.parse(data)).each(function() {
                    var option = $(document.createElement('option'));
                    option.val(this.id);
                    option.text(this.name);
                    $('#project_id').append(option);
                });
                $('body').loadingModal('destroy');
            },
            error: (msg) => {
                alert(msg.responseJSON['message']);
                $('body').loadingModal('destroy');
            }
        });

        $('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });
        $.ajax({
            type: 'get',
            url: 'activities.status',
            data: {'customer_id':$('#customer_id').val()},
            success: (data) => {
                $('#status').empty();
                $('#status').append('<option selected value="">Todos los estados</option>');
                $(JSON.parse(data)).each(function() {
                    var option = $(document.createElement('option'));
                    option.val(this.id);
                    option.text(this.name);
                    $('#status').append(option);
                });
                $('body').loadingModal('destroy');
            },
            error: (msg) => {
                alert(msg.responseJSON['message']);
                $('body').loadingModal('destroy');
            }
        });

        $('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });
        $.ajax({
            type: 'get',
            url: 'activities.users',
            data: {'customer_id':$('#customer_id').val()},
            success: (data) => {
                $('#user_id').empty();
                $('#user_id').append('<option selected value="">Todos los colaboradores</option>');
                $(JSON.parse(data)).each(function() {
                    var option = $(document.createElement('option'));
                    option.val(this.id);
                    option.text(this.name);
                    $('#user_id').append(option);
                });
                $('body').loadingModal('destroy');
            },
            error: (msg) => {
                alert(msg.responseJSON['message']);
                $('body').loadingModal('destroy');
            }
        });
    });

    $('#project_id').change(function() {
        $('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });
        $.ajax({
            type: 'get',
            url: 'activities.status',
            data: {'customer_id':$('#customer_id').val(),'project_id':$('#project_id').val()},
            success: (data) => {
                $('#status').empty();
                $('#status').append('<option selected value="">Todos los estados</option>');
                $(JSON.parse(data)).each(function() {
                    var option = $(document.createElement('option'));
                    option.val(this.id);
                    option.text(this.name);
                    $('#status').append(option);
                });
                $('body').loadingModal('destroy');
            },
            error: (msg) => {
                alert(msg.responseJSON['message']);
                $('body').loadingModal('destroy');
            }
        });

        $('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });
        $.ajax({
            type: 'get',
            url: 'activities.users',
            data: {'customer_id':$('#customer_id').val(),'project_id':$('#project_id').val()},
            success: (data) => {
                $('#user_id').empty();
                $('#user_id').append('<option selected value="">Todos los colaboradores</option>');
                $(JSON.parse(data)).each(function() {
                    var option = $(document.createElement('option'));
                    option.val(this.id);
                    option.text(this.name);
                    $('#user_id').append(option);
                });
                $('body').loadingModal('destroy');
            },
            error: (msg) => {
                alert(msg.responseJSON['message']);
                $('body').loadingModal('destroy');
            }
        });
    });

    $('#status').change(function() {
        $('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });
        $.ajax({
            type: 'get',
            url: 'activities.users',
            data: {'customer_id':$('#customer_id').val(),'project_id':$('#project_id').val(),'status':$('#status').val()},
            success: (data) => {
                $('#user_id').empty();
                $('#user_id').append('<option selected value="">Todos los colaboradores</option>');
                $(JSON.parse(data)).each(function() {
                    var option = $(document.createElement('option'));
                    option.val(this.id);
                    option.text(this.name);
                    $('#user_id').append(option);
                });
                $('body').loadingModal('destroy');
            },
            error: (msg) => {
                alert(msg.responseJSON['message']);
                $('body').loadingModal('destroy');
            }
        });
    });
});