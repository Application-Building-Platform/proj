<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
error_reporting(E_ALL & ~E_NOTICE);
include "connect.php";
include("../menu.php");

$clientName         = filter_input(INPUT_POST, "name",        FILTER_SANITIZE_SPECIAL_CHARS);
$clientEmail        = filter_input(INPUT_POST, "email",       FILTER_VALIDATE_EMAIL);
$clientPhone        = filter_input(INPUT_POST, "phone",       FILTER_SANITIZE_SPECIAL_CHARS);
$clientAddress      = filter_input(INPUT_POST, "address",     FILTER_SANITIZE_SPECIAL_CHARS);
$clientCategory     = filter_input(INPUT_POST, "category",    FILTER_SANITIZE_SPECIAL_CHARS);
$clientDescription  = filter_input(INPUT_POST, "description", FILTER_SANITIZE_SPECIAL_CHARS);
$categoryName       = filter_input(INPUT_POST, "name",        FILTER_SANITIZE_SPECIAL_CHARS);
switch ($_REQUEST['y']) {
    case 'add_client':
        if(($clientName && 
			$clientEmail && 
			$clientPhone && 
			$clientAddress &&
			$clientDescription) !== null &&
		   ($clientName && 
			$clientEmail && 
			$clientPhone && 
			$clientAddress &&
			$clientDescription) !== false){
			$SQL = $dbh->prepare("INSERT INTO clients (
					   client_name,
					   client_email,
					   client_phone,
					   client_address,
					   client_description
					   ) VALUES(?,?,?,?,?)");
			$insert = [$clientName, 
					   $clientEmail, 
					   $clientPhone, 
					   $clientAddress, 
					   $clientDescription];
			if ($SQL->execute($insert)) {
				echo "<div class='controller'>";
				echo "<div class='form green'>";
				echo "The client $clientName , has been added to database";
				echo "</div>";
				echo "</div>";
				header( "refresh:1;url=add.php?i=addclient" );
			}else{
				echo"error";
			}
		}else{
			echo "There is an issue with your parameters ..";
		}
        break;
	case 'add_category':
        if($categoryName !== null && $categoryName !== false){
			$SQL = $dbh->prepare("INSERT INTO categories (category_name) VALUES(?)");
			$insert = [$categoryName];
			if ($SQL->execute($insert)) {
				echo "<div class='controller'>";
				echo "<div class='form green'>";
				echo "The category $categoryName has been added to database";
				echo "</div>";
				echo "</div>";
				header( "refresh:1;url=add.php?i=addcategory" );
			}else{
				echo"error";
			}
		}else{
			echo "There is an issue with your parameters ..";
		}
        break;
	case 'del_client':
	case 'del_category':
		$client_id = $category_id = $_REQUEST['id'];
		$table = ($_REQUEST['y'] == "del_client" ? "clients" : "categories");
		$colum = ($_REQUEST['y'] == "del_client" ? $client_id : $category_id);
		$row   = ($_REQUEST['y'] == "del_client" ? "client_id" : "category_id");
        if($client_id !== null && $client_id !== false){
			$SQL = $dbh->prepare("DELETE FROM $table WHERE $row = ?");
			if ($SQL->execute([$colum])) {
				// echo "<div class='controller'>";
				// echo "<div class='form green'>";
				// echo "The $table id : " . $_REQUEST['id'] . ", has been deleted";
				// echo "</div>";
				// echo "</div>";
			}else {
				echo"error";
			}
		}
        break;
	case 'del_question':
        if($_REQUEST['id'] !== null && $_REQUEST['id'] !== false){
			$SQL = $dbh->prepare("DELETE FROM questions WHERE question_id = ?");
			if ($SQL->execute([$_REQUEST['id']])) {
				// echo "<div class='controller'>";
				// echo "<div class='form green'>";
				// echo "The question id : " . $_REQUEST['id'] . ", has been deleted";
				// echo "</div>";
				// echo "</div>";
			}else {
				echo"error";
			}
		}
        break;
	case 'edit_client':
		include("client.php");
        break;
	case 'edit_category':
		include("category.php");
        break;
	case 'edit_question':
		include("question.php");
        break;
	case 'update_client':
		try {
		  $stmt = $dbh->prepare("UPDATE clients SET client_name = ?,
													client_email = ?,
													client_phone = ?,
													client_address = ?,
													client_description = ? WHERE client_id = ?");
		  if ($stmt->execute([ $clientName, 
							   $clientEmail, 
							   $clientPhone, 
							   $clientAddress, 
							   $clientDescription, 
							   $_REQUEST['id'] ])) {
				echo "<div class='controller'>";
				echo "<div class='form green'>";
				echo "The client id : " . $_REQUEST['id'] . ", has been updated";
				echo "</div>";
				echo "</div>";
				header( "refresh:1;url=view.php?i=viewclient");
			}else {
				echo"error";
			}
		}
		catch(PDOException $e)
		{
		  echo "Update failed: " . $e->getMessage();
		  exit();
		}

		break;
	case 'update_category':
		try {
		  $stmt = $dbh->prepare("UPDATE categories SET category_name = ? WHERE category_id = ?");
		  if ($stmt->execute([ $categoryName, $_REQUEST['id'] ])) {
				echo "<div class='controller'>";
				echo "<div class='form green'>";
				echo "The category id : " . $_REQUEST['id'] . ", has been updated";
				echo "</div>";
				echo "</div>";
				header( "refresh:1;url=view.php?i=viewcategory");
			}else {
				echo"error";
			}
		}
		catch(PDOException $e)
		{
		  echo "Update failed: " . $e->getMessage();
		  exit();
		}

		break;
	case 'addquestion':
		$question_data = array();
		$question_data['q']          = $_POST['qText'];
		$question_data['choices']    = $_POST['qCho'];
		$question_data['q_type']     = $_POST['qType'];
		$question_data['q_category'] = $_POST['qCategory'];
		$SQL = $dbh->prepare("INSERT INTO questions (`question_type`, `question_value`, `category_id`) VALUES(?,?,?)");
		$insert = [$question_data['q_type'], json_encode($question_data), 1];
		if ($SQL->execute($insert)) {
			echo "<div class='controller'>";
			echo "<div class='form green'>";
			echo "The question has been added to database";
			echo "</div>";
			echo "</div>";
			header( "refresh:1;url=add.php?i=addquestion");
			
		}else{
			echo"error";
		}
		break;
	default:
		echo "default";
} 


include("../footer.php"); 