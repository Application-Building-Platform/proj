<?php


include("connect.php");
error_reporting(E_ALL & ~E_NOTICE);
function get_all_data($dbh, $table){
	$results = array();
	
	try 
	{
		$stmt = $dbh->prepare("SELECT * FROM $table");
		$stmt->execute();
		while ($nextRow = $stmt->fetch()){
			$results[] = $nextRow;
		} 	
		
	}
	catch (PDOException $e)
	{
		echo "Select failed: " . $e->getMessage();
		exit();
	}
	
	return $results;
}





