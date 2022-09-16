<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$HeaderData['Site_info']['site_name'].' - '.$doctor_data['FIO']?></title>
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/doctors.css">
</head>
<body>
    <?php require_once 'views/layouts/header.php'; ?>
    <div class="content">
        <section class="section-doctor-info">
            <div class="wrap">
                <div class="body">
                    <div class="section-doctor-info_block-picture">
                        <img src="/<?=$doctor_data['photo']?>" alt="doctor_image">
                    </div>
                    <div class="section-doctor-info_block-info">
                        <h1 class="doctor-name"><?=$doctor_data['FIO']?></h1>
                        <p class="doctor-desc"><?=$doctor_data['Department_name']?></p>
                        <div class="doctor-indicators">
                            <span class="doctor-indicators_text">
                                <p class="key">Дата рождения</p>
                                <p class="value"><?=$doctor_data['birthdate']?></p>
                            </span>
                            <span class="doctor-indicators_text">
                                <p class="key">Образование</p>
                                <p class="value"><?=$doctor_data['education']?></p>
                            </span>
                            <span class="doctor-indicators_text">
                                <p class="key">Дата окончания ВУЗ</p>
                                <p class="value"><?=$doctor_data['graduation_date']?></p>
                            </span>
                            <span class="doctor-indicators_text">
                                <p class="key">Номер телефона</p>
                                <p class="value">8 <?php echo preg_replace("~^(\d{3})(\d{3})(\d{2})(\d{2})$~", "($1) $2 $3-$4", $doctor_data['phone']); ?></p>
                            </span>
                            <span class="doctor-indicators_text">
                                <p class="key">Рабочий кабинет</p>
                                <p class="value"><?=$doctor_data['cabinet']?></p>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php require_once 'views/layouts/footer.php'; ?>
</body>
</html>