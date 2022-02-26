<?php
include("../menu.php");
error_reporting(E_ALL & ~E_NOTICE);
switch ($_REQUEST['i']) {
    case 'addapplication':
        echo "application";
        break;
    case 'addclient':
        include("client.php");
        break;
    case 'addquestion':
        echo "question";
        break;
    case 'addcategory':
        include("category.php");
        break;	
	default:
		echo "default";
} 

include("../footer.php"); 