<?php session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title><?=$title?></title>
</head>
<body>
    <header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link <?php echo ($_SERVER['SCRIPT_NAME'] == "/ecf/index.php") ? 'active' : "" ;?>" aria-current="page" href="index.php">Accueil</a>
        <a class="nav-link <?php echo ($_SERVER['SCRIPT_NAME'] == "/ecf/connexion.php") ? "active" : ""; ?> <?php if(!empty($_SESSION)) : "disabled"; endif ?>" href="./connexion.php">Connexion</a>
        <?php if (isset($_SESSION['role']) && ($_SESSION['role']) == 'admin') : ?>
        <a class="nav-link <?php echo ($_SERVER['SCRIPT_NAME'] == "/ecf/admin.php") ? 'active' : "" ; ?>" href="./admin.php">Tableau de bord</a>
        <?php endif ?>
        <a class="nav-link <?php echo (isset($_SESSION['connecte']) ) ? "" : "disabled" ?>" href="logout.php">Déconnexion </a>
      </div>
    </div>
  </div>
</nav>
    </header>

    <main class="container">
