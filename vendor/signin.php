<?php
session_start();?>
<?php
require_once  ('../databaseConfig.php');
$object = new databaseConfig();
$object->startSession();
$conn = $object->createConnection();

    $login = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM [services].[dbo].[users] WHERE emailAdress = '$login' AND accauntPassword = '$password';";
    $members = $object->getItemFromTable($sql,$conn);
    if (count($members) > 0) {

        $_SESSION['user'] = $members;
        header('Location: ../homepage.php');
    } else {
        $_SESSION['message'] = 'Не верный логин или пароль';
        header('Location: ../index.php');
    }
?>

