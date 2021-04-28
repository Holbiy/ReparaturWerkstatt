<?php
class Order
{
	public $id;
	public $name;
	public $email;
	public $phonenumber;
	public $urgency;
	public $orderdate;
	public $status;
	public $deadline;
	public $toolid;
	public $pdo;
	public $tool;

	
	public function __construct(int $id = null, string $name = null, string $email = null, int $urgency = null, int $toolid = null, string $phonenumber = null)
	{
		$this->id = $id;
		$this->name = $name;
		$this->email = $email;
		$this->urgency = $urgency;
		$this->orderdate = date("1");
		//$this->deadline = $this->calDeadline(date("1") , $this->urgency);
		$this->toolid = $toolid;
		$this->phonenumber = $phonenumber;
		$this->pdo = db();
	}

	public function getById($id){
        $task = new self();
        $task->id = $id;
        $statement = $this->pdo->prepare("SELECT * FROM orders WHERE id = :id");
        $statement->bindParam(':id', $task->id);
        $statement->execute();
        $result = $statement->fetch();
        $task->name = $result['name'];
        $task->email = $result['email'];
		$task->phonenumber = $result['phonenumber'];
		$task->urgency = $result['urgency'];
		$task->orderdate = $result['orderdate'];
		$task->deadline = $result['deadline'];
		$task->status = $result['status'];
		$task->fk_Tool = $result['fk_Tool'];
        return $task;
    }

	public function add(){

        $statement = $this->pdo->prepare('INSERT INTO orders (name, email, phonenumber, urgency, orderdate, deadline, fk_Tool) VALUES (:name, :email, :phonenumber, :urgency, :oderdate, :deadline, :fk_Tool)');
        $statement->bindParam(':name', $this->name);
        $statement->bindParam(':email', $this->email);
		$statement->bindParam(':phonenumber', $this->phonenumber);
		$statement->bindParam(':urgency', $this->urgency);
		$statement->bindParam(':oderdate', $this->orderdate);
		$statement->bindParam(':deadline', $this->deadline);
		$statement->bindParam(':fk_Tool', $this->toolid);
        $statement->execute();
	}

//	public function addentrywithoutphone(){
//
//		$statement = $this->pdo->prepare('INSERT INTO orders (name, email, urgency, orderdate, deadline, fk_Tool) VALUES (:name, :email, :urgency, :oderdate, :deadline, :fk_Tool)');
//       $statement->bindParam(':name', $this->name);
//        $statement->bindParam(':email', $this->email);
//		$statement->bindParam(':urgency', $this->urgency);
//		$statement->bindParam(':oderdate', $this->orderdate);
//		$statement->bindParam(':deadline', $this->deadline);
//		$statement->bindParam(':fk_Tool', $this->toolid);
//       $statement->execute();
//
//	}

	public function update($id){

		$this->id = $id;
        $statement = $this->pdo->prepare('UPDATE orders SET name = :name, email = :email, phonenumber = :phonenumber, fk_Tool = :fk_Tool, status = :status  WHERE id = :id');
        $statement->bindParam(':name', $this->name);
        $statement->bindParam(':id', $this->id);
		$statement->bindParam(':email', $this->email);
		$statement->bindParam(':urgency', $this->urgency);
		$statement->bindParam(':phonenumber', $this->phonenumber);
		$statement->bindParam(':orderdate', $this->orderdate);
		$statement->bindParam(':deadline', $this->deadline);
		$statement->bindParam(':fk_Tool', $this->fk_Tool);
		$statement->bindParam(':status', $this->status);
        $statement->execute();
	}

	public function delete($id){
        $statement = $this->pdo->prepare('DELETE From orders WHERE id = :id');
        $statement->bindParam(':id', $id);
        $statement->execute();
    }

	static function GetAll(){
        $pdo = db();
        $statement = $pdo->prepare('SELECT orders.id, orders.name as "name", email, phonenumber, urgency, orderdate, deadline, status, tools.name as "tool" FROM orders JOIN tools on tools.id = fk_tool');
        $statement->execute();
        $listoforders = $statement->fetchAll();
		$result = array();
		
		foreach($listoforders as $order){
			$task = new self();
			$task->id = $order['id'];
			$task->name = $order['name'];
			$task->email = $order['email'];
			$task->phonenumber = $order['phonenumber'];
			$task->urgancy = $order['urgency'];
			$task->orderdate = $order['orderdate'];
			$task->deadline = $order['deadline'];
			$task->status = $order['status'];
			$task->tool = $order['tool'];

			$result[] = $task;
		}

		return $result;
    }

	public function calDeadline($startdate, int $urgency){
				
		switch ($urgency) {
			case 1:
				$reparaturdauer = 25;
				break;
			case 2:
				$reparaturdauer = 20;
				break;
			case 3:
				$reparaturdauer = 15;
				break;
			case 4:
				$reparaturdauer = 10;
				break;
			case 5:
				$reparaturdauer = 5;
				break;
		}

		return strtotime($startdate. ' + ' . $reparaturdauer .' days');
	}

	static function GetAllPending(){
        $pdo = db();
        $statement = $pdo->prepare('SELECT * FROM  orders WHERE status = :status');
        $statement->bindParam(':status', $this->status);
        $statement->execute();
        $listoforders = $statement->fetchAll();
        $result = array();
        foreach($listoforders as $order){
            $task = new self();
            $task->id = $order['id'];
            $task->name = $order['name'];
            $task->email = $order['email'];
            $task->phonenumber = $order['phonenumber'];
            $task->urgency = $order['urgency'];
            $task->orderdate = $order['orderdate'];
            $task->deadline = $order['deadline'];
            $task->status = $order['status'];
            $task->fk_Tool = $order['fk_Tool'];
            $result[] = $task;
        }
        return $result;
    }
}