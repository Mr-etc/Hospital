<?php
    class LayoutsController{
        private $modeLayouts = null;
        private $Site_info = null;
        public function __construct(){
            require_once 'models/layouts.php';
            require_once 'models/DB.php';
            $this->modeLayouts = new modeLayouts();
        }
        private function Get_site_info(){
            require_once 'models/info.php';
            $modelInfo = new modelInfo();
            return $modelInfo->Get_site_info(['site_name', 'our_address', 'our_phone', 'our_mail']);
        }
        public function DataHeader(){
            $header_data = [];
            $header_data['menu'] = $this->modeLayouts->GetMenu();
            if($this->Site_info == null)
                $header_data['Site_info'] = $this->Get_site_info();
            else
                $header_data['Site_info'] = $this->Site_info;
            return $header_data;
        }
        public function DataFooter(){
            if($this->Site_info == null)
                $footer_data['Site_info'] = $this->Get_site_info();
            else
                $footer_data['Site_info'] = $this->Site_info;
            $footer_data['social'] = $this->modeLayouts->Get_footer_data();
            return $footer_data;
        }
    }
?>