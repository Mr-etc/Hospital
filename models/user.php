<?php
    class modelUser{
        private $Connect_db = false;
        public function __construct(){
            require_once 'models/DB.php';
            $this->Connect_db = new Connect_db();
        }
        public function userExist($mail, $snils){
            $this->Connect_db->Connect();
            $data = $this->Connect_db->query("SELECT 1 FROM `users` WHERE `mail` = '$mail' or `snils` = '$snils'");
            $this->Connect_db->Close_Connect();
            return count($data)>0? true:false;
        }

        public function registerUser($name, $surname, $lastname, $birthdate, $sex, $mail, $phone, $snils, $pass){
            $this->Connect_db->Connect();
            $data = $this->Connect_db->query("INSERT INTO `users` VALUES (null, '$name', '$surname', '$lastname', '$birthdate', $sex, '$mail', '$phone', '$snils', '".md5($pass)."')");
            $this->Connect_db->Close_Connect();
            return $data != null? true:false;
        }

        public function userLogin($phone, $pass){
            $this->Connect_db->Connect();
            $data = $this->Connect_db->query("SELECT `id`, CONCAT(`surname`, ' ', `name`, ' ', `lastname`) AS 'FIO' FROM `users` WHERE `phone` = '$phone' AND `password` = '".md5($pass)."'");
            $this->Connect_db->Close_Connect();
            if($data != null){
                $_SESSION['User_data'] = [
                    'id' => $data[0]['id'],
                    'FIO' => $data[0]['FIO']
                ];
                return true;
            }else
                return false;
        }
    }
?>