<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$HeaderData['Site_info']['site_name']?> - Контакты</title>
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/contacts.css">
</head>
<body>
    <?php
        require_once 'views/layouts/header.php'; 
    ?>
    <div class="content">
        <section class="section-information">
            <div class="wrap">
                <div class="header_block"><h1>Контакты</h1></div>
                <div class="section-information_block">
                    <div class="section-information_block-section">
                        <div class="section-information_block-section_item">
                            <h3 class="section-information_block-section_item-header">Адрес</h3>
                            <p class="section-information_block-section_item-desc"><?=$Site_info['our_address']?></p>
                        </div>
                        <div class="section-information_block-section_item">
                            <h3 class="section-information_block-section_item-header">Телефон</h3>
                            <p class="section-information_block-section_item-desc"><?=$Site_info['our_phone']?></p>
                        </div>
                        <div class="section-information_block-section_item">
                            <h3 class="section-information_block-section_item-header">Email</h3>
                            <p class="section-information_block-section_item-desc"><?=$Site_info['our_mail']?></p>
                        </div>
                    </div>
                    <div class="section-information_block-section">
                        <div class="section-information_block-section_item">
                            <h3 class="section-information_block-section_item-header">Как добраться до нас:</h3>
                            <ol class="section-information_block-section_item-desc">
                                <?php foreach($Site_info['how_to_get'] as $item): ?>
                                <li><?=$item;?></li>
                                <?php endforeach; ?>
                            </ol>
                        </div>
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