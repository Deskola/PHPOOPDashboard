<?php

interface SubServiceInter {
	//subservice functions
	public function createSubService($name, $parentID, $description);
	public function readAllSubServices();
	public function readSuberviceById($serviceID);
	public function getSubServiceName($id);
	public function editSubService();

}