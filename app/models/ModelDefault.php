<?php

namespace models;

class ModelDefault
{
   private $db;
   public function __construct()
   {
      $this->db = new \lib\Database;
   }

   public function findUserByEmail($email)
   {
      return [];
   }
}
