<?php

    /**
     * @uses sending html emails wrapper
     * @return swift mailer wrapper
     */
    namespace DealsManager\Controllers;
    
    require_once __DIR__.'/../../vendor/swiftmailer/swiftmailer/lib/swift_required.php';
    
    class EmailController extends Controller{

        public $Connection, $transport;

        public function __construct(){

            $this->Connection = new Swift_SmtpTransport('in-v3.mailjet.com', 25);
            $this->transport = $Connection->setUsername('47a02e8986f2dc42976fdba43ccb2fbd')->setPassword('25e513cd363eb4eae15c67b7bdc36a42');

        }

        public function sendMessage($subject, $email, $data){

            $emailBody = $this->view->render("emails/signin.twig",$data);
            $mailer = new Swift_Mailer($this->$transport);
            
                        // Create a message
                $message = (new Swift_Message($subject))->setFrom(['leon@techadon.tech' => 'Leon'])
                        ->setTo([$email => $email])
                        ->setBody('Here is the message itself');
            
                        // Send the message
                $result = $mailer->send($message);
            
        }

    }

?>