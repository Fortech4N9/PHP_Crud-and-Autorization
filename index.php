<?php
require_once  ('databaseConfig.php');
$object = new databaseConfig();
$object->startSession();
$conn = $object->createConnection();

if (isset($_POST['search-button'])){
    $a = $_POST['search-bd'];
    if ($a == null) $a = "";
    $sql = "select TOP 10 AM.URL_Image,AM.Name_Amenities,atw.ID_Worker,AM.Descript,wr.Cost_work from [dbo].[Amenities] AM
join [dbo].[Amenities_to_Workers] atw on AM.ID_Amenities = atw.ID_Amenities
join [dbo].[Workers] wr on wr.ID_Worker = atw.ID_Worker
where CONCAT(AM.URL_Image,AM.Name_Amenities,atw.ID_Worker,AM.Descript,wr.Cost_work) like '%$a%';";
    $members = $object->getArrayFromTable($sql,$conn);
}else
$sql = "select TOP 10 AM.URL_Image,AM.Name_Amenities,atw.ID_Worker,AM.Descript,wr.Cost_work from [dbo].[Amenities] AM
join [dbo].[Amenities_to_Workers] atw on AM.ID_Amenities = atw.ID_Amenities
join [dbo].[Workers] wr on wr.ID_Worker = atw.ID_Worker";
$members = $object->getArrayFromTable($sql,$conn);
?>
<!DOCTYPE html>
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
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.21.1/dist/bootstrap-table.min.css">
    <link rel="canonical" href="https://www.creative-tim.com/product/fresh-bootstrap-table"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Bootstrap demo</title>
