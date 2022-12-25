<?php
require_once 'C:\localhost\PHP_Crud-and-Autorization\databaseConfig.php';
//start session
$object = new databaseConfig();
$object->startSession();

// Retrieve session data
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';

// Get status message from session
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}
// Get member data
$workerData = $userData = array();
if(!empty($_GET['id'])){
    $sql = "select * from [dbo].[Workers] where ID_Worker = ".$_GET['id'];

    $conn = $object->createConnection();
    $workerData = $object->getItemFromTable($sql,$conn);
}
$userData = !empty($sessData['userData'])?$sessData['userData']:$workerData;
unset($_SESSION['sessData']['userData']);

$actionLabel = !empty($_GET['id'])?'Edit':'Add';


?>

<!-- Display status message -->
<?php if(!empty($statusMsg) && ($statusMsgType == 'success')){ ?>
    <div class="col-xs-12">
        <div class="alert alert-success"><?php echo $statusMsg; ?></div>
    </div>
<?php }elseif(!empty($statusMsg) && ($statusMsgType == 'error')){ ?>
    <div class="col-xs-12">
        <div class="alert alert-danger"><?php echo $statusMsg; ?></div>
    </div>
<?php } ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="C:\localhost\Lab_01_BootStrap\style.css">
    <title>AddWorker</title>
</head>
<body>
    <div class="container">
        <h1 style="font-size: 3em;text-align: center">Редактирование сотрудников</h1>
        <div class="row" style="margin:30px auto;justify-content: center">
            <div class="col-md-12">
                <h2 style="text-align: center">Сотрудник</h2>
            </div>
            <div class="col-md-7">
                <form method="post" action="userAction.php">
                    <div class="form-group" style="margin: 10px auto">
                        <label style="margin-bottom: 5px">Имя</label>
                        <input type="text" class="form-control" name="FirstName" placeholder="Пожайлуста введите имя сотрудника"
                               value="<?php echo !empty($userData['Name_Worker'])?$userData['Name_Worker']:'';?>" required = "">
                    </div>
                    <div class="form-group" style="margin: 10px auto">
                        <label style="margin-bottom: 5px">Фамилия</label>
                        <input type="text" class="form-control" name="LastName" placeholder="Пожайлуста введите сотрудника фамилию"
                               value="<?php echo !empty($userData['Surname_Worker'])?$userData['Surname_Worker']:'';?>" required = "">
                    </div>
                    <div class="form-group" style="margin: 10px auto">
                        <label style="margin-bottom: 5px">Опыт работы</label>
                        <input type="number" min="0" class="form-control" name="Experience" placeholder="Пожайлуста введите опыт работы(лет)"
                               value=<?php echo (int)(!empty($userData['Work_experience'])?$userData['Work_experience']:'');?> required = "">
                    </div>
                    <div class="form-group" style="margin: 10px auto">
                        <label style="margin-bottom: 5px">Специальность</label>
                        <input type="text" class="form-control" name="Cost" placeholder="Пожайлуста введите специальность сотрудника"
                               value="<?php echo !empty($userData['Cost'])?$userData['Cost']:'';?>" required = "">
                    </div>
                    <div class="form-group" style="margin: 10px auto">
                        <label style="margin-bottom: 5px">Плата за рабочий день</label>
                        <input type="number" min="0" class="form-control" name="CostWork" placeholder="Пожайлуста введите плату за рабочий день"
                               value=<?php echo (int)!empty($userData['Cost_work'])?$userData['Cost_work']:'';?> required = "">
                    </div>
                    <a href="http://localhost:3000/Add/AndOrUpdateAmentities.php" class="btn btn-secondary">Назад</a>
                    <input type="hidden" name="ID_Worker" value="<?php echo !empty($workerData['ID_Worker'])? $workerData['ID_Worker']:''; ?>">
                    <input type="submit" name="userSubmit" class="btn btn-success" value="Принять">
                </form>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>
<script src="main.js"></script>
</body>
</html>
