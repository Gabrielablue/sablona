<?php include 'funkcie.php' ?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moja stránka</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/accordion.css">
    <link rel="stylesheet" href="css/banner.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>


<?php
include_once('parts/header.php');
?>
<?php
include_once('parts/nav.php');
?>
<?php
include_once("classes/QnA.php");
use otazkyodpovede\QnA;

$qna = new QnA();
$otazkyAOdpovede = $qna->getQnA();
?>

  <main>
    <section class="banner">
      <div class="container text-white">
        <h1>Q&A</h1>
      </div>
    </section>
    <section class="container">
      <div class="row">
        <div class="col-100 text-center">
          <p><strong><em>Elit culpa id mollit irure sit. Ex ut et ea esse culpa officia ea incididunt elit velit veniam qui. Mollit deserunt culpa incididunt laborum commodo in culpa.</em></strong></p>
        </div>
      </div>
    </section>
      <section class="container">
      <?php
          foreach($otazkyAOdpovede as $item){
          echo '<div class="accordion">';
          echo '<div class="question">'.$item['otazka'].'</div>';
          echo '<div class="answer">'.$item['odpoved'].'</div>';
          echo '</div>';
          }
      ?>
    </section>
    </section>
  </div>
  </main>

<?php 
include_once('parts/footer.php');
?>
<script src="js/accordion.js"></script>
<script src="js/menu.js"></script>
</body>
</html>