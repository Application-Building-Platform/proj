<<<<<<< Updated upstream
<?php include("function.php"); ?>
=======
<?php include("function.php"); 
	
	
$reqI 		   = isset($_REQUEST['i']) && $_REQUEST['i'] == 'addapplication';
$reqY 		   = isset($_REQUEST['y']) && $_REQUEST['y'] == 'edit_application';
$get_client    = readOne($dbh, $TPL['edit_application']['client_id'], 'clients', 'client_id');
$get_category  = readOne($dbh, $TPL['edit_application']['category_id'], 'categories', 'category_id');
if($reqY){
	$get_questions = get_all_questions($dbh, $TPL['edit_application']['application_id']);
}
$slug_rul = $url . 'server/survey.php?' . $TPL['edit_application']['application_slug'];
?>
>>>>>>> Stashed changes
<div class="controller">
	<div class="title">
		<h2><?php echo ($_REQUEST['i'] == 'addapplication' ? 'Add a new Application' : 'View Application'); ?></h2>
	</div>
	<div class="form">
<<<<<<< Updated upstream
		<?php if ($_REQUEST['i'] == 'addapplication') { ?>

			<div class="application">
			
			
			<form action="action.php?y=addapplication" method="post">
				<!-- Start Question Class -->
=======
		<div class="application">
			<form action="action.php?y=<?=($reqY ? 'update_application&id=' .$_REQUEST['id'] : 'addapplication')?>" method="post">
				<!-- Start Application Class -->
>>>>>>> Stashed changes
				<div class="questinInfo">
					<!-- Start Application slug -->
					<div class="a_title qst qMargin">
						<label for="a_title" class="qst lbl">Application Link : </label>
						<div class="inputFlex">
							<?php if($reqI){ ?>
								<p>The link will be generated once the application has been created</p>
							<?php }else { ?>
								<a target="_tab" href="<?=$slug_rul?>"><?=$slug_rul?></a>
							<?php } ?>
						</div>
					</div>
					<!-- End Application slug -->
					
<<<<<<< Updated upstream
					<!-- Start Question Title -->
					<div class="qst qMargin">
						<label for="cName" class="qst lbl">Client Name :</label>
						<select name="cName" id="cName" class="cName inputFlex">
						<option disabled selected value> -- select a client -- </option>
						<?php foreach($TPL['clients'] as $row){
							echo '<option value="' . $row['client_name'] . '">' . $row['client_name'] . '</option>';
=======
					<!-- Start Application Text -->
					<div class="a_title qst qMargin">
						<label for="a_title" class="qst lbl">Application Title : </label>
						<input type="text" id="a_title" name="a_title" required class="inputFlex" value="<?php echo ( $reqY ? $TPL['edit_application']['application_title'] : "" ); ?>" required>
					</div>
					<!-- End Application Text -->

					<!-- Start Application Title -->
					<div class="qst qMargin">
						<label for="qClient" class="qst lbl">Client Name :</label>
						<select name="qClient" id="qClient" class="cName inputFlex" required>
						<option disabled selected value> -- select a client -- </option>
						<?php 
						if($reqY){
							echo '<option value="' . $get_client['client_id'] . '" selected="selected">' . $get_client['client_name'] . '</option>';
						}
						foreach($TPL['clients'] as $row){
							if($row['client_id'] != $get_client['client_id']){
								echo '<option value="' . $row['client_id'] . '">' . $row['client_name'] . '</option>';
							}
>>>>>>> Stashed changes
						}?>
						</select>
					</div>
					<!-- End Application Title -->
					
					
					<!-- Start Application Category -->
					<div class="qst qMargin">
<<<<<<< Updated upstream
						<label for="qCategory" class="qst lbl">Question Category :</label>
						<select name="qCategory" id="qCategory" class="qCategory inputFlex">
						<?php foreach($TPL['categories'] as $row){
							echo '<option value="' . $row['category_name'] . '">' . $row['category_name'] . '</option>';
						}?>
=======
						<label for="qCategory" class="qst lbl">Application Category :</label>
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
					
					<!-- Line -->
					<div class="justline"></div>
					<!-- End Line -->
					
<<<<<<< Updated upstream
					
					
					
					
					
					
						
					<!-- Start Question Form -->
					<div class="question qst">

						<!-- Start Question Number -->
						<div class="qst qMargin">
							<div class="qNum">
								<h2>Question <span class="qi">1</span></h2>
							</div>
						</div>
						<!-- End Question Number -->

						<!-- Start Question Text -->
						<div class="qst qMargin">
							<label for="qSelect" class="qst lbl">Pick a Question</label>
							<select name="qSelect" id="qSelect" class="qSelect inputFlex">
								<option disabled selected value> -- select a question -- </option>
								<?php foreach($TPL['questions'] as $key => $row){
									$arr = json_decode($TPL['questions'][$key]['question_value'], true);
									echo '<option id="dd" data-id="' . $row['question_id'] . '" value="' . $arr['q'] . '">' . $arr['q'] . '</option>';
								}?>
							</select>
						</div>
						<!-- End Question Text -->
						
						
						<div class="showAfter">
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
												echo '<div class="childChoice qst qMargin">';
													echo '<label for="qCho1" class="qst lbl">Choice: ' . $count . '</label>';
													echo '<input type="text" id="input1" name="qCho[]" class="inputFlex" value="' . $arr['choices'][$i] . '" />';
													echo '<input class="choiceButtonDelete qst" type="button" value="Delete Choice">';
												echo '</div>';
												$count++;		
											}
										}
									}else { ?>
								<div class="childChoice qst qMargin">
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
=======
					<!-- Start Question Form -->
					<div id="add_question_form">
						<div class="addchild buttonbg qst">
							<input class="addNewQ" type="button" value="+ Add a question">
						</div>
						<div class="question qst" style="display:none" id="pick_question_form">
							<div class="qst qMargin">
								<div class="qNum">
									<h2>Choose a Question</h2>
								</div>
							</div>
							<div class="qst qMargin">
								<label for="qSelect" class="qst lbl">Pick a Question</label>
								<select id="qSelect" class="qSelect inputFlex">
									<option disabled selected value> -- select a question -- </option>
									<?php foreach($TPL['questions'] as $key => $row){
									
										$arr = json_decode($TPL['questions'][$key]['question_value'], true);
										
										echo '<option  data-choices="' . htmlspecialchars(json_encode($arr['choices'], ENT_QUOTES)) . '" data-type="' . $arr['q_type'] . '" data-id="' . $row['question_id'] . '" value="' . $row['question_id'] . '">' . $arr['q'] . ' (' . $arr['q_type'] . ')</option>';
										
									}?>
								</select>
							</div>
>>>>>>> Stashed changes
							<div class="addchild qst">
								<input class="AddChoiceButton" type="button" value="Add Choice">
							</div>
<<<<<<< Updated upstream
							<!-- End Add Choice Button -->
							<?php }} ?>
