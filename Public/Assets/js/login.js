$(document).ready(function(){
    "use strict";
    $("#loginbtn").click(loginUser);
    var email, token, password, accessHeader, redirectUrl;
    var alert = $("#signinalert");

    function loginUser(){
        $("body").addClass("bodything");
        $("#loaderr").fadeIn(400);

        email = $("#hdemailaddr").val();
        password = $("#password").val();
        token = $("#hdtokenaddr").val();

        if(password != ""){
            let xhr = new XMLHttpRequest();
            xhr.open("POST","http://localhost/dealsmanager/login",true);
            xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");

            xhr.onload = function(){

                if(this.status == 200){
                    //get headers
                    accessHeader = this.getResponseHeader('X-Access-Token');
                    
                    if(accessHeader != null || accessHeader != ""){

                        //loader
                        $("body").removeClass("bodything");
                        $("#loaderr").fadeOut(400);

                        return window.location.href = 'http://localhost/dealsmanager/home';

                    }else{
                        //loader
                        $("body").removeClass("bodything");
                        $("#loaderr").fadeOut(400);

                        //alert box
                        alert.addClass("alert-danger");
                        alert.fadeIn(500);
                        alert.find("#alertnotice").text("Error ! ");
                        alert.find("#alertmessage").text(" umm yea about the token we couldnt assign you one for some reason");
                    }
                    
                }

            }
            xhr.send("email="+email+"&token="+token+"&password="+password);
        }else{
            //loader
            $("body").removeClass("bodything");
            $("#loaderr").fadeOut(400);

            //alert box
            alert.addClass("alert-danger");
            alert.fadeIn(500);
            alert.find("#alertnotice").text("Error ! ");
            alert.find("#alertmessage").text(" Please fill in your Your OTP");

        }

    }

});