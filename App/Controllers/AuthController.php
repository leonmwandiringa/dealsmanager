<?php
/**
 * @uses run auth methods and endpoints
 * @return mixed, validation and route endpoint handling
 */

    namespace DealsManager\Controllers;
    use DealsManager\Controllers\Controller;
    use DealsManager\Models\User;
    use DealsManager\Controllers\JWTController;
    use Carbon\Carbon;

    require __DIR__."/../../vendor/swiftmailer/swiftmailer/lib/classes/Swift/Message.php";

    class AuthController extends Controller{

        //validate email and retun json string
        public function checkEmailValidity($request, $response){

            $email = filter_var($request->getParsedBodyParam("email"), FILTER_SANITIZE_EMAIL);

            if(empty($email)){

                return $response->withJson(["notice"=>"Error","message"=>"Sorry the email address is empty", "result"=>"false"],200);
            }

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){

                return $response->withJson(["notice"=>"Error","message"=>"Sorry the email address is invalid, please provide a valid email", "result"=>"false"],200);

            }

            return $response->withJson(["notice"=>"Success", "message"=>"Great your email is valid", "result"=>"true", "email"=>$email], 200);

        }

        //start the run user methods
        public function login($request, $response, $args){

            $email = base64_decode($args['email']);

            $token = $args['token'];

            $user = User::where('email', $email)->get()->take(1)->first();

            //as long as token is not old
            if(User::where('email', $email)->get()->take(1)->count()){

                $now = Carbon::now();
                $tokendate = new Carbon($user->tokendate);

                if($tokendate->diffInHours($now) < 25){
               
                    return $this->view->render($response, 'login.twig', ['email'=>$email, 'token'=>$token]);
    
               }else{

                    $this->flash->addMessage('error', 'Sorry Your Token has expired Please sign in again');
                   return $response->withRedirect($this->router->pathFor('signin'));
    
               }

            }else{

                $this->flash->addMessage('error', 'Your email Address and Key was not found');
                return $response->withRedirect($this->router->pathFor('signin'));

            }

            //var_dump(Carbon::parse($user->tokendate));
        }

        public function postLogin($request, $response){

            $email = $request->getParsedBodyParam('email');
            $password = $request->getParsedBodyParam('password');
            $token = $request->getParsedBodyParam('token');
            $userIn = User::where('email', $email)->get()->take(1)->first();
            $tokenldate = new Carbon($userIn->tokendate);

            if(!$this->checkUser($email)){

                $this->flash->addMessage("error", "Your email account was not found try signing in");
                return $response->withRedirect($this->router->pathFor('signin'));
            }

            if($token == $userIn->tokenvalue && $tokenldate->diffInHours(Carbon::now()) < 25){

                if(!password_verify($password, $userIn->password)){

                    $message = ['notice'=>'error', 'message'=>'Password is not correct', 'result'=>'false'];

                }else{
                    
                    // if($this->setupUserNow($email, $token, $userIn->id)){
                    //     $this->flash->addMessage('success','Great stuff you\'re In');
                    //     $response->withRedirect($this->router->pathFor('home'));
                    // }
                    return var_dump($this->setupUserNow($email, $userIn->id, $userIn->name));
                }

            }else{

                $message = ['notice'=>'error', 'message'=>'Sorry its Either  Your Token has expired or cant be found', 'result'=>'false'];
            }

            return $response->withJson($message,200);
            
        }

        public function checkUser($email){

            $userAvail = User::where('email', $email)->get()->take(1)->count();

            if($userAvail != 0){
                return true;
            }

            return false;
        }

        public function setupUserNow($email, $id, $name){

            //$cookieval = '';
            $cookieValJWT = $this->JWTAUTH->authenticate($id, $name, $email);
            return setCookie('umid', $cookieValJWT, time()+86500 * 30, '/', isset($_SERVER['HTTPS']), TRUE);

        }

    }




?>