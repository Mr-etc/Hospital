<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?=$HeaderData['Site_info']['site_name']?></title>
        <link rel="stylesheet" href="/css/reset.css">
        <link rel="stylesheet" href="/css/base.css">
        <link rel="stylesheet" href="/css/UserForm.css">
        <script src="/js/jquery.js"></script>
        <script src="/js/notifications.js"></script>
        <script src="/js/registerUser.js"></script>
        <script type="text/javascript" src="/js/jquery_mask.js"></script>
        <script type="text/javaScript">
            window.onload = ()=>{
                initialize();
            }
        </script>
    </head>
    <body>
        <?php require_once 'views/layouts/header.php'; ?>
        <div class="content">
            <div class="notifications"></div>
            <section class="section-register">
                <div class="wrap">
                    <div class="header_block"><h1>Регистрация</h1></div>
                    <div class="section-register_body">
                        <div class="wait_wrap ">
                            <svg class="" viewBox="0 0 50 50">
                                <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
                            </svg>
                        </div>
                        <div class="input-block with_title">
                            <label class="fill-label" for="Surname-user">Фамилия</label>
                            <input class="upcase" id="Surname-user" type="text" value="">
                        </div>
                        <div class="input-block with_title">
                            <label class="fill-label" for="Name-user">Имя</label>
                            <input class="upcase" id="Name-user" type="text" value="">
                        </div>
                        <div class="input-block with_title">
                            <label class="fill-label" for="Lastname-user">Отчество</label>
                            <input class="upcase" id="Lastname-user" type="text" value="">
                        </div>
                        <div class="input-block with_title">
                            <label class="fill-label" for="Birthdate-user">Дата рождения</label>
                            <input id="Birthdate-user" type="date" min="1900-01-01" max="<?=date("Y-m-d")?>" required>
                        </div>
                        <div class="input-block radiobutton">
                            <div class="radio">
                                <input checked type="radio" id="Male-user"
                                name="SexUser-user" value="male">
                                <label for="Male-user"><img src="/image/icons/male.svg" alt="male"><span>Я парень</spa></label>
                            </div>
                            <div class="radio">
                                <input type="radio" id="Female-user"
                                name="SexUser-user" value="female">
                                <label for="Female-user"><img src="/image/icons/female.svg" alt="female"><span>Я девушка</span></label>
                            </div>
                        </div>
                        <div class="input-block with_title">
                            <label class="fill-label" for="SNILS-user">СНИЛС</label>
                            <input id="SNILS-user" type="text" value="">
                        </div>
                        <div class="input-block with_title stretchable">
                            <label class="fill-label" for="Mail-user">Электронная почта</label>
                            <input id="Mail-user" type="text" value="">
                        </div>
                        <div class="input-block with_title">
                            <label class="fill-label" for="Phone-user">Телефон</label>
                            <input id="Phone-user" type="text" value="">
                        </div>
                        <div class="input-block with_title">
                            <label class="fill-label" for="Pass-user">Пароль</label>
                            <input id="Pass-user" type="password" value="">
                        </div>
                        <button class="Button" name="RegisterUser">Зарегистрироваться</button>
                    </div>
                </div>
            </section>
        </div>
        <?php require_once 'views/layouts/footer.php'; ?>
    </body>
</html>