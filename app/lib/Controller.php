<?php

/**
 *  Base Controller
 *  Load the model and views
 */

namespace lib;

class Controller
{  
      
   // Load model
   public function model($model)
   {
      $model = "\\models\\" . ucfirst($model);

      // Return instantiate defined model
      return new $model();
   }

   // Response Html
   public function view($view, $data)
   {
      $view_file = __DIR__ . '\\..\\..\\views\\' . $view . '.php';
      if (file_exists($view_file)) {
         require_once $view_file;
      } else {
         die($view_file . " View File Not exist");
      }
   }

   // Response Json
   public function resjson($obj)
   {
      // Change Content Type to json
      header('Content-Type: application/json');
      echo json_encode($obj);
   }

   // Response file 
   public function resfile($file_path, $file_type = '')
   {

      if (file_exists($file_path)) {

         $file_size = filesize($file_path);
         $file_type = $file_type == '' ? mime_content_type($file_path) : $file_type;

         //Set the content-type header as appropriate
         header('Content-Type: ' .  $file_type);
         header('Accept-Ranges: bytes');

         //Set the content-length header
         header('Content-Length: ' . $file_size);


         header("Content-Disposition: inline;");
         header("Content-Range: bytes .$file_size");
         header("Content-Transfer-Encoding: binary\n");
         header('Connection: close');

         readfile($file_path);
      } else {
         http_response_code(404);
      }
   }


   // Load Middleware
   public function middleware($middleware)
   {

      $middleware = "\\middlewares\\" . ucfirst($middleware);

      // Return instantiate defined model
      return new $middleware();
   }

   // Santize post request 
   public function sanitize_post_request()
   {
      return $_SERVER['REQUEST_METHOD'] == 'POST' ? filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS) : false;
   }


   // Santize post request 
   public function sanitize_get_request()
   {
      return $_SERVER['REQUEST_METHOD'] == 'GET' ? filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS) : false;
   }

   // check request method
   public function request_method($method){
      return $_SERVER['REQUEST_METHOD'] == $method;
   }
}
