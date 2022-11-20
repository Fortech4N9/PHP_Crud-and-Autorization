<?php
//include database configuration file
require_once 'databaseConfig.php';
$object = new databaseConfig();
//start session
$object->startSession();
// Retrieve session data
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';

// Get status message from session
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}
//Fetch the data from SQL server
$sqlWorker = "select * from [dbo].[Workers];";
$sqlAmenities = "select * from [dbo].[Amenities];";
$sqlConnection = "select * from [dbo].[Amenities_to_Workers];";

$conn = $object->createConnection();
//receiving array in table
$members1 = $object->getArrayFromTable($sqlWorker,$conn);
$members2 = $object->getArrayFromTable($sqlAmenities,$conn);
$members3 = $object->getArrayFromTable($sqlConnection,$conn);
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
    <link rel="stylesheet" href="style.css">
    <title>AddService</title>
</head>
<body>
    <header class="d-flex" style="justify-content: center; margin: 10px auto;" >
        <h1 style="font-size: 3em">Добавление услуг</h1>
    </header>
    <div class="container">
        <div class="block-heading-two text center border-bottom text-center">
            <h3><span>Рабочие</span></h3>
        </div>
        <div class="row">
            <div class="col-md-12 head">
                <!--Add link-->
                <div class="float-right">
                    <a href="Add/AddOrUpdate.php" class="btn btn-success" style="width: 15em"><i class="plus"></i>Добавить работника</a>
                </div>
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Имя работника</th>
                            <th>Фамилия работника</th>
                            <th>Опыт работы</th>
                            <th>Специальность</th>
                            <th>Цена за рабочий день</th>
                            <th>Изменить/Удалить</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (!empty($members1)){
                        foreach ($members1 as $row){?>
                        <tr>
                            <td><?php echo $row["ID_Worker"]?></td>
                            <td><?php echo $row['Name_Worker']?></td>
                            <td><?php echo $row['Surname_Worker']?></td>
                            <td><?php echo $row['Work_experience']?></td>
                            <td><?php echo $row['Cost']?></td>
                            <td><?php echo $row['Cost_work']?></td>
                            <td>
                                <a href="Add/AddOrUpdate.php?id=<?php echo $row['ID_Worker']; ?>" class="btn">Изменить</a>
                                <a href="Add\userAction.php?action_type=delete&id=<?php echo $row["ID_Worker"]; ?>" class="btn" onclick="return confirm('Вы точно хотите удалить услугу ?')">Удалить</a>
                            </td>
                        </tr>
                    <?php } }else{?>
                        <tr><td colspan="7">NO members(s) found...</td></tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="block-heading-two text center border-bottom text-center">
            <h3><span>Услуги</span></h3>
        </div>
        <div class="row">
            <div class="col-md-12 head">
                <!--Add link-->
                <div class="float-right">
                    <a href="Add/AddAmenities.php" class="btn btn-success" style="width: 15em"><i class="plus"></i>Добавить услугу</a>
                </div>
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Имя услуги</th>
                        <th>Описание</th>
                        <th>Картинка услуги</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (!empty($members2)){
                        foreach ($members2 as $row){?>
                            <tr>
                                <td><?php echo $row['ID_Amenities']?></td>
                                <td><?php echo $row['Name_Amenities']?></td>
                                <td><?php echo $row['Descript']?></td>
                                <td><img  class="image-table" src=<?php echo $row['URL_Image']?>></td>
                            </tr>
                        <?php } }else{?>
                        <tr><td colspan="7">NO members(s) found...</td></tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="block-heading-two text center border-bottom text-center">
            <h3><span>Работники и услуги</span></h3>
        </div>
        <div class="row">
            <div class="col-md-12 head">
                <!--Add link-->
                <div class="float-right">
                    <a href="Add/AddConnection.php" class="btn btn-success" style="width: 25em"><i class="plus"></i>Добавить услуги</a>
                </div>
                <table class="table table-striped table-bordered" style="width: 50%; float: right;margin: 10px auto">
                    <thead class="thead-dark">
                    <tr>
                        <th>#Рабоника</th>
                        <th>#Услуги</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (!empty($members3)){
                        foreach ($members3 as $row){?>
                            <tr>
                                <td><?php echo $row['ID_Worker']?></td>
                                <td><?php echo $row['ID_Amenities']?></td>
                            </tr>
                        <?php } }else{?>
                        <tr><td colspan="7">NO members(s) found...</td></tr>
                    <?php }?>
                    </tbody>
                </table>
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
