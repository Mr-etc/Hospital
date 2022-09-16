<?php 
    class modeLayouts{ 
        public function GetMenu(){
            $Menu_item = null;
            $Connect_db = new Connect_db();
            $Connect_db->Connect();
            $data = $Connect_db->query("SELECT `name`, `data` FROM `general_menu`");
            foreach($data as $item){
                $data = (array)json_decode($item['data']);
                $Menu_item[]['name'] = $item['name'];
                $Menu_item_cnt = count($Menu_item);
                if(isset($data["subitems_from_base"])){
                    $arrayCnt = Count($data["subitems_from_base"]);
                    $query = "SELECT ";
                    for($i = 1; $i < $arrayCnt; $i++)
                        $query .= "`".$data["subitems_from_base"][$i]."`".(($i+1 !== $arrayCnt)? ",":" ");
                    $query .= "FROM ".$data["subitems_from_base"][0];
                    if(strpos($query, '`id`'))
                        $query = str_replace('`id`', '`id` AS `path`', $query);
                    $data_result = $Connect_db->query($query);
                    $Menu_item[$Menu_item_cnt-1]['subitems'] = $data_result;
                }
                if(isset($data["subitems_from_list"]))
                    foreach($data["subitems_from_list"] as $data_list)
                        $Menu_item[$Menu_item_cnt-1]['subitems'][] = ["name"=>$data_list[0], "path"=>$data_list[1]];
                if(isset($data["path"]))
                    $Menu_item[$Menu_item_cnt-1]['path'] = $data["path"];
            }
            $Connect_db->Close_Connect();
            return $Menu_item;
        }
        public function Get_footer_data(){
            require_once 'models/info.php';
            $modelInfo = new modelInfo();
            return $modelInfo->Get_site_info(['Social_'], "like");
        }
    }
