<?php
    class UserController{
        private $Response_obj;
        function __construct(){
            require_once 'components/Response.php';
            $this->Response_obj = new Response();
        }

        public function actionRegister(){
            require_once 'models/DB.php';
            require_once 'controllers/LayoutsController.php';
            require_once 'models/info.php';
            $modelInfo = new modelInfo();
            $Site_info = $modelInfo->Get_site_info(['site_name','our_phone']);
            $LayoutsController = new LayoutsController();
            $HeaderData = $LayoutsController->DataHeader();
            $FooterData = $LayoutsController->DataFooter();
            require_once 'views/user/register.php';
        }
        public function actionAuth(){
            require_once 'models/DB.php';
            require_once 'controllers/LayoutsController.php';
            require_once 'models/info.php';
            $modelInfo = new modelInfo();
            $Site_info = $modelInfo->Get_site_info(['site_name','our_phone']);
            $LayoutsController = new LayoutsController();
            $HeaderData = $LayoutsController->DataHeader();
            $FooterData = $LayoutsController->DataFooter();
            require_once 'views/user/auth.php';
        }
        public function actionLogout(){
            unset($_SESSION['User_data']);
            header("Location: $_SERVER[HTTP_REFERER]");
        }
        public function actionApi(){
            if(isset($_POST['query_type'])){
                switch ($_POST['query_type']) {
                    case 'registrationAccount':
                        $this->registerUser();
                        exit;
                        break;
                    case 'authAccount':
                        $this->authUser();
                        exit;
                        break;
                    default:
                        echo $this->Response_obj->Response_data(200, [
                            "status"=>"error",
                            "type" => "notify",
                            "data"=>[
                                "header" => "Ошибка при выполнении запроса",
                                "message" => "Некорректный параметр 'query_type'"
                            ]
                        ]);
                        exit;
                        break;
                }
            }else{
                echo $this->Response_obj->Response_data(200, [
                    "status"=>"error",
                    "type" => "notify",
                    "data"=>[
                        "header" => "Ошибка при выполнении запроса",
                        "message" => "Укажите параметр 'query_type'"
                    ]
                ]);
            }
        }


        private function authUser(){
            if(preg_match("~^\d{10}$~" ,$_POST['phone']) && preg_match("~^[A-zА-я0-9]{8,}$~", $_POST['pass'])){
                require_once 'models/user.php';
                $modelUser = new modelUser();
                if($modelUser->userLogin($_POST['phone'], $_POST['pass']))
                {
                    echo $this->Response_obj->Response_data(200, [
                        "status"=>"success",
                        "type" => "auth"
                    ]);
                }else
                    echo $this->Response_obj->Response_data(200, [
                        "status"=>"error",
                        "type" => "notify",
                        "data"=>[
                            "header" => "Ошибка авторизации",
                            "message" => "Неверный логин или пароль"
                        ]
                    ]);
            }else
                echo $this->Response_obj->Response_data(200, [
                    "status"=>"error",
                    "type" => "notify",
                    "data"=>[
                        "header" => "Ошибка авторизации",
                        "message" => "Не все поля корректно заполнены"
                    ]
                ]);
        }

        private function registerUser(){
            if(!empty($_POST['surname']) && !empty($_POST['name'])
            && !empty($_POST['lastname']) && preg_match("~^[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])$~u", trim($_POST['birthdate']))
            && !empty($_POST['sex']) && preg_match("~^([A-z0-9_-]+\.)*[A-z0-9_-]+@[A-z0-9_-]+(\.[A-z0-9_-]+)*\.[A-z]{2,6}$~u", trim($_POST['mail']))
            && preg_match("~^\d{10}$~" ,$_POST['phone']) && preg_match("~^\d{3}-\d{3}-\d{3} \d{2}$~", $_POST['snils'])
            && preg_match("~^.{8,}$~", $_POST['pass'])){
                require_once 'models/user.php';
                $modelUser = new modelUser();
                if(!$modelUser->userExist($_POST['mail'], $_POST['snils']))
                {
                    $sex = $_POST['sex'] == 'male'? 1:0;
                    $modelUser->registerUser(trim($_POST['name']), trim($_POST['surname']), trim($_POST['lastname']), $_POST['birthdate'], $sex, $_POST['mail'], $_POST['phone'], $_POST['snils'], $_POST['pass']);
                    echo $this->Response_obj->Response_data(200, [
                        "status"=>"success",
                        "type" => "register"
                    ]);
                }else
                    echo $this->Response_obj->Response_data(200, [
                        "status"=>"error",
                        "type" => "notify",
                        "data"=>[
                            "header" => "Ошибка при регистрации",
                            "message" => "Пользователь с таким номером СНИЛС или Адресом электронной почты существует"
                        ]
                    ]);
            }else
                echo $this->Response_obj->Response_data(200, [
                    "status"=>"error",
                    "type" => "notify",
                    "data"=>[
                        "header" => "Ошибка при регистрации",
                        "message" => "Не все поля корректно заполнены"
                    ]
                ]);
        }
    }
?>