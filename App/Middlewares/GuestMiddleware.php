<?php

/**
 * @uses permissions for guests only
 * @return mixed exec redirection 
 */

 namespace DealsManager\Middlewares;
 use DealsManager\Middlewares\Middleware;
 
 class GuestMiddleware extends Middleware{

        public function __invoke($request, $response, $next){

            if(isset($_COOKIE['umid'])){

                return $response->withRedirect($this->router->pathFor('home'));
            }

            return $next($request, $response);
        }

 }

?>