<?php

namespace formular;

error_reporting(E_ALL);
ini_set('display_errors', 1);
if (!defined('__ROOT__')) {
    define('__ROOT__', dirname(dirname(__FILE__)));
}require_once (__ROOT__.'/classes/Database.php');


class Kontakt extends \Database
{

  private $conn;
  public function __construct() {
      $this->connect();
  }
/*rivate function connect() {
    $config = DATABASE;
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        );

    try {
        $this->conn = new PDO('mysql:host=' . $config['HOST'] . ';dbname=' . $config['DBNAME'] . ';port=' . $config['PORT'], $config['USER_NAME'], $config['PASSWORD'], $options);
    } catch (PDOException $e) {
        die("Chyba pripojenia: " . $e->getMessage());
    }
}
*/

public function ulozitSpravu($meno, $email, $sprava) {
    $sql = "INSERT INTO kontakt_formular (meno, email, sprava) 
    VALUE ('" . $meno . "', '" . $email . "', '" . $sprava . "')";
    $statement = $this->conn->prepare($sql);

    try {
        $insert = $statement->execute();
        header("Location: http://localhost/sablona/thankyou.php");
        http_response_code(200);
        return $insert;
    } catch (\Exception $exception) {
        return http_response_code(404);
    }
}
public function __destruct() {
    $this->conn = null;
}
}