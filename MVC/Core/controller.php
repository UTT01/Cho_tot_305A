<?php
    class controller{
        public function model($model){
            include_once './MVC/Models/'.$model.'.php';
            return new $model;
        }
        public function view($view,$data=[]){
            if (file_exists(ROOT_PATH . '/MVC/Views/' . $view . '.php')) {
                include_once ROOT_PATH . '/MVC/Views/' . $view . '.php';
            } else {
                echo "Lỗi: Không tìm thấy view: " . ROOT_PATH . '/MVC/Views/' . $view . '.php';
            }
        }
    }
?>
