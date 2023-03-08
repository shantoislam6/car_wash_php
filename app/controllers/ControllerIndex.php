<?php

namespace controllers;


class ControllerIndex extends \lib\Controller
{

   public function __construct()
   {
   }

   public function index()
   {
      if(is_admin()){
         redirect('/user/dashboard');
      }
      $this->view('index', [
         'title' => SITENAME,
         'services' => (new \models\ModelService)->getAllServices()
      ]);
   }
}
