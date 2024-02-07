<?php

session_start();
$compteur = isset($_SESSION['compteur']) ? $_SESSION['compteur'] : 0;
$compteur = $compteur + 12;
$_SESSION['compteur'] = $compteur;
header("Location: index.php");
Exit;

?>