<?php
    class Connect_db{
        private $MySql = false;
        public function Connect(){
            $this->MySql = new Mysqli('127.0.0.1', 'mysql', '', 'aibolit');
            $this->MySql->set_charset('utf8');
            return $this->MySql;
        }
        public function Close_Connect(){
            $this->MySql->close();
            return true;
        }
        /*
        *param1 -> query
        *param2 -> type answer: associative(default), indexed
        */
        public function query($String_query, $type = null){
            $data = $this->MySql->query($String_query);
            if($this->MySql != false){
                if(preg_match("/\bINSERT\b|UPDATE\b/", $String_query))
                    return $this->MySql->insert_id;
                if($type == null)
                    return $this->Sort_Result($data);
                else
                    return $this->Sort_Result($data, $type);
            }else{
                return 'Connection error!';
            }
        }

        private function Sort_Result($data, $type = 'associative'){
            $result = array();
            if($type == 'associative')
                while(($row = $data->fetch_assoc()) != false)
                    $result[] = $row;
            else if($type == 'indexed')
                while(($row = $data->fetch_row()) != false)
                    $result[] = $row;
            return $result;
        }
    }
?>