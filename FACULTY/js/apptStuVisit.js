$( document ).ready(function(){
  updateApptsView();

//Check all boxes for specified day
$('#allDay1').click(function(e){
  e.preventDefault();
  $( ".cbDay1" ).prop( "checked", function( i, val ) {
    return !val;
  });
});

//Check all boxes for specified day
$('#allDay2').click(function(e){
  e.preventDefault();
  $( ".cbDay2" ).prop( "checked", function( i, val ) {
    return !val;
  });
});

//Faculty Appt management
//Valdiation check for room location being set then sends serialized form data to update operations. 
//confirms successful update via alert (requested) and by displaying them in the currAppts DIV. 
// After successful submission the checkboxes are cleared so users can input more locations and times
//  as needed
 $("#apptSub").click( function(){
    if ( !$("#roomLoc").val() ){
//  if ( $("#roomLoc").val().length == 0 ){
          alert ("!! You did not enter a Room Location !!");
    } else {
      $.post( "updateFacAppt.php", $("#facApptForm :input").serialize() );
      setTimeout(function() {
      // Do something after .5 seconds
        updateApptsView();
      }, 500);
      alert('Your selected times have been saved');
      window.scrollTo(0,100);
     }
   $("#facApptForm :input").each( function() {
    $(this).val('');
    });
   $("input:checkbox").removeAttr('checked');

});

$("#facApptForm").submit( function() {
    return false;
    });

});

//Refreshes the Div currAppts with current tbl_facAppts data
function updateApptsView(){
  $.getJSON("facApptFormView.php", function(data){
      $("#currAppts").empty();
      $.each(data.result, function(){ 
        $("#currAppts").append('<div class="record" id="record-' + this.id + '"><strong>' + ' ' + this.appDate + '</strong> ' + this.startTime + ' in ' + this.roomLoc + ' - ' + this.student + ' </div>');     

          });
  });
}




