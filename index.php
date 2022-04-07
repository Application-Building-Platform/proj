<?php 
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
				<div class="row tblHeader">Category</div>
				<div class="row tblHeader">Update</div>
				<div class="row tblHeader">Delete</div>
				<div class="row tblHeader">View</div>
				<div class="row tblHeader">Answered?</div>
			</div>
				<?php
				foreach($TPL['applications'] as $row){
					echo '<div class="table">';
					echo '<div class="row rows r">' . $row['application_title'] . '</div>';
					echo '<div class="row rows">' . $get_category['category_name'] . '</div>';
					echo '<div class="row rows"><a href="server/action.php?y=edit_application&id=' . $row['application_id'] . '" title="Update ' . $row['application_title'] . '"><img src="images/edit.png" width="20" height="20"></a></div>';
					echo '<div class="row rows"><a class="delete" id="application" data-id="' . $row['application_id'] . '" title="Delete ' . $row['application_title'] . '"><img src="images/delete.png" width="20" height="20"></a></div>';
					echo '<div class="row rows"><a href="server/action.php?y=view_application&id=' . $row['application_id'] . '" title="view ' . $row['application_title'] . '"><img src="images/view.png" width="20" height="20"></a></div>';
					echo '<div class="row rows"><a href="server/action.php?y=view_question&id=' . $row['application_id'] . '" title="view ' . $row['application_title'] . '">X</a></div>';
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
				<div class="row tblHeader">Category</div>
				<div class="row tblHeader">Update</div>
				<div class="row tblHeader">Delete</div>
				<div class="row tblHeader">View</div>
			</div>
				<?php
				
				foreach($TPL['questions'] as $key => $row){
					$arr = json_decode($TPL['questions'][$key]['question_value'], true);
					echo '<div class="table">';
					echo '<div class="row rows r">' . $arr['q'] . '</div>';
					echo '<div class="row rows">' . $arr['q_category'] . '</div>';
					echo '<div class="row rows"><a href="server/action.php?y=edit_question&id=' . $row['question_id'] . '" title="Update ' . $arr['q'] . '"><img src="images/edit.png" width="20" height="20"></a></div>';
					echo '<div class="row rows"><a class="delete" id="question" data-id="' . $row['question_id'] . '" title="Delete ' . $arr['q'] . '"><img src="images/delete.png" width="20" height="20"></a></div>';
					echo '<div class="row rows"><a href="server/action.php?y=view_question&id=' . $row['question_id'] . '" title="view ' . $arr['q'] . '"><img src="images/view.png" width="20" height="20"></a></div>';
					echo '</div>';
				}
				
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


<?php








include("footer.php"); 

?>
