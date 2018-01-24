$(document).ready(function(){
/**
 * @uses run sign in details asyncronously
 * @support email validity as a clockwork worker check and signing in via email token uth
 */
    "use strict";
    let emailaddr, emailvalidity, resultVal, csrfName, csrfValue;
    let signinalert = $("#signinalert");

    //the click which is going to make shit happen
    $("#signinbtn").click(signInUser);

    //check validity ...- 2nd to be executed
    function checkValidity(emailaddr, csrfName, csrfValue){

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "http://localhost/dealsmanager/checkemailvalidity", true);
        xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");

        xhr.error = function(){

            console.log("error");
        }

        xhr.onload = function(){

            if(this.status == 200){

                resultVal =  JSON.parse(this.responseText);

                    runResultDisplay(resultVal, csrfName, csrfValue);

            }

        }

        xhr.send("email="+emailaddr+"&csrf_name="+csrfName+"&csrf_value="+csrfValue);

    }

    //execute results and run the sign in endpoint .. - 3rd to be executed
    function runResultDisplay(resultVal, csrfName, csrfValue){

       let resultObject = resultVal;

        if(resultObject.result == "true"){

            $("body").addClass("bodything");
            $("#loaderr").fadeIn(400);

            runSigninUser(resultObject.email, csrfName, csrfValue);
            
        }else{

            signinalert.addClass("alert-danger");
            signinalert.find("#alertnotice").text("Error ");
            signinalert.find("#alertmessage").text(" "+ resultObject.message);
            signinalert.fadeIn(500);

        }

    }

    //sign in user.. - 1st to be executed
    function signInUser(){

        emailaddr = $("#emailaddress").val();
        csrfName = $("input[name='csrf_name']").val();
        csrfValue = $("input[name='csrf_value']").val();

        if(emailaddr == "" || emailaddr == null){

            signinalert.addClass("alert-danger");
            signinalert.find("#alertnotice").text("Error ");
            signinalert.find("#alertmessage").text(" Email Address Required");
            signinalert.fadeIn(500);
            
        }else{

            checkValidity(emailaddr, csrfName, csrfValue);

        }

    }
    //last to be executed
    function runSigninUser(emailVal, csrfName, csrfValue){

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "http://localhost/dealsmanager/signinuser", true);
        xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");

        xhr.error = function(){

            console.log("error");
        }

        xhr.onload = function(){

            if(this.status == 200){

                if(this.responseText == "true"){

                    $("body").removeClass("bodything");
                    $("#loaderr").fadeOut(400);
                    
                    swal("Great stuff!", "an email has been sent to your email address, use the link and password gived to log in !", "success");
                }

            }

        }

        xhr.send("email="+emailVal+"&csrf_name="+csrfName+"&csrf_value="+csrfValue);

    }





});