<?php
/**
 * @uses run auth methods and endpoints
 * @return mixed, validation and route endpoint handling
 */

    namespace DealsManager\Controllers;
    use DealsManager\Controllers\Controller;

    class AuthController extends Controller{

        //validate email and retun json string
        public function checkEmailValidity($request, $response){

            $email = filter_var($request->getParsedBodyParam("email"), FILTER_SANITIZE_EMAIL);

            if(empty($email)){

                return $response->withJson(["notice"=>"Error","message"=>"Sorry the email address is empty", "result"=>"false"],200);
            }

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){

                return $response->withJson(["notice"=>"Error","message"=>"Sorry the email address is invalid, please provide a valid email", "result"=>"false"],200);

            }

            return $response->withJson(["notice"=>"Success", "message"=>"Great your email is valid", "result"=>"true", "email"=>$email], 200);

        }

        //start the run user methods
        public function signInUser($request, $response){

            $email = $request->getParsedBodyParam("email");
            return $email;

        }

    }




?>