<?php

/**
 * @uses jwt authentication helper for auth
 * @rertun an encoded authentication json string for user
 */

 namespace Dealsmanager\Controllers;
 use Firebase\JWT\JWT;

 class JWTController extends Controller{

    protected $payload, $secret;
    

    public function authenticate($id, $name, $email){

        $this->payload = array(

            "id"=>$id,
            "name"=>$name,
            "email"=>$email
        );

        $this->secret = $this->container['settings']['jwt']['secret'];

        return $this->setJWTToken($this->payload, $this->secret);

    }

    public function setJWTToken($payload, $secret){

        return JWT::encode($payload, $secret);
    }


 }

?>