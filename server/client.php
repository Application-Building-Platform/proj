<?php include("action2.php"); ?>
<?php //include("connect.php"); ?>
<div class="controller">
	<div class="title">
		<h2><?php echo ($_REQUEST['i'] == 'addclient' ? 'Add a new client' : 'View clients'); ?></h2>
	</div>
	<div class="form">
<?php if($_REQUEST['i'] == 'addclient'){?>

		<form action="action.php?y=add_client" method="post">
			<label for="name">Client Name :</label>
			<input type="text" id="name" name="name">

			<label for="email">Client Email :</label>
			<input type="text" id="email" name="email">

			<label for="phone">Client Phone :</label>
			<input type="text" id="phone" name="phone"> 
			
			<label for="address">Client Address :</label>
			<input type="text" id="address" name="address">

			<label for="category">Client Category :</label>
			<input type="text" id="category" name="category"> 	

			<label for="description">Client Description :</label>
			<textarea id="description" rows="4" name="description"> </textarea>

			<input type="submit" value="ADD">
		</form>

<?php }
if($_REQUEST['i'] == 'viewclient'){?>

		<div class="table">
			<div class="row header r">Client Name</div>
			<div class="row header r">Client Email</div>
			<div class="row header">Update</div>
			<div class="row header">Delete</div>
		</div>
			<?php
			$TPL['results'] = get_all_data($dbh, 'clients');
			foreach($TPL['results'] as $t){
				echo '<div class="table">';
				echo '<div class="row rows r">' . $t['client_name'] . '</div>';
				echo '<div class="row rows r">' . $t['client_email'] . '</div>';
				echo '<div class="row rows">E</div>';
				echo '<div class="row rows">D</div>';
				echo '</div>';
			}
			?>
<?php } ?>


	</div>
</div>
