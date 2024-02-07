<?php
$title = 'Ajouter un article';
include 'template/header.php';
?>

<h2 class="fs-2 text-center m-5">
    Ajouter un article
</h2>

<?php

// Vérification de l'ajout
if ((isset($_POST['title'])) && ($_POST['title'] !== '')) 
{
// Connexion à la BDD
$pdo = new PDO('mysql:dbname=ecf;host=localhost;port=3306', 'root', '');

$query = $pdo->prepare('INSERT INTO posts(title, body, userId)
VALUES(:title, :body, :userId)');
$query->execute([
    'title'=> $_POST['title'],
    'body' => $_POST['body'],
    'userId'=>intval($_SESSION['userId'])
]);
$_SESSION['ajout'] = 1;
header("Location: admin.php");

}
?>

<form action="#" method="post">
      <div class="mb-3 mt-3">
        
        <label for="title" class="form-label">Titre</label>
        <input type="text" class="form-control" id="title" name="title">
      <div class="mb-3">
        <label for="body" class="form-label">Article</label>
        <textarea type="text-area" class="form-control" rows="3" id="body" name="body"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Valider</button>
      <a href="admin.php" class="btn btn-danger">Annuler</a>
    </form>

<?php
include 'template/footer.php';
?>