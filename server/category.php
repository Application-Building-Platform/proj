<?php include("action2.php"); ?>
<?php //include("connect.php"); ?>
<div class="controller">
	<div class="title">
		<h2><?php echo ($_REQUEST['i'] == 'addcategory' ? 'Add a new category' : 'View categories'); ?></h2>
	</div>
	<div class="form">
<?php if($_REQUEST['i'] == 'addcategory'){?>
		
		<form action="action.php?y=add_category" method="post">
			<label for="name">Category Name :</label>
			<input type="text" id="name" name="name">
			<input type="submit" value="ADD">
		</form>

<?php }
if($_REQUEST['i'] == 'viewcategory'){?>

		<div class="table">
			<div class="row header r">Category Name</div>
			<div class="row header">Delete</div>
		</div>
			<?php
			$TPL['results'] = get_all_data($dbh, 'categories');
			foreach($TPL['results'] as $row){
				echo '<div class="table">';
				echo '<div class="row rows r">' . $row['category_name'] . '</div>';
				echo '<div class="row rows">D</div>';
				echo '</div>';
			}
			?>
<?php } ?>


	</div>
</div>
