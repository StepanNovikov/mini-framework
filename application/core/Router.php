<?php   

    namespace application\core;    

    class Router 
    {
        protected $routes = [];
        protected $params = [];

        function construct__(){
            $arr = require 'application/config/routes.php';
            foreach($arr as $key => $val) {
                $this->add($key,$val);
            }
            debug($routes);
        }

        public function add($route, $params){
            $route = '#^'.$route.'$#';
            $this->routes[$route] = $params;
        }

        public function match(){
            $url = trim($_SERVER['REQUEST_URI'],'/');
            foreach($this->routes as $route=>$params){
                if(preg_match($route,$url,$matches)){
                    $this->params = $params;
                    return true;
                }
            }
            return false;
        }

        public function run(){
            if($this->match()){
                $path = 'application\controllers\\'.ucfirst($this->$params['controller']).'Controller.php';
                if(class_exists($path)) {
                    $action = $this->params['action'].'Action';
                    if(method_exists($path,$action)){
                        $controller = new $path($this->params);
                        $controller->$action();
                    } else {    
                        echo 'Экшен не найден';
                    }
                } else {
                    echo 'Не найден контроллер: '.$path;
                }

            } else {
                echo 'Маршрут не найден';
            } 
        }

        
    }