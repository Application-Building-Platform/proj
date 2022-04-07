window.addEventListener("load", function() {
	let i = $('.i');
	let qNum = 1;
	let cNum = 1;
	// let id;
	// let u;
	
	
	i.text(1);
	$('.showAfter').hide();
	
	$('#qType').on('change', function() {
		console.log("e.value : " + this.value);
		if(this.value == 'TEXT'){
			$('.choiceSection').hide();
		}else{
			$('.choiceSection').show();
		}
	});
	
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
		// if(this.value == 'text'){
			// $('.choiceSection').hide();
		// }else{
			// $('.choiceSection').show();
		// }
	});
	
	
	// $('.qi').text(qNum);
	// $('.qTitle').replaceWith($( ".qTitled" ));
	// $( ".qTitle" ).addClass(function( index ) {
	  // return "item-" + index;
	// });
	// $('.questinInfo').find('.qTitle').each(function( i, obj ){
		// $(obj).addClass(function(){
		  // return "item-" + (qNum);
		// });
		// qNum++;
		// console.log(qNum);
		
	// });
	delete_row();
	function delete_row(){
		$(".message").hide();
		$( ".delete" ).each(function(index) {
			$(this).on("click", function(){
				let id = $(this).attr('data-id'); 
				let type = this.id;
				let url = "server/action.php?y=del_" + type + "&id=" + id;
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

			});
		});		
	}


		
	$('.AddChoiceButton').on('click', function(){
		cNum++;
		$('.choiceButtonGroup').append(
		'<div class="childChoice qst qMargin childChoice' + cNum + '">' + 
		'<label for="qCho' + cNum + '" class="qst lbl">Choice <span class="i"></span>: ' + cNum + '</label>' +
		'<input type="text" id="input' + cNum + '" name="qCho[]" class="inputFlex" />' +
		'<input class="choiceButtonDelete qst" type="button" value="Delete Choice"></div>');
	
	
		// $(".choiceButtonGroup").html($('.childChoice').clone());

		// $('div.question').find('div.childChoice').each(function(i, obj){
			// $(obj).find('.i').text(i + 1);
		// });
		
	
	});
	 
	$('.newQButton').on('click', function(){
		$(".anotherQ").html($('.question').clone());

		// $('div.questinInfo').find('div.question').each(function(i, obj){
			// $(obj).find('.qi').text(i + 1);
		// });
		$('.questinInfo').find('.qTitle, .question').each(function(i, obj){
			$(obj).addClass(function(){
			  return "item-" + (qNum);
			});
			qNum++;
			console.log(qNum);
		});
	
	});
	
	$('.choiceButtonDelete').bind('click', function(){
		$('div.question' + qNum).find('div.childChoice').each(function(i, obj){
			console.log("obj " + obj + " - " + i);
			$(obj).slice(i).remove();
		});
	});
	///var textValues = $('.question').map((i, el) => console.log("i : " + i + " el : " + el)).get();


	$('.nav-tab').click(function(e) {
	  //Toggle tab link
	  $(this).addClass('nav-tab-active').siblings().removeClass('nav-tab-active');

	  //Toggle target tab
	  $($(this).attr('href')).addClass('active').siblings().removeClass('active');
	});




	
	
	
	
	$(".addNewQ").on('click', function(){
		$("#pick_question_form").show();
	});

	$('#save_question').on('click', function(){
		let question_title = $('#qSelect').find(":selected").text();
		let question_id    = $('#qSelect').val()
		
		if(question_id != null){
			if( !$('div[data-question=' + question_id + ']').length){
			
				let question_choices = jQuery.parseJSON($('#qSelect').find(":selected").attr('data-choices')); 
				let question_type    = $('#qSelect').find(":selected").attr('data-type'); 
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

				$('#questions').append('<div class="added_question" data-question="'
										+ question_id + '"><div class="qst"><h4>' + qNum + ' - ' + question_title + '</h4></div><div class="que_cho">' + question_info + '</div>'
										+ '<input type="hidden" class="added_hidden_question" name="questions[]" value="' 
										+ question_id + '" /><div class="delete_Button qst"><input type="button" onClick="$(\'div[data-question=\' +  $(this).prev().val() + \' ]\').remove();" value="delete" /></div></div>');	

				$('.select_condition').each(function(i){
					let q_id = $(this).attr('data-question');
					if(q_id != question_id){
						$(this).append('<option value="' + question_id + '">Go to: ' + qNum + ' - ' + question_title + '</option>');
					}
				})

			}else {
				alert("you can't choose the same question twice!");
				qNum--;
			}
		}else {
			alert("Please select a question");
			qNum--;
		}
		
		qNum++;
		
	});
	
	$('#cancel_a').on('click', function(){

		$(location).prop('href', '/');
		
	});
	
	$('#delete_a').on('click', function(){
		if(confirm('Are you sure?')){
		
			$(location).prop('href', '/');
		}
		
		
		
	});

	
	
}); 
