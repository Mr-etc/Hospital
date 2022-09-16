<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$HeaderData['Site_info']['site_name']?> - Отделения</title>
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/departments.css">
</head>
<body>
    <?php
        require_once 'views/layouts/header.php'; 
    ?>
    <div class="content">
       <section class="section-department-info">
           <div class="wrap">
                <div class="header_block"><h1><?=$department_info['name']?></h1></div>
               <div class="section-department-info_body">
                   <div class="section-department-info_body_block ">
                        <div class="item_doctor">
                                <div class="item-image"><img src="../<?=$doctors_data['photo']?>" alt="doctor_image"></div>
                                <div class="item-desc">
                                    <a href="/doctors/<?=$doctors_data['id']?>" class="item-desc_header"><?=$doctors_data['FIO']?></a>
                                    <p class="item-desc_text">Заведующий отделения</p>
                                </div>
                        </div>
                   </div>
                   <div class="section-department-info_body_block">
                       <?php foreach($department_info['description'] as $item):
                            if(!is_array($item[1]))
                                echo "<$item[0]>".$item[1]."</$item[0]>";
                            else{
                                if($item[0] == 'ul' || $item[0] == 'ol'){
                                    echo "<$item[0]>";
                                    foreach($item[1] as $subitem){
                                        echo "<li>$subitem</li>";
                                    }
                                    echo "</$item[0]>";
                                }else
                                    foreach($item[1] as $subitem)
                                        echo "<$item[0]>$subitem</$item[0]>";
                                    
                            }
                        ?>
                       <?php endforeach;?>
                   </div>
               </div>
           </div>
       </section>
    </div>
    <?php
        require_once 'views/layouts/footer.php'; 
    ?>
</body>
</html>