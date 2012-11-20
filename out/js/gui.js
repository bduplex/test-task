function showArchiveByDate(date){

    $("#results").fadeTo("slow", 0.33);

    var surl = window.location + "?fnc=showarchive&date=" + date;
    $.ajax({
        url: surl,
        cache: false,
        type: "POST",
        dataType: "html"
     }).success(function(data) {
        $("#results").html(data);
        $("#results").fadeTo("slow", 1.0);
   });
}

$(document).ready(function(){

    /*
        INIT function for JQUERY UI Calendar
        Then date choosed, calls filter archive function by selected date
     */
    $(function() {
        $( "#datepicker" ).datepicker({
            dateFormat : "dd.mm.yy",
            onClose: function( selectedDate ) {
            //console.log(selectedDate);
            showArchiveByDate(selectedDate);
           }
     });
    });

});