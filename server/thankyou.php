<?php

include("connect.php");
 //get application unique id (slug) from URL
$slug = $_SERVER['QUERY_STRING'];
if(empty($slug)){
	include("../menu.php");
	echo "error";
	include("../footer.php");
	exit;
}



//get current application
try {
	
	$stmt = $dbh->prepare("SELECT a.*, c.client_email, c.client_name, c.client_phone, c.client_address, c.client_description
		FROM applications a 
		LEFT JOIN clients c  ON(c.client_id=a.client_id)
		WHERE a.application_slug  = ?");
	$stmt->execute([$slug]);
	$application = $stmt->fetch();
	

		
}
catch (PDOException $e){
	echo "Select failed: " . $e->getMessage();
	exit();
}

?>

<?php include("../menu.php"); ?>
	<div class="form">
		<h2>Thank you, <?=$application['client_name']?></h2>
		<p>We appreciate your participation in the survery (<?=$application['application_title']?>). We will be in contact .</p>
	</div>
	<?php header( "refresh:5;url=" . $url ); ?>
<?php include("../footer.php"); ?>