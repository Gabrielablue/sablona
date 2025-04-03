<?php include 'funkcie.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Moja stránka</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/portfolio.css">
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

<main>
    <section class="banner">
        <div class="container text-white">
            <h1> Portfólio </h1>
        </div>
    </section> 
    <section class="container" style="background-color: <?php echo $theme === "dark" ? "grey" :  "white"; ?>">
        <?php
        finishPortfolio();
        ?>
    </section>
</main>

<?php include_once('parts/footer.php'); ?>

</body>
</html>