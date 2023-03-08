<?php

namespace controllers;


class ControllerStatic extends \lib\Controller
{
   protected  $defaultModel;

   public function __construct()
   {
      $this->defaultModel = new \models\ModelDefault;

   }

   public function index($file_name = '')
   {
      $site_path = STATIC_DIR . '\\sites\\' . 'index.html';
      $this->resfile($site_path);
   }

   public function img($file_name = '')
   {
      $site_path = STATIC_DIR . '\\sites\\img\\' . $file_name;


      $this->resfile($site_path);
   }

   public function css($file_name = '')
   {
      $site_path = STATIC_DIR . '\\sites\\css\\' . $file_name;
      $this->resfile($site_path, 'text/css;X-Content-Type-Options: nosniff;');
   }

   public function js($file_name = '')
   {
      $site_path = STATIC_DIR . '\\sites\\js\\' . $file_name;
      $this->resfile($site_path, 'application/javascript;X-Content-Type-Options: nosniff;');
   }


   public function avatar($file_name = '')
   {
      if (!empty($file_name)) {
         $file_path = STATIC_DIR . '\\avatar\\' . $file_name;
         $this->resfile($file_path);
      } else
         http_response_code(404);
   }

   public function service_covers($file_name = '')
   {
      if (!empty($file_name)) {
         $file_path = STATIC_DIR . '\\service\\cover\\' . $file_name;
         $this->resfile($file_path);
      } else
         http_response_code(404);
   }

   public function service_thumbnails($file_name = '')
   {

      if (!empty($file_name)) {
         $file_path = STATIC_DIR . '\\service\\thumbnails\\' . $file_name;
         $this->resfile($file_path);
      } else
         http_response_code(404);
   }
}
