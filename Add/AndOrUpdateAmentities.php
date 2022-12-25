<?php
require_once 'C:\localhost\PHP_Crud-and-Autorization\databaseConfig.php';
//start session
$object = new databaseConfig();
$object->startSession();

// Retrieve session data
$sessData = !empty($_SESSION['sessData']) ? $_SESSION['sessData'] : '';

// Get status message from session
if (!empty($sessData['status']['msg'])) {
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}
// Get member data
$workerData = $userData = array();
$conn = $object->createConnection();
if (!empty($_GET['id'])) {
    $sql = "select * from [dbo].[Amenities] where ID_Amenities = " . $_GET['id'];
    $workerData = $object->getItemFromTable($sql, $conn);
}
$sqlWorker = "select * from [dbo].[Workers];";
$members1 = $object->getArrayFromTable($sqlWorker, $conn);
$userData = !empty($sessData['userData']) ? $sessData['userData'] : $workerData;
unset($_SESSION['sessData']['userData']);

$actionLabel = !empty($_GET['id']) ? 'Edit' : 'Add';
?>

<!-- Display status message -->
<?php if (!empty($statusMsg) && ($statusMsgType == 'success')) { ?>
    <div class="col-xs-12">
        <div class="alert alert-success"><?php echo $statusMsg; ?></div>
    </div>
<?php } elseif (!empty($statusMsg) && ($statusMsgType == 'error')) { ?>
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
    <title>AddAmentities</title>
</head>
<body>
<div class="container">
    <h1 style="font-size: 3em;text-align: center">Редактирование Услуг</h1>
    <div class="row" style="margin:30px auto;justify-content: center">
        <div class="col-md-12">
            <h2 style="text-align: center">Услуга</h2>
        </div>
        <div class="col-md-7">
            <form method="post" action="userActionAmentities.php">
                <div class="form-group" style="margin: 10px auto">
                    <label style="margin-bottom: 5px">Имя услуги</label>
                    <input type="text" class="form-control" name="Name_Amenities"
                           placeholder="Пожайлуста введите имя сотрудника"
                           value="<?php echo !empty($userData['Name_Amenities']) ? $userData['Name_Amenities'] : ''; ?>"
                           required="">
                </div>
                <div class="form-group" style="margin: 10px auto">
                    <label style="margin-bottom: 5px">Описание услуги</label>
                    <input type="text" class="form-control" name="Descript"
                           placeholder="Пожайлуста введите сотрудника фамилию"
                           value="<?php echo !empty($userData['Descript']) ? $userData['Descript'] : ''; ?>"
                           required="">
                </div>
                <div class="form-group" style="margin: 10px auto">
                    <label style="margin-bottom: 5px">URL-адрес услуги</label>
                    <input type="text" class="form-control" name="URL_Image"
                           placeholder="Пожайлуста введите опыт работы(лет)"
                           value=<?php echo !empty($workerData['URL_Image']) ? $workerData['URL_Image'] : ''; ?> required
                    = "">
                </div>
                <div class="form-group" style="margin: 10px auto">
                    <label style="margin-bottom: 5px">ID-Работника</label>
                    <input type="text" class="form-control" name="ID_Worker"
                           placeholder="Пожайлуста введите опыт работы(лет)"
                           value=<?php echo (int)!empty($workerData['ID_Worker']) ? $workerData['ID_Worker'] : ''; ?> required
                    = "">
                </div>
                <a href="http://localhost:3000/AddService.php" class="btn btn-secondary">Назад</a>
                <input type="hidden" name="ID_Amenities"
                       value="<?php echo !empty($userData['ID_Amenities']) ? $userData['ID_Amenities'] : ''; ?>">
                <input type="submit" name="userSubmit" class="btn btn-success" value="Принять">
            </form>
        </div>
    </div>
    <div class="container">
        <div class="block-heading-two text center border-bottom text-center">
            <h3><span>Рабочие</span></h3>
        </div>
        <div class="row">
            <div class="col-md-12 head">
                <!--Add link-->
                <div class="float-right">
                    <a href="AddOrUpdate.php" class="btn btn-success" style="width: 15em"><i class="plus"></i>Добавить
                        работника</a>
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
                    if (!empty($members1)) {
                        foreach ($members1 as $row) {
                            ?>
                            <tr>
                                <td><?php echo $row['ID_Worker'] ?></td>
                                <td><?php echo $row['Name_Worker'] ?></td>
                                <td><?php echo $row['Surname_Worker'] ?></td>
                                <td><?php echo $row['Work_experience'] ?></td>
                                <td><?php echo $row['Cost'] ?></td>
                                <td><?php echo $row['Cost_work'] ?></td>
                                <td>
                                    <a href="AddOrUpdate.php?id=<?php echo $row['ID_Worker']; ?>" class="btn">Изменить</a>
                                    <a href="userAction.php?action_type=delete&id=<?php echo $row["ID_Worker"]; ?>"
                                       class="btn"
                                       onclick="return confirm('Вы точно хотите удалить услугу ?')">Удалить</a>
                                </td>
                            </tr>
                        <?php }
                    } else {
                        ?>
                        <tr>
                            <td colspan="7">NO members(s) found...</td>
                        </tr>
                    <?php } ?>
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

