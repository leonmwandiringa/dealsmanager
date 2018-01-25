<?php
/**
 * @uses expose certain auth methods to view
 * @return mixed auth permissions
 */

namespace DealsManager\Controllers;
use DealsManager\Controllers\Controller;
use DealsManager\Models\User;
use Firebase\JWT\JWT;

 class AuthViewHandler extends Controller{

    public $jwtVal;

    public function check(){

        if(isset($_COOKIE['umid'])){

                return True;
        }

        return False;

    }

    public function getUser(){
        
        if(isset($_COOKIE['umid'])){
            $this->jwtVal = JWT::decode($_COOKIE['umid'], $this->container['settings']['jwt']['secret'], array('HS256'));
            $userDetails = User::where('email', $this->jwtVal->email)->get()->take(1)->first();

            return $userDetails;
        }
        return False;

    }

 }


?>