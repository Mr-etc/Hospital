<?php
    class DoctorsController{
        private $items_of_doctors = 8;
        public function actionIndex(){
            require_once 'models/DB.php';
            require_once 'models/doctors.php';
            require_once 'models/departments.php';
            require_once 'controllers/LayoutsController.php';
            if(isset($_POST['query_type'])){
                switch ($_POST['query_type']) {
                    case 'Change_page':
                        $this->Change_Page();
                        exit;
                        break;
                    case 'Search':
                        $this->Search();
                        exit;
                        break;
                    case 'SearchFIO':
                        $this->Search();
                        exit;
                        break;
                }
            }
            
            $LayoutsController = new LayoutsController();
            $modelDoctors = new modelDoctors();
            $modelDepartments = new modelDepartments();
            $HeaderData = $LayoutsController->DataHeader();
            $FooterData = $LayoutsController->DataFooter();
            //$doctors_data = $modelDoctors->Get_doctors(true, $this->items_of_doctors);
            $doctors_data = $modelDoctors->Get_doctors(null, $this->items_of_doctors, true);
            $List_departments = $modelDepartments->get_list();
            require_once 'views/doctors/index.php';
        }
        public function actionSingle($param){
            require_once 'controllers/LayoutsController.php';
            require_once 'models/DB.php';
            require_once 'models/departments.php';
            require_once 'models/doctors.php';
            $LayoutsController = new LayoutsController();
            $modelDoctors = new modelDoctors();
            $modelDepartments = new modelDepartments();
            $HeaderData = $LayoutsController->DataHeader();
            $doctor_data = $modelDoctors->Get_doctor_byID($param);
            $FooterData = $LayoutsController->DataFooter();
            require_once 'views/doctors/single.php';
        }

        private function Change_Page(){
            require_once 'components/Response.php';
            $Response_obj = new Response();
            if(isset($_POST['page']) && is_numeric($_POST['page']))
                $page = $_POST['page'];
            else
                $this->Return_error($Response_obj);
            $modelDoctors = new modelDoctors();

            $department_id = isset($_POST['department'])? $_POST['department']:null;
            $Data['type'] = "RequestDoctors";
            $Data['status'] = "Success";
            $Data['page'] = $page; 
            $Data['data'] = $modelDoctors->Get_doctors($page, $this->items_of_doctors, true);
            echo $Response_obj->Response_data(200, $Data);
        }

        private function Search(){
            require_once 'components/Response.php';
            $Response_obj = new Response();
            $Error_status = true;

            if(isset($_POST['Search_type'])){
                $modelDoctors = new modelDoctors();
                $page = isset($_POST['page'])? $_POST['page']:null;
                $Data['type'] = "RequestSearch";
                $Data['status'] = "Success";
                $parameters = null;
                $parameters = ['type' => $_POST['Search_type'], 'value' => $_POST['value']];
                $Data['data'] = $modelDoctors->Get_doctors(null, $this->items_of_doctors, true, $parameters);
                $Error_status = false;
            }
            if($Error_status == true)
                $this->Return_error($Response_obj);
            else
                echo $Response_obj->Response_data(200, $Data);
        }
        private function Return_error($Response_obj){
            echo $Response_obj->Response_data(200, json_encode([
                "type" => "RequestSearch",
                "status" => "Error",
            ]));
            exit;
        }
    }
?>