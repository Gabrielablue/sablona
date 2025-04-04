<?php

require_once("../classes/Contact.php");
use formular\Contact;

$meno = $_POST['meno'];
$email = $_POST['email'];
$sprava = $_POST['sprava'];

// ak sú premenné prázdne
if (empty($meno) || empty($email) || empty($sprava)) {
    die("VŠetky polia sú povinné");
}

// nová inštancia triedy Contact

$kontakt = new Contact();
$ulozene = $kontakt->ulozSpravu($meno, $email, $sprava);

if ($ulozene) {
    header("Location: ../thankyou.php");
} else {
    die("Chyba pri odoslaní správy do databázy");
    http_response_code(404);
}