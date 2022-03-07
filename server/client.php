<?php include("function.php"); ?>
<div class="controller">
	<div class="title">
		<h2><?php echo ($_REQUEST['i'] == 'addclient' ? 'Add a new client' : 'View clients'); ?></h2>
	</div>
	<div class="form">
<?php if($_REQUEST['i'] == 'addclient'){?>

		<form action="action.php?y=add_client" method="post">
			<label for="name">Client Name :</label>
			<input type="text" id="name" name="name" class="qMargin">

			<label for="email">Client Email :</label>
			<input type="text" id="email" name="email" class="qMargin">

			<label for="phone">Client Phone :</label>
			<input type="text" id="phone" name="phone" class="qMargin"> 
			
			<label for="address">Client Address :</label>
			<input type="text" id="address" name="address" class="qMargin">

			<label for="category">Client Category :</label>
			<input type="text" id="category" name="category" class="qMargin"> 	

			<label for="description">Client Description :</label>
			<textarea id="description" rows="4" name="description" class="qMargin"> </textarea>

			<div class="qst rightSubmit">
				<input type="submit" value="ADD">
			</div>
		</form>

<?php }
if($_REQUEST['i'] == 'viewclient'){?>

		<div class="table">
			<div class="row tblHeader r">Client Name</div>
			<div class="row tblHeader r">Client Email</div>
			<div class="row tblHeader">Update</div>
			<div class="row tblHeader">Delete</div>
		</div>
			<?php
			$TPL['results'] = get_all_data($dbh, 'clients');
			foreach($TPL['results'] as $row){
				echo '<div class="table">';
				echo '<div class="row rows r">' . $row['client_name'] . '</div>';
				echo '<div class="row rows r">' . $row['client_email'] . '</div>';
				echo '<div class="row rows">E</div>';
				echo '<div class="row rows"><a href="action.php?y=del_client&id=' . $row['client_id'] . '" title="Delete' . $row['client_name'] . '">D</a></div>';
				echo '</div>';
			}
			?>
<?php } ?>


	</div>
</div>
