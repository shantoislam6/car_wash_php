<?php

namespace controllers;

class ControllerUser extends \lib\Controller
{
   protected $POST;
   protected $GET;
   protected $userModel;
   protected $user;
   protected $routePath;

   // Middleware
   public function __construct()
   {

      // check user authenticate or not
      if (!is_auth_user()) {
         flash_message('info', "<b>Please </b> Login first!! Or if you don't have and account then create one!!");
         redirectTo('/signin');
      }


      // Prevent xss attack
      $this->POST = $this->sanitize_post_request();
      $this->GET = $this->sanitize_get_request();

      // Retreive User Model
      $this->userModel = new \models\ModelUser;


      // Retrieve User from database based on session data
      $this->user = $this->userModel->findUserById($_SESSION['user_id']);


      // check user verfied or not
      if (!is_verified_user() && !matchRoute('/user/signout') && !matchRoute('/user/verify')) {
         $this->verify();
         exit;
      }
   }

   public function index()
   {
      redirectTo('/status/notfound');
   }


   public function verify()
   {

      // If user is verified then redirect to dashboard 
      if (is_verified_user()) {
         redirectTo('/user/dashboard');
      }

      // Check the request method is post 
      if ($this->request_method('POST')) {

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


         // check if there is error or not
         if (count($errors) == 0) {

            $this->userModel->makeVerified($_SESSION['user_id']);

            unset($_SESSION['verficaion_code_info']);

            flash_message("success", "<b>Your email has been verified!!</b>");

            $_SESSION['is_verified'] = 1;
            redirectTo('/user/dashboard');
         } else {

            $this->view('user/verify', [
               'title' => 'Verifiy Your Account',
               'user' => $this->user,
               'errors' => $errors,
               'form_data' => $this->POST,
            ]);
         }
      }

      // If request method is get
      if ($this->request_method('GET')) {


         // with send query
         if (!empty($this->GET['send_tk'])) {

            // Then send Verfication Code
            send_verification_code([
               'email' => $this->user['email'],
               'name' => $this->user['first_name'] . ' ' . $this->user['last_name'],
            ]);
         }

         // And view the verfy user interface
         $this->view('user/verify', [
            'title' => 'Verifiy Your Account',
            'user' => $this->user
         ]);
      }
   }

   public function bookings()
   {

      $this->view('user/bookings', [
         'title' => "Your Bookings",
      ]);
   }


   public function dashboard()
   {


      $this->view('user/dashboard', [
         'title' => "Dashboard",
         'user' => $this->user
      ]);
   }


   public function profile($id = '')
   {

      if (empty($id) || $id == $_SESSION['user_id']) {
         $this->view('user/profile', [
            'title' => 'You',
            'user' => $this->user
         ]);
      } else {
         $user = $this->userModel->findUserById($id);
         if ($user) {
            if (is_admin()) {
               $this->view('user/profile', [
                  'title' => $this->user["first_name"] . ' ' . $this->user["last_name"],
                  'user' => $this->userModel->findUserById($id)
               ]);
            } else {
               $this->view('user/profileother', [
                  'title' => $this->user["first_name"] . ' ' . $this->user["last_name"],
                  'user' => $user
               ]);
            }
         } else {
            flash_message('danger', 'Sorry invalid profile link!! Redirect to yours');
            redirectTo('/user/profile');
         }
      }
   }

   public function edit_profile()
   {
      $this->view('user/editprofile', [
         'title' => "Edit Profile",
         'user' => $this->user
      ]);
   }


