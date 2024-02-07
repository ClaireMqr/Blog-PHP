<?php
include 'class/Post.php';

session_start();
$id = $_GET['nom'];

$pdo = new PDO('mysql:dbname=ecf;host=localhost;port=3306', 'root', '');

$query2 = $pdo->query(
"DELETE FROM comments WHERE postId = $id;");

$query = $pdo->query(
"DELETE FROM posts WHERE id = $id;");
$_SESSION['suppr'] = 1;

header("Location: admin.php");

?>