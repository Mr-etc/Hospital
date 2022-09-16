<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$HeaderData['Site_info']['site_name']?></title>
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/main.css">
</head>

<body>
    <?php 
        require_once 'views/layouts/header.php'; 
    ?>
    <div class="content">
        <?php
        if(!empty($_SESSION['User_data']))
            require_once 'views/layouts/popup_appointment.php'; 
        ?>
        <section class="section-wrong">
            <div class="wrap">
                <div class="section-wrong_banner">
                    <h1 class="title">Важно!</h1>
                    <p class="text">В целях противодействия распространению вирусной инфекции в больнице <?=$Site_info['site_name']?> временно ограничен допуск посетителей. Прием передач для госпитализированных пациентов организован в холлах. Сбор ведется в маркированных тележках, все оперативно доставляется в отделения.</p>
                    <p class="text">В медучреждении предусмотрена возможность ежедневного информирования родственников о состоянии пациентов, находящихся на лечении. Такую справку можно получить по телефону единой справочной службы медучреждения: 8 <?php echo preg_replace("~^(\d{3})(\d{3})(\d{2})(\d{2})$~", "($1) $2 $3-$4", $Site_info['our_phone']); ?>. Беседы с лечащим врачом проводятся ежедневно с 14:00 до 16:00. Связь по местному телефону с поста охраны в холлах лечебных корпусов.</p>
                </div>
            </div>
        </section>
        <section class="section-about">
                <div class="wrap">
                    <div class="section-about_block">
                        <img class="section-about_block-image" src="image/main/about-block.jpg" alt="about" srcset="">
                    </div>
                    <div class="section-about_block">
                        <h1 class="section-about_block-header"><?=$Site_info['site_name']?></h1>
                        <p class="section-about_block-desc">Одно из самых крупных медицинских учреждений столицы, объединяющее многопрофильный стационар, консультативно-диагностический центр, научно-исследовательские институты и кафедры постдипломного образования. Более 30 лет оказывает медицинскую помощь. Среди пациентов ФНКЦ спортсмены олимпийской сборной и космонавты, а также граждане со всей России и иностранцы, которым необходимо медицинское обслуживание.</p>
                        <?php if(!empty($_SESSION['User_data'])):?>
                            <span onclick="initializePopup()" class="section-about_block-button">Записаться на прием</span>
                        <?php endif;?>
                    </div>
                </div>
        </section>
        <section class="section-department">
            <div class="wrap">
                <div class="header_block"><h1>Отделения</h1></div>
                <div class="section-department_block wd100">
                    <?php
                        foreach($blocks_Departments as $blockitem):
                     ?>
                    <div class="section-department_block-item">
                        <h1 class="section-department_block-item_header"><?=$blockitem['name']?></h1>
                        <div class="section-department_block-item_content">
                            <p class="desc_text"><?=$blockitem['short_description']?></p>
                        </div>
                        <a href="departments/<?=$blockitem['id']?>" class="section-department_block-item_button"><?=$blockitem['name']?></a>
                    </div>
                        <?php endforeach;?>
                </div>
            </div>
        </section>
        <section class="section-stats">
            <div class="wrap">
                <div class="section-stats_header header_block"><h1>Статистика нашей больницы</h1></div>
                <div class="section-stats_block">
                    <img src="image/main/doctors.png" alt="doctors" class="section-stats_block-img">
                    <div class="section-stats_block-items">
                        <div class="item">
                            <h1 class="item-header">600</h1>
                            <p class="item-desc">Врачей</p>
                        </div>
                        <div class="item">
                            <h1 class="item-header">59</h1>
                            <p class="item-desc">Отделений</p>
                        </div>
                        <div class="item">
                            <h1 class="item-header">83</h1>
                            <p class="item-desc">Года опыта</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-location">
            <div class="wrap">
                <div class="header_block"><h1>Мы на карте</h1></div>
                <iframe class="section-location_body" src="https://yandex.ru/map-widget/v1/-/CCQ37IBNdA" allowfullscreen="true"></iframe>
                </div>
        </section>
    </div>
    <?php
        require_once 'views/layouts/footer.php'; 
    ?>
</body>

</html>