<?php
    class modelDirections{
        private $Connect_db = null;
        public function __construct(){
            require_once 'models/DB.php';
            $this->Connect_db = new Connect_db();
        }
        public function get_list($limit = 10){
            $this->Connect_db->Connect();
            $data = $this->Connect_db->query("SELECT `id`, `name` FROM `directions` ".($limit !== null?"LIMIT ".$limit:""));
            $this->Connect_db->Close_Connect();
            return $data;
        }
        public function get_direction($id){
            $this->Connect_db->Connect();
            $data = $this->Connect_db->query("SELECT `name`,`description`,`departments` FROM `directions` WHERE `id` = $id");
            if(!isset($data[0]))
                return null;
            $data = $data[0];
            $this->Connect_db->Close_Connect();
            $data['description'] = (array)json_decode($data['description']);
            return $data;
        }
    }
?>