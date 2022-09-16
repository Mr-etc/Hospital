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
        <script src="/js/authUser.js"></script>
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
            <section class="section-auth">
                <div class="wrap">
                    <div class="header_block"><h1>Авторизация</h1></div>
                    <div class="section-auth_body">
                        <div class="wait_wrap ">
                            <svg class="" viewBox="0 0 50 50">
                                <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
                            </svg>
                        </div>
                        <div class="input-block with_title">
                            <label class="fill-label" for="Phone-user">Телефон</label>
                            <input id="Phone-user" type="text" value="">
                        </div>
                        <div class="input-block with_title">
                            <label class="fill-label" for="Pass-user">Пароль</label>
                            <input id="Pass-user" type="password" value="">
                        </div>
                        <button class="Button" name="AuthUser">Войти</button>
                        <a href="/user/register" class="desc-label">Нет учетной записи? Зарегистрируйтесь!</a>
                    </div>
                </div>
            </section>
        </div>
        <?php require_once 'views/layouts/footer.php'; ?>
    </body>
</html>