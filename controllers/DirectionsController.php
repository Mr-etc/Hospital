<?php
    class DirectionsController{
        public function actionIndex(){
            require_once 'controllers/LayoutsController.php';
            require_once 'models/directions.php';
            $modeldirections = new modelDirections();
            $LayoutsController = new LayoutsController();
            $HeaderData = $LayoutsController->DataHeader();
            $FooterData = $LayoutsController->DataFooter();
            $directions_data = $modeldirections->get_list(null);
            require_once 'views/directions/index.php';
        }
        public function actionSingle($param){
            require_once 'controllers/LayoutsController.php';
            require_once 'models/directions.php';
            require_once 'models/departments.php';
            $modeldirections = new modelDirections();
            $modeldepartments = new modelDepartments();
            $directionData = $modeldirections->get_direction($param);
            if($directionData != null)
            {
                if($directionData['departments'] != null)
                    $directionData['departments'] = $modeldepartments->get_list_byid(trim($directionData['departments'], "[]")); 
                $LayoutsController = new LayoutsController();
                $HeaderData = $LayoutsController->DataHeader();
                $FooterData = $LayoutsController->DataFooter();
                //print_r($directionData);
                require_once 'views/directions/single.php';
            }else
                echo "Страница не найдена";
        }
    }
?>