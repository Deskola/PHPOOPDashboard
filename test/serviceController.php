<?php
include 'serviceInterface.php';
/**
 * 
 */
class Services implements ServicesInterf
{
	private $db;
	
	function __construct($db)
	{
		$this->db = $db;
	}

	public function createService($name, $description){
		$stmt = $this->db->prepare("INSERT INTO service(name, description) VALUES(?,?)");
		$stmt->bind_param('ss',$name,$description);
		$results = $stmt->execute();
		//$results = mysqli_query($dbconn, $query) or die("Error".mysqli_error($dbconn));

		return $results;
	}

	public function readAllServices(){
		$dbconn = $this->db;

		// $stmt = $dbconn->prepare("SELECT * FROM service");
		// //$results = mysqli_query($dbconn, $query) or die("Error".mysqli_error($dbconn));		
		// $results = $stmt->execute();
		// return $results;
		$query = "SELECT * FROM service";
		$results = mysqli_query($dbconn, $query) or die("Error".mysqli_error($dbconn));

		return $results;

	}

	public function readServiceById($serviceID){
		$dbconn = $this->db;

		$stmt = $dbconn->prepare("SELECT id, name FROM service WHERE id = ?");
		$stmt->bind_param('s',$serviceID);
		//$res = mysqli_query($dbconn, $query) or die("Error".mysqli_error($dbconn));
		$stmt->execute();
		$results = $stmt->get_result();

		return $results;
	}

	public function editService(){

	}
}