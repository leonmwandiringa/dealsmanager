<?php
    /**
     * @uses define web based routes
     * @return mixed type views and process execution
     */
    //include controllers to be used
     use DealsManager\Controllers\HomeController;
     use DealsManager\Controllers\AuthController;

    //  $mailer = Swift_Mailer::newInstance(Swift_SmtpTransport::newInstance('in-v3.mailjet.com', 25)
    //  ->setUsername('47a02e8986f2dc42976fdba43ccb2fbd')
    //  ->setPassword('25e513cd363eb4eae15c67b7bdc36a42'));
    
     $app->get("/", HomeController::class.":index");

     $app->post("/checkemailvalidity", AuthController::class.":checkEmailValidity");

     //$app->post("/signinuser", AuthController::class.":signInUser");

     $app->post("/signinuser", function($request, $response){

         $email = filter_var($request->getParsedBodyParam('email'), FILTER_SANITIZE_EMAIL);
        $name = substr($email, 0, strpos($email, "@"));
        $messageBody = $this->view->fetch('Emails/signin.twig');

        $message = Swift_Message::newInstance($name." Sign In Key")->setFrom(['leon@techadon.tech' => 'Leon'])
        ->setTo([$email => $name])
        ->setBody($messageBody)
        ->setContentType('text/html');

        $this->mail->send($message);

     });

     


?>