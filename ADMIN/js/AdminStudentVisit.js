$(document).ready(function() {
    updateAdmins(); //document ready function to update teh current admins for the webapplication

    //
    function updateAdmins() {
        $.getJSON("php/myAdminFormView.php", function(data) {
            $("#currAdmins").empty();
            $.each(data.result, function() {
                $("#currAdmins").append("<div class='record' id='record-" + this['adminID'] + "'><a href='?bl1pA=" + this['adminID'] + "' class='delete'><i style='color:Tomato;' class='fas fa-trash fa-sm'></i></a>&nbsp;<strong>" + this['adminFname'] + " " + this['adminLname'] + " (" +  this['admin'] + ")</strong></div>");
            });
        });
    }

    //Administrator management
    $("#adminSub").click(function() {
        if (!$("#myAdminForm :input").val() || $("#myAdminForm :input").val().length > 8) {
            alert("!! You did not enter a uniqname here !!");
        } else {
            $.post("php/myAdminFormSubmit.php", $("#myAdminForm :input").serializeArray());
        }
        $(function() {
            setTimeout(updateAdmins, 200);
        });
        //updateAll();

        $("#myAdminForm :input").each(function() {
            $(this).val('');
        });
    });

    $("#myAdminForm").submit(function() {
        return false;
    });

});
