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
<<<<<<< Updated upstream
=======
function get_all_questions($dbh, $id){
	$results = array();
	try 
	{
		$stmt = $dbh->prepare("SELECT q.question_id, k.question_type, k.question_value
							   FROM application_questions q
							   LEFT JOIN questions k ON (k.question_id = q.question_id)
							   WHERE q.application_id = ?
							   ORDER BY q.question_order ASC");
							   
		$stmt->execute([$id]);
		while ($nextRow = $stmt->fetch(PDO::FETCH_ASSOC)){
			$SQL = $dbh->prepare("SELECT c.question_id, c.condition_value, c.condition_question_id
							   FROM conditions c
							   WHERE c.question_id = ? AND c.application_id = ?");
			$SQL->execute([$nextRow['question_id'],$id]);
			$nextRow['conditions'] = $SQL->fetchAll(PDO::FETCH_ASSOC|PDO::FETCH_GROUP)[$nextRow['question_id']] ?? [];
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
>>>>>>> Stashed changes

$TPL['edit_client']   = readOne($dbh, $_REQUEST['id'], 'clients', 'client_id');
$TPL['edit_category'] = readOne($dbh, $_REQUEST['id'], 'categories', 'category_id');
$TPL['edit_question'] = readOne($dbh, $_REQUEST['id'], 'questions', 'question_id');
$TPL['clients']       = get_all_data($dbh, 'clients');
$TPL['categories']    = get_all_data($dbh, 'categories');
$TPL['questions']     = get_all_data($dbh, 'questions');


