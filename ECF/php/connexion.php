<?php
$title = 'Connexion';
include 'template/header.php';
include 'class/User.php';

if (!empty($_POST)) {
$_SESSION['username'] = $_POST['username'];
$_SESSION['password'] = $_POST['password'];
}

$usernameInconnu =0;
$mdpIncorrect =0;

$pdo = new PDO('mysql:dbname=ecf;host=localhost;port=3306', 'root', '');

if ((isset($_POST['username'])) && ($_POST['username'] !== '')) 
{
    $username = $_POST['username'];
    $query = $pdo->query(
    "SELECT *
    FROM user 
    WHERE username = '$username';");
    $utilisateurs = $query->fetchAll(PDO::FETCH_CLASS, 'User'); 

  

    if(!empty($utilisateurs)) {
    foreach($utilisateurs as $utilisateur) {
    if (strtolower($utilisateur->username) == strtolower($username))
    {
        if (in_array($utilisateur->password, $_POST)) {
            session_unset();
            $_SESSION['connecte'] = 'oui';
            $_SESSION['role'] = $utilisateur->role;
            $_SESSION['username'] = $utilisateur->username;
            $_SESSION['name'] = $utilisateur->name;
            $_SESSION['userId'] = $utilisateur->id;
            header("Location: index.php");
        } else {
            $mdpIncorrect ++;
        }
    }

}
} else {
        $usernameInconnu ++;
    }
}

?>
    <form action="#" method="post">
      <div class="mb-3 mt-3">
        
        <label for="username" class="form-label">Nom d'utilisateur</label>
        <?php if($usernameInconnu > 0) : ?><br><span class="text-danger"> Nom d'utilisateur inconnu </span> <?php endif ?>
        <input type="text" class="form-control" id="username" name="username">
      <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <?php if($mdpIncorrect > 0) : ?><br><span class="text-danger"> Mot de passe incorrect </span> <?php endif ?>
        <input type="password" class="form-control" id="password" name="password">
      </div>
      <button type="submit" class="btn btn-primary">Valider</button>
    </form>


<?php

include 'template/footer.php';

?>