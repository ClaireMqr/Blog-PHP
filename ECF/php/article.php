<?php
include 'template/header.php';
include_once 'class/Comment.php';
include_once 'class/Post.php';

// Récupération de l'article sélectionné
$numPost = $_GET['nom'];

// Appel de ma BDD
$pdo = new PDO('mysql:dbname=ecf;host=localhost;port=3306', 'root', '');

$query = $pdo->query("SELECT title, body, createdAt, username
FROM posts 
INNER JOIN user ON posts.userId = user.id
WHERE posts.id = $numPost;");
$posts = $query->fetchAll(PDO::FETCH_CLASS, 'Post');

$query2 = $pdo->query("SELECT name, email, comments.body, comments.createdAt
FROM comments
INNER JOIN posts ON comments.postId = posts.id
WHERE postId = $numPost;");
$commentaires = $query2->fetchAll(PDO::FETCH_CLASS, 'Comment');

// var_dump($post);
?>

<!-- Affichage du post entier -->
<?php foreach ($posts as $post) :

$affichage = new Comment();
echo $affichage->post($post, $numPost);

endforeach ?>
<hr>

<!-- Affichage des commentaires -->
<div class="mt-5">
  <h4>Commentaires</h4>

  <?php foreach ($commentaires as $commentaire) :

  echo $affichage->comment($commentaire);

  endforeach ?>

</div>

<?php include 'template/footer.php'; ?>