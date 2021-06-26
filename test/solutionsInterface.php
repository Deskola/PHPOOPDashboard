<?php

interface SolutionsInterf {
	//solution functions
	public function createSolution($title, $subId, $problemDesc, $soln);
	public function readAllSolutions();	
	public function readSolutionById();	
	public function editSolution();
	public function search();
}