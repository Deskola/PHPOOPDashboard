<?php
include '../loggerController.php';
$service = new LoggerImp();
$conn = $service->dbConnect();

/////////////// //////////////////////////////////////////////
  /// //////  SERVICE AJAX RESPONSE (index.php) ////////////////////////////
  /// ////////////////////////////////////////////////  
if (isset($_POST['field1'])) {
	$parentId =mysqli_escape_string($conn, $_POST["field1"]);

	$data = $service->readSuberviceById($parentId);
	echo json_encode($data);
}

