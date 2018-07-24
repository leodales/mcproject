
$(document).ready(function() {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $('select#select_btn').change(function() {
    var sel_value = $('option:selected').val();
    if (sel_value == 0) {
    $("#form_submit").empty(); // Resetting Form
    $("#form1").css({
    'display': 'none'
    });
    } else {
    $("#form_submit").empty(); //Resetting Form
    // Below Function Creates Input Fields Dynamically
    create(sel_value);
    // Appending Submit Button To Form
    $("#form_submit").append($("<br/>"),$("<input/>",{
        type: 'hidden',
        name: 'titlenum',
        value: ''+sel_value
    }),$("<input/>", {
    type: 'submit',
    value: 'Search'
    }))
    }
    });
    function create(sel_value) {
    for (var i = 1; i <= sel_value; i++) {
    $("div#form1").slideDown('slow');
    $("div#form1").append($("#form_submit").append( $("<br/>"), $("<input/>", {
    type: 'text',
    placeholder: 'Title Serial' + i,
    name: 'title' + i
    }),  $("<br/>")))
    }
    }
    });


    
