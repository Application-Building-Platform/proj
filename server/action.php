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
$categoryName       = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
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
	case 'del_client':
	case 'del_category':
		$client_id = $category_id = $_REQUEST['id'];
		$table = ($_REQUEST['y'] == "del_client" ? "clients" : "categories");
		$colum = ($_REQUEST['y'] == "del_client" ? $client_id : $category_id);
		$row   = ($_REQUEST['y'] == "del_client" ? "client_id" : "category_id");
        if($client_id !== null && $client_id !== false){
			$SQL = $dbh->prepare("DELETE FROM $table WHERE $row = ?");
			if ($SQL->execute([$colum])) {
				echo "<div class='controller'>";
				echo "<div class='form green'>";
				echo "The $table has been deleted";
				echo "</div>";
				echo "</div>";
			}else {
				echo"error";
			}
		}
        break;
	default:
		echo "default";
} 


include("../footer.php"); 