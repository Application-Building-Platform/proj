<?php

$url = 'http://' . $_SERVER['SERVER_NAME'] . '/proj/';

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Project (Beta)</title>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<link href="http://127.0.0.1/proj/css/css.css" rel="stylesheet">
	<script src="http://127.0.0.1/proj/js/js.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
	</script>
</head>

<body>
	<div class="page">
		<div class="header">
			<div class="logo">
				<h1><a href="<?=$url?>"><span class="logo_colour">Survey Builder</span></a></h1>
			</div>
			<div class="menu">
				<a class="link" href="<?php echo $url; ?>" alt="HOME">HOME</a>
				<a class="link" href="<?php echo $url; ?>server/add.php?i=addapplication" alt="Add Application">Add an Application</a>
				<a class="link" href="<?php echo $url; ?>server/add.php?i=addclient" alt="Add client">Add a Client</a>
				<a class="link" href="<?php echo $url; ?>server/add.php?i=addquestion" alt="Add a question">Add a Question</a>
				<a class="link" href="<?php echo $url; ?>server/add.php?i=addcategory" alt="Add category">Add Category</a>
			</div>

		</div>
		<div class="page_canter">