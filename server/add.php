<?php
	
include("../menu.php");

error_reporting(E_ALL & ~E_NOTICE);

switch ($_REQUEST['i']) {
    case 'addapplication':
        include("application.php");
        break;
    case 'addclient':
        include("client.php");
        break;
    case 'addquestion':
        include("question.php");
        break;
    case 'addcategory':
        include("category.php");
        break;	
	default:
		echo "I don't think you should be here .. ";
		header( "refresh:2;url=" . $url);
} 

include("../footer.php"); 