<?php
include 'solutionsController.php';
/**
 * 
 */
class Pagination extends Solutions
{
	private $table, $total_records,$db, $limit = 5, $col;
	
	function __construct($table,$db)
	{
		parent::__construct($db);
		$this->table = $table;	
		$this->db = $db;	
		if($this->is_search()) $this->set_search_col();
		$this->set_total_records();
	}

	public function set_total_records()
	{
		$conn = $this->db;
		$stmt = "SELECT id FROM $this->table";

		if($this->is_search()){
			$val 	= $this->is_search();
			// $query  = "SELECT id FROM $this->table WHERE username LIKE '%$val%'";
			$query  = "SELECT id FROM $this->table WHERE $this->col LIKE '%$val%'";
		}

		$results = mysqli_query($conn, $stmt);
		// $stmt->execute();
		// $results = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$this->total_records = $results->num_rows;
	}

	public function current_page()
	{
		return isset($_GET['page']) ? (int)$_GET['page'] : 1;
	}

	public function get_data()
	{
		$start = 0;
		if ($this->current_page() > 1) {
			$start = ($this->current_page() * $this->limit) - $this->limit;
		}

		$conn = $this->db;


		$stmt = "SELECT * FROM $this->table LIMIT $start, $this->limit";
		$results = mysqli_query($conn, $stmt);

		if($this->is_search()){
			$val 	= $this->is_search();
			// $query  = "SELECT id FROM $this->table WHERE username LIKE '%$val%' $start, $this->limit";
			$query  = "SELECT id FROM $this->table WHERE $this->col LIKE '%$val%' $start, $this->limit";
		}
		// $stmt->execute();

		// //grab a result set
		// $resultSet = $stmt->get_result();

		//pull all results as an associative array
		//return $results->fetch_all();
		//$results = $results->fetch_assoc();
		return $results;
		 
	}

	public function check_search(){
		if($this->is_search()){
			return '&search='.$this->is_search().'&col='.$this->col;
		}
		return '';
	}
	

	public function is_search(){
		return isset($_GET['search']) ? $_GET['search'] : '';
	}

	

	public function get_pagination_number(){
		return ceil($this->total_records / $this->limit);
	}

	public function prev_page(){
		return ($this->current_page() > 1) ? $this->current_page()-1 : 1;
	}
	public function next_page(){
		return ($this->current_page() < $this->get_pagination_number()) ? $this->current_page()+1 : $this->get_pagination_number();
	}
	public function is_active_class($page){
		return ($page == $this->current_page()) ? 'active' : '';
	}
	
	public function set_search_col(){
		$this->col = $_GET['col'];
	}
	public function is_showable($num){
		// The first conditions
	  if($this->get_pagination_number() < 4 || $this->current_page() == $num)
			return true;
		// The second conditions
	  if(
			($this->current_page()-2) <= $num && ($this->current_page()+2) >= $num
		)
			return true;
	}

	// public function dbConnect(){
	// 	$conn = new DBConnect;
	// 	$conn = $conn->connect;

	// 	return $conn;
	// }
}