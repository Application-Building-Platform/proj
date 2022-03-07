<?php
include("../menu.php");
error_reporting(E_ALL & ~E_NOTICE);
switch ($_REQUEST['i']) {
    case 'viewclient':
        include("client.php");
        break;
    case 'viewcategory':
        include("category.php");
        break;			
    case 'viewquestion':
        include("question.php");
        break;
	default:
		echo "default";
} 

include("../footer.php"); 