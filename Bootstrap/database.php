<?php
/**
 * @uses run dependancy injection container
 * @return db abstraction object api
 */

    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($container['settings']['db']);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    $container['db'] = function($container) use($capsule){

        return $capsule;
    }

?>