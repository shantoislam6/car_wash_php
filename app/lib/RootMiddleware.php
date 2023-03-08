<?php

/**
 *  Root Middleware
 *  Check all suspect 
 *  
 */

namespace lib;





class RootMiddleware extends \lib\Controller
{


   public function __construct()
   {

      $userModel = new \models\ModelUser;

      $user = false;


      if (isset($_SESSION['user_id'])) {
         $user = $userModel->findUserById($_SESSION['user_id']);
      }

      // Check if there is no user
      if ($userModel->countUser() == 0) {
         unset_user_session();

         if($this->request_method('GET')){
            flash_message('danger', 'You have to create a <b> super Admin </b> first!!');
         }
         (new \controllers\ControllerSignup)->index("Create You As a Super Admin");
         exit;
      }

      if (isset($_SESSION['user_id'])) {
         if (!$user) {
            unset_user_session();
            flash_message("danger", "Your account has been Deleted!!");
            // Clear auth cookie
            if (isset($_COOKIE['xs'])) {
               setcookie('xs', null, time() - 3600, '/');
               setcookie('user_id', null, time() - 3600, '/');
            }
            redirectTo('/');
            exit;
         }
      }

      // Add extra security for super admin
      if (
         is_admin() && !matchRoute('/user/signout') &&
         empty($_SESSION['admin_secrete'])
      ) {

         $errors = [];

         if ($this->request_method('POST')) {

            if (!empty($_POST['admin_secrete'])) {
               if ($_POST['admin_secrete'] == $_ENV['ADMIN_SECRETE']) {

                  $_SESSION['admin_secrete'] = $_ENV['ADMIN_SECRETE'];
                  flash_message('success', 'You has been verified as admin!!');
                  redirectTo('/user/dashboard');
               } else {
                  $errors['admin_secrete'] = 'Invalid admin secrete!!';
               }
            } else {
               $errors['admin_secrete'] = 'Enter admin secrete!!';
            }
         }

         $this->view('admin/admin_verify', [
            'title' => 'Admin Verify',
            'user' => $user,
            'errors' => $errors,
            'form_data' => $_POST
         ]);

         exit;
      }

   }
}
