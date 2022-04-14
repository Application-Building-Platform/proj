<?php include("function.php"); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
error_reporting(E_ALL & ~E_NOTICE);

$reqI = isset($_REQUEST['i']) && $_REQUEST['i'] == 'addquestion';
$reqV = isset($_REQUEST['i']) && $_REQUEST['i'] == 'viewquestion';
$reqY = isset($_REQUEST['y']) && $_REQUEST['y'] == 'edit_question';
$arr = json_decode($TPL['edit_question'][2], true);
$get_category  = readOne($dbh, $TPL['edit_question']['category_id'], 'categories', 'category_id');

?>

<div class="controller">
	<div class="title">
		<h2><?php echo ( $reqI ? 'Add a new Question' : 'View Questions'); ?></h2>
	</div>
	<div class="form">
	<div class="message"></div>
		<?php if ( $reqI || $reqY ) { ?>

			<form action="action.php?y=<?=($reqY ? 'update_question&id=' .$_REQUEST['id'] : 'addquestion')?>" method="POST">
				<!-- Start Question Class -->
				<div class="questinInfo">
					
					<!-- Start Question Category -->
					<div class="qst qMargin">
						<label for="qCategory" class="qst lbl">Question Category :</label>
<<<<<<< Updated upstream
						<select name="qCategory" id="qCategory" class="qCategory inputFlex">
						<?php foreach($TPL['categories'] as $row){
							echo '<option value="' . $row['category_name'] . '">' . $row['category_name'] . '</option>';
						}?>
=======
						<select name="qCategory" id="qCategory" class="qCategory inputFlex" required>
							<option disabled selected value> -- select a category -- </option>
							<?php 
							if($reqY){
								echo '<option value="' . $get_category['category_id'] . '" selected="selected">' . $get_category['category_name'] . '</option>';
							}
							foreach($TPL['categories'] as $row){
								if($row['category_id'] != $get_category['category_id']){
									echo '<option value="' . $row['category_id'] . '">' . $row['category_name'] . '</option>';
								}
							}?>	
>>>>>>> Stashed changes
						</select>
					</div>
					<!-- End Question Category -->
						
					<!-- Start Question Form -->
					<div class="question qst">

						<!-- Start Question Number -->
						<div class="qst qMargin">
							<div class="qNum">
								<h2>Question <span class="qi"></span></h2>
							</div>
						</div>
						<!-- End Question Number -->

						<!-- Start Question Text -->
						<div class="qText qst qMargin">
							<label for="qText" class="qst lbl">Question Text</label>
							<input type="text" id="qText" name="qText" class="inputFlex" value="<?php echo ( $reqY ? $arr['q'] : "" ); ?>">
						</div>
						<!-- End Question Text -->
						
						
						<!-- Start Question Type -->
						<div class="qst qMargin">
							<label for="qType" class="qst lbl">Question Type</label>
							<select name="qType" id="qType" class="qType inputFlex">
								<option value="checkBox" <?php if ($reqY && $TPL['edit_question']['question_type'] == "CHECKBOX"){ ?> selected="selected" <?php } ?>>CheckBox</option>
								<option value="shortAnswer" <?php if ($reqY && $TPL['edit_question']['question_type'] == "SHORTANSWER"){ ?> selected="selected" <?php } ?>>Short Answer</option>
								<option value="radio" <?php if ($reqY && $TPL['edit_question']['question_type'] == "RADIO"){ ?> selected="selected" <?php } ?>>Radio</option>
							</select>
						</div>
						<!-- End Question Type -->
						
						<!-- Start Question Choice Div -->
						<div class="choiceSection qst qMargin">
							<?php 
							if($reqI || $reqV || $reqY){
								if($TPL['edit_question']['question_type'] != "SHORTANSWER"){ 
							?>
							
							<!-- Start Question Choices Title -->
							<div class="qChoices qMargin">
								<h4>Choices</h4>
							</div>
							<!-- End Question Choices Title -->
							<?php }} ?>
							<!-- Start Question Choice Buttons -->
							<div class="choiceButtonGroup qst">
								<?php 
									$count = 1;
									if($reqY){
										if($TPL['edit_question']['question_type'] != "SHORTANSWER"){
											for($i = 0; $i < sizeof($arr['choices']); $i++){
												echo '<div class="childChoice qst qMargin" data-branch="' . $count . '".>';
													echo '<label for="qCho1" class="qst lbl">Choice: ' . $count . '</label>';
													echo '<input type="text" id="input1" name="qCho[]" class="inputFlex" value="' . $arr['choices'][$i] . '" />';
													echo '<input class="choiceButtonDelete qst" type="button" value="Delete Choice">';
												echo '</div>';
												$count++;		
											}
										}
									}else { ?>
<<<<<<< Updated upstream
								<div class="childChoice qst qMargin">
=======
								
								<div class="childChoice qst qMargin" data-branch="1">
>>>>>>> Stashed changes
									<label for="qCho1" class="qst lbl">Choice: 1</label>
									<input type="text" id="input1" name="qCho[]" class="inputFlex" />
									<input class="choiceButtonDelete qst" type="button" value="Delete Choice">
								</div>
									<?php } ?>
							</div>
							<!-- End Question Choice Buttons -->
							<?php 
							if($reqI || $reqV || $reqY){
								if($TPL['edit_question']['question_type'] != "SHORTANSWER"){ 
							?>
							<!-- Start Add Choice Button -->
							<div class="addchild qst">
								<input class="AddChoiceButton" type="button" value="Add Choice">
							</div>
							<!-- End Add Choice Button -->
							<?php }} ?>
						</div>
						<!-- End Question Choice Div -->

					</div>
					<!-- End Question Form -->

					<!-- Start New Question Div -->
					<div class="anotherQ"></div>
					<!-- End New Question Div -->

					<!-- Start Save + delete Question Buttons -->
					<div class="qst rightSubmit">
						<input type="submit" value="<?php echo ( $reqY ? 'Update' : 'Add' ); ?>">
					</div>
					<!-- End Save + delete Question Buttons -->

				</div>
				<!-- End Question Class -->

			</form>

		<?php }
		if ($reqV) { ?>
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
					echo '<div class="row rows"><a href="action.php?y=edit_question&id=' . $row['question_id'] . '" title="Update ' . $arr['q'] . '"><img src="../images/edit.png" width="20" height="20"></a></div>';
					echo '<div class="row rows"><a class="delete" id="question" data-id="' . $row['question_id'] . '" title="Delete ' . $arr['q'] . '"><img src="../images/delete.png" width="20" height="20"></a></div>';
					echo '<div class="row rows"><a href="action.php?y=view_question&id=' . $row['question_id'] . '" title="view ' . $arr['q'] . '"><img src="../images/view.png" width="20" height="20"></a></div>';
					echo '</div>';
				}
		} ?>


	</div>
</div>