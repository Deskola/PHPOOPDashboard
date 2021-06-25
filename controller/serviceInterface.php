<?php

interface ServicesInterf {
	//main service functions
	public function createService($name, $description);
	public function readAllServices();
	public function readServiceById($serviceID);
	public function editService();
}