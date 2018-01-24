<?php

/**
 * @uses run route endpoints methods
 * @return mixed view and exec
 */

 namespace DealsManager\Controllers;
 use DealsManager\Controllers\Controller;

 class HomeController extends Controller{

    public function index($request, $response){

        return $this->view->render($response, "guesthome.twig");

    }

 }

?>