<?php   

    namespace application\controllers;

    use application\core\Controller;

    class AccountController extends Controller
    {
        public function login(){
            echo 'Страница входа';
        }

        public function registerAction(){
            echo 'страница регистрации';
        }
    }