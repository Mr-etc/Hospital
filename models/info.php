<?php
    class modelInfo{
        /*
        * @param array. array of keys in table
        * @type (default or like), default use "WHERE IN", like user (param LIKE)
        */
        public function Get_site_info($param, $type = "default"){
            $Connect_db = new Connect_db();
            $Connect_db->Connect();
            $query = "SELECT `name`, `value` FROM `info` WHERE ";
            if($type === "default"){
                $query .= "`name` IN (";
                foreach($param as $item)
                    $query .= "'".$item.(next($param)? "',":"')");
                $data = $Connect_db->query($query);
            }else if ($type === "like"){
                foreach($param as $item)
                    $query .= "`name` LIKE '%".$item.(next($param)? "%' OR ":"%'");
                $data = $Connect_db->query($query);
            }
            return $this->Sort_element($data);
        }
        private function Sort_element($array){
            $result = [];
            foreach($array as $item)
                $result[$item['name']] = $item['value'];
            return $result;
        }
    }
?>
