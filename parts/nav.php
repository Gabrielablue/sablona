<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>navigácia</title>
</head>

<?php 
include_once 'funkcie.php';
$menu = getMenuData("header");
$theme = $_GET['theme'];
?>

<body>
<header style="background-color: <?php echo $theme === "dark" ? "grey" :  "white"; ?>" class="container main-header">
        <div class="logo-holder">
            <a href="<?php echo $menu['home']['path'] ?>">
            <img alt="img" src="img/logo.png" height="40">
          </a>
        </div>
        <nav class="main-nav">
        <ul class="main-menu" id="main-menu">
            <a href=<?php echo $theme === "dark" ? "?theme=light" : "?theme=dark"; ?> > Zmena témy </a>
            <?php printMenu($menu); ?>
        </ul>
        <a class="hamburger" id="hamburger">
            <i class="fa fa-bars"></i>
        </a>
      </nav> 
    </header>
</body>
</html>