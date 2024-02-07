<?php
$title = 'Modification';
include 'template/header.php';
include 'class/Post.php';

$id = $_GET['nom'];

$pdo = new PDO('mysql:dbname=ecf;host=localhost;port=3306', 'root', '');

$article = $pdo->query("SELECT title, body, createdAt, username
FROM posts 
INNER JOIN user ON posts.userId = user.id
WHERE posts.id = $id;");
$posts = $article->fetchAll(PDO::FETCH_CLASS, 'Post');

if ((isset($_POST['title'])) && ($_POST['title'] !== '')) {
    $date = date("Y-m-d H:i:s");
    $query = $pdo->prepare("UPDATE posts SET title = :title, body = :body, createdAt = :createdAt
    WHERE posts.id = $id");
    $query->execute([
        'title'=> $_POST['title'],
        'body' => $_POST['body'],
        'createdAt' => $date
    ]);
$_SESSION['modif'] = 1;
header("Location: admin.php");
}
?>

<?php foreach ($posts as $post) : ?>
<form action="#" method="post">
      <div class="mb-3 mt-3">
        
        <label for="title" class="form-label">Titre</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= $post->title ?>">
      <div class="mb-3">
        <label for="body" class="form-label">Article</label>
        <textarea type="text-area" class="form-control" rows="5" id="body" name="body"><?= $post->body ?></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Valider</button>
      <a href="admin.php" class="btn btn-danger">Annuler</a>
    </form>
  <?php  endforeach ?>

    <?php
    include 'template/footer.php';
    ?>