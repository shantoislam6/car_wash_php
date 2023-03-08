<?php

namespace controllers;


class ControllerPages extends \lib\Controller
{
   protected $serviceModel;

   // middleware
   public function __construct()
   {

      // create service model
      $this->serviceModel = new \models\ModelService;
   }

   public function index()
   {
      redirectTo('/status/notfound', ['message' => "Page Not Fount! 404!"]);
   }

   public function contact()
   {

      if ($this->request_method('GET')) {

         $this->view('pages/contact',  [
            'title' => "Contact",
         ]);
      }

      if ($this->request_method('POST')) {
         $post = $this->sanitize_post_request();

         $errors = [];

         if (!empty($post['name'])) {
            if (strlen($post['name']) < 4) {
               $errors['name'] = 'Name should at least contain 4 characters!';
            }
         } else {
            $errors['name'] = 'Please enter you name!';
         }


         if (!empty($post['email'])) {

            if (filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
               list($username, $domain) = explode('@', $post['email']);

               if (!checkdnsrr($domain, 'MX')) {
                  $errors['email'] = "Invalid email dns!";
               }
            } else {
               $errors['email'] = 'Invalid email format!';
            }
         } else {
            $errors['email'] = 'Please enter email!';
         }

         if (empty($post['message'])) {
            $errors['message'] = 'Message required!';
         }


         if (!empty($post['message'])) {
            if (strlen($post['message']) < 21) {
               $errors['message'] = 'Minimum message length is 20 characters!';
            }
            if (strlen($post['message']) > 299) {
               $errors['message'] = 'Maximum message length is 300 characters!';
            }
         } else {
            $errors['message'] = 'Message required!';
         }



         if (count($errors) == 0) {
       
            try {

               $mail = init_mail();

               $mail->setFrom($post['email'], $post['name']);

               $mail->addAddress($_ENV['CONTACT_MAIL'], SITENAME . ' - ' . $_ENV['CONTACT_MAIL_NAME']);
               $mail->addReplyTo($post['email']);

               $mail->isHTML(true);
               $mail->Subject = $_ENV['CONTACT_SUBJECT'];
               $mail->Body    = '<p>' . $post['message'] . '</p>';
               $mail->AltBody = $post['message'];
               $mail->send();
               flash_message('warning', "<b>Messaged has been sent!</b> Thanks for let's us know!!");
               $post = [];
            } catch (\PHPMailer\PHPMailer\Exception $e) {
               flash_message('warning', "Messaged hasn't been sent! Please try again!!");
            }
         }

         $this->view('pages/contact', [
            'title' => "Contact",
            'errors' => $errors,
            'form_data' => $post
         ]);
      }
   }


   public function services()
   {
      $this->view('pages/services', [
         'title' => "Services",
         'services' => $this->serviceModel->getAllServices()
      ]);
   }


   public function service_view($id = '')
   {

      $service = $this->serviceModel->getService($id);
      if (!$service) {
         redirectTo('/pages/services');
      }

      $this->view('pages/service_view', [
         'title' => "Service Name",
         'service' => $service
      ]);
   }
}
