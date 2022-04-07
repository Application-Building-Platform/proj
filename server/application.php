<?php include("function.php"); 
	
	
$reqI 		   = isset($_REQUEST['i']) && $_REQUEST['i'] == 'addapplication';
$reqY 		   = isset($_REQUEST['y']) && $_REQUEST['y'] == 'edit_application';
$get_client    = readOne($dbh, $TPL['edit_application']['client_id'], 'clients', 'client_id');
$get_category  = readOne($dbh, $TPL['edit_application']['category_id'], 'categories', 'category_id');
// $get_questions = readOne($dbh, $TPL['edit_application']['application_id'], 'conditions', 'application_id');
// if($reqY){
	// $get_questions = get_all_questions($dbh, $TPL['edit_application']['application_id']);
// }

?>
<div class="controller">
	<div class="title">
		<h2><?php echo ( $reqI ? 'Add a new Application' : 'Edit Application : ' .$_REQUEST['id'] ); ?></h2>
	</div>
	<div class="form">
		

			<div class="application">
			
			<form action="action.php?y=<?=($reqY ? 'update_application&id=' .$_REQUEST['id'] : 'addapplication')?>" method="post">
			
				<!-- Start Question Class -->
				<div class="questinInfo">
					
					<!-- Start Question Text -->
					<div class="a_title qst qMargin">
						<label for="a_title" class="qst lbl">Application Title</label>
						<input type="text" id="a_title" name="a_title" class="inputFlex" value="<?php echo ( $reqY ? $TPL['edit_application']['application_title'] : "" ); ?>" required>
					</div>
					<!-- End Question Text -->

					<!-- Start Question Title -->
					<div class="qst qMargin">
						<label for="qClient" class="qst lbl">Client Name :</label>
						<select name="qClient" id="qClient" class="cName inputFlex">
						<option disabled selected value> -- select a client -- </option>
						<?php 
						if($reqY){
								echo '<option value="' . $get_client['client_id'] . '" selected="selected">' . $get_client['client_name'] . '</option>';
						}
						foreach($TPL['clients'] as $row){
							if($row['client_id'] != $get_client['client_id']){
								echo '<option value="' . $row['client_id'] . '">' . $row['client_name'] . '</option>';
							}
						}?>
						</select>
					</div>
					<!-- End Question Title -->
					
					
					<!-- Start Question Category -->
					<div class="qst qMargin">
						<label for="qCategory" class="qst lbl">Question Category :</label>
						<select name="qCategory" id="qCategory" class="qCategory inputFlex">
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
						</select>
					</div>
					<!-- End Question Category -->
					<?php if ( $reqY ) { ?>
					<!-- Line -->
					<div class="justline"></div>
					<!-- End Line -->
					
					<!-- Start Question Form -->
					<div id="add_question_form">
					
						<div class="addchild buttonbg qst">
							<input class="addNewQ" type="button" value="+ Add a question">
						</div>
				
						<div class="question qst" style="display:none" id="pick_question_form">

							<!-- Start Question Number -->
							<div class="qst qMargin">
								<div class="qNum">
									<h2>Choose a Question</h2>
								</div>
							</div>
							<!-- End Question Number -->

							<!-- Start Question Text -->
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
							<!-- End Question Text -->
						
							<div class="addchild qst">
								<input id="save_question" type="button" value="ADD">
							</div>
							
						</div>
					</div>
					<!-- End Question Form -->

					<div id="questions">
						<?php
							// for($i = 0; $i < sizeof($arr['choices']); $i++){
								// echo '<div class="childChoice qst qMargin">';
								// echo '<label for="qCho1" class="qst lbl">Choice: ' . $count . '</label>';
								// echo '<input type="text" id="input1" name="qCho[]" class="inputFlex" value="' . $arr['choices'][$i] . '" />';
								// echo '<input class="choiceButtonDelete qst" type="button" value="Delete Choice">';
								// echo '</div>';		
							// }
							
							if($reqY){
								// print_r($get_questions);
								// echo sizeof($get_questions[0]['question_id']);
								// foreach($get_questions[0] as $key => $row){
									// echo $row . '<br>';
								// }
							}
						?>
					</div>
					
					
					<?php } ?>
					
					
					<!-- Start Save + delete Question Buttons -->
					<div class="qst rightSubmit">
						<input type="button" id="cancel_a" value="Cancel">
						<?php if ( $reqI ) { ?>
						
						<input type="submit" name="save_a" value="SAVE AND CONTINUE TO ADD QUESTION">
					
						<?php } else {?>
						<input type="submit" name="save_a" value="UPDATE">	
						<?php } ?>

						
					</div>
					<!-- End Save + delete Question Buttons -->

				</div>
				<!-- End Question Class -->

			</form>

			</div>
		
	</div>
</div>