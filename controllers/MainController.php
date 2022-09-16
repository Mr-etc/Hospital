<?php
    class MainController{
        public function actionIndex(){
            require_once 'models/DB.php';
            require_once 'controllers/LayoutsController.php';
            require_once 'models/departments.php';
            require_once 'models/info.php';


            $modelInfo = new modelInfo();
            $Site_info = $modelInfo->Get_site_info(['site_name','our_phone']);

            $LayoutsController = new LayoutsController();
            $HeaderData = $LayoutsController->DataHeader();
            $FooterData = $LayoutsController->DataFooter();
            $modelDepartments = new modelDepartments();
            $blocks_Departments = $modelDepartments->get_blocks();
            require_once 'views/main/index.php';
        }
    }
?>
