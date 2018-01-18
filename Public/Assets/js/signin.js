$(document).ready(function(){
/**
 * @uses run sign in details asyncronously
 * @support email validity as a clockwork worker check and signing in via email token uth
 */
    "use strict";
    let emailaddr, emailvalidity, resultVal;
    let signinalert = $("#signinalert");

    //the click which is going to make shit happen
    $("#signinbtn").click(signInUser);

    //check validity ...- 2nd to be executed
    function checkValidity(emailaddr){

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "http://localhost/dealsmanager/checkemailvalidity", true);
        xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");

        xhr.error = function(){

            console.log("error");
        }

        xhr.onload = function(){

            if(this.status == 200){

                resultVal =  JSON.parse(this.responseText);

                    runResultDisplay(resultVal);

            }

        }

        xhr.send("email="+emailaddr);

    }

    //execute results and run the sign in endpoint .. - 3rd to be executed
    function runResultDisplay(resultVal){

       let resultObject = resultVal;

        if(resultObject.result == "true"){

            runSigninUser();
        }else{

            signinalert.addClass("alert-danger");
            signinalert.find("#alertnotice").text("Error ");
            signinalert.find("#alertmessage").text(" "+ resultObject.message);
            signinalert.show(1000);

        }

    }

    //sign in user.. - 1st to be executed
    function signInUser(){

        emailaddr = $("#emailaddress").val();

        if(emailaddr == "" || emailaddr == null){

            signinalert.addClass("alert-danger");
            signinalert.find("#alertnotice").text("Error ");
            signinalert.find("#alertmessage").text(" Email Address Required");
            signinalert.show(1000);
            
        }else{

            checkValidity(emailaddr);

        }

    }





});