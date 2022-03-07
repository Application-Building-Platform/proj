<?php include("function.php"); ?>
<div class="controller">
	<div class="title">
		<h2><?php echo ($_REQUEST['i'] == 'addcategory' ? 'Add a new category' : 'View categories'); ?></h2>
	</div>
	<div class="form">
<?php if($_REQUEST['i'] == 'addcategory'){?>
		
		<form action="action.php?y=add_category" method="post">
			<div class="gTitle qst qMargin">
				<label for="name" class="qst lbl">Category Name :</label>
				<input type="text" id="name" name="name" class="inputFlex">
			</div>
			<div class="qst rightSubmit">
				<input type="submit" value="ADD">
			</div>
		</form>

<?php }
if($_REQUEST['i'] == 'viewcategory'){?>

		<div class="table">
			<div class="row tblHeader r">Category Name</div>
			<div class="row tblHeader">Delete</div>
		</div>
			<?php
			$TPL['results'] = get_all_data($dbh, 'categories');
			foreach($TPL['results'] as $row){
				echo '<div class="table">';
				echo '<div class="row rows r">' . $row['category_name'] . '</div>';
				echo '<div class="row rows"><a href="action.php?y=del_category&id=' . $row['category_id'] . '" title="Delete' . $row['category_name'] . '">D</a></div>';
				echo '</div>';
			}
			?>
<?php } ?>


	</div>
</div>
