<?php include("function.php"); ?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$reqI = isset($_REQUEST['i']) && $_REQUEST['i'] == 'addclient';
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
			<input type="text" id="name" name="name" class="qMargin" value="<?php echo ( $reqY ? $TPL['edit_client']['client_name'] : "" ); ?>" required>

			<label for="email">Client Email :</label>
			<input type="text" id="email" name="email" class="qMargin" value="<?php echo ( $reqY ? $TPL['edit_client']['client_email'] : "" ); ?>" required>

			<label for="phone">Client Phone :</label>
			<input type="text" id="phone" name="phone" class="qMargin" value="<?php echo ( $reqY ? $TPL['edit_client']['client_phone'] : "" ); ?>" required> 
			
			<label for="address">Client Address :</label>
			<input type="text" id="address" name="address" class="qMargin" value="<?php echo ( $reqY ? $TPL['edit_client']['client_address'] : "" ); ?>" required>

			<label for="description">Client Description :</label>
			<textarea id="description" rows="4" name="description" class="qMargin"><?php echo ( $reqY ? $TPL['edit_client']['client_description'] : "" ); ?></textarea>

			<div class="qst rightSubmit">
				<input type="submit" value="<?php echo ( $reqY ? 'Update' : 'Add' ); ?>">
			</div>
		</form>

<?php } ?>


	</div>
</div>
