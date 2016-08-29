<?php
require_once "config.php";

class Model {
	public $db;

	public function __construct($data){
		$this->connect($data);
	}

	public function connect($data){
		try {
			$host = $data['server'];
			$db = $data['database'];

			$this->db = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $data['username'], $data['password']);

		} catch (PDOException $e) {
			opd($e->getMessage());
		}
	}

	public function getTagByCategory($category){
		$records = array();

		$stmnt = $this->db->prepare("
				SELECT *
				FROM tags
				WHERE category = ?
			");

		$stmnt->execute(array($category));

		while($row = $stmnt->fetch()){
			$records[] = $row;
		}

		return $records;
	}

	public function getCategories(){
		$records = array();

		$stmnt = $this->db->prepare("
				SELECT DISTINCT(category)
				FROM tags
			");

		$stmnt->execute();

		while($row = $stmnt->fetch()){
			$records[] = $row;
		}

		return $records;
	}

	public function getAllTags(){
		$records 	= array();
		$stmnt 		= $this->db->prepare("
				SELECT *
				FROM tags
			");

		$stmnt->execute();

		while($row = $stmnt->fetch()){
			$records[] = $row;
		}

		return $records;
	}

	public function addTag(){
		if(isset($_POST['id'])){
			$stmnt = $this->db->prepare("
					DELETE FROM tags
					WHERE id = ?
				");

			$stmnt->execute(array($_POST['id']));

			die(json_encode(array("success" => 1)));
		}
	}

	public function tags(){
		$name 		= $_POST['name'];
		$category 	= $_POST['category'];
		$markup 	= ($_POST['markup']);

		$stmnt = $this->db->prepare("
				INSERT INTO tags
				VALUES (
						null,
						?,
						?,
						?
					)
			");

		$stmnt->execute(array(
				$name,
				$category,
				$markup
			));

		redirect("tags.php");
	}
}

