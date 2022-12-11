<?php
session_start();?>
<?php
require_once  ('../databaseConfig.php');
$object = new databaseConfig();
$object->startSession();
$conn = $object->createConnection();

    $accauntName = $_POST['accauntName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    if ($password === $password_confirm) {
        $password = md5($password);



        $sql = "insert into [services].[dbo].[users] (emailAdress,accauntName,accauntPassword) values(?,?,?);";
        $params = array(
            &$email,
            &$accauntName,
            &$password,
        );
        $query = $object->createConnection()->prepare($sql);
        $insert = $query->execute($params);
        $_SESSION['message'] = 'Регистрация прошла успешно!';
        header('Location: ../index.php');


    } else {
        $_SESSION['message'] = 'Пароли не совпадают';
        header('Location: ../registration.php');
    }
?>
