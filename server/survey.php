<?php include("function.php"); ?>
<div class="controller">
	<div class="title">
		<h2><?php echo ($_REQUEST['i'] == 'addsurvey' ? 'Add a new Survey' : 'View Surveys'); ?></h2>
	</div>
	<div class="form">
		<?php if ($_REQUEST['i'] == 'addsurvey') { ?>

			<form action="action.php?y=addsurvey" method="post">`
				<!-- Start Survey Class -->
				<div class="questinInfo">
					
					<!-- Start Survey Title -->
					<div class="qTitle qst qMargin">
						<label for="qTitle" class="qst lbl">Survey <span class="qi"></span>&nbsp;Title :</label>
						<input type="text" id="qTitle" class="inputFlex" name="qTitle">
					</div>
					<!-- End Survey Title -->
						
					<!-- Start Survey Form -->
					<div class="question qst">

						<!-- Start Survey Number -->
						<div class="qst qMargin">
							<div class="qNum">
								<h2>Question <span class="qi">&nbsp;#</span></h2>
							</div>
						</div>
						<!-- End Survey Number -->

						<!-- Start Survey Type -->
						<div class="qst qMargin">
							<label for="qType" class="qst lbl">Question Type</label>
							<select name="qType" id="qType" class="qType inputFlex">
								<option selected="true" disabled="disabled">Survey Type</option>
								<option value="shortAnswer">Short Answer</option>
								<option value="checkBox" selected="selected">CheckBox</option>
								<option value="radio">Radio</option>
							</select>
						</div>
						<!-- End Survey Type -->

						<!-- Start Survey Text -->
						<div class="qText qst qMargin">
							<label for="qText" class="qst lbl">Question Text</label>
							<input type="text" id="qText" name="qText" class="inputFlex">
						</div>
						<!-- End Survey Text -->

						<!-- Start Survey Choice Div -->
						<div class="choiceSection qst qMargin">

							<!-- Start Survey Choices Title -->
							<div class="qChoices qMargin">
								<h4>Choices</h4>
							</div>
							<!-- End Survey Choices Title -->

							<!-- Start Survey Choice Buttons -->
							<div class="childChoice qst qMargin">
								<label for="qText" class="qst lbl">Choice <span class="i">&nbsp;1</span>:</label>
								<input type="text" id="input" name="qText" class="inputFlex" />
								<input class="choiceButtonDelete qst" type="button" value="Delete Choice">
							</div>
							<!-- End Survey Choice Buttons -->

							<!-- Start Add Another Choice Div -->
							<div class="choiceButtonGroup qst"></div>
							<!-- End Add Another Choice Div -->

							<!-- Start Add Choice Button -->
							<div class="choiceButtonAdd qst">
								<input class="AddChoiceButton" type="button" value="Add Choice">
							</div>
							<!-- End Add Choice Button -->

						</div>
						<!-- End Survey Choice Div -->

						<!-- Start Add New + Delete Survey -->
						<div class="newQButton qst">
							<input type="button" class="addQ" title="Add Question" value="Add Question">
							<input type="button" class="deleteQ" value="Delete Question">
						</div>
						<!-- End Add New + Delete Survey -->

					</div>
					<!-- End Survey Form -->

					<!-- Start New Survey Div -->
					<div class="anotherQ"></div>
					<!-- End New Survey Div -->

					<!-- Start Save + delete Survey Buttons -->
					<div class="qst rightSubmit">
						<input type="button" value="Delete Survey">
						<input type="submit" value="Save">
					</div>
					<!-- End Save + delete Survey Buttons -->

				</div>
				<!-- End Survey Class -->

			</form>

		<?php }
		if ($_REQUEST['i'] == 'viewsurvey') { ?>


		<?php } ?>


	</div>
</div>