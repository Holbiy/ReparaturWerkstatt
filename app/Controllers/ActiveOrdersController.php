<?php
    class ActiveOrdersController{
        public function index(){
            $activeorders = Order::GetAll(true);
            require './app/Views/activeorders.view.php';
        }
    }
