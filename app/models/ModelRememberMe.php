<?php

namespace models;


class ModelRememberMe
{
   private $db;
   public function __construct()
   {
      $this->db = new \lib\Database;
   }

   // Save the hashed token in the database along with the user's ID
   public function insert_xs_token($user_id, $xs, $expired_at)
   {
      $this->db->query("INSERT INTO remember_me_tokens (user_id, xs, expired_at) VALUES (?, ?, ?)");
      $this->db->execute([$user_id, $xs, $expired_at]);
   }


   // Retrieve users with xs
   public function retrieveUserxs($user_id)
   {
      $sql = "SELECT users.* , remember_me_tokens.* FROM remember_me_tokens JOIN users ON remember_me_tokens.user_id = users.id WHERE remember_me_tokens.user_id = :user_id";

      $this->db->query($sql);

      $this->db->execute([
         ':user_id' => $user_id,
      ]);

      return $this->db->fetchAssocAll();
   }

   // // Delete expired xs record
   public function deleteExpiredXs($xs_id)
   {
      $this->db->query("DELETE FROM remember_me_tokens WHERE xs_id = :xs_id");
      $this->db->execute([
         ':xs_id' => $xs_id
      ]);
   }

   public function deleteUsersXsTokens($user_id)
   {
      $this->db->query("DELETE FROM remember_me_tokens WHERE user_id = :user_id");
      $this->db->execute([
         ':user_id' => $user_id,
      ]);
   }
}
