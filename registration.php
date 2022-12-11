<?php
session_start();?>
<?php
error_reporting(E_ERROR | E_PARSE);
require_once  ('databaseConfig.php');
$object = new databaseConfig();
$object->startSession();
if ($_SESSION['user']) {
    header('Location: homepage.php');
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Регистрация</title>
</head>
<body>
<form action="vendor/signup.php" method="post">
    <div class="container">
        <h4 style="text-align: center">Регистрация</h4>
        <div class="autorization">
            <div class="item">
                <label>Почта</label>
                <input type="text" name="email" placeholder="Введите свою почту, она будет вышим логином">
            </div>
            <div class="item">
                <label>Пароль</label>
                <input type="password" name="password" placeholder="придумайте и введите пароль от аккаунта">
            </div>
            <div class="item">
                <label>Подтверждение пароля</label>
                <input type="password" name="password_confirm" placeholder="подтвердите пароль">
            </div>
            <div class="item">
                <label>Имя акканута</label>
                <input type="text"  name="accauntName" placeholder="Придумайте имя аккаунту">
            </div>
            <div class="item">
                <button class="btn btn-success" type="submit" style="width: 180px">Зарегистрироваться</button>
            </div>
        </div>
    </div>
    <?php
    if ($_SESSION['message']) {
        echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
    }
    unset($_SESSION['message']);
    ?>
</form>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>
</body>
</html>
