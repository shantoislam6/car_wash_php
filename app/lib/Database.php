<?php

/**
 * PDO Database class
 * Connect to database 
 * Create prepared statement
 * Bind values
 * Return rows and results
 */

namespace lib;

use \PDO;
use PDOException;

class Database
{

   private static $RDBMS = DBMS;
   private static $host = DB_HOST;
   private static $user = DB_USER;
   private static $port = DB_PORT;
   private static $pass = DB_PASS;
   private static $dbname = DB_NAME;


   private $dbh;
   private $stmt;
   private $error;

   public function __construct($alternative_db = null)
   {
      self::$dbname = isset($alternative_db) ? $alternative_db : self::$dbname;
      // set dsn
      $dsn = self::$RDBMS . ':host=' . self::$host . '.;dbname=' . self::$dbname . ';port=' . self::$port;

      // set default options for pdo
      $options = [
         PDO::ATTR_PERSISTENT => true,
         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      ];
      // Create PDO instance
      try {
         $this->dbh = new PDO($dsn, self::$user, self::$pass, $options);
      } catch (PDOException $e) {
         $this->error = $e->getMessage();
         die($this->error);
      }
   }

   // Prepare statement with query
   public function query($sql)
   {
      return $this->stmt = $this->dbh->prepare($sql);
   }

   // Bind values
   public function bind($param, $value, $type = null)
   {
      if (is_null($type)) {
         switch (true) {
            case is_int($value):
               $type = PDO::PARAM_INT;
               break;
            case is_bool($value):
               $type = PDO::PARAM_BOOL;
               break;
            case is_null($value):
               $type = PDO::PARAM_NULL;
               break;
            default:
               $type = PDO::PARAM_STR;
         }
         $this->stmt->bindValue($param, $value, $type);
      }
   }

   // Execute the prepared statement
   public function execute($options = [])
   {
      try {
         if (count($options) > 0) {
            $this->stmt->execute($options);
         } else {
            $this->stmt->execute();
         }
      } catch (PDOException $e) {
         die($e->getMessage());
      }
   }

   // Get result set as array of objects
   public function fetchObjAll($options = [])
   {
      $this->execute($options);
      return $this->stmt->fetchAll(PDO::FETCH_OBJ);
   }

   // Get result set as array of assoc array
   public function fetchAssocAll($options = [])
   {
      $this->execute($options);
      return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
   }
   // Get single record of object
   public function fetchObj($options = [])
   {
      $this->execute($options);
      return $this->stmt->fetch(PDO::FETCH_OBJ);
   }

   // Get single record of assoc array
   public function fetchAssoc($options = [])
   {
      $this->execute($options);
      return $this->stmt->fetch(PDO::FETCH_ASSOC);
   }

   // Get row count
   public function rowCount()
   {
      return $this->stmt->rowCount();
   }
   // Returns the last inserted ID
   public function lastInsertId()
   {
      return $this->dbh->lastInsertId();
   }
}
