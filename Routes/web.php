<?php
    /**
     * @uses define web based routes
     * @return mixed type views and process execution
     */
    //include controllers to be used
     use DealsManager\Controllers\HomeController;
     use DealsManager\Controllers\AuthController;
    
     $app->get("/", HomeController::class.":index");

     $app->post("/checkemailvalidity", AuthController::class.":checkEmailValidity");



?>