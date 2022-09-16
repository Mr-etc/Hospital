<?php
    class ContactsController{
        public function actionIndex(){
            require_once 'models/DB.php';
            require_once 'controllers/LayoutsController.php';
            require_once 'models/info.php';
            $modelInfo = new modelInfo();
            $Site_info = $modelInfo->Get_site_info(['site_name', 'our_address', 'our_phone', 'our_mail', 'how_to_get']);
            $LayoutsController = new LayoutsController();
            $HeaderData = $LayoutsController->DataHeader();
            $FooterData = $LayoutsController->DataFooter();
            $Site_info['how_to_get'] = (array)json_decode($Site_info['how_to_get']);
            require_once 'views/contacts/index.php';
        }
    }
?>