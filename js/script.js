
/*---------index--------------------*/
$(function() {

    $('#login-form-link').click(function(e) {
        $("#login-form").delay(100).fadeIn(100);
        $("#register-form").fadeOut(100);
        $('#register-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });
    $('#register-form-link').click(function(e) {
        $("#register-form").delay(100).fadeIn(100);
        $("#login-form").fadeOut(100);
        $('#login-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });

});



/*---------profile--------------------*/

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});

$(function () {
    $('[data-toggle="popover"]').popover()
});



/*---------gallery--------------------*/
$(document).ready(function() {
    $('.thumbnail').click(function(){
        $('.modal-body').empty();
        var title = $(this).parent('a').attr("title");
        $('.modal-title').html(title);
        $($(this).parents('div').html()).appendTo('.modal-body');
        $('#myModal').modal({show:true});
    });
});

/*---------------------------------*/

$("#img").on("change",function(){
    $("#load_img").removeClass("hide");
    $("#img").addClass("hide");
});

$("#avatar").on("change",function(){
    $("#saveBtn").removeClass("hide");
    $("#avatar").addClass("hide");
});



/*--------------registration-------------------*/

$("#email").on("blur",function(){
    $that = $(this);
    var data = new Object();
    data.email = $that.val();
    $.ajax({
        url:"validation.php",
        method:"post",
        dataType:"json",
        data:data,
        success:function(response){
            if(response.error){
                $that.parent().removeClass("has-success");
                $that.parent().addClass("has-error");
            }else{
                $that.parent().removeClass("has-error");
                $that.parent().addClass("has-success");
            }
        }
    })
});

/*--------------map-------------------*/
var map;
function initMap() {
    var uluru = {lat: -25.363, lng: 131.044};
    map = new google.maps.Map(document.getElementById('map'), {
        center: uluru,
        zoom: 8
    });
    var marker = new google.maps.Marker({
        position: uluru,
        map: map
    });
}