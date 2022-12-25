<?php
require_once 'C:\localhost\PHP_Crud-and-Autorization\databaseConfig.php';
$object = new databaseConfig();
$object->startSession();
$redirectUrl = "http://localhost:3000/homepage";
if (isset($_POST['userSubmit'])){
    $ID_Amenities = $_POST['ID_Amenities'];
    $Name_Amenities = trim(strip_tags($_POST['Name_Amenities']));
    $Descript = trim(strip_tags($_POST['Descript']));
    $URL_Image = ($_POST['URL_Image']);
    $ID_Worker = ($_POST['ID_Worker']);


    $id_str = '';
    if(!empty($id)){
        $id_str = '?id'.$ID_Amenities;
    }
    //validation
    $errorMsg = '';
    if(empty($Name_Amenities))
        $errorMsg.='<p>Пожайлуста заполните все поля!!</p>';
    if(empty($Descript))
        $errorMsg.='<p>Пожайлуста заполните все поля!!</p>';
    if(empty($URL_Image))
        $errorMsg.='<p>Пожайлуста заполните все поля!!</p>';
    if(empty($ID_Worker))
        $errorMsg.='<p>Пожайлуста заполните все поля!!</p>';

    //submitted form data
    $userData = array(
        'Name_Amenities' =>$Name_Amenities,
        'Descript' =>$Descript,
        'URL_Image'=>$URL_Image,
        'ID_Worker'=>$ID_Worker
    );

    //process the form data
    if (empty($errorMsg)){
        if(!empty($ID_Amenities)){
            //Update data in SQL server
            $sql = "update [dbo].[Amenities] set Name_Amenities = ?,Descript = ?,URL_Image = ?,ID_Worker = ? where ID_Amenities = ?;";
            $query = $object->createConnection()->prepare($sql);
            $update = $query->execute(array($Name_Amenities,$Descript,$URL_Image,$ID_Worker,$ID_Amenities));
            if ($update){
                $sessData['status']['type'] = 'success';
                $sessData['status']['msg'] = 'Обновление данных прошло успешно';

                unset($sessData['userData']);
            }else{
                $sessData['status']['type'] = 'error';
                $sessData['status']['msg'] = 'Возникли проблемы с обнолвением, повторите заново!';

                $redirectURL = 'userActionAmentities.php'.$id_str;
            }
        }else{
            //insert data in SQL server
            $sql = "insert into [dbo].[Amenities] (Name_Amenities,Descript,URL_Image,ID_Worker) values(?,?,?,?);";
            $params = array(
                &$Name_Amenities,
                &$Descript,
                &$URL_Image,
                &$ID_Worker,
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

                $redirectURL = 'userActionAmentities.php'.$id_str;
            }
        }
    }else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'Возникли проблемы с добавлением, повторите заново!';

        $redirectURL = 'userActionAmentities.php'.$id_str;
    }
    $_SESSION['sessData'] = $sessData;

}elseif(($_REQUEST['action_type'] == 'delete') && !empty($_GET['id'])){
    $ID_Amenities = $_GET['id'];

    // Удалить данные с SQL server
    $sql = "delete  from [dbo].[Amenities] where ID_Amenities = ?;";
    $query = $object->createConnection()->prepare($sql);
    $delete = $query->execute(array($ID_Amenities));

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
