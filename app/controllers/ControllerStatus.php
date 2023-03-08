<?php

namespace controllers;

class ControllerStatus extends \lib\Controller
{  
   protected  $defaultModel;

   public function __construct()
   {
      $this->defaultModel = new \models\ModelDefault;

   }

   public function index()
   {
      
      redirectTo('/status/notfound');
   }

   
   public function notfound(){
      $data = [
         'title' => "Deafult Index"
      ];

      $this->view('status/404', $data);
   }
}

