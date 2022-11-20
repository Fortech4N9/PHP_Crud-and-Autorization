<?php
require_once 'C:\localhost\Lab_01_BootStrap\databaseConfig.php';
$object = new databaseConfig();
$object->startSession();
$redirectUrl = "http://localhost:3000/AddService.php";
if (isset($_POST['userSubmit'])){
    $ID_Worker = $_POST['ID_Worker'];
    $FirstName = trim(strip_tags($_POST['FirstName']));
    $LastName = trim(strip_tags($_POST['LastName']));
    $Experience = trim(strip_tags($_POST['Experience']));
    $Cost = trim(strip_tags($_POST['Cost']));
    $CostWork = trim(strip_tags($_POST['CostWork']));


    $id_str = '';
    if(!empty($id)){
        $id_str = '?id'.$ID_Worker;
    }
    //validation
    $errorMsg = '';
    if(empty($FirstName))
        $errorMsg.='<p>Пожайлуста заполните все поля!!</p>';
    if(empty($LastName))
        $errorMsg.='<p>Пожайлуста заполните все поля!!</p>';
    if(empty($Experience))
        $errorMsg.='<p>Пожайлуста заполните все поля!!</p>';
    if(empty($Cost))
        $errorMsg.='<p>Пожайлуста заполните все поля!!</p>';
    if(empty($CostWork))
        $errorMsg.='<p>Пожайлуста заполните все поля!!</p>';

    //submitted form data
    $userData = array(
        'Name_Worker' =>$FirstName,
        'Surname_Worker' =>$LastName,
        'Work_experience'=>$Experience,
        'Cost'=>$Cost,
        'Cost_work'=>$CostWork
    );

    //process the form data
    if (empty($errorMsg)){
        if(!empty($ID_Worker)){
            //Update data in SQL server
            $sql = "update [dbo].[Workers] set Name_Worker = ?,Surname_Worker = ?,Work_experience = ?,Cost = ?,Cost_work = ? where ID_Worker =?;";
            $query = $object->createConnection()->prepare($sql);
            $update = $query->execute(array($FirstName,$LastName,$Experience,$Cost,$CostWork,$ID_Worker));
            if ($update){
                $sessData['status']['type'] = 'success';
                $sessData['status']['msg'] = 'Обновление данных прошло успешно';

                unset($sessData['userData']);
            }else{
                $sessData['status']['type'] = 'error';
                $sessData['status']['msg'] = 'Возникли проблемы с обнолвением, повторите заново!';

                $redirectURL = 'userAction.php'.$id_str;
            }
        }else{
            //insert data in SQL server
            $sql = "insert into [dbo].[Workers] (Name_Worker,Surname_Worker,Work_experience,Cost,Cost_work) values(?,?,?,?,?);";
            $params = array(
                &$FirstName,
                &$LastName,
                &$Experience,
                &$Cost,
                &$CostWork
            );
            $query = $object->createConnection()->prepare($sql);
            $insert = $query->execute($params);
            if ($insert){
                $sessData['status']['type'] = 'success';
                $sessData['status']['msg'] = 'Добовление данных прошло успешно';

                unset($sessData['userData']);
            }else{
                $sessData['status']['type'] = 'error';
                $sessData['status']['msg'] = 'Возникли проблемы с добавлением, повторите заново!';

                $redirectURL = 'userAction.php'.$id_str;
            }
        }
    }else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'Возникли проблемы с добавлением, повторите заново!';

        $redirectURL = 'userAction.php'.$id_str;
    }
$_SESSION['sessData'] = $sessData;

}elseif(($_REQUEST['action_type'] == 'delete') && !empty($_GET['id'])){
    $ID_Worker = $_GET['id'];

    // Удалить данные с SQL server
    $sql = "delete  from [dbo].[Workers] where ID_Worker = ?;";
    $query = $object->createConnection()->prepare($sql);
    $delete = $query->execute(array($ID_Worker));

    if($delete){
        $sessData['status']['type'] = 'успех';
        $sessData['status']['msg'] = 'Данные участника были успешно удалены.';
    }else{
        $sessData['status']['type'] = 'ошибка';
        $sessData['status']['msg'] = 'Возникла какая-то проблема, пожалуйста, повторите попытку.';
    }

    // Сохранить статус в сеансе
    $_SESSION['sessData'] = $sessData;
}
// Перенаправление на соответствующий заголовок страниц
header("Location:".$redirectUrl);
die();
?>