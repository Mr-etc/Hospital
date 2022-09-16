<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$HeaderData['Site_info']['site_name']?> - Врачи</title>
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/doctors.css">
    <script src="/js/jquery.js"></script>
    <script src="/js/doctors.js"></script>
</head>
<body>
    <?php
        require_once 'views/layouts/header.php'; 
    ?>
    <div class="content">
        <section class="section-doctors">
            <div class="wrap">
                <div class="header_block">
                    <h1>Врачи</h1>
                </div>
                <div class="section-doctors-body">

                    <div class="section-doctors-body_search-block">
                        <select onchange="get_data_func('SearchDepartment', null)" name="departments" id="select_department">
                            <option value="0" selected>Все отделения</option>
                            <?php foreach($List_departments as $item): ?>
                                <option value="<?=$item['id']?>"><?=$item['name']?></option>
                            <?php endforeach;?>
                        </select>
                        <div class="input-block">
                            <input id="doctorsFIO_search" type="text" placeholder="Поиск по ФИО" value="">
                            <svg onclick="get_data_func('SearchFIO')" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="28.931px" height="28.932px" viewBox="0 0 28.931 28.932" style="enable-background:new 0 0 28.931 28.932;" xml:space="preserve">
                                    <path d="M28.344,25.518l-6.114-6.115c1.486-2.067,2.303-4.537,2.303-7.137c0-3.275-1.275-6.355-3.594-8.672   C18.625,1.278,15.543,0,12.266,0C8.99,0,5.909,1.275,3.593,3.594C1.277,5.909,0.001,8.99,0.001,12.266   c0,3.276,1.275,6.356,3.592,8.674c2.316,2.316,5.396,3.594,8.673,3.594c2.599,0,5.067-0.813,7.136-2.303l6.114,6.115   c0.392,0.391,0.902,0.586,1.414,0.586c0.513,0,1.024-0.195,1.414-0.586C29.125,27.564,29.125,26.299,28.344,25.518z M6.422,18.111   c-1.562-1.562-2.421-3.639-2.421-5.846S4.86,7.983,6.422,6.421c1.561-1.562,3.636-2.422,5.844-2.422s4.284,0.86,5.845,2.422   c1.562,1.562,2.422,3.638,2.422,5.845s-0.859,4.283-2.422,5.846c-1.562,1.562-3.636,2.42-5.845,2.42S7.981,19.672,6.422,18.111z"/>
                            </svg>
                        </div>
                    </div>

                    <div class="section-doctors-body_items-block">
                        <?php foreach($doctors_data['doctors'] as $item):?>
                            <div class="section-doctors-body_items-block_item item_doctor">
                                    <div class="item-image"><img src="<?=$item['photo']?>" alt="doctor_image"></div>
                                    <div class="item-desc">
                                        <a href="doctors/<?=$item['id']?>" class="item-desc_header"><?=$item['FIO']?></a>
                                        <p class="item-desc_text"><?=$item['Department_name']?></p>
                                    </div>
                            </div>
                        <?php endforeach;?>
                    </div>
                    <?php if($doctors_data['amount_pages'] > 1): ?>
                        <script type="text/javascript">
                            var amount_pages = <?=$doctors_data['amount_pages']?>;
                        </script>
                        <div class="section-doctors-body_pages-block">
                            <span onclick="get_data_func('ChangePage', 1)" class="link">«</span>
                            <?php
                                for($i = 1; $i < 6; $i++){
                                    if($i < $doctors_data['amount_pages']+1)
                                        echo '<span onclick="get_data_func(\'ChangePage\', '.$i.')" class="link '.($i == 1?'selected_link':'').'">'.$i.'</span>';
                                    else
                                        break;
                                } 
                            ?>
                            <span onclick="get_data_func('ChangePage',<?=$doctors_data['amount_pages']?>)" class="link">»</span>
                        </div>
                    <?php endif;?>

                </div>
            </div>
        </section>
    </div>
    <?php
        require_once 'views/layouts/footer.php'; 
    ?>
</body>
</html>