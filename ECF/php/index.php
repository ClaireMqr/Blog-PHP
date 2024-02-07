<?php
$title = 'Accueil';
include 'template/header.php';
include 'class/Post.php';

?>

<h2 class="fs-2 text-center m-5">
    Autour du monde
</h2>

<?php


if (isset($_SESSION['connecte'])) {
echo '<h4 class="text-center"> Bonjour '.$_SESSION['name'].'. Vous êtes bien connecté(e). </h4>';}
// session_destroy();
// $compteur = 0;
if(isset($_POST['user']) && ($_POST['user'] !== '')) {
  $_SESSION['nom'] = $_POST['user'];
  $_SESSION['mdp'] = $_POST['mdp'];}
$compteur = isset($_SESSION['compteur']) ? $_SESSION['compteur'] : 0;

// Appel de ma BDD
$pdo = new PDO('mysql:dbname=ecf;host=localhost;port=3306', 'root', '');
$query = $pdo->query(
"SELECT posts.id, title, body, createdAt, username 
FROM posts 
INNER JOIN user ON posts.userId = user.id 
ORDER BY posts.id
LIMIT 12 OFFSET $compteur;");
$posts = $query->fetchAll(PDO::FETCH_CLASS, 'Post');

$lignes = $pdo->query("SELECT id FROM posts;");
$nbrPost = count($lignes->fetchAll());
$postDernierePage = (floor($nbrPost/12))*12;

?>
<!-- Affichage des cartes -->
<div class="row justify-content-center">

  <?php 
    
    foreach($posts as $post) : 

    $affichage = new Post();
    echo $affichage->card($post); 

    endforeach ?>

</div>

<!-- Pagination -->
<nav aria-label="...">
  <ul class="pagination justify-content-center">
    <li class="page-item <?= ($compteur <= 1) ? "disabled" : "" ?>">
      <a class="page-link" href="pagePrecedente.php">Précédent</a>
    </li>
    <li class="page-item <?= ($compteur >= $postDernierePage) ? "disabled" : "" ?>">
      <a class="page-link" href="pageSuivante.php" >Suivant</a>
    </li>
  </ul>
</nav>


<?php

include 'template/footer.php';

?>