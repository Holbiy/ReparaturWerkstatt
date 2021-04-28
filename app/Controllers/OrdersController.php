<?php

class OrdersController{
    public function index(){

        $orders = (new Order)::GetAllOrders;

        require './app/Views/allorders.view.php';
    }

    public function ShowActive(){

        require './app/Views/activeorders.view.php';
    }

    public function create(){

        $tools = $this->getAllTools();
        require './app/Views/createorder.view.php';
    }

    public function edit(){

        require './app/Views/editorder.view.php';
    }

    private function getAllTools(){
        $pdo = db();

        $statement = $pdo->prepare('SELECT * FROM tools');
        $statement->execute();
        return $statement->fetchAll();
    }

}