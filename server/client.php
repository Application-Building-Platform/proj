<?php include("function.php"); ?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$reqI = isset($_REQUEST['i']) && $_REQUEST['i'] == 'addclient';
$reqV = isset($_REQUEST['i']) && $_REQUEST['i'] == 'viewclient';
$reqY = isset($_REQUEST['y']) && $_REQUEST['y'] == 'edit_client';
?>
<div class="controller">
	<div class="title">
		<h2><?php echo ( $reqI ? 'Add a new client' : 'View clients' ); ?></h2>
	</div>
	<div class="form">
	<div class="message"></div>
<?php if( $reqI || $reqY ){?>

		<form action="action.php?y=<?=($reqY ? 'update_client&id=' .$_REQUEST['id'] : 'add_client')?>" method="post">
			<label for="name">Client Name :</label>
			<input type="text" id="name" name="name" class="qMargin" value="<?php echo ( $reqY ? $TPL['edit_client']['client_name'] : "" ); ?>">

			<label for="email">Client Email :</label>
			<input type="text" id="email" name="email" class="qMargin" value="<?php echo ( $reqY ? $TPL['edit_client']['client_email'] : "" ); ?>">

			<label for="phone">Client Phone :</label>
			<input type="text" id="phone" name="phone" class="qMargin" value="<?php echo ( $reqY ? $TPL['edit_client']['client_phone'] : "" ); ?>"> 
			
			<label for="address">Client Address :</label>
			<input type="text" id="address" name="address" class="qMargin" value="<?php echo ( $reqY ? $TPL['edit_client']['client_address'] : "" ); ?>">
			<!-- Do we need a client category?
			<label for="category">Client Category :</label>
			<input type="text" id="category" name="category" class="qMargin" value="<?php echo ( $reqY ? $TPL['edit_client']['client_category'] : "" ); ?>"> 	
			-->
			<label for="description">Client Description :</label>
			<textarea id="description" rows="4" name="description" class="qMargin"><?php echo ( $reqY ? $TPL['edit_client']['client_description'] : "" ); ?></textarea>

			<div class="qst rightSubmit">
				<input type="submit" value="<?php echo ( $reqY ? 'Update' : 'Add' ); ?>">
			</div>
		</form>

<?php }
if( $reqV ){?>

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
				echo '<div class="row rows"><a href="action.php?y=edit_client&id=' . $row['client_id'] . '" title="Update ' . $row['client_name'] . '"><img src="../images/edit.png" width="20" height="20"></a></div>';
				echo '<div class="row rows"><a class="delete" id="client" data-id="' . $row['client_id'] . '" title="Delete ' . $row['client_name'] . '"><img src="../images/delete.png" width="20" height="20"></a></div>';
				echo '</div>';
			}
			?>
<?php } ?>


	</div>
</div>
