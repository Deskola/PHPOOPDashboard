<?php
include 'solutionsInterface.php';
include 'subServiceController.php';

/**
 * 
 */
class Solutions extends SubServices implements SolutionsInterf
{
	// private $title, $subId, $problemDesc, $soln;
	private $db;
	
	function __construct($db)
	{
		parent::__construct($db);
		$this->db = $db;
		// $this->subId = $subId;
		// $this->problemDesc = $problemDesc;
		// $this->soln = $soln;
	}

	//solution functions
	public function createSolution($title, $subId, $problemDesc, $soln){
		$dbconn = $this->db;

		$currentTime = date("Y-m-d H:i:s");
		$updateTime = $currentTime;
		$stmt = $dbconn->prepare("INSERT INTO solution(title,subserviceid,problemDescription,solution,createdAt,updatedAt) VALUES(?,?,?,?,?,?)");
		$stmt->bind_param('ssssss',$this->title,$this->subId,$this->problemDesc,$this->soln,$currentTime,$updateTime);
		//$results = mysqli_query($dbconn, $query) or die("Error".mysqli_error($dbconn));
		$results = $stmt->execute();

		return $results;
	}

	public function readAllSolutions(){
		$dbconn = $this->db;

		$stmt = $dbconn->prepare("SELECT * FROM solution");
		//$results = mysqli_query($dbconn, $query) or die("Error".mysqli_error($dbconn));		
		$results = $stmt->execute();
		return $results;
	}

	public function readSolutionById(){

	}

	public function editSolution(){

	}
	public function search(){

	}
	
}