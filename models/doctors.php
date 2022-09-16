<?php
    class modelDoctors{
        private $Connect_db = false;
        public function __construct(){
            require_once 'models/DB.php';
            $this->Connect_db = new Connect_db();
        }
        public function Get_doctors($page = null, $amount_items, $amount_pages = false, $Search_parameters = null){
            $condition = "WHERE `doctors`.`departments_id` = `departments`.`id`";
            if($Search_parameters != null)
            {
                switch ($Search_parameters['type']) {
                    case 'byDepartment':
                        $condition = "WHERE `doctors`.`departments_id` = `departments`.`id` AND `doctors`.`departments_id` = ".$Search_parameters['value'];
                        break;
                    case 'byFIO':
                        $condition = @"WHERE `doctors`.`departments_id` = `departments`.`id` 
                        AND (`doctors`.`surname` LIKE '%$Search_parameters[value]%' 
                        OR `doctors`.`name` LIKE '%$Search_parameters[value]%' 
                        OR `doctors`.`lastname` LIKE '%$Search_parameters[value]%')";
                        break;
                }
            }
            $started = ($page != null? ($page-1)*$amount_items : 0);
            $this->Connect_db->Connect();
            $query = @"SELECT `doctors`.`id`, CONCAT(`doctors`.`surname`, ' ', `doctors`.`name`, ' ', `doctors`.`lastname`) AS `FIO`, `doctors`.`photo`, `departments`.`name` AS `Department_name` FROM `doctors`, `departments` 
            ".$condition.($started !== null?" LIMIT ".$started.($amount_items !== null?" , ".$amount_items:""):"");
            $data['doctors'] = $this->Connect_db->query($query);
            if($amount_pages == true){
                $data['amount_pages'] = $this->Connect_db->query("SELECT COUNT(*) AS `amount_pages` FROM `doctors`, `departments` ".$condition)[0]['amount_pages'];
                $data['amount_pages'] = ceil($data['amount_pages']/$amount_items);
            }
            $this->Connect_db->Close_Connect();
            return $data;
        }
        public function Get_doctor_byID($id, $type = 'full'){
            $this->Connect_db->Connect();
            if($type == 'full')
                $data = $this->Connect_db->query(@"SELECT CONCAT(`doctors`.`surname`, ' ', `doctors`.`name`, ' ', `doctors`.`lastname`) AS `FIO`, `doctors`.`education`, `doctors`.`graduation_date`, `doctors`.`birthdate`, `doctors`.`photo`,`doctors`.`phone` ,`doctors`.`cabinet` ,`departments`.`name` AS `Department_name`
                FROM  `doctors`, `departments` 
                WHERE `doctors`.`departments_id` = `departments`.`id` AND `doctors`.`id` = ".$id)[0];
            else if($type == 'short')
                $data = $this->Connect_db->query(@"SELECT `doctors`.`id`, CONCAT(`doctors`.`surname`, ' ', `doctors`.`name`, ' ', `doctors`.`lastname`) AS `FIO`, `doctors`.`photo`
                FROM  `doctors`, `departments` 
                WHERE `doctors`.`departments_id` = `departments`.`id` AND `doctors`.`id` = ".$id)[0];
            else{
                $this->Connect_db->Close_Connect();
                return false;
            }
            $this->Connect_db->Close_Connect();
            return $data;
        }
        public function Get_doctors_bydirection($id){
            $this->Connect_db->Connect();
            $data = $this->Connect_db->query(@"SELECT `id`, CONCAT(`doctors`.`surname`, ' ', `doctors`.`name`, ' ', `doctors`.`lastname`) AS `FIO` FROM `doctors` WHERE departments_id = ".$id);
            $this->Connect_db->Close_Connect();
            return $data;
        }
        public function exist_doctor($id){
            $this->Connect_db->Connect();
            $data = $this->Connect_db->query(@"SELECT 1 FROM `doctors` WHERE id = ".$id);
            $this->Connect_db->Close_Connect();
            if(count($data) > 0)
                return true;
            else
                return false;
        }
    }
?>