	let qNum = 1;
	let cNum = 1;
$(document).ready(function() {
	let i = $('.i');
	i.text(1);
	$('.showAfter').hide();
	
	$('#qType').on('change', function() {
		console.log("e.value : " + this.value);
		if(this.value == 'shortAnswer'){
			$('.choiceSection').hide();
		}else{
			$('.choiceSection').show();
		}
	});
	
<<<<<<< Updated upstream
	$('.application #qSelect').on('change', function() {
		// $(".qSelect").each( function () {
			// let y = $(this).val( $(this).attr("data-id") );
			// console.log(y);
		// });
		// $('.qSelect').find('.qTitle').each(function( i, obj ){
		// ids = $("#dd").attr("data-id");
		// u = this;
		// console.log("e.value : " + this);
		// console.log($(this).attr("data-id"));
		
		// console.log("e.value : " + $("#dd")this.attr("data-id"));
		// if(this.value == 'shortAnswer'){
			// $('.choiceSection').hide();
		// }else{
			// $('.choiceSection').show();
		// }
=======
	$('.showQuestion').hide();
	var $elements = $('.show_q, .showQuestion');
	$('.show_q').on('click', function(){
		if ($elements.eq($elements.index(this) + 1).css('display') == 'none' ){
			$elements.eq($elements.index(this) + 1).show("slow").delay(1000);
		}else {
			$elements.eq($elements.index(this) + 1).hide("slow").delay(1000);
		}
>>>>>>> Stashed changes
	});

	$(".message").hide();
	$( ".delete" ).each(function(index) {
		$(this).on("click", function(){
			if(confirm('Are you sure you want to delete this?')){
				let id = $(this).attr('data-id'); 
				let type = this.id;
				let url = "../server/action.php?y=del_" + type + "&id=" + id;
				$.get(url, function() {
					$(".message")
						.addClass("red")
						.append("The " + type + " id : " + id + " has been deleted")
						.show("slow")
						.delay(1000)
						.hide("slow")
						.queue(function() {
						location.reload();
						$(this).hide("slow");
					});
				})				
			}
		});
	});		
	
	$('.AddChoiceButton').on('click', function(){
		cNum++;
		$('.choiceButtonGroup').append(
		'<div class="childChoice qst qMargin" data-branch="' + cNum + '">' + 
		'<label for="qCho' + cNum + '" class="qst lbl">Choice <span class="i"></span>: ' + cNum + '</label>' +
		'<input type="text" id="input' + cNum + '" name="qCho[]" class="inputFlex" />' +
		'<input class="choiceButtonDelete qst" type="button" value="Delete Choice"></div>');
	
	});
	
<<<<<<< Updated upstream
	$('.choiceButtonDelete').bind('click', function(){
		console.log("Fff")

		$('div.question' + qNum).find('div.childChoice').each(function(i, obj){
			console.log("obj " + obj + " - " + i);
			$(obj).slice(i).remove();
		});
	
=======
	$(document).on("click",".choiceButtonDelete" ,function(){
		$('div[data-branch=' +  $(this).closest('.childChoice').data('branch') + ' ]').remove();
	});
	$('.nav-tab').click(function(e) {
	  $(this).addClass('nav-tab-active').siblings().removeClass('nav-tab-active');

	  $($(this).attr('href')).addClass('active').siblings().removeClass('active');
	});

	$(".addNewQ").on('click', function(){
		$("#pick_question_form").show();
	});

	$('#save_question').on('click', function(){
		let question_title = $('#qSelect').find(":selected").text();
		let question_id    = $('#qSelect').val();
		let question_choices = jQuery.parseJSON($('#qSelect').find(":selected").attr('data-choices')); 
		let question_type    = $('#qSelect').find(":selected").attr('data-type'); 
		
		if(question_id != null){
			if( !$('div[data-question=' + question_id + ']').length){
			
				addQuestion(question_id, question_title, question_choices, question_type);

			}else {
				alert("you can't choose the same question twice!");
			}
		}else {
			alert("Please select a question");
		}
		
	});
	
	$('#cancel_a').on('click', function(){

		$(location).prop('href', '/proj/');
		
	});
	
	$('#delete_a').on('click', function(){
		if(confirm('Are you sure?')){
		
			$(location).prop('href', '/');
		}
		
	});
	
	
	$(document).on("click", '.order_up', function(){
	console.log('up');
		let data_order = parseInt($(this).attr('data-order')); 
	console.log(data_order);
		
		sortOrder('up', data_order);
		
>>>>>>> Stashed changes
	});
	///var textValues = $('.question').map((i, el) => console.log("i : " + i + " el : " + el)).get();

<<<<<<< Updated upstream
=======
	$(document).on("click",'.order_down', function(){
		console.log('down');
		let data_order = parseInt($(this).attr('data-order')); 
		console.log(data_order);
		sortOrder('down', data_order);
		
	});
	
>>>>>>> Stashed changes
}); 
function addQuestion(question_id, question_title, question_choices, question_type){
		let conditions       = '<select name="conditions[' + question_id + '][xxx]" data-question="' + question_id + '" class="select_condition qSelect"><option value="0">Go to next</option>';
		let question_info    =  '';
		$('.added_question').each(function(i){
			conditions += '<option value="' + $(this).attr('data-question') + '">Go to: ' + $(this).find('h4').text() + '</option>';
		});
		conditions += '</select>';
		for(let i = 0; i < question_choices.length; i++ ){
			if(question_type == 'radio'){
				question_info += '<div class="q_choices qst"><div class="cho_start">'
								+ '<input disabled type="radio" id="radio" name="' + question_id + '" value="' + question_choices[i] + '" />'
								+ '<label for="radio" name="' + question_id + '">' + question_choices[i] + '</label></div>'
								+ '<div class="cho_end">' + conditions.replace('xxx', i) + '</div></div>';
			}else{
				question_info += '<div class="q_choices qst"><div class="cho_start">'
								+ '<input disabled type="' + question_type + '" name="' + question_id + '" value="' + question_choices[i] + '" />'
								+ '<label for="' + question_type + '" name="' + question_id + '">' + question_choices[i] + '</label></div></div>';
			}
		}
		
		let order_html = '<div class="updown b_end"><input type="hidden" class="input_order" style="width:20px;" name="order['+question_id+']" value="'+qNum+'" />' +
			'<img src="../images/outline_arrow_upward_black_24dp.png" class="order_up" data-order="'+qNum+'" />' +
			'<img src="../images/outline_arrow_downward_black_24dp.png" class="order_down" data-order="'+qNum+'" />' +
			'</div>' + 
			'<div class="delete_Button b_end"><input type="button" class="delete_bracnh" value="delete" /></div>'
		;
			
		$('#questions').append('<div class="added_question" data-order="'+qNum+'" data-question="'
								+ question_id + '"><div class="qst_order"><div class="a_q_title"><h4>' + question_title + '</h4></div>'+order_html+'</div><div class="que_cho">' + question_info + '</div>'
								+ '<input type="hidden" name="questions[]" value="' 
								+ question_id + '" /></div>');	

		$('.select_condition').each(function(i){
			let q_id = $(this).attr('data-question');
			if(q_id != question_id){
				$(this).append('<option value="' + question_id + '">Go to: ' + question_title + '</option>');
			}
		});

		qNum++;
		hideUnneedOrder();
	}
	
	function selectCondition(question_id, selected_index, selected_question_id){
		$('select[name="conditions['+ question_id +'][' + selected_index + ']"] option[value="' + selected_question_id + '"]').attr('selected', true);
		
	}
	$(document).on("click",".delete_bracnh",function(){
		if(confirm('Are you sure?')){
		
			$('div[data-question=' +  $(this).closest('.added_question').data('question') + ' ]').remove();
		} 
	});
	function hideUnneedOrder() {
		$('.order_up, .order_down').css('display', '');
		$('.order_up[data-order=1]').css('display', 'none');
		$('.order_down[data-order='+(qNum -1)+']').css('display', 'none');
	}

	function sortOrder(type, current_number) {
		//is first or last ?

		if(current_number +1 == qNum && type == 'down') { //last
			return;
		} else if(current_number == 1 && type == 'up') { //first
			return;
		}

		let changed_q_element =  $('.added_question[data-order='+(type == 'up' ? current_number-1 : current_number+1)+']');
		let current_q_element = $('.added_question[data-order='+current_number+']');
		
		let changed_element_order = type == 'up' ? (current_number-1)+1 : (current_number + 1)-1;
		let current_element_order = type == 'up' ? current_number-1 : current_number+1;
		
		if(type == 'up') {
			current_q_element.insertBefore(changed_q_element);
		} else {
			current_q_element.insertAfter(changed_q_element);
		}
		
		current_q_element.attr('data-order', current_element_order);
		changed_q_element.attr('data-order', changed_element_order);
		current_q_element.find('img').attr('data-order', current_element_order);
		changed_q_element.find('img').attr('data-order', changed_element_order);
		current_q_element.find('.input_order').attr('value', current_element_order);
		changed_q_element.find('.input_order').attr('value', changed_element_order);
	
		hideUnneedOrder();
	}