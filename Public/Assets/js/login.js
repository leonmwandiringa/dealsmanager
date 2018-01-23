$(document).ready(function(){
    "use strict";
    $("#loginbtn").click(loginUser);
    var email, token, password;
    var alert = $("#signinalert");

    function loginUser(){

        email = $("#hdemailaddr").val();
        password = $("#password").val();
        token = $("#hdtokenaddr").val();

        if(password != ""){
            let xhr = new XMLHttpRequest();
            xhr.open("POST","http://localhost/dealsmanager/login",true);
            xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");

            xhr.onload = function(){

                if(this.status == 200){

                    console.log(this.responseText);

                }

            }
            xhr.send("email="+email+"&token="+token+"&password="+password);
        }else{

            alert.addClass("alert-danger");
            alert.fadeIn(500);
            alert.find("#alertnotice").text("Error ! ");
            alert.find("#alertmessage").text(" Please fill in your Your OTP");

        }

    }

});