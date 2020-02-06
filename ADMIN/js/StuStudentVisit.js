$(document).ready(function() {
    updateStuInfo(); //document ready function

    function updateStuInfo() {
        $.getJSON("myStuInfoFormView.php", function(data) {

            $.each(data, function(i, item) {
                if (item.notAttend == 1) {
                $('<tr style="background-color:#CC0099">').append(
                    $('<td class="recID"><small>').text(item.userID),
                    $('<td >').text(item.umid),
                    $('<td>').text(item.Lname),
                    $('<td>').text(item.Fname),
                    $('<td>').text(item.email),
                    $('<td>').text(item.airlineTkt),
                    $('<td>').text(item.hotel),
                    $('<td>').text(item.shuttleArrive),
                    $('<td>').text(item.shuttleDepart),
                    $('<td>').text(item.facAppt),
                    $('<td>').text(item.welcomeDinner),
                    $('<td>').text(item.recLunch),
                    $('<td>').text(item.deptLunch),
                    $('<td>').text(item.dietrestriction),
                    $('<td>').text(item.accessibility),
                    $('<td>').text(item.shirt),
                    $('<td>').text(item.studentBio)).appendTo('#records_table');
                }   else{
                $('<tr>').append(
                    $('<td class="recID"><small>').text(item.userID),
                    $('<td >').text(item.umid),
                    $('<td>').text(item.Lname),
                    $('<td>').text(item.Fname),
                    $('<td>').text(item.email),
                    $('<td>').text(item.airlineTkt),
                    $('<td>').text(item.hotel),
                    $('<td>').text(item.shuttleArrive),
                    $('<td>').text(item.shuttleDepart),
                    $('<td>').text(item.facAppt),
                    $('<td>').text(item.welcomeDinner),
                    $('<td>').text(item.recLunch),
                    $('<td>').text(item.deptLunch),
                    $('<td>').text(item.dietrestriction),
                    $('<td>').text(item.accessibility),
                    $('<td>').text(item.shirt),
                    $('<td>').text(item.studentBio)).appendTo('#records_table');

                }
            });
        });
        updateTableView();
    }
    function updateTableView() {
        var t11 = setTimeout(function() {
            $("td").filter(function() {
                return $(this).text() === '1';
            }).text("X ");
            $("td").filter(function() {
                return $(this).text() === '0';
            }).text("");
            $("td").filter(function() {
                return $(this).text() === 'more..';
            }).html("<button class='moreStuff btn btn-sm btn-info'>more...</button>");
        }, 500);

    }

    $('#records_table').on('click', '.moreStuff', function() {
        $.post('studentBioView.php', {
            recID  : $(this).closest('tr').children('td.recID').text()}, function(resp) {
                alert(resp);
            });
    });
});
