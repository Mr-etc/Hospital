<?php
    class Router{
        private $routes;
        public function __construct(){
            $this->routes = require_once 'config/routes.php';
        }
        public function run(){
            $uri = $this->Get_URI();
            if(empty($uri)){
                $this->Drawing('Main', 'Index');
                exit;
            }
            foreach($this->routes as $uri_pattern => $path){
                if(preg_match("~^$uri_pattern$~", $uri)){
                    $path_array = explode("/", $path);
                    $ControllerName = ucfirst($path_array[0]);
                    $ActionName = ucfirst($path_array[1]);
                    $parameters = explode("/", preg_replace("~$uri_pattern~", $path, $uri));
                    unset($parameters[0], $parameters[1]);
                    $this->Drawing($ControllerName, $ActionName, $parameters);
                    exit;
                }
            }
            echo 'Страница: <b>'.$uri.'</b> не найдена </br>';
        }
        private function Get_URI(){
            if(!empty($uri = $_SERVER['REQUEST_URI']))
            {
                $uri = str_replace($_SERVER['CONTEXT_PREFIX'], '', $uri);
                $uri = trim($uri, '/');
                if(($cut = strpos($uri, '?')) !== false)
                    $uri = substr($uri, 0, $cut);
                return $uri;
            }
        }
        private function Drawing($ControllerName, $ActionName, array $parameters = Array()){
            $ControllerName .= 'Controller';
            require_once 'controllers/'.$ControllerName.'.php';
            $controllerObj = new $ControllerName();
            call_user_func_array([$controllerObj, 'action'.$ActionName], $parameters);
        }
    }
?>