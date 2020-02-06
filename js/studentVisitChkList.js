$( document ).ready( function() {

  //added to allow for chklist views to update
  updateStuVisChklst();
  updateStuVisAppts();

   //used for updatting checklist values both upon entry to checklist page as well as upon clicking the update button
   function updateStuVisChklst(){
      $.getJSON("stuVisChklstView.php", function( data ) {
        $.each(data, function(){
          $.each(this, function (key, value){
            // since checked checklist values will reresent at '1' the biography field needs to be
            //  handled seperately if there is data entered.
          if (key == 'studentBio' && value !== null ){
            //populate studentBio
            $('#studentBio').text(value);
          } else if (key == 'dietrestriction' && value !== null ){
            //populate diet restriction
            $('#dietrestriction').text(value);
          } else if (key == 'accessibility' && value !== null ){
            //populate diet restriction
            $('#accessibility').text(value);
          } else if (key == 'shirt' && value !== null ){
            //populate diet restriction
            $('#shirt').text(value);
          } else {
            if (value == '1'){
                $("#" + key).prop('checked', true);
            }
          }
        });
      });
    });
    $("#stuChkLstMessage").text("Your checklist is up to date!");
  }

  $(".chkLstChkBox" ).click( function() {
    $("#stuChkLstMessage").text("You need to save your changes");
  });

  $(".chkLstTxtBox" ).change( function() {
    $("#stuChkLstMessage").text("You need to save your changes");
  });


 //Update changes to the checklist and call update function to reload checklist data
 // added alert per request to give additional visual conformation

	  $('#btnCheckListSubmit').click( function(e) {
	  e.preventDefault();
	    $.post("stuVisUpdChklst.php", $('#chklst').serialize() ).done(function( data ) {
	    console.log( "Data Loaded: " + data );
	  });
          //Form.serialize('myform', true);
     var t1 = setTimeout(updateStuVisChklst, 500);
  });


  // allows for ajax update of selected faculty appointments using the ID of the specific appointment. An appointment is
  //  considered 'taken' when a students email address populates the studentname field of the tbl_facAppts table
  $('#apptTimes').on('click', '.timePick', function() {
    //the post URL path is relative to the calling page URL
        $.post('stuVisFacApptUpd.php', {
            'recNum': $(this).attr('value')
        });
        var t1 = setTimeout(updateStuVisAppts, 500);
        return false;
    });

  $('#listAppts').on('click', '.timeDel', function() {
    //the post URL path is relative to the calling page URL
        $.post('stuVisFacApptDel.php', {
            'recNum': $(this).attr('value')
        });
        var t1 = setTimeout(updateStuVisAppts, 500);
        return false;
    });

  //To obtain available appointment times specific to a selected faculty from the tbl_facAppts table, a SQL query is triggered upon
  //  name selection
      $('#facApptName').change ( function() {
        $('#apptTimes').empty();
        // assign the value to a variable, so you can test to see if it is working
        var selectVal = $(this).find('option:selected').attr('value');
        $.getJSON("stuVisFacApptView.php?name=" + selectVal, function(data) {
            $.each(data, function(key, value) {
                $('<tr>').append(
                    $('<td>').html('<button type="button" class="timePick btn btn-success btn-sm " value="' + value.apptid + '">' + value.appTime + '</button>')).appendTo('#apptTimes');
            });
        });
    });

  //Clear the div ID setAppts content and repopulate with fresh query list of appts
    function updateStuVisAppts() {
        $("#setAppts").empty();
        $.post("stuVisApptView.php", function(data) {
            $.each(data, function(key, value) {
                $("#setAppts").append('<strong>' + value.facFname + " " + value.facLname + ' (' + value.facUniq + ')</strong> at <strong>' + value.appTime + '</strong> in <strong>' + value.roomLoc + '</strong> <button class="btn btn-sm timeDel" value="' + value.apptid + '"><i style="color:Tomato;" class="fas fa-trash fa-sm"></i></button><br><br>');
            });
        }, 'json');
        $("#facApptName option[value='blank']").prop('selected', true);
        $("#apptTimes").empty();
    }

});
