<?php 	

include("function.php");
 
 //get application unique id (slug) from URL
$slug = $_SERVER['QUERY_STRING'];
if(empty($slug)){
	include("../menu.php");
		echo '<div class="form">';
			echo "There is no data for this slug !!";
		echo '</div>';
		header( "refresh:3;url=" . $url );
	include("../footer.php");
	exit;
}

//get current application
try {
	
	$stmt = $dbh->prepare("SELECT a.*, c.*
							FROM applications a 
							LEFT JOIN clients c  ON(c.client_id=a.client_id)
							WHERE a.application_slug  = ?");
	$stmt->execute([$slug]);
	$application = $stmt->fetch();
	
	$get_questions = $dbh->prepare("SELECT aq.*, q.*
									FROM application_questions aq 
									LEFT JOIN questions q  ON(q.question_id = aq.question_id)
									WHERE application_id = ? AND solved_value IS NOT NULL");
	$get_questions->execute([$application['application_id']]);
	$questions = $get_questions->fetchAll();
	
}
catch (PDOException $e){
	echo "Select failed: " . $e->getMessage();
	exit();
}
if(!empty($application['responded_at'])){
	include("../menu.php");
		echo '<div class="form">';
			echo '<div class="green msg">This survey has been solved .. </div>'; ?>
		<div class="table">
			<div class="row tblHeader">#</div>
			<div class="row tblHeader r">Question</div>
			<div class="row tblHeader">Question type</div>
			<div class="row tblHeader">Question answers</div>
			<div class="row tblHeader">Client answers</div>
		</div>
		<?php
		$count = 1;
		foreach($questions as $row){
			$question_value = json_decode($row['question_value'], true);
			echo '<div class="table">';
				echo '<div class="row rows">' . $count . '</div>';
				echo '<div class="row rows r">' . $question_value['q'] . '</div>';
				echo '<div class="row rows">' . $row['question_type'] . '</div>';
				if($row['question_type'] == 'TEXT'){
					echo '<div class="row rows">-</div>';
					echo '<div class="row rows">' . $row['solved_value'] . '</div>';
				}else {
					echo '<div class="row rows"><ul>';
					foreach($question_value['choices'] as $row_){
						echo '<li> - ' . $row_ . '</li>';
					}
					echo '</ul></div>';
					echo '<div class="row rows">' . $question_value['choices'][$row['solved_value']] . '</div>';
				}
			echo '</div>';
			$count++;
		}
		echo '</div>';
	include("../footer.php");
	exit;
}




$error = false;
$showQuestionId = 0;

if(isset($_POST['submit'])){
	

	$qid 	= intval($_POST['q_id']);
	$qorder = intval($_POST['q_o']);
	$answer = trim($_POST['answer']);
var_export($qorder);
	if(empty($answer) && $answer !== '0') {
		$error = "Missing answer..";
		$showQuestionId = $qid;
	} else {

		//update solved_value=answer , solved_at=time() in database
		$update_val = $dbh->prepare("UPDATE application_questions SET solved_value = ?, solved_at = ? WHERE application_id = ? AND question_id = ?");
		$update_val->execute([$answer, time(), $application['application_id'], $qid ]);
		
		
		//in case the user jumps to another question using conditions, then skip previous unsolved skipped questions
		$update_skipped = $dbh->prepare("UPDATE application_questions SET solved_at = ? WHERE application_id = ? AND question_order < ? AND solved_at is NULL ORDER BY question_order ASC");
		$update_skipped->execute([time(), $application['application_id'], $qorder ]);
		
		//now we check if the submitted question has conditions and if the answer equal one of them.
		$stmt = $dbh->prepare("SELECT k.question_type
			FROM application_questions q
			LEFT JOIN questions k  ON(k.question_id=q.question_id)
			WHERE q.application_id  = ? AND q.question_id = ?
			LIMIT 1");
		$stmt->execute([$application['application_id'], $qid]);
		$prev_question = $stmt->fetch();
		
		if($prev_question['question_type'] == 'RADIO') {
	
			
			$SQL = $dbh->prepare("SELECT  c.condition_value, c.condition_question_id
							   FROM conditions c
							   WHERE c.question_id = ? AND c.application_id = ?");
			$SQL->execute([$qid, $application['application_id']]);
			//1. if condition value == ans --> we go to condition question
			//2. if not: we just ingore it and where > prev q limit 1
			// $showQuestionId = ;
		
			while ($condition = $SQL->fetch(PDO::FETCH_ASSOC)){
				if($condition['condition_value'] == $answer && intval($condition['condition_question_id']) > 0) {
					$showQuestionId = $condition['condition_question_id'];  //order = 2
				}
			}
		
		}//endif == radio
		
	}// /else empty answer
	
	
	//check if there is unsolved or we just finished
	$scount = $dbh->prepare("SELECT COUNT(*) FROM application_questions WHERE solved_at is NULL AND application_id = ?");
	$scount->execute( [$application['application_id']]);	
	if($scount->fetchColumn() == 0) {
		$update_val = $dbh->prepare("UPDATE applications SET responded_at = ? WHERE application_id = ?");
		$update_val->execute([time(), $application['application_id'] ]);
		header('Location: thankyou.php?'.$slug);
		exit;
	}
}
	//in case of the first question we only get the first question using limit 1
	
	//get current question
	$stmt = $dbh->prepare("SELECT q.*, k.*
		FROM application_questions q
		LEFT JOIN questions k  ON(k.question_id=q.question_id)
		WHERE q.application_id  = ? AND q.solved_at is NULL ".
		($showQuestionId ? " AND q.question_id = ? " : (isset($_POST['submit']) ? " AND q.question_order > ? ORDER BY q.question_order ASC LIMIT 1" : " ORDER BY q.question_order ASC LIMIT 1")) 
		);

	$stmt->execute( 
				array_merge([$application['application_id']], $showQuestionId > 0  ? [$showQuestionId] : (isset($_POST['submit']) ? [$qorder] : []))
	);
	$question = $stmt->fetch(PDO::FETCH_ASSOC);
	if(empty($question)){
		$error = '<div class="red msg">This survey does not have questions yet !</div>';
	}
	
	
	$SQL = $dbh->prepare("SELECT c.question_id, c.condition_value, c.condition_question_id
					   FROM conditions c
					   WHERE c.question_id = ? AND c.application_id = ?");
	$SQL->execute([$question['question_id'],$application['application_id']]);
	$question['conditions'] = $SQL->fetchAll(PDO::FETCH_ASSOC|PDO::FETCH_GROUP)[$question['question_id']] ?? [];
	$question_value = json_decode($question['question_value'], true);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Survey - Client name ( from DB )</title>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<link href="<?=$url?>css/css.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="<?=$url?>js/js.js"></script>
</head>
<body>
	<div class="page">
		<div class="survey header">
			<div class="logo">
				<h1><a href="<?=$url?>"><span class="logo_colour">Survey Builder</span></a></h1>
			</div>
		</div>
		<div class="page_canter">
		
	
<h1><?=$application['application_title']?></h1>

<div class="client_info">
	<h2>Client Information</h2>
	<div class="info"><?= $application['client_name'] ?></div>
	<div class="info"><?= $application['client_phone'] ?></div>
	<div class="info"><?= $application['client_email'] ?></div>
	<div class="info"><?= $application['client_address'] ?></div>
	<div class="info"><?= $application['client_description'] ?></div>
</div>
<div class="justline"></div>

<?php if(! empty($error)):?>
<div class="error"><?=$error;?></div>
<?php else:?>

<div class="form">
	<form method="post">
	<input type="hidden" name="q_id" value="<?=$question['question_id']?>" />
	<input type="hidden" name="q_o" value="<?=$question['question_order']?>" />
	<div class="added_question">
		<div class="qst">
			<h4><?=$question_value['q']?></h4>
		</div>
		<div class="q_choices qst">
		<?php if($question['question_type'] == 'TEXT'):?>
			<div class="cho_start">
				<input type="text" id="answer" name="answer" value="" required>
			</div>
			
		<?php elseif($question['question_type'] == 'RADIO'):?>

		<?php foreach($question_value['choices'] as $index=>$choice): ?>

		<div class="q_choices qst">
			<div class="cho_start">
				<input type="radio" id="choice-<?=$index?>"  name="answer" value="<?=$index?>" required>
				<label for="choice-<?=$index?>"><?=$choice?></label>
			</div>
		</div>
		<?php endforeach;?>


		<?php elseif($question['question_type'] == 'CHECKBOX'):?>
		
		<?php foreach($question_value['choices'] as $index=>$choice): ?>
		<div class="q_choices qst">
			<div class="cho_start">
				<input type="checkbox" id="choice-<?=$index?>" name="answer" value="<?=$choice?>" required />
				<label for="checkbox" for="choice-<?=$index?>"><?=$choice?></label>
			</div>
		</div>
		<?php endforeach;?>
		<?php endif;?>
		</div>
	</div>
	
	<div class="qst rightSubmit">
		<input type="submit" name="submit" value="Next" />
	</div>
	</form>
	
</div>

<?php endif;?>



<?php include("../footer.php"); ?>



	
