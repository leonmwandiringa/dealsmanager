<?php
/**
 * @uses Run the automated csrf security
 * @return overloaded container properties and methods
 */

    namespace DealsManager\Middlewares;
    
    class Middleware{

        protected $container;

        public function __construct($container){

            $this->container = $container;

        }

        //overload non linked container methods and properties
        public function __get($property){

            if($this->container->{$property}){

                return $this->container->{$property};
            }

        }

    }

?>