<?php
/**
 * @uses handling authenticated users views
 * @return mixed view pages
 */

 namespace DealsManager\Controllers;
 use DealsManager\Controllers\Controller;

 class AuthViewController extends Controller{

    public function index($request, $response){

        return $this->view->render($response, 'userhome.twig');

    }

    public function manageDeals($request, $response){

        return $this->view->render($response, 'adddeals.twig');
    }

 }

?>