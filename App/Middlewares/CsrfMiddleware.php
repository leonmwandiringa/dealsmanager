<?php

/**
 * @uses run a dynamic easy to use csrf middleware on requests 
 * @return mixed html object containing csrf keys and values
 */

    namespace DealsManager\Middlewares;
    class CsrfMiddleware extends Middleware{

        public function __invoke($request, $response, $next){

            $this->view->getEnvironment()->addGlobal('csrf',[
                'field'=>'<input type="hidden" name="'.$this->csrf->getTokenNameKey().'" value="'.$this->csrf->getTokenName().'">
                    <input type="hidden" name="'.$this->csrf->getTokenValueKey().'" value="'.$this->csrf->getTokenValue().'">'

            ]);

            $response = $next($request, $response);
            return $response;
        }

    }



?>