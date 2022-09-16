<?php
    class AppointmentsController{
        public function actionAppointmentlist(){
            require_once 'models/DB.php';
            require_once 'controllers/LayoutsController.php';
            require_once 'models/info.php';


            $modelInfo = new modelInfo();
            $Site_info = $modelInfo->Get_site_info(['site_name','our_phone']);

            $LayoutsController = new LayoutsController();
            $HeaderData = $LayoutsController->DataHeader();
            $FooterData = $LayoutsController->DataFooter();
            require_once 'views/main/appointments.php';
        }
        public function actionRedirect(){
            require_once 'components/Response.php';
            if(empty($_SESSION['User_data']))
                return;
            $response = new Response();
            if(isset($_POST['query_type'])){
                switch ($_POST['query_type']) {
                    case 'Get_department':
                        require_once 'models/departments.php';
                        $modeldepartment = new modelDepartments();
                        echo $response->Response_data(200, ['status' => "Success", "type" => "RequestDepartments", 'data' => $modeldepartment->get_list(null)]);
                        exit;
                        break;
                    case 'Get_doctor':
                        if(isset($_POST['department_id']))
                        {
                            if(is_int((int)$_POST['department_id'])){
                                require_once 'models/doctors.php';
                                $modeldoctors = new modelDoctors();
                                $data = $response->Response_data(200, ['status' => "Success", "type" => "RequestDoctors", 'data' => $modeldoctors->Get_doctors_bydirection($_POST['department_id'])]);
                                echo $data; 
                            }
                            exit;
                        }
                        break;
                    case 'Get_schedule':
                        if(isset($_POST['doctor_id']))
                            if(is_int((int)$_POST['doctor_id']))
                                $this->Get_schedule($_POST['doctor_id']);
                        exit;
                        break;
                    case 'Register_appoinment':
                        $this->Register_appoinment();
                        break;
                }
            }
        }
        private function Get_schedule($id_doctor){
            require_once 'models/doctors.php';
            require_once 'models/appointments.php';
            $modeldoctors = new modelDoctors();
            $modelAppointments = new modelAppointments();
            $response = new Response();
            $data = $modelAppointments->get_register_appointmentDate($id_doctor);
            $data = array_map(function($data){
                return date('w,H', strtotime($data['date']));
            }, $data);
            echo $response->Response_data(200, ['status' => "Success","type" => "RequestDoctorsSchedule", 'data' => $data]);
        }
        private function Register_appoinment(){
            require_once 'models/doctors.php';
            require_once 'models/appointments.php';
            $modeldoctors = new modelDoctors();
            $modelAppointments = new modelAppointments();
            $response = new Response();
            $datas = $_POST;
            if($modeldoctors->exist_doctor($_POST['id_doc']))
                if(!$modelAppointments->check_appointment($_POST['id_doc'], [$_POST['day'], $_POST['time']])){
                    $data = $this->check_fields_appointments($_POST);
                    if($data['result'] == 'true'){
                        $modelAppointments->register_appointment($data['data']);
                        echo $response->Response_data(200, ['status' => "Success","type" => "RequestRegisterAppointment"]);
                    }
                }
        }
        private function check_fields_appointments($data){
            $errors = [];
            $data['date'] = date("Y-m-$data[day] $data[time]:00:00");
            $today = date('Y-m-d');
            $nextdate = date("Y-m-d", strtotime("+7 days"));
            if($data['date'] < $today || $data['date'] > $nextdate)
                array_push($errors, 'Дата введена неправильно!');
            if(count($errors) > 0)
                return ["result" => 'false', "Errors" => $errors];
            else
                return ["result" => 'true', "data" => $data];
        }
    }
?>