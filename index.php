<?php 
<<<<<<< Updated upstream

include("menu.php");
// include("server/client.php");
// include("server/category.php");








include("footer.php"); 
=======
include("server/function.php");
include("menu.php");
$get_category  = readOne($dbh, $TPL['edit_application']['category_id'], 'categories', 'category_id');
?>

<div class="nav-tab-wrapper">
  <a href="#tab-1" class="nav-tab nav-tab-active">Applications</a>
  <a href="#tab-2" class="nav-tab">Clients</a>
  <a href="#tab-3" class="nav-tab">Questions</a>
  <a href="#tab-4" class="nav-tab">Categories</a>
</div>
<div class="message"></div>
<div id="tab-1" class="tab-content active">
<div class="table">
	<div class="row tblHeader r">Application</div>
	<div class="row tblHeader">Client</div>
	<div class="row tblHeader">Category</div>
	<div class="row tblHeader">Update</div>
	<div class="row tblHeader">Delete</div>
	<div class="row tblHeader">View</div>
	<div class="row tblHeader">Answered?</div>
</div>
<?php
foreach($TPL['applications'] as $row){
	$get_answer   = readOne($dbh, $row['application_id'], 'applications', 'application_id');
	$get_client   = readOne($dbh, $get_answer['client_id'], 'clients', 'client_id');
	$get_category = readOne($dbh, $get_answer['category_id'], 'categories', 'category_id');
	echo '<div class="table">';
	echo '<div class="row rows r">' . $row['application_title'] . '</div>';
	echo '<div class="row rows">' . $get_client['client_name'] . '</div>';
	echo '<div class="row rows">' . $get_category['category_name'] . '</div>';
	echo '<div class="row rows"><a href="server/action.php?y=edit_application&id=' . $row['application_id'] . '" title="Update ' . $row['application_title'] . '"><img src="images/edit.png" width="20" height="20"></a></div>';
	echo '<div class="row rows"><a class="delete" id="application" data-id="' . $row['application_id'] . '" title="Delete ' . $row['application_title'] . '"><img src="images/delete.png" width="20" height="20"></a></div>';
	echo '<div class="row rows"><a href="' . $url . 'server/survey.php?' . $get_answer['application_slug'] . '" target="_tab" title="view ' . $row['application_title'] . '"><img src="images/view.png" width="20" height="20"></a></div>';
	if($get_answer['responded_at'] == NULL){
		echo '<div class="row rows">No</a></div>';
	}else {
		echo '<div class="row rows"><a href="' . $url . 'server/survey.php?' . $get_answer['application_slug'] . '" target="_tab" title="view ' . $row['application_title'] . '">Yes</a></div>';
	}
	echo '</div>';
}

?>
</div>
<div id="tab-2" class="tab-content">
<div class="table">
	<div class="row tblHeader r">Client Name</div>
	<div class="row tblHeader r">Client Email</div>
	<div class="row tblHeader">Update</div>
	<div class="row tblHeader">Delete</div>
</div>
<?php		
foreach($TPL['clients'] as $row){
	echo '<div class="table">';
	echo '<div class="row rows r">' . $row['client_name'] . '</div>';
	echo '<div class="row rows r">' . $row['client_email'] . '</div>';
	echo '<div class="row rows"><a href="server/action.php?y=edit_client&id=' . $row['client_id'] . '" title="Update ' . $row['client_name'] . '"><img src="images/edit.png" width="20" height="20"></a></div>';
	echo '<div class="row rows"><a class="delete" id="client" data-id="' . $row['client_id'] . '" title="Delete ' . $row['client_name'] . '"><img src="images/delete.png" width="20" height="20"></a></div>';
	echo '</div>';
}
?>

			
</div>
<div id="tab-3" class="tab-content">
	<div class="table">
		<div class="row tblHeader r">Question</div>
		<div class="row tblHeader">Type</div>
		<div class="row tblHeader">Category</div>
		<div class="row tblHeader">Update</div>
		<div class="row tblHeader">Delete</div>
		<div class="row tblHeader">View</div>
	</div>
<?php

foreach($TPL['questions'] as $key => $row){
	$arr = json_decode($TPL['questions'][$key]['question_value'], true);
	$get_category = readOne($dbh, $row['category_id'], 'categories', 'category_id');
	echo '<div class="table">';
	echo '<div class="row rows r">' . $arr['q'] . '</div>';
	echo '<div class="row rows">' . $get_category['category_name'] . '</div>';
	echo '<div class="row rows">' . $arr['q_type'] . '</div>';
	echo '<div class="row rows"><a href="server/action.php?y=edit_question&id=' . $row['question_id'] . '" title="Update ' . $arr['q'] . '"><img src="images/edit.png" width="20" height="20"></a></div>';
	echo '<div class="row rows"><a class="delete" id="question" data-id="' . $row['question_id'] . '" title="Delete ' . $arr['q'] . '"><img src="images/delete.png" width="20" height="20"></a></div>';
	echo '<div class="row rows"><a class="show_q" title="view ' . $arr['q'] . '"><img src="images/view.png" width="20" height="20"></a></div>';
	echo '</div>';
	echo '<div class="showQuestion">';
		echo '<div class="qst">';
			echo '<h4>' . $arr['q'] . '</h4>';
		echo '</div>';
		echo '<div class="que_cho">';
			for($i = 0; $i < sizeof($arr['choices']); $i++ ){
				echo '<div class="q_choices qst">';
					echo '<div class="cho_start">';
						echo '<input disabled type="' . $arr['q_type'] . '" name="' . $row['question_id'] . '" value="' . $arr['choices'][$i] . '" />';
						echo '<label for="' . $arr['q_type'] . '" name="' . $row['question_id'] . '">' . $arr['choices'][$i] . '</label>';
					echo '</div>';
				echo '</div>';
			}
		echo '</div>';
	echo '</div>';
}
>>>>>>> Stashed changes

?>
</div>
<div id="tab-4" class="tab-content">
<div class="table">
	<div class="row tblHeader r">Category Name</div>
	<div class="row tblHeader">Update</div>
	<div class="row tblHeader">Delete</div>
</div>
<?php
foreach($TPL['categories'] as $row){
	echo '<div class="table">';
	echo '<div class="row rows r">' . $row['category_name'] . '</div>';
	echo '<div class="row rows"><a class="update" data-id="' . $row['category_id'] . '" href="server/action.php?y=edit_category&id=' . $row['category_id'] . '" title="Update' . $row['category_name'] . '"><img src="images/edit.png" width="20" height="20"></a></div>';
	echo '<div class="row rows"><a class="delete" id="category" data-id="' . $row['category_id'] . '" title="Delete' . $row['category_name'] . '"><img src="images/delete.png" width="20" height="20"></a></div>';
	echo '</div>';
}
?>	
</div>
<?php include("footer.php"); ?>
