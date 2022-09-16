<?php
    class modelAppointments{
        private $Connect_db = false;
        public function __construct(){
            require_once 'models/DB.php';
            $this->Connect_db = new Connect_db();
        }
        public function get_register_appointmentDate($id_doctor){
            $this->Connect_db->Connect();
            $today = date('Y-m-d');
            $nextdate = date("Y-m-d", strtotime("+7 days"));
            $data = $this->Connect_db->query(@"SELECT `date` FROM `register_appointments` WHERE `date` > '$today' AND `date` < '$nextdate' AND id_doctor = ".$id_doctor);
            $this->Connect_db->Close_Connect();
            return $data;
        }
        public function check_appointment($id_doc, $time){
            $this->Connect_db->Connect();
            $data = $this->Connect_db->query("SELECT 1 FROM `register_appointments` WHERE id_doctor = $id_doc AND date = '".date('Y-m')."-$time[0] $time[1]:00:00'");
            $this->Connect_db->Close_Connect();
            return count($data) > 0? true:false;
        } 
        public function register_appointment($data){
            $this->Connect_db->Connect();
            $query = "INSERT INTO `register_appointments` VALUES(null, $data[id_doc], ".$_SESSION['User_data']['id'].", 1, '".date("Y-m-$data[day] $data[time]:00:00")."')";
            $request = $this->Connect_db->query($query);
            $this->Connect_db->Close_Connect();
            return $request != null?true:false;
        }
    }

?>