<?php

namespace otazkyodpovede;
use PDO;
use Database;

error_reporting(E_ALL);
ini_set('display_errors', 1);
if (!defined('__ROOT__')) {
    define('__ROOT__', dirname(dirname(__FILE__)));
}
require_once(__ROOT__.'classes/Database.php');

class QnA extends \Database
{
    private $conn;
    public function __construct(){
        parent::__construct();
        $this->conn = $this->getConnection();
    }

    public function insertQnA(){
        try {
            $data = json_decode(file_get_contents(__ROOT__.'/data/datas.json'), true);
            $otazky = $data['otazky'];
            $odpovede  = $data['odpovede'];

            $this->conn->beginTransaction();

            $sql = "INSERT INTO qna1 (otazka, odpoved) VALUES (:otazka, :odpoved)";
            $statement = $this->conn->prepare($sql);

            for ($i=0; $i<count($otazky); $i++) {
                $statement->bindParam(':otazka', $otazky[$i+1]);
                $statement->bindParam(':odpoved', $odpovede[$i+1]);
                $statement->execute();
            }
            $this->conn->commit();
            echo "Dáta vložené do tabuľky";
        } catch (Exception $e) {
            echo "Chyba pri vkladaní dát do tabuľky: ". $e->getMessage();
            $this->conn->rollBack();
        }
    }

    public function getQnA(){
        try {
            $sql = "SELECT otazka, odpoved FROM qna1"; // týmto dokážeme získať otázky/odpovede z tabulky qna
            $statement = $this->conn->prepare($sql);
            $statement->execute();
            // vráti nám všetky výsledky vo formáte asociatívneho poľa otazka =>odpoved
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Chyba pri získaní qna: ". $e->getMessage();
            return false; //ak nastane chyba počas transakcie, vráti všetky zmeny v db späť
        }
    }
}