<?php

namespace controllers;

class ControllerServices extends \lib\Controller
{

   protected  $serviceModel;
   protected  $userModel;
   protected $user;
   protected $POST;
   protected $GET;

   public function __construct()
   {


      // check where user authenticate or not
      if (!is_auth_user()) {
         flash_message('info', "<b>Please </b> Login first!! Or if you don't have and account then create one!!");
         redirectTo('/signin');
      }



      // check user verfied or not
      if (!is_verified_user() && !matchRoute('/user/signout') && !matchRoute('/user/verify')) {
         redirect('/user/verify');
      }


      // Prevent xss attack
      $this->POST = $this->sanitize_post_request();
      $this->GET = $this->sanitize_get_request();


      // Define Service Model
      $this->serviceModel = new \models\ModelService;

      // Define User Model  
      $this->userModel = new \models\ModelUser;
   }

   public function index()
   {
      redirectTo('/status/notfound', ['message' => "Page Not Fount! 404!"]);
   }

   // Car typs add, view and delete
   public function car_types()
   {
      if (is_admin()) {


         $car_types = $this->serviceModel->getAllCarTypes();

         if ($this->request_method('GET')) {

            $this->view('services/cartypes', [
               'title' => "Car Type",
               'car_types' => $car_types,
            ]);
         }


         if ($this->request_method('POST')) {

            $errors = [];


            if (!empty($this->POST['car_type_delete'])) {
               if ($this->serviceModel->findCarType($this->POST['car_type_delete'])) {

                  $this->serviceModel->deleteCarType($this->POST['car_type_delete']);
                  flash_message('success', 'Car type has been deleted!!');
               } else {
                  flash_message('danger', 'Car type is not exist in your list!!');
               }

               redirectTo('/services/car_types');
            }


            if (!empty($this->POST['car_type'])) {
               if ($this->serviceModel->findCarType($this->POST['car_type'])) {
                  $errors['car_type'] = 'This car type has already been added!!';
               }
            } else {
               $errors['car_type'] = 'Please enter a car type!!';
            }

            if (count($errors) == 0) {

               $this->serviceModel->addCarType($this->POST['car_type'], $_SESSION['user_id']);
               flash_message('success', '\'' . $this->POST['car_type'] . '\' has been added to car type list!!');
               redirectTo('/services/car_types');
            } else {
               $this->view('services/cartypes', [
                  'title' => "Car Type",
                  'form_data' => $this->POST,
                  'errors' => $errors,
                  'car_types' => $car_types,
               ]);
            }
         }
      } else {
         redirectTo('/');
      }
   }

   //optional services 

   public function optional_services()
   {

      if (is_admin()) {

         $errors = [];

         if ($this->request_method('POST')) {

            if (!empty($this->POST['optional_service_delete_id'])) {

               if ($this->serviceModel->findOptionalService($this->POST['optional_service_delete_id'])) {

                  $this->serviceModel->deteleOptionalService($this->POST['optional_service_delete_id']);
                  flash_message('success', 'Optional service has been deleted!!');
               } else {
                  flash_message('danger', 'Optional service is not exist in your list!!');
               }


               redirectTo('/services/optional_services');
            }


            if (!empty($this->POST['title'])) {
               if (strlen($this->POST['title']) > 25) {
                  $errors['title'] = 'The Maximmum characters length of title is 25!!';
               }
            } else {
               $errors['title'] = 'Please enter a title!!';
            }

            if (!empty($this->POST['description'])) {
               if (strlen($this->POST['description']) > 75) {
                  $errors['description'] = 'The Maximmum characters length of description is 75!!';
               }
            } else {
               $errors['description'] = 'Please enter description!!';
            }

            if (!empty($this->POST['price'])) {
               if (!is_numeric($this->POST['price'])) {
                  $errors['price'] = "Price is not a valid number!!";
               }
            } else {
               $errors['price'] = 'Please enter the price!!';
            }

            if (count($errors) == 0) {
               $this->POST['user_id'] =  $_SESSION['user_id'];
               $this->serviceModel->createOptionalService($this->POST);
               flash_message("success", "Optional service has been created!!");
               redirect('/services/optional_services');
            }
         }


         $this->view('/services/optional_services', [
            'title' => 'Optional Services',
            'form_data' => $this->POST,
            'errors' => $errors,
            'optional_services' => $this->serviceModel->getAllOptionalServices()
         ]);
      } else {
         redirectTo('/');
      }
   }


