$(document).ready(function() {
    updatefacAppts(); //document ready function

    function updatefacAppts() {
      $('#records_table').html('');
        $.getJSON("myFacApptFormView.php", function(data) {

            $.each(data, function(i, item) {
                $('<tr id=item_' + item.id + '>').append(
                    $('<td>').text(item.id),
                    $('<td>').text(item.facLname),
                    $('<td>').text(item.facFname),
                    $('<td>').text(item.uniqname),
                    $('<td>').text(item.roomLoc),
                    $('<td>').text(item.appDate),
                    $('<td>').text(item.startTime),
                    $('<td class="text-warning">').text(item.stuFname),
                    $('<td class="text-warning">').text(item.stuLname),
                    $('<td class="text-warning">').text(item.studentName)).appendTo('#records_table');
            });
        });
    }

      //To obtain available appointment times specific to a selected faculty from the tbl_facAppts table, a SQL query is triggered upon
  //  name selection
    $('#facApptName').change ( function() {
        $('#apptTimes').empty();
        // assign the value to a variable, so you can test to see if it is working
        var selectVal = $(this).find('option:selected').attr('value');
        $.getJSON("myFacIndApptView.php?name=" + selectVal, function(data) {
            $.each(data, function(key, value) {
                $('<tr>').append(
                    $('<td>').html('<button type="button" id="button_' + value.apptid + '" class="timePick btn btn-success btn-sm" value="' + value.apptid + '" data-toggle="modal" data-target="#apptModal">' + value.appTime + " in " + value.location + " [" + value.studentName + ']</button>')).appendTo('#apptTimes');
            });
        });
    });


    $("body").on("click", ".timePick", function(e) {
    e.preventDefault();
    var clickedItem = $(this).attr("value");
    var data = 'recordToUpdate=' + clickedItem;
    $('.modal-title').text('Editing Appointment #' + clickedItem);
        $.getJSON("myFacIndApptModalView.php", data, function(response){
            console.log(response);
                     $.each(response, function(key, item) {
                         //$('#facUniq').val(item.facUniq);
                         $('#apptID').val(item.id);
                         $('#stuName').val(item.stuName);
                         $('#facName').val(item.facFname + " " + item.facLname);

                        //These are values that cannot be changed in the modal
                         $('#location').html(": " + item.location);
                         $('#stuName').html(": " + item.stuName);
                         $('#facName').html(": " + item.facFname + " " + item.facLname + "<small> (" + item.facUniq + ")</small>");
                         $('#apptDate').html(": " + item.date);
                         $('#start').html(": " + item.startTime);
                 });
        });
    });


    $("body").on("click", ".btn-delAppt", function(e) {
        e.preventDefault();
        var thisAppt = $('#apptID').val();
        var myData = 'apptToDelete=' + $('#apptID').val();
        //var sendmailData = 'recipient=' + $('#stuName').val() + '&faculty=' + $('#facName').val();
        if ($('#stuName').val().length > 1){
          //$.post("sendmail.php", sendmailData).done( function (responsedata){
          //  console.log(responsedata);
          //});
          alert ('You need to send an email to ' + $('#stuName').val() + ' letting them know this appointment was cancelled');
        }
        $.post("myApptDelete.php", myData).done( function(deldata){
            console.log(deldata);
            $("#button_" + thisAppt).remove();
            $('#item_' + thisAppt).fadeOut("slow");
        $('#apptModal').modal('hide');
        });
    });

    //Checks all boxes for specified day
    $('#allDay1').click(function(e){
      e.preventDefault();
      $( ".cbDay1" ).prop( "checked", function( i, val ) {
        return !val;
      });
    });

    //Faculty Appt management
    //Valdiation check for room location being set then sends serialized form data to update operations.
    //confirms successful update via alert (requested) and by displaying them in the currAppts DIV.
    // After successful submission the checkboxes are cleared so users can input more locations and times
    //  as needed
     $("#apptSub").click( function(){
      //alert ($('#facApptName').val() + " -1- " + $('roomLoc').val());
        if ( $("#facApptName").val() != 'blank' && ($('#roomLoc').val() != '' && $('#roomLoc').val() != 'undefined')) {
            $('#facNameSelected').val( $("#facApptName").val() );
            var updateResult = $.post( "myFacNewAppt.php", $("#facNewApptForm :input").serialize() );
              updateResult.done( function( data ){
                console.log( data );
                $("#facApptName").val("blank");

                updatefacAppts();

            alert('Your selected times have been saved');
            });

       $("input:checkbox").removeAttr('checked');
       } else {
        var errMessage = "";
        if ( $("#facApptName").val() == 'blank'){
         errMessage +=  "\n - need a faculty name";
         }
         if ( $("#roomLoc").val() == '' || $("#roomLoc").val() == 'undefined'){
         errMessage +=  "\n - need a room location"
         }
         alert ("!! Please fix the following:" + errMessage );
       }
    });


});
