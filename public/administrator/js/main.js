
function ServeContent(ID) {
    var request = $.ajax({
        type: "GET",
        url: "./content.php",
        data: {type:"Page",url:ID}
    });

    request.done(
        function ( response ) {
            $("#content").fadeOut(500, function () {
                $(this).html(response).fadeIn(500);


            });
        });

}

function toggleMenu(ID)
{
    if(ID)
        ServeContent(ID);
}

function toggleSidebar(){
    element =  $(document).find(".toggle-menu");
    if($('#sidebar').css('display')==='none')
        element.addClass("w3-text-white");
    else
        element.removeClass("w3-text-white");

    if($("#sidebar").css("position")==="fixed")
    {
        if($(element).css("position") === "fixed") {
            $(element).css("position", "relative");

        }
        else{
            $(element).css("position","fixed");
        }

    }
    $("#sidebar").fadeToggle();
}
function Login() {
      var request = $.ajax({
          type: "POST",
          url:"./login.php",
          data: { type:'Login', login: $("#loginInput").val(), password: CryptoJS.SHA512($('#passwordInput').val()).toString() }
      });

     request.done(
         function (response) {
             if(response==="ERROR")
                 $('#bad-login-modal').css("display","block");
             else window.location.reload();
         }
     );
    
}

function ShowError(Title, Content) {
    $('#bad-request-modal').find('#ErrorTitle').text(Title);
    $('#bad-request-modal').find('#ErrorContent').text(Content);
    $('#bad-request-modal').css("display","block");
}

function Logout() {
    var request = $.ajax({
        type: "POST",
        url:"./login.php",
        data: { type:'Logout' }
    });

    request.done(
        function (response) {
            window.location.reload();
        }
    );

}

document.addEventListener('DOMContentLoaded', function () {
    ServeContent('EntryList');
        $(document).find(".toggle-menu").each(function (id, element) {
            $(element).on('click',function () {
                toggleSidebar();
            });
        });
        $("#sidebar").find(".ajax-link").each(function(id, element){
           $(element).on('click',function(){
             toggleSidebar();
               ServeContent($(element).attr('id'));
           });
        });

   });
