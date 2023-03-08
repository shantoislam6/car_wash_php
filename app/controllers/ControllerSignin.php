<?php

namespace controllers;


class ControllerSignin extends \lib\Controller
{
   protected $defaultModel;
   protected $userModel;
   protected $POST;


   // Middleware
   public function __construct()
   {
      // check where user authenticate or not
      if (is_auth_user()) {
         redirectTo('/');
      }

      // Retreive User Model
      $this->userModel = new \models\ModelUser;

      // Prevent xss attack
      $this->POST = $this->sanitize_post_request();
   }

   public function index()
   {
      if ($this->request_method('GET')) {

         $this->view('signin',  [
            'title' => "Sign In",
         ]);
      }

      if ($this->request_method('POST')) {

         $errors = [];
         $user = [];

         // Validate Email
         if (!empty($this->POST['email'])) {

            if (filter_var($this->POST['email'], FILTER_VALIDATE_EMAIL)) {

               $user = $this->userModel->findUserByEmail($this->POST['email']);
               if ($user) {
                  // Validate password and verify password
                  if (!empty($this->POST['password'])) {
                     if (!password_verify($this->POST['password'], $user['password'])) {
                        $errors['password'] = 'Password is not correct!';
                     }
                  } else {
                     $errors['password'] = 'Please enter password!';
                  }
               } else {
                  $errors['email'] = 'This email has not been registered!';
               }
            } else {
               $errors['email'] = 'Invalid email format!';
            }
         } else {
            $errors['email'] = 'Please enter email!';
         }

         // Validate password
         if (empty($this->POST['password'])) {
            $errors['password'] = 'Please enter password!';
         }

         if (count($errors) == 0) {

            if (isset($this->POST['rember_me']) && $this->POST['rember_me'] == 'on') {

               $xs = 'xs_' . bin2hex(random_bytes(16));

               $expires_time = time() + 60 * 60 * 24 * (is_int(COOKIE_LIFE_TIME) ? (int)COOKIE_LIFE_TIME : 30);

               $arr_cookie_options = array(
                  'expires' => $expires_time,
                  'path' => '/',
                  'domain' => DOMAIN, // leading dot for compatibility or use subdomain
                  'secure' => true,     // or false
                  'httponly' => true,    // or false
                  'samesite' => 'None' // None || Lax  || Strict
               );

               setcookie('xs', $xs, $arr_cookie_options);
               setcookie('user_id', $user['id'], $arr_cookie_options);

               $hashed_xs = password_hash($xs, PASSWORD_DEFAULT);

               $rememberMeModel = new \models\ModelRememberMe;

               $rememberMeModel->insert_xs_token($user['id'], $hashed_xs, $expires_time);
            } else {

               // make auth via session only
               set_user_session($user);
            }

            //set login flash

            flash_message('success', '<b>You have successfully signed in!!</b>');

            redirectTo('/user/dashboard');
         } else {

            $this->view('signin', [
               'title' => "Sign In",
               'errors' => $errors,
               'form_data' => $this->POST,
            ]);
         }
      }
   }
}
