<?php
$title = 'Tableau de bord';
include 'template/header.php';
include 'class/Post.php';

?>

<h2 class="fs-2 text-center m-5">
    Tableau de bord
</h2>

<?php
// Redirection d'un utilisateur
if($_SESSION['role'] == 'user') {
    header("Location: index.php");
}
// Redirection d'une personne non connectée
if(empty($_SESSION)) {
    header("Location: connexion.php");
}
// Connexion à la BDD
$pdo = new PDO('mysql:dbname=ecf;host=localhost;port=3306', 'root', '');
$query = $pdo->query(
"SELECT posts.id, title, body, createdAt, username 
FROM posts 
INNER JOIN user ON posts.userId = user.id 
ORDER BY posts.id ;");
$posts = $query->fetchAll(PDO::FETCH_CLASS, 'Post');
?>

<!-- Si la personne connectée est admin, affichage du dashboard -->
<?php if($_SESSION['role'] == 'admin') : ?>


    <a href="ajout.php" class="text-decoration-none text-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
  <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"/>
</svg> Ajouter un post</a><br>

<?php 
if(isset($_SESSION['suppr']) && ($_SESSION['suppr'] > 0)) {
    echo '<span class="text-success">Suppression effectuée avec succès.</span>';
    $_SESSION['suppr'] = 0;
} 

if(isset($_SESSION['ajout']) && ($_SESSION['ajout'] > 0)) {
    echo '<span class="text-success">Ajout effectué avec succès.</span>';
    $_SESSION['ajout'] = 0;
} 

if(isset($_SESSION['modif']) && ($_SESSION['modif'] > 0)) {
    echo '<span class="text-success">Modification effectuée avec succès.</span>';
    $_SESSION['modif'] = 0;
} 
?>

    <table class="table table-striped table-fixed mt-3">
        <tr>
            <th></th>
            <th>Titre</th>
            <th>Contenu</th>
            <th>Auteur</th>
            <th>Date</th>
            <th></th>
        </tr>
        <?php
        foreach($posts as $post) {
            $tableau = new Post();
            echo $tableau->dashboard($post);
        }
        ?>
    </table>
<?php endif ?>   


<?php

include 'template/footer.php';

?>