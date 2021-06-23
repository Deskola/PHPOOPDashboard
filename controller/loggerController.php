<?php
include 'crudinterface.php';
include 'init/db_connection.php';
/**
 * 
 */
class LoggerImp implements Crud
{
	
	function __construct()
	{
		
	}

	public static function create()
	{
		 
		$reflection = new ReflectionClass(__CLASS__);
		$instance = $reflection->newInstanceWithoutConstructor();

		return $instance;
	}	

	//solution functions
	public function createSolution($title,$subid,$descrip,$soln){
		$dbconn = $this->dbConnect();

		$currentTime = date("Y-m-d H:i:s");
		$updateTime = $currentTime;
		$query = "INSERT INTO solution(title,subserviceid,problemDescription,solution,createdAt,updatedAt) VALUES('$title','$subid','$descrip','$soln','$currentTime','$updateTime')";

		$results = mysqli_query($dbconn, $query) or die("Error".mysqli_error($dbconn));

		return $results;
	}
	public function readAllSolutions(){
		$dbconn = $this->dbConnect();

		$query = "SELECT * FROM solution";
		$results = mysqli_query($dbconn, $query) or die("Error".mysqli_error($dbconn));		

		return $results;
	}	
	public function readSolutionById(){

	}	
	public function editSolution(){}
	public function search(){}

	//main service functions
	public function createService($name, $description){
		$dbconn = $this->dbConnect();

		$query = "INSERT INTO service(name, description)
				VALUES('$name','$description')";

		$results = mysqli_query($dbconn, $query) or die("Error".mysqli_error($dbconn));

		return $results;
	}

	public function readAllServices(){
		$dbconn = $this->dbConnect();

		$query = "SELECT * FROM service";
		$results = mysqli_query($dbconn, $query) or die("Error".mysqli_error($dbconn));

		return $results;
	}

	public function readServiceById($serviceID){
		$dbconn = $this->dbConnect();
		
		$query = "SELECT id, name FROM service WHERE id = $serviceID";
		$res = mysqli_query($dbconn, $query) or die("Error".mysqli_error($dbconn));

		$results = $res->fetch_assoc();

		return $results;
	}

	public function editService(){}

	//subservice functions
	public function createSubService($name, $parentID, $description){
		$dbconn = $this->dbConnect();

		$query = "INSERT INTO subservice(name, serviceId, description)
				VALUES('$name','$parentID','$description')";

		$results = mysqli_query($dbconn, $query) or die("Error".mysqli_error($dbconn));

		return $results;
	}

	public function readAllSubServices(){
		$dbconn = $this->dbConnect();

		$query = "SELECT * FROM subservice";
		$results = mysqli_query($dbconn, $query) or die("Error".mysqli_error($dbconn));

		return $results;
	}

	public function readSuberviceById($serviceID){
		$dbconn = $this->dbConnect();

		$query = "SELECT * FROM subservice WHERE serviceId = $serviceID";
		$results = mysqli_query($dbconn, $query) or die("Error".mysqli_error($dbconn));
		
		$subservice_arr = array();
		while ($row = mysqli_fetch_assoc($results)) {
			$subservice_arr[] = array(
				'id' => $row["id"], 
				'name' => $row["name"]
			);
		}

		return $subservice_arr;

	}

	public function getSubServiceName($id)
	{
		$dbconn = $this->dbConnect();
		
		$query = "SELECT name FROM subservice WHERE id = $id";
		$res = mysqli_query($dbconn, $query) or die("Error".mysqli_error($dbconn));

		$results = $res->fetch_assoc();

		return $results;
	}
	public function editSubService(){}

	public function dbConnect(){
		$conn = new DBConnect;
		$conn = $conn->connect;

		return $conn;
	}

	public function validateForm(){
		$name = $this->name;
		$description = $this->description;
		
		if ($name == "" || $description=="") 
		{
			return false;
		}
		return true;
		
	}
}