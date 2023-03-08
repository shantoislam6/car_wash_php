<?php

namespace controllers;

use Exception;
use models\ModelUser;

class ControllerCustomers extends \lib\Controller
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


      // check user verfied or not
      if (!is_verified_user() && !matchRoute('/user/signout') && !matchRoute('/user/verify')) {
         redirect('/user/verify');
         exit;
      }



      // Retreive User Model
      $this->userModel = new \models\ModelUser;


      // Prevent xss attack
      $this->POST = $this->sanitize_post_request();
      $this->GET = $this->sanitize_get_request();

      // Retrieve User from database based on session data
      $this->user = $this->userModel->findUserById($_SESSION['user_id']);
   }

   public function index()
   {
      if (is_admin()) {
         $this->view('/customers/customers', [
            'title' => 'Customers',
            'customers' => $this->userModel->getCustomers()
         ]);
      } else {
         http_response_code(401);
      }
   }

   // delete_customer

   public function delete_customer($id = '')
   {

      if (is_admin()) {
         $id = $this->request_method('POST') ? $this->POST['delete_id'] : $id;

         $customer = $this->userModel->findUserById($id);

         if (!$customer) {
            redirectTo('/pages/services');
         }

         if ($this->request_method('GET')) {
            $this->view('/customers/delete_customer', [
               'title' => 'Delete Customer',
               'user' => $customer
            ]);
         }

         if ($this->request_method('POST')) {

            $errors = [];


            if (!empty($this->POST['delete_note'])) {
               if (strlen($this->POST['delete_note']) < 20 || strlen($this->POST['delete_note']) > 160) {
                  $errors['delete_note'] = 'The minimum characters 20 and the maximum character 160';
               }
            } else {
               $errors['delete_note'] = 'Tell the customer a  reason why you wanna delete!';
            }

            if (count($errors) == 0) {

               try {


                  $mail = init_mail();


                  $name = $customer['first_name'] . ' ' . $customer['last_name'];
                  $mail->setFrom($_SESSION['user_email'], 'Admin of ' . SITENAME);
                  $mail->addAddress($customer['email'], $name);
                  $mail->addReplyTo($_SESSION['user_email'], 'Admin of ' . SITENAME);


                  //Content
                  $mail->isHTML(true);
                  $mail->Subject = 'Your Car Wash Account Has Been Deleted!!';
                  $mail->Body    = '<b>' . $name . '</b> Your account has been deleted!<hr><p>Dear Customer,<br>' . $this->POST['delete_note'] . '</p>';
                  $mail->AltBody = $name . ' Your account has been deleted!Dear Customer,' . $this->POST['delete_note'];
                  $mail->send();



                  // Remove user / customar avatar
                  if ($customer['avatar_path'] != $_ENV['DEFAULT_PROFILE_AVATER_MALE'] && $customer['avatar_path'] != $_ENV['DEFAULT_PROFILE_AVATER_FEMALE']) {
                     $avatar_img_path = STATIC_DIR . '\\avatar\\' . $customer['avatar_path'];

                     if (file_exists($avatar_img_path)) {
                        unlink($avatar_img_path);
                     }
                  }

                  // Delete customer/ user 
                  if ($this->userModel->deleteUser($customer['id'])) {
                     (new \models\ModelRememberMe)->deleteUsersXsTokens($customer['id']);
                     flash_message('success', 'Customer has been deleted!');
                     redirect('/customers');
                  }
               } catch (Exception $e) {

                  redirectTo('/customers/delete_customer/' . $customer['id']);
                  flash_message('danger', 'Something went wrong! Please, try again!!');
               }
            } else {
               $this->view('/customers/delete_customer', [
                  'title' => 'Delete Customer',
                  'user' => $customer,
                  'errors' => $errors,
                  'form_data' => $this->POST
               ]);
            }
         }
      } else {
         redirectTo('/');
      }
   }
}
