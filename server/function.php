<?php


include("connect.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
function readOne($dbh, $rowId, $table, $id){
	
	try {
		$stmt = $dbh->prepare("SELECT * FROM $table WHERE $id = ?");
		$stmt->execute([$rowId]);
		return $stmt->fetch();
	}
	catch (PDOException $e){
		echo "Select failed: " . $e->getMessage();
		exit();
	}
	
}
function get_all_questions($dbh, $id){
	$results = array();
	try 
	{
		$stmt = $dbh->prepare("SELECT q.question_id, q.question_type, q.question_value
							   FROM conditions c
							   JOIN questions q
							   ON c.question_id = q.question_id
							   WHERE application_id = ?");
		$stmt->execute([$id]);
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

$TPL['edit_client']      = readOne($dbh, $_REQUEST['id'], 'clients', 'client_id');
$TPL['edit_category']    = readOne($dbh, $_REQUEST['id'], 'categories', 'category_id');
$TPL['edit_question']    = readOne($dbh, $_REQUEST['id'], 'questions', 'question_id');
$TPL['edit_application'] = readOne($dbh, $_REQUEST['id'], 'applications', 'application_id');
$TPL['clients']          = get_all_data($dbh, 'clients');
$TPL['categories']       = get_all_data($dbh, 'categories');
$TPL['questions']        = get_all_data($dbh, 'questions');
$TPL['applications']     = get_all_data($dbh, 'applications');



