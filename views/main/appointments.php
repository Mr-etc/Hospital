<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$HeaderData['Site_info']['site_name']?></title>
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/appointments.css">
</head>

<body>
    <?php 
        require_once 'views/layouts/header.php'; 
    ?>
    <div class="content">
       <div class="section-appointments">
           <table class="section-appointments_body">
               <caption>Лист записей на прием</caption>
               <tbody class="table_body">
                   <tr>
                       <th>ФИО</th>
                       <th>Дата рождения</th>
                       <th>Пол</th>
                       <th>Почта</th>
                       <th>Номер телефона</th>
                       <th>Снилс</th>
                   </tr>
                   <?php for($i = 0; $i < 5; $i++):?>
                        <tr>
                            <td>Мыра Артем Валерьевич</td>
                            <td>03.12.2001</td>
                            <td>Муж</td>
                            <td>art.myra@yandex.ru</td>
                            <td>79778800733</td>
                            <td>123-132-656 12</td>
                        </tr>
                   <?php endfor;?>
               </tbody>
           </table>
       </div>
    </div>
    <?php
        require_once 'views/layouts/footer.php'; 
    ?>
</body>

</html>