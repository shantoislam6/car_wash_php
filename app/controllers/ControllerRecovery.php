<?php

namespace controllers;


class ControllerRecovery extends \lib\Controller
{

   protected $POST;
   protected $userModel;

   // Middleware
   public function __construct()
   {

      // check user authenticate or not
      if (is_auth_user()) {
         redirectTo('/');
      }

      // Retreive User Model
      $this->userModel =  new \models\ModelUser;

      // Prevent xss attack
      $this->POST = $this->sanitize_post_request();
   }

   public function index()
   {
      redirectTo('/status/notfound');
   }


   public function password()
   {


      if ($this->request_method('GET')) {
         $this->view('recovery/recovery_password', [
            'title' => 'Recovery Password'
         ]);
      }


      if ($this->request_method('POST')) {

         $post = $this->POST;

         $errors = [];

         $user = [];

         // Validate Email
         if (!empty($post['email'])) {

            if (filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {

               $user = $this->userModel->findUserByEmail($post['email']);
               if ($user) {
                  if ($user['role'] == 3) {
                     $errors['email'] = 'Sorry, Site owner email!';
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

         if (count($errors) == 0) {

            send_verification_code([
               'email' => $user['email'],
               'name'  => $user['first_name'] . ' ' . $user['last_name']
            ]);

            $_SESSION['recovery_password_email'] = $post['email'];

            redirectTo('/recovery/verify_code');
         } else {

            $this->view('recovery/recovery_password', [
               'title' => 'Recovery Password',
               'errors' => $errors,
               'form_data' => $post
            ]);
         }
      }
   }

   public function verify_code()
   {

      if (isset($_SESSION['recovery_password_email'])) {


         if ($this->request_method('GET')) {
            $this->view('recovery/verify_code', [
               'title' => 'Verify Code'
            ]);
         }


         if (
            $this->request_method('POST') && isset($this->POST['verify_recovery_password_email']) &&  isset($_SESSION['verficaion_code_info'])
         ) {


            $errors = [];



            if (!empty($this->POST['verification_code'])) {

               $vcode = $this->POST['verification_code'];

               if (strlen($vcode) == 6) {

                  if (!empty($_SESSION['verficaion_code_info'])) {

                     $verification_info = json_decode($_SESSION['verficaion_code_info']);
                     $scode = $verification_info->code;
                     $time_limit = $verification_info->time_limit;

                     if ($scode == $vcode) {
                        if ($time_limit - time() < 0) {
                           $errors['verification_code'] = "Time has been expired! Send Verification Code Again!";
                        }
                     } else {
                        $errors['verification_code'] = 'Invalid verification_code Code!';
                     }
                  } else {
                     $errors['verification_code'] = "Send Verification code Again!";
                  }
               } else {
                  $errors['verification_code'] = "Verfication Code must be 6 digit code!";
               }
            } else {
               $errors['verification_code'] = "Input Verification code!";
            }

            // Check if there is no error then submit the form
            if (count($errors) == 0) {

               $xs = bin2hex(random_bytes(16));

               // Set new password change xs_token
               $_SESSION['xs_forgotten_pass_info'] = json_encode([
                  'xs' => $xs,
                  'time_limit' => time() + (60 * 2)
               ]);

               // store hased token to database
               $hashed_xs = password_hash($xs, PASSWORD_DEFAULT);
               $this->userModel->addUserToken($hashed_xs, $_SESSION['recovery_password_email']);
               redirectTo('/recovery/set_new_password');
            } else {
               $this->view('recovery/verify_code', [
                  'title' => 'Verify Code',
                  'errors' => $errors,
                  'form_data' => $this->POST,
               ]);
            }
         } else {
            redirect(current_url());
            flash_message('danger', 'Resend the verification code!!');
         }
      } else {
         redirectTo('/recovery/password');
      }
   }


   // set new password within xs session time 
   public function set_new_password()
   {

      if (isset($_SESSION['xs_forgotten_pass_info'])) {

         $user = $this->userModel->findUserByEmail($_SESSION['recovery_password_email']);

         $xs_forgotten_pass_info = json_decode($_SESSION['xs_forgotten_pass_info']);

         if (password_verify($xs_forgotten_pass_info->xs, $user['user_token'])) {

            if (time() < $xs_forgotten_pass_info->time_limit) {

               if ($this->request_method('POST')) {

                  $errors = [];
                  $post = $this->POST;

                  if (
                     strlen($post['new_password'])  > 5
                     && strlen($post['new_password']) < 21
                  ) {
                     if (!empty($post['re_new_password'])) {

                        if ($post['re_new_password'] != $post['new_password']) {
                           $errors['re_new_password'] = ' Didn\'t match with new password!';
                        }
                     } else {
                        $errors['re_new_password'] = 'Please enter the same new password again!';
                     }
                  } else {
                     $errors['new_password'] = 'Password must be minimum 6 and maximum 20 characters!';
                  }


                  // Check if there is no error then submit the form
                  if (count($errors) == 0) {
                     // Hash the password before create a user
                     $post['re_new_password'] = password_hash($post['re_new_password'], PASSWORD_DEFAULT);

                     $this->userModel->updateUserPass($post['re_new_password'], $user['id']);

                     // Remove all cookie from users
                     $rememberMeModel = new \models\ModelRememberMe;
                     $rememberMeModel->deleteUsersXsTokens($user['id']);

                     unset($_SESSION['xs_forgotten_pass_info']);
                     unset($_SESSION['recovery_password_email']);

                     flash_message("warning", "<b>You have set a new password!! Now you can signin!!</b>");
                     redirectTo('/signin');
                  } else {

                     $this->view('recovery/set_new_password', [
                        'title' => 'Set New Password',
                        'form_data' => $post,
                        'errors' => $errors,
                     ]);
                  }
               }

               if ($this->request_method('GET')) {
                  $this->view('recovery/set_new_password', [
                     'title' => 'Set New Password'
                  ]);
               }
            } else {
               unset($_SESSION['xs_forgotten_pass_info']);
               flash_message('danger', 'Your session has been expired for set up a new password!');
               redirectTo('/signin');
            }
         } else {
            http_response_code(401);
         }
      } else {
         redirectTo('/recovery/password');
      }
   }
}
