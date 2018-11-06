/**
 * Created by malasz on 5/27/17.
 */

class Calendar {

    constructor(){
        this.d = new Date();
        this.day = this.d.getDate();
        this.month = this.d.getMonth();
        this.year = this.d.getFullYear();
        this.SetMonth = this.month;
        this.SetYear = this.year;
    }

    UpdateCalendar() {
        var request = $.ajax({
            type: "GET",
            url: "./content.php",
            data: {type:'calendar', month:this.SetMonth, year:this.SetYear}
        });

        request.done(
            function ( response ) {
                var data = JSON.parse(response);
                $('#calendar-monthyear').html( data['MonthYear']);
                $('#calendar-days').html(data['Days']);
            });
    }

    PreviousMonth() {
        this.SetMonth--;
        if( this.SetMonth === 0 ) {
            this.SetMonth = 12;
            this.SetYear--;
        }
        this.UpdateCalendar();

    }
    NextMonth() {
        this.SetMonth++;
        if( this.SetMonth === 13 ) {
            this.SetMonth = 1;
            this.SetYear++;
        }
        this.UpdateCalendar();

    }
}


function LoadEntry(ID)
{
    var request = $.ajax({
        type: "GET",
        url: "./content.php",
        data: {url:"article",type:'article', id:ID}
    });

    request.done(
        function ( response ) {
            $("#content").fadeOut(500, function () {
                $(this).html(response).fadeIn(500);
            });
        });
}

function ServeContent(ID) {

    var request = $.ajax({
        type: "GET",
        url: "./content.php",
        data: {url:ID, type:'url'}
    });

    request.done(
        function ( response ) {
            $("#content").fadeOut(500, function () {
                $(this).html(response).fadeIn(500);
                CurrentPage = ID;
            });
        });

}

function toggleMenu(ID) {
    $("#navMobile").fadeToggle();
    console.log(ID);
    if(ID)
        ServeContent(ID);
}

document.addEventListener("DOMContentLoaded",function(event) {
    ServeContent('Home');

   $('#myNavbar').find(".ajax-link").each(function (id, element) {
       $(element).on('click',function () {
           ServeContent($(element).attr('id'));
       })
   });

});