=======
>>>>>>> Stashed changes
						</div>
						<!-- End Question Choice Div -->
						
						
						
						</div>

					</div>
					<!-- End question Form -->

<<<<<<< Updated upstream
					<!-- Start New Question Div -->
					<div class="anotherQ"></div>
					<!-- End New Question Div -->

					<!-- Start Save + delete Question Buttons -->
					<div class="qst rightSubmit">
						<input type="submit" value="<?php echo ( $reqY ? 'Update' : 'Add' ); ?>">
					</div>
					<!-- End Save + delete Question Buttons -->

					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					<!-- Start Question Text -->
						<div class="qst qMargin">
							<label for="qSelect" class="qst lbl">Pick a Question</label>
							<select name="qSelect" id="qSelect" class="qSelect inputFlex">
								<option disabled selected value> -- select a question -- </option>
								<?php foreach($TPL['questions'] as $key => $row){
									$arr = json_decode($TPL['questions'][$key]['question_value'], true);
									echo '<option value="' . $arr['q'] . '">' . $arr['q'] . '</option>';
								}?>
							</select>
						</div>
					<!-- End Question Text -->
				
					<div class="addchild buttonbg qst">
						<input class="addNewQ" type="button" value="+ Add this question">
					</div>
				
				
				
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					<div class="questionsGroup"></div>
					
					
					
					
					
					
					
					<!-- End Question Title -->
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>

					<!-- Start Save + delete Question Buttons -->
					<div class="qst rightSubmit">
						<input type="button" value="Delete Application">
						<input type="submit" value="Save">
=======
					<div id="questions"></div>
					<?php } ?>
					<!-- Start Save + delete Application Buttons -->
					<div class="qst rightSubmit">
						<input type="button" id="cancel_a" value="Cancel">
						<?php if ( $reqI ) { ?>
						
						<input type="submit" name="save_a" value="SAVE AND CONTINUE TO ADD QUESTIONS">
					
						<?php } else {?>
						<input type="submit" name="save_a" value="UPDATE">	
						<?php } ?>
>>>>>>> Stashed changes
					</div>
					<!-- End Save + delete Application Buttons -->
				</div>
				<!-- End Application Class -->
			</form>
<<<<<<< Updated upstream
			
			
			</div>
		<?php }
		if ($_REQUEST['i'] == 'viewquestion') { ?>


		<?php } ?>


=======
		</div>
>>>>>>> Stashed changes
	</div>
</div>
<?php if($reqY): ?>
<script>
	 $(document).ready(function(){
		<?php foreach($get_questions as $question):?>
			<?php $question_value = json_decode($question['question_value'], true); ?>

				addQuestion(<?=$question['question_id']?>, '<?=$question_value['q']?>', <?=json_encode($question_value['choices']  ?? '[]')?>, '<?=$question_value['q_type']?>');
				
		<?php endforeach; ?>
		<?php foreach($get_questions as $question):?>
			<?php foreach($question['conditions'] as $condition):?>
				
				selectCondition(<?=$question['question_id']?>, <?=$condition['condition_value']?>, <?=$condition['condition_question_id']?>);
				
			<?php endforeach; ?>
		<?php endforeach; ?>
 
	});
</script>

<?php endif; ?>