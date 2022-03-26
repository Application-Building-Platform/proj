<?php include("function.php"); ?>
<div class="controller">
	<div class="title">
		<h2><?php echo ($_REQUEST['i'] == 'addapplication' ? 'Add a new Application' : 'View Application'); ?></h2>
	</div>
	<div class="form">
		<?php if ($_REQUEST['i'] == 'addapplication') { ?>

			<div class="application">
			
			
			<form action="action.php?y=addapplication" method="post">
				<!-- Start Question Class -->
				<div class="questinInfo">
					
					<!-- Start Question Title -->
					<div class="qst qMargin">
						<label for="cName" class="qst lbl">Client Name :</label>
						<select name="cName" id="cName" class="cName inputFlex">
						<option disabled selected value> -- select a client -- </option>
						<?php foreach($TPL['clients'] as $row){
							echo '<option value="' . $row['client_name'] . '">' . $row['client_name'] . '</option>';
						}?>
						</select>
					</div>
					<!-- End Question Title -->
					
					
					<!-- Start Question Category -->
					<div class="qst qMargin">
						<label for="qCategory" class="qst lbl">Question Category :</label>
						<select name="qCategory" id="qCategory" class="qCategory inputFlex">
						<?php foreach($TPL['categories'] as $row){
							echo '<option value="' . $row['category_name'] . '">' . $row['category_name'] . '</option>';
						}?>
						</select>
					</div>
					<!-- End Question Category -->
					
					<!-- Line -->
					<div class="justline"></div>
					<!-- End Line -->
					
					
					
					
					
					
					
						
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
							<div class="addchild qst">
								<input class="AddChoiceButton" type="button" value="Add Choice">
							</div>
							<!-- End Add Choice Button -->
							<?php }} ?>
						</div>
						<!-- End Question Choice Div -->
						
						
						
						</div>

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
					</div>
					<!-- End Save + delete Question Buttons -->

				</div>
				<!-- End Question Class -->

			</form>
			
			
			</div>
		<?php }
		if ($_REQUEST['i'] == 'viewquestion') { ?>


		<?php } ?>


	</div>
</div>