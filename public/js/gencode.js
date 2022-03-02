$('#project_type_id').change(function() {
    setProjectCode();
});

$('#happen_at').change(function() {
    setProjectCode();
});

$('#has_proposal').change(function() {
    if ($(this).prop('checked'))
        setProjectCode();
    else
        $('#prop_code').val('');
});

function setProjectCode() {
    if ($('#has_proposal').prop('checked')) {
        var type = getTypeCode();
        var cust = getCustCode();
        var date = getDateCode();
        setNextCode(type + cust + date);
    }
}

function getTypeCode() {
    var val = $('#project_type_id :selected').val();
    if (!val) return '___';
    var txt = $('#project_type_id').children(':selected').text().trim();
    return txt.substr(txt.length - 4,3);
}

function getCustCode() {
    var val = $('#customer_name').val().trim();
    if (!val) return '___';
    return val.substr(val.length - 4,3);
}

function getDateCode() {
    var val = $('#happen_at').val();
    if (!val) return '______';
    return moment(val).format('DDMMYY');
}

function setNextCode(code) {
    if ($('#aux_code').val() && $('#aux_code').val().substr(0,12) === code) {
        $('#prop_code').val($('#aux_code').val());
    }
    else {
        var pre = $('#_method').val() ? '../' : '';
        $.ajax({
            type: 'get',
            url: pre + '../getNextCode/' + code,
            success: function(data) {
                $('#prop_code').val(code + data);
            },
            error: function(msg) {
                $('#fail-msg').text(JSON.stringify(msg));
                $('#fail-div').css('display', 'block');
            }
        });
    }
}