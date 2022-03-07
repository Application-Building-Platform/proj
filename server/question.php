<?php include("function.php"); ?>
<div class="controller">
	<div class="title">
		<h2><?php echo ($_REQUEST['i'] == 'addquestion' ? 'Add a new question' : 'View questions'); ?></h2>
	</div>
	<div class="form">
<?php if($_REQUEST['i'] == 'addquestion'){?>

		<form action="action.php?y=add_question" method="post">
			<!-- Start Question Class -->
			<div class="questinInfo">
			
				<!-- Start Question Form -->
				<div class="question qst">
					
					<!-- Start Question Title -->
					<div class="qTitle qst qMargin">
						<label for="qTitle" class="qst lbl">Question <span class="qi"></span>Title :</label>
						<input type="text" id="qTitle" class="inputFlex" name="qTitle">
					</div>
					<!-- End Question Title -->
					
					<!-- Start Question Number -->
					<div class="qst qMargin">
						<div class="qNum"><h2>Question <span class="qi"></span></h2></div>
					</div>
					<!-- End Question Number -->
					
					<!-- Start Question Type -->
					<div class="qst qMargin">
						<label for="qType" class="qst lbl">Question type</label>
						<select name="qType" id="qType" class="qType inputFlex">
							  <option selected="true" disabled="disabled">Question type</option>
							  <option value="shortAnswer">Short Answer</option>
							  <option value="checkBox" selected="selected">CheckBox</option>
							  <option value="radio">Radio</option>
						</select>
					</div>
					<!-- End Question Type -->
					
					<!-- Start Question Text -->
					<div class="qText qst qMargin">
						<label for="qText" class="qst lbl">Question text</label>
						<input type="text" id="qText" name="qText" class="inputFlex">
					</div>
					<!-- End Question Text -->
					
					<!-- Start Question Choice Div -->
					<div class="choiceSection qst qMargin">
					
						<!-- Start Question Choices Title -->
						<div class="qChoices qMargin"><h4>Choices</h4></div>
						<!-- End Question Choices Title -->
						
						<!-- Start Question Choice Buttons -->
						<div class="childChoice qst qMargin">
								<label for="qText" class="qst lbl">Choice <span class="i">1</span>:</label>
								<input type="text" id="input" name="qText" class="inputFlex"/>
								<input class="choiceButtonDelete qst" type="button" value="Delete choice">
						</div>
						<!-- End Question Choice Buttons -->
						
						<!-- Start Add Another Choice Div -->
						<div class="choiceButtonGroup qst"></div>
						<!-- End Add Another Choice Div -->
						
						<!-- Start Add Choice Button -->
						<div class="choiceButtonAdd qst">
							<input class="AddChoiceButton" type="button" value="Add choice">
						</div>
						<!-- End Add Choice Button -->
						
					</div>
					<!-- End Question Choice Div -->
					
					<!-- Start Add New + Delete Question -->
					<div class="newQButton qst">
						<input type="button" class="addQ" title="Add a question" value="Add Question">
						<input type="button" class="deleteQ" value="Delete Question">
					</div>
					<!-- End Add New + Delete Question -->
					
				</div>
				<!-- End Question Form -->
				
				<!-- Start New Question Div -->
				<div class="anotherQ"></div>
				<!-- End New Question Div -->
				
				<!-- Start Save + delete Survey Buttons -->
				<div class="qst rightSubmit">
					<input type="button" value="Delete Survey">
					<input type="submit" value="Save">
				</div>
				<!-- End Save + delete Survey Buttons -->
				
			</div>
			<!-- End Question Class -->
			
		</form>

<?php }
if($_REQUEST['i'] == 'viewquestion'){?>

		<div class="table">
			<div class="row tblHeader r">Client Name</div>
			<div class="row tblHeader r">Client Email</div>
			<div class="row tblHeader">Update</div>
			<div class="row tblHeader">Delete</div>
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
