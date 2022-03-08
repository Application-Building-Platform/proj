<?php
	

include("../menu.php");
error_reporting(E_ALL & ~E_NOTICE);
switch ($_REQUEST['i']) {
	case 'id':
        echo $_REQUEST['id'];
        break;
    case 'addapplication':
        echo "application";
        break;
    case 'addclient':
        include("client.php");
        break;
    case 'addsurvey':
        include("survey.php");
        break;
    case 'addcategory':
        include("category.php");
        break;	
	default:
		echo "default";
} 

include("../footer.php"); 