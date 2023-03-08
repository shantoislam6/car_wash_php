<?php

namespace models;


class ModelService
{
   private $db;
   public function __construct()
   {
      $this->db = new \lib\Database;
   }

   // Create Service
   public function createService($data)
   {
      $sql = "INSERT INTO services (user_id, title, car_types, optional_services_id, cover_img, thumbnail_img, description, body, created_at, price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
      $this->db->query($sql);
      $this->db->execute([
         $data['user_id'], $data['title'], json_encode($data['car_types']),
         json_encode($data['optional_services']), $data['cover_img'],
         $data['thumbnail_img'], $data['description'],
         $data['body'], time(), $data['price']

      ]);
      return $this->db->lastInsertId();
   }

   // Update Service
   public function updateService($data, $id)
   {
      $sql = "UPDATE services SET user_id = ?, title = ?, car_types = ?, optional_services_id = ?, cover_img = ?, thumbnail_img = ?, description = ?, body = ?, created_at = ?,  price = ? WHERE id = ?;";
      $this->db->query($sql);
      $this->db->execute([
         $data['user_id'], $data['title'],
         json_encode($data['car_types']),
         json_encode($data['optional_services']),
         $data['cover_img'], $data['thumbnail_img'],
         $data['description'], $data['body'],
         time(), $data['price'], $id
      ]);
   }

   // Delete Service 
   public function deteleService($id)
   {
      $this->db->query("DELETE FROM services WHERE id = ?");
      $this->db->execute([$id]);
   }

   // Retrive all services rows
   public function getAllServices()
   {
      $this->db->query("SELECT * FROM services ORDER BY created_at DESC");
      return $this->db->fetchAssocAll();
   }

   // Retrive one service based on id
   public function getService($id)
   {
      $this->db->query("SELECT * FROM services WHERE id = ?");
      return $this->db->fetchAssoc([$id]);
   }


   // Optional service

   public function createOptionalService($data)
   {

      $sql = "INSERT INTO optional_services (title, description, price, user_id, created_at) VALUES (?, ?, ?, ?, ?);";
      $this->db->query($sql);
      $this->db->execute([
         $data['title'], $data['description'],
         $data['price'], $data['user_id'], time(),
      ]);
      return $this->db->lastInsertId();
   }

   // Retrive all optional services rows
   public function getAllOptionalServices()
   {
      $this->db->query("SELECT * FROM optional_services ORDER BY created_at DESC");
      return $this->db->fetchAssocAll();
   }

   // Delete Service 
   public function deteleOptionalService($id)
   {
      $this->db->query("DELETE FROM optional_services WHERE id = ?");
      $this->db->execute([$id]);
   }


   public function findOptionalService($id)
   {
      $this->db->query("SELECT * FROM optional_services WHERE id = ?");
      return $this->db->fetchObj([$id]);
   }


   // Add car type to car_types table
   public function addCarType($car_type, $user_id)
   {
      $this->db->query("INSERT INTO car_types (car_type, created_at, user_id) VALUES (?, ?, ?);");
      $this->db->execute([$car_type, time(), $user_id]);
   }

   // retrive all car_type rows
   public function getAllCarTypes()
   {
      $this->db->query("SELECT * FROM car_types ORDER BY created_at DESC");
      return $this->db->fetchAssocAll();
   }

   // find car types by car_type
   public function findCarType($car_type)
   {
      $this->db->query("SELECT * FROM car_types WHERE car_type = ?");
      return $this->db->fetchObj([$car_type]);
   }

   public function deleteCarType($car_type_delete)
   {

      $this->db->query("DELETE FROM car_types WHERE car_type = ?");
      $this->db->execute([$car_type_delete]);
   }
}
