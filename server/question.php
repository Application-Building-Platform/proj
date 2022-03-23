<?php include("function.php"); ?>
<div class="controller">
	<div class="title">
		<h2><?php echo ($_REQUEST['i'] == 'addquestion' ? 'Add a new Question' : 'View Questions'); ?></h2>
	</div>
	<div class="form">
		<?php if ($_REQUEST['i'] == 'addquestion') { ?>

			<form action="action.php?y=addquestion" method="post">`
				<!-- Start Question Class -->
				<div class="questinInfo">

					<!-- Start Question Title -->
					<div class="qTitle qst qMargin">
						<label for="qTitle" class="qst lbl">Question <span class="qi"></span>&nbsp;Title :</label>
						<input type="text" id="qTitle" class="inputFlex" name="qTitle">
					</div>
					<!-- End Question Title -->

					<!-- Start Question Form -->
					<div class="question qst">

						<!-- Start Question Number -->
						<div class="qst qMargin">
							<div class="qNum">
								<h2>Question <span class="qi">&nbsp;#</span></h2>
							</div>
						</div>
						<!-- End Question Number -->

						<!-- Start Question Type -->
						<div class="qst qMargin">
							<label for="qType" class="qst lbl">Question Type</label>
							<select name="qType" id="qType" class="qType inputFlex">
								<option selected="true" disabled="disabled">Question Type</option>
								<option value="shortAnswer">Short Answer</option>
								<option value="checkBox" selected="selected">CheckBox</option>
								<option value="radio">Radio</option>
							</select>
						</div>
						<!-- End Question Type -->

						<!-- Start Question Text -->
						<div class="qText qst qMargin">
							<label for="qText" class="qst lbl">Question Text</label>
							<input type="text" id="qText" name="qText" class="inputFlex">
						</div>
						<!-- End Question Text -->

						<!-- Start Question Choice Div -->
						<div class="choiceSection qst qMargin">

							<!-- Start Question Choices Title -->
							<div class="qChoices qMargin">
								<h4>Choices</h4>
							</div>
							<!-- End Question Choices Title -->

							<!-- Start Question Choice Buttons -->
							<div class="childChoice qst qMargin">
								<label for="qText" class="qst lbl">Choice <span class="i">&nbsp;#</span>:</label>
								<input type="text" id="input" name="qText" class="inputFlex" />
								<input class="addBranchQuestion qst" type="button" value="Add branch question">
								<input class="choiceButtonDelete qst" type="button" value="Delete Choice"><i class="fa fa-trash"></i>
							</div>
							<!-- End Question Choice Buttons -->

							<!-- Start Add Another Choice Div -->
							<div class="choiceButtonGroup qst"></div>
							<!-- End Add Another Choice Div -->

							<!-- Start Add Choice Button -->
							<div class="choiceButtonAdd qst">
								<input class="AddChoiceButton" type="button" value="Add Choice">
							</div>
							<!-- End Add Choice Button -->

						</div>
						<!-- End Question Choice Div -->

					</div>
					<!-- End Question Form -->

					<!-- Start New Question Div -->
					<div class="anotherQ"></div>
					<!-- End New Question Div -->

					<!-- Start Save + delete Question Buttons -->
					<div class="qst rightSubmit">
						<input type="button" value="Delete Question">
						<input type="submit" value="Save">
					</div>
					<!-- End Save + delete Question Buttons -->

				</div>
				<!-- End Question Class -->

			</form>

		<?php }
		if ($_REQUEST['i'] == 'viewquestion') { ?>


		<?php } ?>


	</div>
</div>