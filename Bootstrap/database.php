<?php
/**
 * @uses run dependancy injection container
 */

 $container = $app->getContainer();

 //add csrf to the container
 $container['csrf'] = function($container){

    return new \Slim\Csrf\Guard;
 };

 $app->add(new DealsManager\Middlewares\CsrfMiddleware($container));
 $app->add($container->csrf);



?>