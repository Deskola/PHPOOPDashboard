<?php

interface Crud {	
	//solution functions
	public function createSolution($title,$subid,$descrip,$slon,$ref);
	public function readAllSolutions();	
	public function readSolutionById();	
	public function editSolution();
	public function search($search_word);
	public function storeImages($data);
	public function getSolutionID($ref);
	

	//main service functions
	public function createService($name, $description);
	public function readAllServices();
	public function readServiceById($serviceID);
	public function editService();

	//subservice functions
	public function createSubService($name, $parentID, $description);
	public function readAllSubServices();
	public function readSuberviceById($serviceID);
	public function editSubService();
}