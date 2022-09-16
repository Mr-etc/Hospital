<?php
    class modelDepartments{
        private $Connect_db = false;
        public function __construct(){
            require_once 'models/DB.php';
            $this->Connect_db = new Connect_db();
        }
        public function get_blocks($limit = 10){
            $this->Connect_db->Connect();
            $data = $this->Connect_db->query("SELECT `id`, `name`, `short_description` FROM `departments` ".($limit !== null?"LIMIT ".$limit:""));
            $this->Connect_db->Close_Connect();
            return $data;
        }
        public function get_list($limit = 10){
            $this->Connect_db->Connect();
            $data = $this->Connect_db->query("SELECT `id`, `name` FROM `departments` ".($limit !== null?"LIMIT ".$limit:""));
            $this->Connect_db->Close_Connect();
            return $data;
        }
        public function get_department($id){
            $this->Connect_db->Connect();
            $data = $this->Connect_db->query("SELECT `name`, `department_head`, `description` FROM `departments` WHERE `id` = $id")[0];
            $this->Connect_db->Close_Connect();
            $data['description'] = (array)json_decode($data['description']);
            return $data;
        }
        public function get_list_byid($id){
            $this->Connect_db->Connect();
            $data = $this->Connect_db->query("SELECT `id`, `name` FROM `departments` WHERE `id` IN ($id)");
            $this->Connect_db->Close_Connect();
            return $data;
        }
    }
?>