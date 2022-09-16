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
        <section class="section-departments">
            <div class="wrap wrap_column">
                <div class="header_block"><h1>Отделения</h1></div>
                <div class="section-departments_block-list list-block">
                    <ol class="section-departments_block-list_items list-block_items">
                        <?php foreach($departments_data as $item): ?>
                            <li class="section-departments_block-list_items-content list-block_items_content"><a href="departments/<?=$item['id']?>"><?=$item['name']?></a></li>
                        <?php endforeach; ?>
                    </ol>
                </div>
            </div>
        </section>
    </div>
    <?php
        require_once 'views/layouts/footer.php'; 
    ?>
</body>
</html>