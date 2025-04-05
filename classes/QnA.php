<?php

namespace otazkyodpovede;
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/db/config.php');
use PDO;
use PDOException;

class QnA
{
    private $conn;
    public function __construct(){
        $config = DATABASE;
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // vráti ako asociatívne pole, ked nenastavíme, vráti sa prvý riadok tabulky 
        );                                                      // pozrieť prezentáciu 7 - podobné vyťahovanie z databázy budeme mať/musieť mať na projekte 

        try {
            $this->conn = new PDO('mysql:host='.$config['HOST'].';dbname='.$config['DBNAME'].';port='. $config['PORT'], $config['USER_NAME'],$config['PASSWORD'], $options);
        } catch (PDOException $e) {
            die("Chyba pripojenia: ". $e->getMessage());
        }
    }

    public function insertQnA(){
        try {
            $data = json_decode(file_get_contents(__ROOT__.'/data/datas.json'), true);
            $otazky = $data['otazky'];
            $odpovede  = $data['odpovede'];

            $this->conn->beginTransaction();

            $sql = "INSERT INTO qna (otazka, odpoved) VALUES (:otazka, :odpoved)";
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
        } finally {
            $this->conn = null;
        }
    }

    public function getQnA(){
        try {
            $sql = "SELECT otazka, odpoved FROM qna"; // týmto dokážeme získať otázky/odpovede z tabulky qna
            $statement = $this->conn->prepare($sql);
            $statement->execute();
            // vráti nám všetky výsledky vo formáte asociatívneho poľa otazka =>odpoved
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Chyba pri získaní qna: ". $e->getMessage();
            $this->conn->rollBack(); //ak nastane chyba počas transakcie, vráti všetky zmeny v db späť
        }
    }
}