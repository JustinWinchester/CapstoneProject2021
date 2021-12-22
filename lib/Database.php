<?php
// login information for database
define('DB_HOST', 'localhost');
define('DB_NAME', 'cs12');
define('DB_USER', 'cs12');
define('DB_PASS', 'CUaDGKK8');


// Class Database

class  Database
{

  public $pdo;


  // Construct Class
  public function __construct()
  {

    if (!isset($this->pdo)) {
      try {
        $link = new PDO('mysql:host=' . DB_HOST . '; dbname=' . DB_NAME, DB_USER, DB_PASS);
        $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $link->exec("SET CHARACTER SET utf8");
        $this->pdo  =  $link;
      } catch (PDOException $e) {
        die("Connection error..." . $e->getMessage());
      }
    }
  }
}
