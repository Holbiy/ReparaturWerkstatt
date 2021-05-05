<?php
class Order
{
	public $id;
	public $name;
	public $email;
	public $phonenumber;
	public $urgency;
	public $urgencyText;
	public $orderdate;
	public $status;
	public $deadline;
	public $toolid;
	public $toolText;
	public $pdo;
	public $duration;


	public function __construct(
		$id = null,
		$name = null,
		$email = null,
		$urgency = null,
		$toolid = null,
		$phonenumber = null,
		$status = null,
		$orderdate = null,
		$deadline = null,
		$toolText = null
	) {
		$this->id = $id;
		$this->name = $name;
		$this->email = $email;
		$this->urgency = $urgency;
		$this->orderdate = $orderdate;
		$this->deadline = $deadline;
		$this->toolid = $toolid;
		$this->phonenumber = $phonenumber;
		$this->toolText = $toolText;
		$this->pdo = db();
		$this->status = $status;
		if (isset($urgency)) {
			$this->urgencyText = $this->getUrgencyText($this->urgency);
		}
	}

	static function getById($id)
	{
		$task = new self();

		$task->id = $id;
		$statement = $task->pdo->prepare("SELECT * FROM orders WHERE id = :id");
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
		$task->toolid = $result['fk_Tool'];
		$task->urgencyText = $task->getUrgencyText($task->urgency);
		return $task;
	}

	public function add()
	{
		$this->orderdate = date('Y-m-d');
		$this->deadline = $this->getDeadline($this->urgency);

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

	public function update()
	{
		$statement = $this->pdo->prepare('UPDATE orders SET name = :name, email = :email, phonenumber = :phonenumber, fk_Tool = :fk_Tool, status = :status WHERE id = :id');
		$statement->bindParam(':name', $this->name);
		$statement->bindParam(':id', $this->id);
		$statement->bindParam(':phonenumber', $this->phonenumber);
		$statement->bindParam(':email', $this->email);
		$statement->bindParam(':fk_Tool', $this->toolid);
		$statement->bindParam(':status', $this->status);
		$statement->execute();
	}

	public function updatestatus(){
		if($this->status == 1){
			$statement = $this->pdo->prepare('UPDATE orders SET status = 0 WHERE id = :id');
			$statement->bindParam(':id', $this->id );
			$statement->execute();
		}elseif($this->status == 0){
			$statement = $this->pdo->prepare('UPDATE orders SET status = 1 WHERE id = :id');
			$statement->bindParam(':id', $this->id );
			$statement->execute();
		}
	}

	static function GetAll($filter = false)
	{
		$pdo = db();
		$filter = $filter ? " WHERE status = 0 Order by urgency DESC " : "";
		$statement = $pdo->prepare('SELECT orders.id, orders.name as "name", email, phonenumber, urgency, orderdate, deadline, status, tools.name as "tool", tools.id as "toolid" FROM orders JOIN tools on tools.id = fk_tool' . $filter);
		$statement->execute();
		$listoforders = $statement->fetchAll();
		$result = array();

		foreach ($listoforders as $order) {
			$task = new self(
							$order['id'], 
							$order['name'], 
							$order['email'], 
							$order['urgency'], 
							$order['toolid'], 
							$order['phonenumber'], 
							$order['status'], 
							$order['orderdate'], 
							$order['deadline'], 
							$order['tool']);
			$result[] = $task;
		}

		return $result;
	}

	private function getUrgencyText($urgency)
	{
		switch ($urgency) {
			case 1:
				return "sehr tief";
				break;
			case 2:
				return "tief";
				break;
			case 3:
				return "normal";
				break;
			case 4:
				return "hoch";
				break;
			case 5:
				return "sehr hoch";
				break;
		}
	}

	private function getDeadline($urgency)
	{
		switch ($urgency) {
			case 1:
				$this->duration = 25;
				break;
			case 2:
				$this->duration = 20;
				break;
			case 3:
				$this->duration = 15;
				break;
			case 4:
				$this->duration = 10;
				break;
			case 5:
				$this->duration = 5;
				break;
		}
		$startdate = date("d-m-Y", strtotime(date('Y-m-d')));
		return  date('Y-m-d', strtotime($startdate . ' + ' . $this->duration . ' days'));
	}
}
