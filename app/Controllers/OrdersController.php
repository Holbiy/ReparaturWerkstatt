<?php

class OrdersController
{
    public function index()
    {
        $orders = (new Order)::GetAll();
        require './app/Views/allorders.view.php';
    }

    public function new()
    {
        $tools = $this->getAllTools();
        require './app/Views/new.view.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $name = $_POST['name'] ?? "";
            $phone = $_POST['phonenumber'] ?? "";
            $email = $_POST['email'] ?? "";
            $urgency = $_POST['urgency'] ?? "";
            $toolid = $_POST['tool'] ?? "";

            $name = trim($name);
            $phonenumber = trim($phone);
            $email = trim($email);
            $urgency = trim($urgency);
            $toolid = trim($toolid);

            $errors = $this->validate($name, $email, $phonenumber, $toolid, $urgency);

            if (!empty($errors)) {
                $tools = $this->getAllTools();
                require './app/Views/new.view.php';
            } else {
                $order = new Order(null, $name, $email, $urgency, $toolid, $phonenumber);
                $order->add();
                header('Location: allorders');
            }
        } else {
            header('Location: new');
            die();
        }
    }

    public function edit()
    {
        $id = $_GET['id'];
        if(isset($id)){
            $tools = $this->getAllTools();
            $order = Order::getById($id);
            require './app/Views/edit.view.php';
        }
        else{
            header('Location: allorders');
        }
        
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $id = $_POST['id'];

            $name = $_POST['name'] ?? "";
            $phonenumber = $_POST['phonenumber'] ?? "";
            $email = $_POST['email'] ?? "";
            $status = $_POST['status'] ?? "";
            $toolid = $_POST['tool'] ?? "";

            $name = trim($name);
            $phonenumber = trim($phonenumber);
            $email = trim($email);
            $status = trim($status);
            $toolid = trim($toolid);

            $errors = $this->validate($name, $email, $phonenumber, $toolid, null, $status);

            if (!empty($errors)) {
                $order = Order::getById($id);
                $order->name = $name;
                $order->phonenumber = $phonenumber;
                $order->email = $email;
                $order->status = $status;
                $tools = $this->getAllTools();
                require './app/Views/edit.view.php';
            } else {
                $order = new Order($id, $name, $email, null, $toolid, $phonenumber, $status);
                $order->update();
                header('Location: allorders');
            }
        } else {
            header('Location: edit');
            die();
        }
    }

    function updatestatus()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $pdo = db();
            $statement = $pdo->prepare("select id from orders");
            $statement->execute();
            $result = $statement->fetchAll();
            $ids = [];
            foreach ($result as $id) {
                $ids[] = $id[0];
            }

            foreach ($_POST as $id) {
                if (in_array($id, $ids)) {
                    $order = Order::getById($id);
                    $order->updatestatus();
                }
            }
            $orders = (new Order)::GetAll();
            header('Location: allorders');
        } else {
            header('Location: allorders');
            die();
        }
    }

    private function getAllTools()
    {
        $pdo = db();
        $statement = $pdo->prepare('SELECT * FROM tools');
        $statement->execute();
        return $statement->fetchAll();
    }

    private function validate($name, $email, $phonenumber, $tool, $urgency = null, $status = null)
    {
        //Daten validieren
        $errors = [];

        if ($name === "") {
            $errors[] = "Bitte geben sie einen Namen ein.<br>";
        } elseif (!preg_match('/^([^0-9]*)$/', $name)) {
            $errors[] = "Bitte geben sie einen Richtigen namen an.";
        }

        if ($email === "") {
            $errors[] = "Bitte geben sie eine Email ein.<br>";
        } elseif (preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email) == false) {
            $errors[] = "Bitte geben sie eine gültige Email an.<br>";
        }

        if (!preg_match('/^[0-9\-\(\)\/\+\s]*$/', $phonenumber) && $phonenumber != "") {
            $errors[] = "Bitte geben sie eine reguläre Telefonnummer ein.<br>";
        }

        if (isset($urgency)) {
            if ($urgency === "") {
                $errors[] = "Bitte geben sie eine Dringlichkeit an.";
            } elseif ($urgency < 1 || $urgency > 5) {
                $errors[] = "Bitte geben sie eine richtige Dringlichkeit an.";
            }
        }

        if (isset($status)) {
            if ($status != 1 && $status != "") {
                $errors[] = "Bitte geben sie einen richtigen Status an.";
            }
        } 

        $pdo = db();
        $statement = $pdo->prepare("SELECT id from tools");
        $statement->execute();
        $result = $statement->fetchAll();
        $tools = [];
        foreach ($result as $tool) {
            $tools[] = $tool[0];
        }
        if ($tool === "") {
            $errors[] = "Bitte geben sie ein Werkzeug an.";
        } elseif (!in_array($tool[0], $tools)) {
            $errors[] = "Bitte geben sie ein vorhandenes Werkzeug an.";
        }

        return $errors;
    }
}