</head>
<body>
<div class="container-sm">
    <header
        class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 ">
        <div class="logo">
            <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                <div class="logo-image">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                         class="bi bi-laptop" viewBox="0 0 16 16">
                        <path
                            d="M13.5 3a.5.5 0 0 1 .5.5V11H2V3.5a.5.5 0 0 1 .5-.5h11zm-11-1A1.5 1.5 0 0 0 1 3.5V12h14V3.5A1.5 1.5 0 0 0 13.5 2h-11zM0 12.5h16a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5z" />
                    </svg>
                </div>
                &nbspминжкх
            </a>
        </div>
        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">

            <li href="#" class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                   data-toggle="dropdown" aria-expanded="false">
                    Компании
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">По регионам</a></li>
                    <li><a class="dropdown-item" href="#">По городам</a></li>
                </ul>
            </li>
            <li href="#" class="nav-item"><a href="#" class="nav-link">Жилой фонд</a></li>
            <li href="#" class="nav-item"><a href="#" class="nav-link">Новости</a></li>
            <li href="#" class="nav-item"><a href="#" class="nav-link">О проекте</a></li>
        </ul>

        <div class="col-md-3 text-end">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" class="bi bi-search"
                 viewBox="0 0 16 16">
                <path
                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                <a href="#"></a>
            </svg>
        </div>
    </header>
    <div class="block-heading-two">
        <h1>Управляющие компании ЖКХ и ТСЖ</h1>
    </div>
    <div class="col-md-12 col-sm-12">
        <p>
            МинЖКХ - некоммерческий общественный инициативный проект повышения общественной осведомлённости в
            области функционирования управляющих компаний и ТСЖ.
            Мы полны решимости побудить управляющие компании к поиску и реализации путей решения проблем в сфере
            жилищно-коммунального хозяйства и оптимизации
            расходов на содержание жилого фонда. За проектом стоят неравнодушные граждане, желающие порядка в сфере
            жилищно-коммунального хозяйства и связанных
            с ним отраслей. Вы тоже можете быть одним из них. Мы стремимся к эффективному использованию информации
            во имя прогресса общества и поддержки
            государства в раскрытии информации для большей доступности, прозрачности и подотчетности.
        </p>
    </div>
    <div class="block-heading-two text center border-bottom text-center">
        <h3><span>Статистика проекта</span></h3>
    </div>
    <div class="counter-one text-center">
        <div class="container">
            <div class="counter-content">
                <div class="row">
                    <div class="col-md-3 col-sm-4 col-xs-6">
                        <div class="counter-item">
                            <div class="counter-image" style="color: #d08166;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                     class="bi bi-building" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                          d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022zM6 8.694 1 10.36V15h5V8.694zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15z" />
                                    <path
                                        d="M2 11h1v1H2v-1zm2 0h1v1H4v-1zm-2 2h1v1H2v-1zm2 0h1v1H4v-1zm4-4h1v1H8V9zm2 0h1v1h-1V9zm-2 2h1v1H8v-1zm2 0h1v1h-1v-1zm2-2h1v1h-1V9zm0 2h1v1h-1v-1zM8 7h1v1H8V7zm2 0h1v1h-1V7zm2 0h1v1h-1V7zM8 5h1v1H8V5zm2 0h1v1h-1V5zm2 0h1v1h-1V5zm0-2h1v1h-1V3z" />
                                </svg>
                            </div>
                            <span class="number-count">934,2</span>
                            <hr class="br brown" style="color: #d08166 ;">
                            <small>тыс. домов</small>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 col-xs-6">
                        <div class="counter-item">
                            <div class="counter-image" style="color: #ed5441;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                     class="bi bi-pin" viewBox="0 0 16 16">
                                    <path
                                        d="M4.146.146A.5.5 0 0 1 4.5 0h7a.5.5 0 0 1 .5.5c0 .68-.342 1.174-.646 1.479-.126.125-.25.224-.354.298v4.431l.078.048c.203.127.476.314.751.555C12.36 7.775 13 8.527 13 9.5a.5.5 0 0 1-.5.5h-4v4.5c0 .276-.224 1.5-.5 1.5s-.5-1.224-.5-1.5V10h-4a.5.5 0 0 1-.5-.5c0-.973.64-1.725 1.17-2.189A5.921 5.921 0 0 1 5 6.708V2.277a2.77 2.77 0 0 1-.354-.298C4.342 1.674 4 1.179 4 .5a.5.5 0 0 1 .146-.354zm1.58 1.408-.002-.001.002.001zm-.002-.001.002.001A.5.5 0 0 1 6 2v5a.5.5 0 0 1-.276.447h-.002l-.012.007-.054.03a4.922 4.922 0 0 0-.827.58c-.318.278-.585.596-.725.936h7.792c-.14-.34-.407-.658-.725-.936a4.915 4.915 0 0 0-.881-.61l-.012-.006h-.002A.5.5 0 0 1 10 7V2a.5.5 0 0 1 .295-.458 1.775 1.775 0 0 0 .351-.271c.08-.08.155-.17.214-.271H5.14c.06.1.133.191.214.271a1.78 1.78 0 0 0 .37.282z" />
                                </svg>
                            </div>
                            <span class="number-count">74,1</span>
                            <hr class="br red" style="color: #ed5441">
                            <small>тыс. УК и ТСЖ</small>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 col-xs-6">
                        <div class="counter-item">
                            <div class="counter-image" style="color: #32c8de;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                     class="bi bi-car-front" viewBox="0 0 16 16">
                                    <path
                                        d="M4 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm10 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2H6ZM4.862 4.276 3.906 6.19a.51.51 0 0 0 .497.731c.91-.073 2.35-.17 3.597-.17 1.247 0 2.688.097 3.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 10.691 4H5.309a.5.5 0 0 0-.447.276Z" />
                                    <path fill-rule="evenodd"
                                          d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679c.033.161.049.325.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.807.807 0 0 0 .381-.404l.792-1.848ZM4.82 3a1.5 1.5 0 0 0-1.379.91l-.792 1.847a1.8 1.8 0 0 1-.853.904.807.807 0 0 0-.43.564L1.03 8.904a1.5 1.5 0 0 0-.03.294v.413c0 .796.62 1.448 1.408 1.484 1.555.07 3.786.155 5.592.155 1.806 0 4.037-.084 5.592-.155A1.479 1.479 0 0 0 15 9.611v-.413c0-.099-.01-.197-.03-.294l-.335-1.68a.807.807 0 0 0-.43-.563 1.807 1.807 0 0 1-.853-.904l-.792-1.848A1.5 1.5 0 0 0 11.18 3H4.82Z" />
                                </svg>
                            </div>
                            <span class="number-count">12,9</span>
                            <hr class="br" style="color: #32c8de;">
                            <small>тыс. населенных пунктов</small>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 col-xs-6">
                        <div class="counter-item">
                            <div class="counter-image" style="color: #51d466;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                     class="bi bi-bookmark-check" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                          d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                    <path
                                        d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                                </svg>
                            </div>
                            <span class="number-count">85</span>
                            <hr class="br-green" style="color: #51d466;">
                            <small>регионов</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="block-heading-two text center border-bottom text-center">
        <h3><span>Поиск информации</span></h3>
    </div>
    <div class="navs-tabs-two">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-link active" id="nav-tab1-tab" data-toggle="tab" href="#nav-home" role="tab"
                   aria-controls="nav-tab1" aria-selected="true">Управляющие компании и ТСЖ</a>
                <a class="nav-link" id="nav-tab2-tab" data-toggle="tab" href="#nav-tab2" role="tab"
                   aria-controls="nav-tab2" aria-selected="false">Многоквартирные дома</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-tab1-tab">
                <form role="form" action="/search" method="get" name="companysearch">
                    <div class="row">
                        <div class="col-md-5 col-sm-12">
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder="название компании" value="">
                        </div>
                        <div class="col-md-5 col-sm-12">
                            <select id="select-companycity" name="city" placeholder="название города..."
                                    tabindex="-1" class="selectized" style="display: none;">
                                <option value="" selected="selected"></option>
                            </select>
                            <div class="selectize-control single">
                                <div class="selectize-input items not-full"><input type="text" autocomplete="off"
                                                                                   tabindex="" placeholder="  название города..."></div>
                                <div class="selectize-dropdown single"
                                     style="display: none; visibility: visible; width: 436px; top: 36px; left: 0px;">
                                    <div class="selectize-dropdown-content"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <button type="submit" class="btn btn-color"><i class="fa fa-search"></i>&nbsp; Найти
                                компанию</button>
                            <input type="hidden" name="searchtype" value="company">
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="nav-tab2" role="tabpanel" aria-labelledby="nav-tab2-tab">
                <form role="form" action="/search" method="get" name="housesearch">
                    <div class="row">
                        <div class="col-md-10 col-sm-6">
                            <input type="text" class="form-control" id="address" name="address"
                                   placeholder="адрес дома, например, Москва, Шаболовка, 37" value="">
                        </div>
                        <div class="col-md-2 col-sm-6">
                            <button type="submit" class="btn btn-block btn-color"><i class="fa fa-search"></i>&nbsp;
                                Найти дом</button>
                            <input type="hidden" name="searchtype" value="house">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="block-heading-two text center border-bottom text-center">
        <h3><span>Управляющие компании ЖКХ И ТСЖ в Москве</span></h3>
    </div>
    <table class="table table-bordered table-striped" style="margin-top: 15px;">
        <thead>
        <tr>
            <th class="col-md-1">№</th>
            <th class="col-md-3">Компания</th>
            <th class="col-md-2">Город</th>
            <th class="col-md-1">Домов</th>
            <th class="col-md-3">Адрес</th>
            <th class="col-md-2">Телефон</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td style="display: flex;justify-content: space-between;">1&nbsp;<span class="table-UK">УК</span>
            </td>
            <td><a href="/moskva/moskva/1027700430889/">УК «Цжку»</a></td>
            <td>Москва</td>
            <td>1876</td>
            <td>Москва г, ул. Спартаковская, д. 2Б</td>
            <td>8 (926) 314-88-27</td>
        </tr>
        <tr>
            <td style="display: flex;justify-content: space-between;">2&nbsp;<span class="table-UK">УК</span>
            </td>
            <td><a href="/moskva/moskva/1027700082266/">УК «Пик-комфорт»</a></td>
            <td>Москва</td>
            <td>1463</td>
            <td>Москва г, ул. Маршала Соколовского, д. 3, помещение II, комната 2,4</td>
            <td>8 (800) 234-22-22</td>
        </tr>
        <tr>
            <td style="display: flex;justify-content: space-between;">3&nbsp;<span class="table-UK">УК</span>
            </td>
            <td><a href="/moskva/moskva/1157746180305/">УК «Гужф»</a></td>
            <td>Москва</td>
            <td>644</td>
            <td>Москва г, пер. Токмаков, д. 5, строение 1</td>
            <td>8 (499) 790-91-11</td>
        </tr>
        <tr>
            <td style="display: flex;justify-content: space-between;">4&nbsp;<span class="table-UK">УК</span>
            </td>
            <td><a href="/moskva/moskva/1157746573368/">УК «Жилищник района перово»</a></td>
            <td>Москва</td>
            <td>530</td>
            <td>Москва г, пр-кт. Зелёный, д. 6, корп. 2</td>
            <td>8 (495) 304-18-40</td>
        </tr>
        <tr>
            <td style="display: flex;justify-content: space-between;">5&nbsp;<span class="table-UK">УК</span>
            </td>
            <td><a href="/moskva/moskva/5147746268280/">УК «Жилищник пресненского района»</a></td>
            <td>Москва</td>
            <td>522</td>
            <td>Москва г, ул. Красная Пресня, д. 26, строение 1</td>
            <td>8 (499) 255-68-18</td>
        </tr>
        <tr>
            <td style="display: flex;justify-content: space-between;">6&nbsp;<span class="table-UK">УК</span>
            </td>
            <td><a href="/moskva/moskva/5137746116657/">УК «Жилищник басманного района»</a></td>
            <td>Москва</td>
            <td>506</td>
            <td>Москва г, пер. 1-й Басманный, д. 6</td>
            <td>8 (499) 391-41-08</td>
        </tr>
        <tr>
            <td style="display: flex;justify-content: space-between;">7&nbsp;<span class="table-UK">УК</span>
            </td>
            <td><a href="/moskva/moskva/1137746552877/">УК «Жилищник района тверской»</a></td>
            <td>Москва</td>
            <td>432</td>
            <td>Москва г, б-р. Цветной, д. 15, корп. 2</td>
            <td>8 (495) 624-71-72</td>
        </tr>
        <tr>
            <td style="display: flex;justify-content: space-between;">8&nbsp;<span class="table-UK">УК</span>
            </td>
            <td><a href="/moskva/moskva/1137746566760/">УК «Жилищник района хорошево-мневники»</a></td>
            <td>Москва</td>
            <td>430</td>
            <td>Москва г, наб.. Карамышевская, д. 12, корп. 1</td>
            <td>8 (499) 191-40-86</td>
        </tr>
        <tr>
            <td style="display: flex;justify-content: space-between;">9&nbsp;<span class="table-UK">УК</span>
            </td>
            <td><a href="/moskva/moskva/1137746564097/">УК «Жилищник района люблино»</a></td>
            <td>Москва</td>
            <td>421</td>
            <td>Москва г, ул. Кубанская, д. 27</td>
            <td>8 (495) 350-01-45</td>
        </tr>
        <tr>
            <td style="display: flex;justify-content: space-between;">10&nbsp;<span class="table-UK">УК</span>
            </td>
            <td><a href="/moskva/moskva/1157746514375/">УК «Жилищник Можайского района»</a></td>
            <td>Москва</td>
            <td>388</td>
            <td>ул. Барвихинская, д. 8, к. 2</td>
            <td>8 (916) 390-53-27</td>
        </tr>
        <tr>
            <td colspan="6"><a href="/moskva/moskva/">Полный список УК ЖКХ И ТСЖ в Москве</a> (3576)</td>
        </tr>
        </tbody>
    </table>
    <div class="block-heading-two text center border-bottom text-center">
        <h3><span>География проекта</span></h3>
    </div>
    <div class="row margin-bottom-20" style="margin-top: 15px;">
        <ul class="col-md-3 list-unstyled">
            <li><a href="/adygeya/">Адыгея</a></li>
            <li><a href="/altay/">Алтай</a></li>
            <li><a href="/altayskiy-kray/">Алтайский край</a></li>
            <li><a href="/amurskaya-oblast/">Амурская область</a></li>
            <li><a href="/arhangelskaya-oblast/">Архангельская область</a></li>
            <li><a href="/astrahanskaya-oblast/">Астраханская область</a></li>
            <li><a href="/bashkortostan/">Башкортостан</a></li>
            <li><a href="/belgorodskaya-oblast/">Белгородская область</a></li>
            <li><a href="/bryanskaya-oblast/">Брянская область</a></li>
            <li><a href="/buryatiya/">Бурятия</a></li>
            <li><a href="/vladimirskaya-oblast/">Владимирская область</a></li>
            <li><a href="/volgogradskaya-oblast/">Волгоградская область</a></li>
            <li><a href="/vologodskaya-oblast/">Вологодская область</a></li>
            <li><a href="/voronezhskaya-oblast/">Воронежская область</a></li>
            <li><a href="/dagestan/">Дагестан</a></li>
            <li><a href="/evreyskaya-avtonomnaya-oblast/">Еврейская автономная область</a></li>
            <li><a href="/zabaykalskiy-kray/">Забайкальский край</a></li>
            <li><a href="/ivanovskaya-oblast/">Ивановская область</a></li>
            <li><a href="/ingushetiya/">Ингушетия</a></li>
            <li><a href="/irkutskaya-oblast/">Иркутская область</a></li>
            <li><a href="/kabardino-balkarskaya-respublika/">Кабардино-Балкарская Республика</a></li>
        </ul>
        <ul class="col-md-3 list-unstyled">
            <li><a href="/kaliningradskaya-oblast/">Калининградская область</a></li>
            <li><a href="/kalmykiya/">Калмыкия</a></li>
            <li><a href="/kaluzhskaya-oblast/">Калужская область</a></li>
            <li><a href="/kamchatskiy-kray/">Камчатский край</a></li>
            <li><a href="/karachaevo-cherkesskaya-respublika/">Карачаево-Черкесская Республика</a></li>
            <li><a href="/kareliya/">Карелия</a></li>
            <li><a href="/kemerovskaya-oblast/">Кемеровская область</a></li>
            <li><a href="/kirovskaya-oblast/">Кировская область</a></li>
            <li><a href="/komi/">Коми</a></li>
            <li><a href="/kostromskaya-oblast/">Костромская область</a></li>
            <li><a href="/krasnodarskiy-kray/">Краснодарский край</a></li>
            <li><a href="/krasnoyarskiy-kray/">Красноярский край</a></li>
            <li><a href="/krym/">Крым</a></li>
            <li><a href="/kurganskaya-oblast/">Курганская область</a></li>
            <li><a href="/kurskaya-oblast/">Курская область</a></li>
            <li><a href="/leningradskaya-oblast/">Ленинградская область</a></li>
            <li><a href="/lipeckaya-oblast/">Липецкая область</a></li>
            <li><a href="/magadanskaya-oblast/">Магаданская область</a></li>
            <li><a href="/mariy-el/">Марий Эл</a></li>
            <li><a href="/mordoviya/">Мордовия</a></li>
            <li><a href="/moskva/">Москва</a></li>
        </ul>
        <ul class="col-md-3 list-unstyled">
            <li><a href="/moskovskaya-oblast/">Московская область</a></li>
            <li><a href="/murmanskaya-oblast/">Мурманская область</a></li>
            <li><a href="/neneckiy-ao/">Ненецкий АО</a></li>
            <li><a href="/nizhegorodskaya-oblast/">Нижегородская область</a></li>
            <li><a href="/novgorodskaya-oblast/">Новгородская область</a></li>
            <li><a href="/novosibirskaya-oblast/">Новосибирская область</a></li>
            <li><a href="/omskaya-oblast/">Омская область</a></li>
            <li><a href="/orenburgskaya-oblast/">Оренбургская область</a></li>
            <li><a href="/orlovskaya-oblast/">Орловская область</a></li>
            <li><a href="/penzenskaya-oblast/">Пензенская область</a></li>
            <li><a href="/permskiy-kray/">Пермский край</a></li>
            <li><a href="/primorskiy-kray/">Приморский край</a></li>
            <li><a href="/pskovskaya-oblast/">Псковская область</a></li>
            <li><a href="/severnaya-osetiya-alaniya/">Республика Северная Осетия-Алания</a></li>
            <li><a href="/tatarstan/">Республика Татарстан</a></li>
            <li><a href="/rostovskaya-oblast/">Ростовская область</a></li>
            <li><a href="/ryazanskaya-oblast/">Рязанская область</a></li>
            <li><a href="/samarskaya-oblast/">Самарская область</a></li>
            <li><a href="/sankt-peterburg/">Санкт-Петербург</a></li>
            <li><a href="/saratovskaya-oblast/">Саратовская область</a></li>
            <li><a href="/saha-yakutiya/">Саха (Якутия)</a></li>
        </ul>
        <ul class="col-md-3 list-unstyled">
            <li><a href="/sahalinskaya-oblast/">Сахалинская область</a></li>
            <li><a href="/sverdlovskaya-oblast/">Свердловская область</a></li>
            <li><a href="/sevastopol/">Севастополь</a></li>
            <li><a href="/smolenskaya-oblast/">Смоленская область</a></li>
            <li><a href="/stavropolskiy-kray/">Ставропольский край</a></li>
            <li><a href="/tambovskaya-oblast/">Тамбовская область</a></li>
            <li><a href="/tverskaya-oblast/">Тверская область</a></li>
            <li><a href="/tomskaya-oblast/">Томская область</a></li>
            <li><a href="/tulskaya-oblast/">Тульская область</a></li>
            <li><a href="/tyva/">Тыва</a></li>
            <li><a href="/tyumenskaya-oblast/">Тюменская область</a></li>
            <li><a href="/udmurtskaya-respublika/">Удмуртская Республика</a></li>
            <li><a href="/ulyanovskaya-oblast/">Ульяновская область</a></li>
            <li><a href="/habarovskiy-kray/">Хабаровский край</a></li>
            <li><a href="/hakasiya/">Хакасия</a></li>
            <li><a href="/hanty-mansiyskiy-yugra-ao/">Ханты-Мансийский (Югра) АО</a></li>
            <li><a href="/chelyabinskaya-oblast/">Челябинская область</a></li>
            <li><a href="/chechenskaya-respublika/">Чеченская Республика</a></li>
            <li><a href="/chuvashskaya-respublika/">Чувашская Республика</a></li>
            <li><a href="/chukotskiy-ao/">Чукотский АО</a></li>
            <li><a href="/yamalo-neneckiy-ao/">Ямало-Ненецкий АО</a></li>
        </ul>
        <ul class="col-md-3 list-unstyled">
            <li><a href="/yaroslavskaya-oblast/">Ярославская область</a></li>
        </ul>
    </div>
    <div class="block-heading-two text center border-bottom text-left">
        <h3>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                         class="bi bi-graph-up" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                              d="M0 0h1v15h15v1H0V0Zm14.817 3.113a.5.5 0 0 1 .07.704l-4.5 5.5a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61 4.15-5.073a.5.5 0 0 1 .704-.07Z" />
                    </svg>
                    Сводная статистика</span>
        </h3>
    </div>
    <p style="margin-top: 20px;">
        Ниже представлена сводная статистика общего числа построенных домов в целом по России с указанием суммарной
        площади по годам.
    </p>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Год постройки</th>
                <th>Суммарная площадь</th>
                <th>Число домов</th>
                <th>Кол-во квартир</th>
                <th>Жилая площадь</th>
                <th>Нежилая площадь</th>
                <th>Нежилых помещений</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>2020&nbsp;–&nbsp;2029</td>
                <td>83277004 м<sup>2</sup></td>
                <td><span class="number-of-house">6159</span></td>
                <td>1056970</td>
                <td>46191383 м<sup>2</sup></td>
                <td>4401067 м<sup>2</sup></td>
                <td>129650</td>
            </tr>
            <tr>
                <td>2010&nbsp;–&nbsp;2019</td>
                <td>726232757 м<sup>2</sup></td>
                <td><span class="number-of-house">63858</span></td>
                <td>7467413</td>
                <td>363334274 м<sup>2</sup></td>
                <td>37471815 м<sup>2</sup></td>
                <td>825802</td>
            </tr>
            <tr>
                <td>2000&nbsp;–&nbsp;2009</td>
                <td>277388410 м<sup>2</sup></td>
                <td><span class="number-of-house">39638</span></td>
                <td>3717451</td>
                <td>212001506 м<sup>2</sup></td>
                <td>25461272 м<sup>2</sup></td>
                <td>234806</td>
            </tr>
            <tr>
                <td>1990&nbsp;–&nbsp;1999</td>
                <td>282466678 м<sup>2</sup></td>
                <td><span class="number-of-house"
                          style="background-color:#cb79e6; border: 4px solid #cb79e6;">67451</span></td>
                <td>4670577</td>
                <td>235045718 м<sup>2</sup></td>
                <td>113271394 м<sup>2</sup></td>
                <td>203549</td>
            </tr>
            <tr>
                <td>1980&nbsp;–&nbsp;1989</td>
                <td>508891625 м<sup>2</sup></td>
                <td><span class="number-of-house"
                          style="background-color:#d08166 ;border: 4px solid #d08166">140551</span></td>
                <td>9042580</td>
                <td>421550587 м<sup>2</sup></td>
                <td>93177443 м<sup>2</sup></td>
                <td>300742</td>
            </tr>
            <tr>
                <td>1970&nbsp;–&nbsp;1979</td>
                <td>590624093 м<sup>2</sup></td>
                <td><span class="number-of-house"
                          style="background-color:#609cec ;border: 4px solid #609cec">148194</span></td>
                <td>9287890</td>
                <td>421497921 м<sup>2</sup></td>
                <td>24481200 м<sup>2</sup></td>
                <td>448198</td>
            </tr>
            <tr>
                <td>1960&nbsp;–&nbsp;1969</td>
                <td>348403888 м<sup>2</sup></td>
                <td><span class="number-of-house"
                          style="background-color:#51d466 ;border: 4px solid #51d466">163363</span></td>
                <td>7219661</td>
                <td>277821719 м<sup>2</sup></td>
                <td>21007365 м<sup>2</sup></td>
                <td>292438</td>
            </tr>
            <tr>
                <td>1950&nbsp;–&nbsp;1959</td>
                <td>126710843 м<sup>2</sup></td>
                <td><span class="number-of-house"
                          style="background-color:#f8a841 ;border: 4px solid #f8a841">110944</span></td>
                <td>5212295</td>
                <td>90540988 м<sup>2</sup></td>
                <td>12552539 м<sup>2</sup></td>
                <td>106104</td>
            </tr>
            <tr>
                <td>1940&nbsp;–&nbsp;1949</td>
                <td>18443488 м<sup>2</sup></td>
                <td><span class="number-of-house">24823</span></td>
                <td>281025</td>
                <td>12503162 м<sup>2</sup></td>
                <td>1615388 м<sup>2</sup></td>
                <td>13350</td>
            </tr>
            <tr>
                <td>1930&nbsp;–&nbsp;1939</td>
                <td>120530130 м<sup>2</sup></td>
                <td><span class="number-of-house">16271</span></td>
                <td>280849</td>
                <td>14301059 м<sup>2</sup></td>
                <td>2011082 м<sup>2</sup></td>
                <td>24237</td>
            </tr>
            <tr>
                <td>1920&nbsp;–&nbsp;1929</td>
                <td>5039439 м<sup>2</sup></td>
                <td><span class="number-of-house"
                          style="background-color:#ed5441 ;border: 4px solid #ed5441">5744</span></td>
                <td>79320</td>
                <td>3626896 м<sup>2</sup></td>
                <td>559936 м<sup>2</sup></td>
                <td>8757</td>
            </tr>
            <tr>
                <td>1910&nbsp;–&nbsp;1919</td>
                <td>15486391 м<sup>2</sup></td>
                <td><span class="number-of-house">20918</span></td>
                <td>215145</td>
                <td>10546961 м<sup>2</sup></td>
                <td>2104929 м<sup>2</sup></td>
                <td>21834</td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td><strong>Итого</strong></td>
                <td><strong>3103494746 м<sup>2</sup></strong></td>
                <td><strong>807914</strong></td>
                <td><strong>48531176</strong></td>
                <td><strong>2108962174 м<sup>2</sup></strong></td>
                <td><strong>338115430 м<sup>2</sup></strong></td>
                <td><strong>2609467</strong></td>
            </tr>
            </tfoot>
        </table>
        <div><a class="btn btn-default" href="https://dom.mingkh.ru/">Подробная статистика</a></div>
    </div>

    <div class="block-heading-two text center border-bottom text-center">
        <h3><span>Услуги</span></h3>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 head">
                <div class="float-right crud">
                    <form method="post" style="display: flex; justify-content: space-between; gap: 20px ">
                        <button class="btn btn-success" name="search-button">Поиск</button>
                        <input type="text" class="form-control" name="search-bd"
                               placeholder="поиск" value="">
                    </form>
                    <a href="AddService.php" class="btn btn-success"><i class="plus"></i>Добавить услугу</a>
                </div>
            </div>
            <table  id="fresh-table" class="table">
                <thead class="thead-dark">
                <tr>
                    <th data-field = "id_service" data-sortable="true">#</th>
                    <th data-field = "picture"  style="text-align: center; padding: 0;vertical-align: center">Картинка</th>
                    <th data-field="Cost" data-sortable="true">Название услуги</th>
                    <th data-field="id_worker" data-sortable="true">ID Рабочего</th>
                    <th data-field="description" data-sortable="true">Описание</th>
                    <th data-field="Cost_work" data-sortable="true">Стоимость</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (!empty($members)){$count = 0;foreach ($members as $row){$count++; ?>
                    <tr>
                        <td><?php echo $count?></td>
                        <td><img  class="image-table" src=<?php echo $row['URL_Image']?>></td>
                        <td><?php echo $row['Name_Amenities']?></td>
                        <td><?php echo $row['ID_Worker']?></td>
                        <td><?php echo $row['Descript']?></td>
                        <td><?php echo $row['Cost_work']?></td>
                    </tr>
                <?php } }else{?>
                    <tr><td colspan="7">NO members(s) found...</td></tr>
                <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="foot">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="foot-item">
                    <h5 class="bold">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-building" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022zM6 8.694 1 10.36V15h5V8.694zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15z" />
                            <path
                                d="M2 11h1v1H2v-1zm2 0h1v1H4v-1zm-2 2h1v1H2v-1zm2 0h1v1H4v-1zm4-4h1v1H8V9zm2 0h1v1h-1V9zm-2 2h1v1H8v-1zm2 0h1v1h-1v-1zm2-2h1v1h-1V9zm0 2h1v1h-1v-1zM8 7h1v1H8V7zm2 0h1v1h-1V7zm2 0h1v1h-1V7zM8 5h1v1H8V5zm2 0h1v1h-1V5zm2 0h1v1h-1V5zm0-2h1v1h-1V3z" />
                        </svg>
                        &nbsp;Общественный проект «МинЖКХ.РУ»
                    </h5>

                    <p>Сайт общественного инициативного проекта по раскрытию информации о детятельности управляющих
                        компаний и товариществ собственников жилья</p>
                </div>
            </div>
            <div class="col-md-5 col-sm-6">
                <div class="foot-item">
                    <h5 class="bold">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-building" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022zM6 8.694 1 10.36V15h5V8.694zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15z" />
                            <path
                                d="M2 11h1v1H2v-1zm2 0h1v1H4v-1zm-2 2h1v1H2v-1zm2 0h1v1H4v-1zm4-4h1v1H8V9zm2 0h1v1h-1V9zm-2 2h1v1H8v-1zm2 0h1v1h-1v-1zm2-2h1v1h-1V9zm0 2h1v1h-1v-1zM8 7h1v1H8V7zm2 0h1v1h-1V7zm2 0h1v1h-1V7zM8 5h1v1H8V5zm2 0h1v1h-1V5zm2 0h1v1h-1V5zm0-2h1v1h-1V3z" />
                        </svg>
                        &nbsp;&nbsp;Министерства и ведомства
                    </h5>
                    <div class="foot-item-content">
                        <ul class="list-unstyled">
                            <li><a href="http://rospotrebnadzor.ru/" rel="nofollow"
                                   target="_blank">Роспотребнадзор</a>
                            </li>
                            <li><a href="https://minstroyrf.gov.ru/" rel="nofollow" target="_blank">Министерство
                                    строительства и ЖКХ</a></li>
                            <li><a href="https://xn--d1aqf.xn--p1ai/urban/" rel="nofollow" target="_blank">Фонд
                                    единого института развития в жилищной сфере</a></li>
                            <li><a href="http://gkhrazvitie.ru/" rel="nofollow" target="_blank">Некоммерческое
                                    партнерство «ЖКХ Развитие»</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer>
    <div class="container">
        <div class="footer-left">
            <p class="pull-left">© 2015 - 2022 <a href="#">МинЖКХ.РУ</a></p>&nbsp;
            <script type="text/javascript">
                document.write("<a href='//www.liveinternet.ru/click' " +
                    "target=_blank><img src='//counter.yadro.ru/hit?t44.1;r" +
                    escape(document.referrer) + ((typeof (screen) == "undefined") ? "" :
                        ";s" + screen.width + "*" + screen.height + "*" + (screen.colorDepth ?
                            screen.colorDepth : screen.pixelDepth)) + ";u" + escape(document.URL) +
                    ";h" + escape(document.title.substring(0, 80)) + ";" + Math.random() +
                    "' alt='' title='LiveInternet' " +
                    "border='0' width='31' height='31'><\/a>")
            </script>
        </div>
        <div class="footer-right">
            <ul class="list-inline">
                <li><a href="/about/">О проекте</a>
                </li>
                <li>
                </li>
                <li><a href="/news/">Новости</a></li>
                <li><a href="/region/">Компании</a></li>
                <li><a href="/feedback/">Обратная связь</a></li>
            </ul>
            <div class="clearfix"></div>
        </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>
</body>
</html>


