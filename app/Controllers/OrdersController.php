<?php

class OrdersController{
    public function index(){

        $orders = (new Order)::GetAllOrders;

        require './app/Views/allorders.view.php';
    }

    public function ShowActive(){

        require './app/Views/activeorders.view.php';
    }

    public function createOrder(){

        $tools = $this->getAllTools();
        require './app/Views/createorder.view.php';
    }

    public function create(){
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            
            //Gesendete Daten entgegennehmen 
            $name = $_POST['name'] ?? "";
            $phone = $_POST['phone'] ?? "";
            $email = $_POST['email'] ?? "";
            $urgency = $_POST['urgency'] ?? "";
            $tool = $_POST['tool'] ?? "";

            $name = trim($name);
            $phone = trim($phone);
            $email = trim($email);
            $urgency = trim($urgency);
            $tool = trim($tool);

            $errors = $this->validate($name, $phone, $email, $tool, $urgency);

        }else{
            header('Location: createorder');
            die();
        }

        if(empty($errors)){

        }

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

    private function validate($name, $email, $phone, $tool, $urgency = null, $status = null){

            //Daten validieren
            $errors = [];

            if($name === ""){
                $errors[] = "Bitte geben sie einen Namen ein.<br>";
            }elseif(!preg_match('/^[a-z]*$/i', $name)){
                $errors[] = "Bitte geben sie einen Richtigen namen an.";
            }

            if($email === ""){
                $errors[] = "Bitte geben sie eine Email ein.<br>";
            } elseif(!preg_match("/[^@]+@[^.]+\..+$/i", $email))
            {
                $errors[] = "Bitte geben sie eine gültige Email an.<br>";
            }
            
            if($phone === ""){
                $errors[] = "Bitte geben sie eine Telefonnummer ein.<br>";
            } elseif(!preg_match('/^[0-9\-\(\)\/\+\s]*$/', $phone)){
                $errors[] = "Bitte geben sie eine reguläre Telefonnummer ein.<br>";
            }

            if($urgency != null){
                if($urgency === ""){
                    $errors[] = "Bitte geben sie eine Dringlichkeit an.";
                } elseif($urgency < 1 || $urgency > 5){
                    $errors[] = "Bitte geben sie eine richtige Dringlichkeit an.";
                }
            }

            if($status != null){
                if($status === ""){
                    $errors[] = "Bitte geben sie einen Status an.";
                } elseif($status != 0 || $status != 1){
                    $errors[] = "Bitte geben sie eine richtige Dringlichkeit an.";
                }
            }

            $pdo = db();
            $statement = $pdo->prepare("SELECT id from tools");
            $statement->execute();
            $result = $statement->fetchAll();
            $tools = [];
            foreach($result as $tool){
                $tools[] = $tool[0];
            }
            if($tool === ""){
                $errors[] = "Bitte geben sie ein Werkzeug an.";
            } elseif(!in_array($tool, $tools)){
                $errors[] = "Bitte geben sie ein vorhandenes Werkzeug an.";
            }

            return $errors;
    }

}