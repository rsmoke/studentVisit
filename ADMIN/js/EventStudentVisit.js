$(document).ready(function() {
    updateEvents(); //document ready function

    function updateEvents() {
        $('#records_table_body').html('');
        $.getJSON("myEventFormView.php", function(data) {

            $.each(data, function(i, item) {
                $('<tr id=item_' + item.id + '>').append(
                    $('<td>').text(item.id),
                    $('<td>').text(item.date),
                    $('<td>').text(item.startTime),
                    $('<td>').text(item.endTime),
                    $('<td>').text(item.location),
                    $('<td>').text(item.name),
                    $('<td>').text(item.description),
                    $('<td>').text(item.notes),
                    $('<td>').html('<button value="' + item.id + '" class="btn-edit btn btn-sm btn-info" data-toggle="modal" data-target=".updateRecModal"><i class="far fa-edit fa-sm"></i></button>&nbsp;<button value="' + item.id + '" class="btn-del btn btn-sm btn-warning"><i style="color:Tomato;" class="fas fa-trash fa-sm"></i></button>')).appendTo('#records_table_body');
            });
        });
    }

    $("body").on("click", ".btn-del", function(e) {
        e.preventDefault();
        var clickedItem = $(this).attr("value");
        var myData = 'recordToDelete=' + $(this).attr("value");
        $.post("myEventDelete.php", myData).done( function(deldata){
            console.log(deldata);
            $('#item_' + clickedItem).fadeOut("slow");
        });
    });

    $("body").on("click", ".btn-edit", function(e) {
        e.preventDefault();
        var clickedItem = $(this).attr("value");
        var data = 'recordToUpdate=' + clickedItem;
        $('.modal-title').text('Editing Record #' + clickedItem);
            $.getJSON("myEventModalView.php", data, function(response){
                console.log(response);
                         $.each(response, function(key, item) {
                             $('#recID').val(item.id);
                             $('#datePick1').val(item.date);
                             $('#start').val(item.startTime);
                             $('#end').val(item.endTime);
                             $('#location').val(item.location);
                             $('#name').val(item.name);
                             $('#desc').val(item.description);
                             $('#notes').val(item.notes);
                     });
            });
    });


    //update record from content in modal. You need to convert date and time fomats
    //correctly for insertion in tot eh database.

    $('.btn-updRec').click(function(event) {
        event.preventDefault();
        var form = $('#updForm');
        if ( $('#recID').val() > 0 ) {
            $.post('myEventUpdate.php', form.serialize()).done( function(updatedata){
                console.log(updatedata);
        });
        }else if ($('#datePick1').val().length > 0  && $('#start').val().length > 0  && $('#end').val().length > 0 ) {
            $.post('myEventInsert.php', form.serialize()).done( function(insertdata){
            console.log(insertdata);
        });
        } else {
          alert("You need at least a Date, Start Time and End Time to create an event");
        }
        $('#myModal').modal('hide');
        updateEvents();
    });

   $('.newEvent').click(function(event) {
        event.preventDefault();
            $('#myModal').on('show.bs.modal', function (e) {
              $(this)
                .find("input,textarea,select")
                   .val('')
                   .end()
                .find("input[type=checkbox], input[type=radio]")
                   .prop("checked", "")
                   .end();
              $('.modal-title').text('New Event');
            });
        });

});
