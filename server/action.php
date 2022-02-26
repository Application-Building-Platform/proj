<?php


include "connect.php";
include("../menu.php");
error_reporting(E_ALL & ~E_NOTICE);
$clientName         = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
$clientEmail        = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
$clientPhone        = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_SPECIAL_CHARS);
$clientAddress      = filter_input(INPUT_POST, "address", FILTER_SANITIZE_SPECIAL_CHARS);
$clientCategory     = filter_input(INPUT_POST, "category", FILTER_SANITIZE_SPECIAL_CHARS);
$clientDescription  = filter_input(INPUT_POST, "description", FILTER_SANITIZE_SPECIAL_CHARS);
$categoryName         = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
// $message = "";
switch ($_REQUEST['y']) {
    case 'add_client':
        if(($clientName && 
			$clientEmail && 
			$clientPhone && 
			$clientAddress &&
			$clientCategory &&
			$clientDescription) !== null &&
		   ($clientName && 
			$clientEmail && 
			$clientPhone && 
			$clientAddress &&
			$clientCategory &&
			$clientDescription) !== false){
			$SQL = $dbh->prepare("INSERT INTO clients (client_name,client_email,client_phone,client_address,client_category,client_description) VALUES(?,?,?,?,?,?)");
			$insert = [$clientName, $clientEmail, $clientPhone, $clientAddress, $clientCategory, $clientDescription];
			if ($SQL->execute($insert)) {
				echo "<div class='controller'>";
				echo "<div class='form green'>";
				echo "The client has been added to database";
				echo "</div>";
				echo "</div>";
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
				echo "The category has been added to database";
				echo "</div>";
				echo "</div>";
			}else{
				echo"error";
			}
		}else{
			echo "There is an issue with your parameters ..";
		}
        break;
	default:
		echo "default";
} 

function get_all_data($dbh){
	$results = array();
	
	try 
	{
		$stmt = $dbh->prepare("SELECT * FROM clients");
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

$TPL['results'] = get_all_data($dbh);

include("../footer.php"); 