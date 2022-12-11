<?php
session_start();?>
<?php
require_once  ('../databaseConfig.php');
$object = new databaseConfig();
$object->startSession();
unset($_SESSION['user']);
session_destroy();
header('Location: ../index.php');