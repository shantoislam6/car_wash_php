<?php

namespace controllers;

class ControllerSignup extends \lib\Controller
{
   protected $defaultModel;
   protected $userModel;
   protected $POST;


   // Middleare
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

      // Prevent csrf
      // code ...

   }


   public function index($super_admin = '')
   {
      if ($this->request_method('GET')) {
         $this->view('signup', [
            'title' => 'Sign Up',
            'super_admin' => $super_admin
         ]);
      }

      if ($this->request_method('POST')) {

         $errors = [];

         // Validate first name
         if (!empty($this->POST['first_name'])) {
            if (strlen($this->POST['first_name']) < 3) {
               $errors['first_name'] = 'First name should contains at least 3 letters!';
            }
         } else {
            $errors['first_name'] = 'Please enter first name!';
         }


         // Validate last name
         if (!empty($this->POST['last_name'])) {
            if (strlen($this->POST['last_name']) < 3) {
               $errors['last_name'] = 'Last name should contains at least 3 letters!';
            }
         } else {
            $errors['last_name'] = 'Please enter last name!';
         }


         // Validate last Email
         if (!empty($this->POST['email'])) {

            if (filter_var($this->POST['email'], FILTER_VALIDATE_EMAIL)) {

               list($username, $domain) = explode('@', $this->POST['email']);

               if (checkdnsrr($domain, 'MX')) {

                  if ($this->userModel->findUserByEmail($this->POST['email'])) {
                     $errors['email'] = 'This email has already been registered!';
                  }
               } else {
                  $errors['email'] = "Invalid email dns!";
               }
            } else {
               $errors['email'] = 'Invalid email format!';
            }
         } else {

            $errors['email'] = 'Please enter email!';
         }



         // Validate last mobile number
         $telphone_regexe = "/^(\+\d{1,3})?(\d+)(-?)(\d+)$/";
         if (!empty($this->POST['mobile_number'])) {
            if (!preg_match($telphone_regexe, $this->POST['mobile_number'])) {
               $errors['mobile_number'] = 'Invalid mobile number!';
            }
         } else {
            $errors['mobile_number'] = 'Please enter mobile number!';
         }


         // Validate gender
         if (!empty($this->POST['gender'])) {
            if (!($this->POST['gender'] == "female" || $this->POST['gender'] == "male")) {
               $errors['gender'] = 'Invalid gender input';
            }
         } else {
            $errors['gender'] = 'Please select gender!';
         }


         // Validate address line
         if (empty($this->POST['address_line_1'])) {
            $errors['address_line_1'] = 'Please enter at least address line 1!';
         }

         // Validate post code
         if (!empty($this->POST['postcode'])) {

            if (!preg_match("/^\d{1,12}$/", $this->POST['postcode'])) {
               $errors['postcode'] = 'Invalid postcode!';
            }
         } else {
            $errors['postcode'] = 'Please enter post code!';
         }

         // Validate current_location
         if (empty($this->POST['current_location'])) {
            $errors['current_location'] = 'Please enter your current location!';
         }

         // Validate sate and region
         if (empty($this->POST['state'])) {
            $errors['state'] = 'Please enter you state/region!';
         }

         // Validate Password
         if (!empty($this->POST['password'])) {
            if (
               strlen($this->POST['password'])  > 5
               && strlen($this->POST['password']) < 21
            ) {
               if (!empty($this->POST['re_password'])) {
                  if ($this->POST['re_password'] != $this->POST['password']) {
                     $errors['re_password'] = 'Passwords didn\'t match';
                  }
               } else {
                  $errors['re_password'] = 'Please enter the same password again!';
               }
            } else {
               $errors['password'] = 'Password must be minimum 6 and maximum 20 characters!';
            }
         } else {
            $errors['password'] = 'Please enter password!';
         }

         // Validate user agree on terms of service
         if (!isset($this->POST['agree_on']) && empty($super_admin)) {
            $errors['agree_on'] = 'Must agree on our terms of service!';
         }

         // Check if there is no error then submit the form
         if (count($errors) == 0) {

            // Hash the password before create a user
            $this->POST['re_password'] = password_hash($this->POST['re_password'], PASSWORD_DEFAULT);

            $this->POST['role'] = !empty($super_admin) ? 3 : 0;
            $this->POST['is_verified'] = !empty($super_admin) ? 1 : 0;

            $user_id = $this->userModel->createUser($this->POST);



            $user = $this->userModel->findUserById($user_id);

            // make auth via session only
            set_user_session($user);

            if (!empty($super_admin)) {
               flash_message("success", "<span class='lead'><b >Congratulation!! </b> You have become the super admin of '" . SITENAME . "'");
               redirect('/user/dashboard');
            } else {
               redirect('/user/verify/?send_tk=send');
            }
         } else {
            $this->view('signup', [
               'title' => 'Sign Up',
               'form_data' => $this->POST,
               'errors' => $errors,
               'super_admin' => $super_admin
            ]);
         }
      }
   }
}