   public function create()
   {
      if (is_admin()) {

         $car_types = $this->serviceModel->getAllCarTypes();
         $optional_services = $this->serviceModel->getAllOptionalServices();
         $errors = [];

         if ($this->request_method('POST')) {


            if (!empty($this->POST['title'])) {

               if (strlen($this->POST['title']) > 25) {
                  $errors['title'] = 'The maxmum lenght of title is 25!!';
               }
            } else {
               $errors['title'] = 'Please, Enter the title!!';
            }


            $cover_img = $_FILES['cover_img'];

            if (!$cover_img['error']) {

               $file_size = $cover_img['size'];

               $temp_img = $cover_img['tmp_name'];

               if ($cover_img['type'] == "image/jpeg" || $cover_img['type'] ==  "image/png") {

                  if ($file_size < 2097152) {
                     $image_info = getimagesize($temp_img);

                     if (!$image_info) {
                        $errors['cover_img'] = "Invalid Image!";
                     }
                  } else {
                     $errors['cover_img'] = "Image size must be < 2mb, please check the requirements!";
                  }
               } else {
                  $errors['cover_img'] = "Not a valid image type, please check the requirements!";
               }
            } else {
               $errors['cover_img'] = 'Choose a cover image!';
            }




            if (!empty($_POST['car_types'])) {

               foreach ($_POST['car_types'] as $car_type) {
                  if (!$this->serviceModel->findCarType($car_type)) {
                     $errors['car_types'] = 'Sorry! Invalid car types!!';
                     break;
                  }
               }
            } else {
               $errors['car_types'] = 'Please, Select car types!!';
            }


            if (!empty($_POST['optional_services'])) {

               foreach ($_POST['optional_services'] as $optional_service) {
                  if (!$this->serviceModel->findOptionalService($optional_service)) {
                     $errors['optional_services'] = 'Sorry! Invalid optional service!!';
                     break;
                  }
               }
            }



            if (!empty($this->POST['description'])) {

               if (strlen($this->POST['description']) > 75) {
                  $errors['description'] = 'The maxmum lenght of title is 75!!';
               }
            } else {
               $errors['description'] = 'Please, Enter the description!!';
            }

            if (!empty($this->POST['price'])) {

               if (!is_numeric($this->POST['price'])) {
                  $errors['price'] = 'Price must be a number!!';
               } else {
                  $this->POST['body'] = $_POST['body'];
               }
            } else {
               $errors['price'] = 'Please, Enter the price in cents!!';
            }


            if (empty($this->POST['body'])) {
               $errors['body'] = 'Please, Enter a description!!';
            }


            if (count($errors) == 0) {

               $ext = pathinfo($cover_img['name'], PATHINFO_EXTENSION);

               // Set specific file name
               $cover_img_name = 'service_cover_img_' . time() . '.' . $ext;
               $thumb_img_name = 'service_thumb_img_' . time() . '.' . $ext;

               // Set specific path 
               $cover_img_path = STATIC_DIR . '\\service\\cover\\' . $cover_img_name;
               $thumb_img_path = STATIC_DIR . '\\service\\thumbnails\\' . $thumb_img_name;

               // Upload the service img to specific destination
               move_uploaded_file($temp_img, $cover_img_path);
               resize_image($cover_img_path, $thumb_img_path, 350, 250);

               // Map $user_id, $cover_img_url and $thumb_img_url to $this->POST 
               $this->POST['user_id'] = $_SESSION['user_id'];
               $this->POST['cover_img'] =  $cover_img_name;
               $this->POST['thumbnail_img'] = $thumb_img_name;

               $this->serviceModel->createService($this->POST);
               flash_message('success', "<b>The Service has been Created!!</b>");
               redirectTo('/pages/services/');
            }
         }


         $this->view('/services/create_service', [
            'title' => 'Add Service',
            'form_data' => $this->POST,
            'car_types' => $car_types,
            'optional_services' => $optional_services,
            'errors' => $errors
         ]);
      } else {
         redirectTo('/');
      }
   }