   public function edit_details()
   {
      // if request method is get
      if ($this->request_method('GET')) {
         $this->view('user/editdetails', [
            'title' => "Edit Details",
            'user' => $this->user
         ]);
      }

      // If request method is post
      if ($this->request_method('POST')) {

         $errors = [];



         // Validate first name
         if (!empty($this->POST['first_name'])) {
            if (strlen($this->POST['first_name']) < 3)
               $errors['first_name'] = 'First name should contains at least 3 letters!';
         } else {
            $errors['first_name'] = 'Please enter first name!';
         }

         // Validate last name
         if (!empty($this->POST['last_name'])) {
            if (strlen($this->POST['last_name']) < 3)
               $errors['last_name'] = 'Last name should contains at least 3 letters!';
         } else {
            $errors['last_name'] = 'Please enter last name!';
         }

         // Validate last mobile number
         $telphone_regexe = "/^(\+\d{1,3})?(\d+)(-?)(\d+)$/";
         if (!empty($this->POST['mobile_number'])) {
            if (!preg_match($telphone_regexe, $this->POST['mobile_number']))
               $errors['mobile_number'] = 'Invalid mobile number!';
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
         if (empty($this->POST['address_line_1']))
            $errors['address_line_1'] = 'Please enter at least address line 1!';

         // Validate post code
         if (!empty($this->POST['postcode'])) {
            if (!preg_match("/^\d{1,12}$/", $this->POST['postcode']))
               $errors['postcode'] = 'Invalid postcode!';
         } else {
            $errors['postcode'] = 'Please enter post code!';
         }

         // Validate current_location
         if (empty($this->POST['current_location']))
            $errors['current_location'] = 'Please enter you state/region!';

         // Validate sate and region
         if (empty($this->POST['state']))
            $errors['state'] = 'Please enter you state/region!';


         // Check if there is no error then submit the form
         if (count($errors) == 0) {

            $this->userModel->updateUser($this->POST, $_SESSION['user_id']);
            flash_message("warning", "<b>You have changed your details !!</b>");
            redirectTo('/user/edit_profile');
         } else {
            $this->view('user/editdetails', [
               'title' => "Edit Details",
               'form_data' => $this->POST,
               'errors' => $errors,
               'user' => $this->user
            ]);
         }
      }
   }


   public function change_password()
   {

      if ($this->request_method('GET')) {
         $this->view('user/changepassword', [
            'title' => "Change Password",
            'user' => $this->user
         ]);
      }

      if ($this->request_method('POST')) {

         $errors = [];
         $post = $this->POST;

         // Validate Password
         if (!empty($post['old_password'])) {
            if (!password_verify($post['old_password'], $this->user['password'])) {
               $errors['old_password'] = 'Your old password is not correct!';
            } else {

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
            }
         } else {
            $errors['old_password'] = 'Please enter password!';
         }

         // Check if there is no error then submit the form
         if (count($errors) == 0) {
            // Hash the password before create a user
            $post['re_new_password'] = password_hash($post['re_new_password'], PASSWORD_DEFAULT);

            $this->userModel->updateUserPass($post['re_new_password'], $_SESSION['user_id']);

            flash_message("warning", "<b>You have changed your password!!</b>");
            redirectTo('/user/edit_profile');
         } else {
            $this->view('user/changepassword', [
               'title' => 'Change Password',
               'form_data' => $post,
               'errors' => $errors,
               'user' => $this->user
            ]);
         }
      }
   }


   // Chenage Email Rounte
   public function change_email()
   {



      if ($this->request_method('GET')) {
         $this->view('user/change_email', [
            'title' => "Change Email",
            'user' => $this->user
         ]);
      }

      if ($this->request_method('POST') && isset($this->POST['change_email_request'])) {

         $errors = [];
         $post = $this->POST;


         // Validate last Email
         if (!empty($post['email'])) {

            if (filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {

               list($username, $domain) = explode('@', $post['email']);
               if (checkdnsrr($domain, 'MX')) {
                  if ($this->userModel->findUserByEmail($post['email'])) {
                     $errors['email'] = 'This email has already been registered!';
                  }
               } else {
                  $errors['email'] = "Invalid email dns";
               }
            } else {
               $errors['email'] = 'Invalid email format!';
            }
         } else {

            $errors['email'] = 'Please enter email!';
         }

         // Check if there is no error then submit the form
         if (count($errors) == 0) {

            // Send Verfication Code and set it to a session

            $_SESSION['changed_email_request'] = $post['email'];

            send_verification_code([
               'email' => $post['email'],
               'name' => $this->user['first_name'] . ' ' . $this->user['last_name'],
            ]);

            $this->view('user/verify_changed_email', [
               'title' => 'Verify Email',
               'user' => $this->user
            ]);
         } else {
            $this->view('user/change_email', [
               'title' => 'Change Email',
               'form_data' => $post,
               'errors' => $errors,
               'user' => $this->user
            ]);
         }
      }


      // finally verify the new email
      if ($this->request_method('POST') && isset($this->POST['verify_changed_email_request']) && isset($_SESSION['changed_email_request'])) {

         $errors = [];
         $post = $this->POST;

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

            $this->userModel->updateUserEmail([
               'user_id' => $_SESSION['user_id'],
               'user_email' => $_SESSION['changed_email_request']
            ]);

            $_SESSION['user_email'] = $_SESSION['changed_email_request'];

            unset($_SESSION['changed_email_request']);
            unset($_SESSION['verficaion_code_info']);



            flash_message("success", "<b>Your email has been Changed!!</b>");

            redirectTo('/user/edit_profile');
         } else {

            $this->view('user/verify_changed_email', [
               'title' => 'Verifiy Your Account',
               'user' => $this->user,
               'errors' => $errors,
               'form_data' => $this->POST,
            ]);
         }
      } else {
         http_response_code(401);
      }
   }


   // change avater rounte
   public function change_avater()
   {


      if ($this->request_method('GET')) {
         $this->view('user/changeavatar', [
            'title' => "Change Avtar",
            'user' => $this->user
         ]);
      }

      if ($this->request_method('POST')) {

         $errors = '';
         $img = $_FILES['avatar'];

         if (!$img['error']) {

            $file_size = $img['size'];
            $temp_img = $img['tmp_name'];
            $inital_image_type = $img['type'];

            if ($inital_image_type == "image/jpeg" || $inital_image_type ==  "image/png") {

               if ($file_size < MAX_AVTAR_SIZE) {
                  $image_info = getimagesize($temp_img);

                  if (!$image_info) {
                     $errors = "Invalid Image!";
                  }
               } else {
                  $errors = "Image size must be < 120 kb, please check the requirements!";
               }
            } else {
               $errors = "Not a valid image type, please check the requirements!";
            }
         } else {
            $errors = 'Choose an image!';
         }


         if ($errors == '') {

            $final_image_name = "avater_" . $_SESSION['user_id'] . '.jpg';
            $fileDestination = STATIC_DIR . '\\avatar\\' . $final_image_name;

            $this->userModel->updateAvater($final_image_name, $_SESSION['user_id']);
            move_uploaded_file($temp_img, $fileDestination);

            $_SESSION['avatar_path'] = $final_image_name;

            flash_message("warning", "<b>You have changed your avater!!</b>");
            redirectTo('/user/edit_profile');
         } else {
            $this->view('user/changeavatar', [
               'title' => "Change Avtar",
               'user' => $this->user,
               'errors' => [
                  'avatar' => $errors
               ]
            ]);
         }
      }
   }

   // Set bio
   public function set_bio()
   {

      if ($this->request_method('GET')) {
         $this->view('user/setbio', [
            'title' => "Set Bio",
            'user' => $this->user
         ]);
      }

      if ($this->request_method('POST')) {

         $errors = [];

         // Validate Password
         if (!empty($this->POST['bio']) && strlen($this->POST['bio']) > 140) {
            $errors['bio'] = "Please, descibe in 140 characters";
         }

         // Check if there is no error then submit the form
         if (count($errors) == 0) {
            $this->userModel->setBio($this->POST['bio'], $_SESSION['user_id']);

            if (empty($this->POST['bio'])) {
               flash_message("warning", "<b>Your bio has been cleared!!</b>");
            } else {
               flash_message("success", "<b>Your bio has been created!!</b>");
            }

            redirectTo('/user/edit_profile');
         } else {
            $this->view('user/setbio', [
               'title' => 'Set Bio',
               'form_data' => $this->POST,
               'errors' => $errors,
               'user' => $this->user
            ]);
         }
      }
   }


   // Add social links
   public function add_social()
   {

      if ($this->request_method('GET')) {
         $this->view('user/add_socials', [
            'title' => "Add Social Links",
            'user' => $this->user
         ]);
      }

      if ($this->request_method('POST')) {
         $this->userModel->addSocials(json_encode($this->POST), $_SESSION['user_id']);
         flash_message("warning", "<b>Social links have been updated!!</b>");
         redirectTo('/user/edit_profile');
      }
   }


   // Close account and delete
   public function close_account()
   {

      if (!is_admin()) {

         if ($this->request_method('GET')) {

            $this->view('user/close_account', [
               'title' =>  'Close Account',
               'user' => $this->user
            ]);
         }


         if ($this->request_method('POST')) {


            $errors = [];

            if (!empty($this->POST['password'])) {
               if (!password_verify($this->POST['password'],   $this->user['password'])) {
                  $errors['password'] = 'Incorrect password!!';
               }
            } else {
               $errors['password'] = "Please, enter your password!!";
            }

            if (count($errors) == 0) {


               // Remove user avatar
               if ($this->user['avatar_path'] != $_ENV['DEFAULT_PROFILE_AVATER_MALE'] && $this->user['avatar_path'] != $_ENV['DEFAULT_PROFILE_AVATER_FEMALE']) {
                  $avatar_img_path = STATIC_DIR . '\\avatar\\' . $this->user['avatar_path'];

                  if (file_exists($avatar_img_path)) {
                     unlink($avatar_img_path);
                  }
               }


               // Delete user 
               if ($this->userModel->deleteUser($this->user['id'])) {

                  (new \models\ModelRememberMe)->deleteUsersXsTokens($this->user['id']);
                  flash_message('success', 'Your has been removed permanently, you can\'t login anymore!');
                  redirectTo('/');
               }

               flash_message('danger', 'Your account is removed!!');
            } else {
               $this->view('user/close_account', [
                  'title' =>  'Close Account',
                  'user' => $this->user,
                  'form_data' => $this->POST,
                  'errors' => $errors
               ]);
            }
         }
      } else {
         redirectTo('/');
      }
   }

   // signout handler 
   public function signout()
   {

      // if user is cookie based
      if (isset($_SESSION['xs_id'])) {

         echo $_SESSION['xs_id'];
         echo $_SESSION['user_id'];
         (new \models\ModelRememberMe)->deleteExpiredXs($_SESSION['user_id'], $_SESSION['xs_id']);
      }

      unset_user_session();

      // Clear auth cookie
      if (isset($_COOKIE['xs'])) {
         setcookie('xs', null, time() - 3600, '/');
         setcookie('user_id', null, time() - 3600, '/');
      }


      flash_message('info', "<b>You have been signed out!!</b>");

      redirectTo('/');
   }
}
