<?php

namespace models;

class ModelUser
{
   private $db;
   public function __construct()
   {
      $this->db = new \lib\Database;
   }


   // create a user
   public function createUser($form_data)
   {
      $this->db->query("INSERT INTO users (role, first_name, last_name, email, mobile_number, gender , address_line_1, address_line_2, postcode, current_location, state, password, is_verified, avatar_path, social_links) VALUES (:role, :first_name, :last_name, :email, :mobile_number, :gender ,:address_line_1, :address_line_2, :postcode, :current_location, :state, :password, :is_verified, :avatar_path, :social_links);");
      $this->db->execute([
         ':role' => $form_data['role'],
         ':first_name' => $form_data['first_name'],
         ':last_name' => $form_data['last_name'],
         ':email' => $form_data['email'],
         ':mobile_number' => $form_data['mobile_number'],
         ':gender' => $form_data['gender'],
         ':address_line_1' => $form_data['address_line_1'],
         ':address_line_2' => $form_data['address_line_2'],
         ':postcode' => $form_data['postcode'],
         ':current_location' => $form_data['current_location'],
         ':state' => $form_data['state'],
         ':password' => $form_data['re_password'],
         ':is_verified' => $form_data['is_verified'],
         ':avatar_path' => $form_data['gender'] == 'male' ? $_ENV['DEFAULT_PROFILE_AVATER_MALE'] : $_ENV['DEFAULT_PROFILE_AVATER_FEMALE'],
         ':social_links' => '{"facebook_username":"","twitter_username":"","linkedin_username":"","user_website":""}'
      ]);

      return $this->db->lastInsertId();
   }


   // Update user table row 
   public function updateUser($form_data, $user_id)
   {
      $this->db->query("UPDATE users SET first_name = :first_name ,  last_name= :last_name , mobile_number = :mobile_number, gender = :gender , address_line_1 = :address_line_1 , address_line_2 = :address_line_2 , postcode = :postcode , current_location = :current_location , state = :state WHERE id = :id");
      $this->db->execute([
         ':first_name' => $form_data['first_name'],
         ':last_name' => $form_data['last_name'],
         ':mobile_number' => $form_data['mobile_number'],
         ':gender' => $form_data['gender'],
         ':address_line_1' => $form_data['address_line_1'],
         ':address_line_2' => $form_data['address_line_2'],
         ':postcode' => $form_data['postcode'],
         ':current_location' => $form_data['current_location'],
         ':state' => $form_data['state'],
         ':id' => $user_id
      ]);
      // return $form_data;
   }

   public function getCustomers()
   {
      $this->db->query("SELECT * FROM `users` WHERE role != 3");
      return $this->db->fetchAssocAll();
   }

   // Retrieve a row from users table 
   public function findUserByEmail($email)
   {
      $this->db->query("SELECT * FROM users WHERE email = :email");
      return $this->db->fetchAssoc([
         ":email" => $email
      ]);
   }

   // Retrieve a row from users table 
   public function findUserById($user_id)
   {
      $this->db->query("SELECT * FROM users WHERE id = :id");
      return $this->db->fetchAssoc([
         ":id" => $user_id
      ]);
   }

   // get user details
   public function getUserDetails($user_id)
   {
      $this->db->query("SELECT first_name, last_name, email, mobile_number, address_line_1, address_line_2, postcode, current_location, state FROM users WHERE id = :id");
      return $this->db->fetchAssoc([
         ":id" => $user_id
      ]);
   }

   // Insert new xs token
   public function insert_xs_token($xs, $user_id)
   {
      $this->db->query("UPDATE users SET xs= :xs WHERE id = :id");
      $this->db->execute([
         ":xs" => $xs,
         ':id' => $user_id
      ]);
   }

   // Update password from user table row
   public function updateUserPass($hassedPassword, $user_id)
   {

      $this->db->query("UPDATE users SET password = :password WHERE id = :id");
      $this->db->execute([
         ':password' => $hassedPassword,
         ':id' => $user_id
      ]);
   }


   // Update user avater column
   public function updateAvater($avatarUrlPath, $user_id)
   {
      $this->db->query("UPDATE users SET avatar_path = :avatar_path WHERE id = :id");
      $this->db->execute([
         ':avatar_path' => $avatarUrlPath,
         ':id' => $user_id
      ]);
   }

   // Update user email column
   public function updateUserEmail($data)
   {
      $this->db->query("UPDATE users SET email = :email WHERE id = :id");
      $this->db->execute([
         ':email' => $data['user_email'],
         ':id' => $data['user_id']
      ]);
   }

   // Set bio

   public function setBio($bio, $user_id)
   {
      $this->db->query("UPDATE users SET bio = ? WHERE id = ?");
      $this->db->execute([$bio, $user_id]);
   }


   // Add social username
   public function addSocials($social_username_json, $user_id)
   {
      $this->db->query("UPDATE users SET social_links = ? WHERE id = ?");
      $this->db->execute([$social_username_json, $user_id]);
   }

   // Change verfied columb
   public function makeVerified($user_id)
   {
      $this->db->query("UPDATE users SET is_verified = :is_verified WHERE id = :id");
      $this->db->execute([
         ':is_verified' => 1,
         ':id' => $user_id
      ]);
   }

   // add user token 
   public function addUserToken($user_token, $email)
   {
      $this->db->query("UPDATE users SET user_token = :user_token WHERE email = :email");
      $this->db->execute([
         ':user_token' => $user_token,
         ':email' => $email
      ]);
   }


   // Delete user row

   public function deleteUser($user_id)
   {
      $this->db->query("DELETE FROM users WHERE id = ?");
      $this->db->execute([$user_id]);
      return true;
   }


   // Count Users;
   public function countUser()
   {
      $this->db->query("SELECT * FROM users");
      $this->db->execute();
      return $this->db->rowCount();
   }
}
