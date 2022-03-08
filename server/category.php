<?php include("function.php"); ?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$reqI = isset($_REQUEST['i']) && $_REQUEST['i'] == 'addcategory';
$reqV = isset($_REQUEST['i']) && $_REQUEST['i'] == 'viewcategory';
$reqY = isset($_REQUEST['y']) && $_REQUEST['y'] == 'edit_category';
?>



<div class="controller">
	<div class="title">
		<h2><?php echo ( $reqI ? 'Add a new category' : 'View categories'); ?></h2>
	</div>
	<div class="form">
<?php if( $reqI || $reqY ){?>
		
		<form action="action.php?y=<?=($reqY ? 'update_category&id=' .$_REQUEST['id'] : 'add_category')?>" method="post">
			<div class="gTitle qst qMargin">
				<label for="name" class="qst lbl">Category Name :</label>
				<input type="text" id="name" name="name" class="inputFlex" value="<?php echo ( $reqY ? $TPL['edit_category']['category_name'] : "" ); ?>">
			</div>
			<div class="qst rightSubmit">
				<input type="submit" value="<?php echo ( $reqY ? 'Update' : 'Add' ); ?>">
			</div>
		</form>

<?php }
if( $reqV ){?>

		<div class="table">
			<div class="row tblHeader r">Category Name</div>
			<div class="row tblHeader">Update</div>
			<div class="row tblHeader">Delete</div>
		</div>
			<?php
			foreach($TPL['categories'] as $row){
				echo '<div class="table">';
				echo '<div class="row rows r">' . $row['category_name'] . '</div>';
				echo '<div class="row rows"><a href="action.php?y=edit_category&id=' . $row['category_id'] . '" title="Update' . $row['category_name'] . '">U</a></div>';
				echo '<div class="row rows"><a href="action.php?y=del_category&id=' . $row['category_id'] . '" title="Delete' . $row['category_name'] . '">D</a></div>';
				echo '</div>';
			}
			?>
<?php } ?>


	</div>
</div>
