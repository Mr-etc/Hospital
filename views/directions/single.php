<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$HeaderData['Site_info']['site_name']?> - Направления</title>
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/directions.css">
    <link rel="stylesheet" href="/css/slider.css">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/slick.js"></script>
    <script type="text/javascript" src="../js/slider.js"></script>
</head>
<body>
    <?php require_once 'views/layouts/header.php' ?>
    <div class="content">
        <section class="section-direction">
            <div class="wrap wrap_column">
                <div class="header_block"><h1><?=$directionData['name']?></h1></div>
                <div class="section-direction_description-block">
                    <?php foreach($directionData['description'] as $item)
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
                </div>
            </div>
        </section>
        <?php if($directionData['departments'] != null):?>
        <section class="section-department-slider">
           <div class="wrap wrap_column">
                <div class="header_block"><h1>Отделения</h1></div>
                <div class="section-department-slider_items">
                    <?php foreach($directionData['departments'] as $item):?>
                    <div class="slider_wrap">
                        <div class="item">
                            <div class="item_image-block"><img src="../image/directions/departments_logo.svg" alt="department" class="item_image-block_picture"></div>
                            <div class="item_desc-block">
                                <h4 class="item_desc-block_header"><?=$item['name']?></h4>
                                <a href="/departments/<?=$item['id']?>" class="item_desc-block_link">Подробнее</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
           </div>
        </section>
        <?php endif;?>
    </div>
    <?php require_once 'views/layouts/footer.php' ?>
</body>
</html>