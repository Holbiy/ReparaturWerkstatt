<?php

class OrdersController{
    public function ShowAll(){

        require './app/Views/allorders.view.php';
    }

    public function ShowActive(){

        require './app/Views/activeorders.view.php';
    }

    public function create(){

        require './app/Views/createorder.view.php';
    }

    public function edit(){

        require './app/Views/editorder.view.php';
    }

}