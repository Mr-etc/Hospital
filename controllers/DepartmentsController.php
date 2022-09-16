<?php
    require_once 'models/DB.php';
    class DepartmentsController{
        private function Get_site_info(){
            require_once 'models/info.php';
            $modelInfo = new modelInfo();
            return $modelInfo->Get_site_info(['site_name', 'our_address', 'our_phone', 'our_mail']);
        }
        public function actionIndex(){
            require_once 'controllers/LayoutsController.php';
            require_once 'models/departments.php';
            $modeldepartment = new modelDepartments();
            $LayoutsController = new LayoutsController();
            $HeaderData = $LayoutsController->DataHeader();
            $FooterData = $LayoutsController->DataFooter();
            $departments_data = $modeldepartment->get_list(null);
            require_once 'views/departments/index.php';
        }
        public function actionSingle($param){
            require_once 'controllers/LayoutsController.php';
            require_once 'models/departments.php';
            require_once 'models/doctors.php';
            $modeldepartment = new modelDepartments();
            $LayoutsController = new LayoutsController();
            $modelDoctors = new modelDoctors();
            $Site_info = $this->Get_site_info();
            $HeaderData = $LayoutsController->DataHeader();
            $FooterData = $LayoutsController->DataFooter();
            $department_info = $modeldepartment->get_department($param);
            $doctors_data = $modelDoctors->Get_doctor_byID($department_info['department_head'], 'short');
            require_once 'views/departments/single.php';
        }
    }
?>