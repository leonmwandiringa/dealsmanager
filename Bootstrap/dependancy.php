<?php

    /**
     * @uses dependency injection to the container fo global usage
     */

     $container = $app->getContainer();

     //use slim views
     $container['view'] = function ($container) {
        $view = new \Slim\Views\Twig(__DIR__ . '/../Resources/Views', [
            'cache' => $container->settings['views']['cache']
        ]);
        $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
        $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));
        return $view;
    };



?>