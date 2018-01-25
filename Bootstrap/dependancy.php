<?php

    /**
     * @uses dependency injection to the container fo global usage
     */

     $container = $app->getContainer();

    //adding swift mailer to the container;
    $container['mail'] = function($container){

            $transport = Swift_SmtpTransport::newInstance('in-v3.mailjet.com', 25)
                        ->setUsername('47a02e8986f2dc42976fdba43ccb2fbd')
                        ->setPassword('25e513cd363eb4eae15c67b7bdc36a42');
                        
            return Swift_Mailer::newInstance($transport);

    };

    $container['flash'] = function () {
        return new \Slim\Flash\Messages();
    };

    $container['JWTAUTH'] = function($container){

        return new DealsManager\Controllers\JWTController($container);

    };

    $container['user'] = function($container){

        return new DealsManager\Controllers\AuthViewHandler($container);

    };
    
     //use slim views
     $container['view'] = function ($container) {
        $view = new \Slim\Views\Twig(__DIR__ . '/../Resources/Views', [
            'cache' => $container->settings['views']['cache']
        ]);
        $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
        $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));
        $view->getEnvironment()->addGlobal('flash', $container->flash);
        $view->getEnvironment()->addGlobal('user', ['check'=>$container->user->check(), 'details'=>$container->user->getUser()]);

        return $view;
    };

    
    //add csrf to the container
    // $container['csrf'] = function($container){
   
    //    return new \Slim\Csrf\Guard;
    // };
   
    // $app->add(new DealsManager\Middlewares\CsrfMiddleware($container));
    // $app->add($container->csrf);
   
   
   



?>