   // Delete services
   public function delete($id = '')
   {
      if (is_admin()) {
         $id = $this->request_method('POST') ? $this->POST['delete_id'] : $id;

         $service = $this->serviceModel->getService($id);

         if (!$service) {
            redirectTo('/pages/services');
         }

         if ($this->request_method('GET')) {
            $this->view('/services/delete_service_prompt', [
               'title' => 'Delete Service',
               'service' => $service
            ]);
         }

         if ($this->request_method('POST')) {

            // Delete service related image from static directory
            $cover_img_path = STATIC_DIR . '\\service\\cover\\' . $service['cover_img'];
            $thumbnail_img_path = STATIC_DIR . '\\service\\thumbnails\\' . $service['thumbnail_img'];

            if (file_exists($cover_img_path) && file_exists($thumbnail_img_path)) {
               unlink($cover_img_path);
               unlink($thumbnail_img_path);
            }

            $this->serviceModel->deteleService($id);
            flash_message('success', 'Service has been delete!');
            redirect('/pages/services');
         }
      } else {
         redirectTo('/');
      }
   }

   public function edit($id = '')
   {
      if (is_admin()) {

         $car_types = $this->serviceModel->getAllCarTypes();
         $id = $this->request_method('POST') ? $this->POST['edit_id'] : $id;
         $service = $this->serviceModel->getService($id);
         $optional_services = $this->serviceModel->getAllOptionalServices();

         $errors = [];

         if (!$service) {
            redirectTo('/pages/services');
         }


         if ($this->request_method('POST')) {


            if (!empty($this->POST['title'])) {

               if (strlen($this->POST['title']) > 25) {
                  $errors['title'] = 'The maxmum lenght of title is 25!!';
               }
            } else {
               $errors['title'] = 'Please, Enter the title!!';
            }

            if (!empty($_POST['car_types'])) {

               foreach ($_POST['car_types'] as $car_type) {
                  if (!$this->serviceModel->findCarType($car_type)) {
                     $errors['car_types'] = 'Sorry! Invalid car types!!';
                     break;
                  }
               }
            } else {
               $errors['car_types'] = 'Please, Select car types!!';
            }



            if (!empty($_POST['optional_services'])) {

               foreach ($_POST['optional_services'] as $optional_service) {
                  if (!$this->serviceModel->findOptionalService($optional_service)) {
                     $errors['optional_services'] = 'Sorry! Invalid optional service!!';
                     break;
                  }
               }
            }



            $cover_img = $_FILES['cover_img'];

            if (!$cover_img['error']) {

               $file_size = $cover_img['size'];

               $temp_img = $cover_img['tmp_name'];

               if ($cover_img['type'] == "image/jpeg" || $cover_img['type'] ==  "image/png") {

                  if ($file_size < 2097152) {
                     $image_info = getimagesize($temp_img);

                     if (!$image_info) {
                        $errors['cover_img'] = "Invalid Image!";
                     } else {
                        $img_include = true;
                     }
                  } else {
                     $errors['cover_img'] = "Image size must be < 2mb, please check the requirements!";
                  }
               } else {
                  $errors['cover_img'] = "Not a valid image type, please check the requirements!";
               }
            } else {
               $img_include = false;
            }


            if (!empty($this->POST['description'])) {

               if (strlen($this->POST['description']) > 75) {
                  $errors['description'] = 'The maxmum lenght of title is 75!!';
               }
            } else {
               $errors['description'] = 'Please, Enter the description!!';
            }

            if (!empty($this->POST['price'])) {

               if (!is_numeric($this->POST['price'])) {
                  $errors['price'] = 'Price must be a number!!';
               } else {
                  $this->POST['body'] = $_POST['body'];
               }
            } else {
               $errors['price'] = 'Please, Enter the price in cents!!';
            }


            if (empty($this->POST['body'])) {
               $errors['body'] = 'Please, Enter a description!!';
            }


            if (count($errors) == 0) {

               $cover_img_name = $service['cover_img'];
               $thumb_img_name = $service['thumbnail_img'];


               if ($img_include) {

                  // Delete service related image from static directory
                  $del_cover_img_path = STATIC_DIR . '\\service\\cover\\' . $cover_img_name;
                  $del_thumbnail_img_path = STATIC_DIR . '\\service\\thumbnails\\' . $thumb_img_name;

                  if (file_exists($del_cover_img_path) && file_exists($del_thumbnail_img_path)) {
                     unlink($del_cover_img_path);
                     unlink($del_thumbnail_img_path);
                  }


                  $ext = pathinfo($cover_img['name'], PATHINFO_EXTENSION);

                  // Set specific file name
                  $cover_img_name = 'service_cover_img_' . time() . '.' . $ext;
                  $thumb_img_name = 'service_thumb_img_' . time() . '.' . $ext;

                  // Set specific path 
                  $cover_img_path = STATIC_DIR . '\\service\\cover\\' . $cover_img_name;
                  $thumb_img_path = STATIC_DIR . '\\service\\thumbnails\\' . $thumb_img_name;

                  // Upload the service img to specific destination
                  move_uploaded_file($temp_img, $cover_img_path);
                  resize_image($cover_img_path, $thumb_img_path, 350, 250);
               }


               // Map $user_id, $cover_img_url and $thumb_img_url to $this->POST 
               $this->POST['user_id'] = $_SESSION['user_id'];
               $this->POST['cover_img'] =  $cover_img_name;
               $this->POST['thumbnail_img'] = $thumb_img_name;

               $this->serviceModel->updateService($this->POST, $id);

               flash_message('success', "<b>The Service has been Updated!!</b>");
               redirectTo('/pages/service_view/' . $id);
            }
         }


         $this->view('/services/edit_service', [
            'title' => 'Add Service',
            'form_data' => $this->POST,
            'errors' => $errors,
            'car_types' => $car_types,
            'optional_services' => $optional_services,
            'service' => $service
         ]);
      } else {
         redirectTo('/');
      }
   }



   // Customer booing a service
   public function book($id = '')
   {


      // id, 

      if (!is_admin()) {

         $service = $this->serviceModel->getService($id);


         if ($service) {

            if ($this->request_method('GET')) {
               $this->view('services/book', [
                  'title' => "Book Wash Service",
                  'service' => $service,
                  'user_details' => $this->userModel->getUserDetails($_SESSION['user_id'])
               ]);
            }

            if ($this->request_method('POST')) {

               echo "this is a post request to book a services";
            }
         } else {
            flash_message('warning', 'Sorry,this route has no authorization');
            redirect(prev_url());
         }
      } else {
         flash_message('warning', 'Sorry, you are a owner!! You can\'t buy anything!!');
         redirectTo('/user/dashboard');
      }
   }


   public function voucher()
   {

      if (!is_admin()) {
         $this->view('services/voucher', [
            'title' => "Gift Voucher",
         ]);
      } else {
         flash_message('warning', 'Sorry, you are a owner!! You can\'t buy anything!!');
         redirectTo('/user/dashboard');
      }
   }
}
