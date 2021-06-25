<?php
include 'subServiceInterface.php';
include 'serviceController.php';
/**
 * 
 */
class SubServices extends Services  implements SubServiceInter 
{
	private $db;
	
	function __construct($db)
	{
		parent::__construct($db);
		$this->db = $db;
	}

	public function createSubService($name, $parentID, $description){
		$dbconn = $this->db;

		$stmt = $dbconn->prepare("INSERT INTO subservice(name, serviceId, description) VALUES(?,?,?)");
		$stmt->bind_param('sss',$name, $parentID, $description);
		$results = $stmt->execute();

		//$results = mysqli_query($dbconn, $query) or die("Error".mysqli_error($dbconn));

		return $results;
	}

	public function readAllSubServices(){
		$dbconn = $this->db;

		$stmt = $dbconn->prepare("SELECT * FROM subservice");
		$results = $stmt->execute();
		//$results = mysqli_query($dbconn, $query) or die("Error".mysqli_error($dbconn));

		return $results;
	}

	public function readSuberviceById($serviceID){
		$dbconn = $this->db;

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

	public function getSubServiceName($id){
		$dbconn = $this->db;

		$query = "SELECT name FROM subservice WHERE id = $id";
		$res = mysqli_query($dbconn, $query) or die("Error".mysqli_error($dbconn));

		$results = $res->fetch_assoc();

		return $results;
	}

	public function editSubService(){

	}


}