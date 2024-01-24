$( document ).ready(function(){

//select button day one events from events page
    $("#btnFirst").click(function() {
        $('#eventsFirst').fadeIn();
        $('#eventsSecond').fadeOut();
        $('#eventsThird').fadeOut();
        $('#eventsOther').fadeOut();
    });
    //select button day two events from events page
    $("#btnSecond").click(function() {
        $('#eventsFirst').fadeOut();
        $('#eventsSecond').fadeIn();
        $('#eventsThird').fadeOut();
        $('#eventsOther').fadeOut();
    });
    //select button day three events from events page
    $("#btnLast").click(function() {
        $('#eventsFirst').fadeOut();
        $('#eventsSecond').fadeOut();
        $('#eventsThird').fadeIn();
        $('#eventsOther').fadeOut();
    });
    //select button other events from events page
    $("#btnOther").click(function() {
        $('#eventsFirst').fadeOut();
        $('#eventsSecond').fadeOut();
        $('#eventsThird').fadeOut();
        $('#eventsOther').fadeIn();
    });
    //reset button so all events display on events page
    $("#btnAll").click(function() {
        $('#eventsFirst').fadeIn();
        $('#eventsSecond').fadeIn();
        $('#eventsThird').fadeIn();
        $('#eventsOther').fadeIn();
    });

});
