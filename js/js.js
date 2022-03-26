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
		if(this.value == 'shortAnswer'){
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
		// if(this.value == 'shortAnswer'){
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
		console.log("Fff")

		$('div.question' + qNum).find('div.childChoice').each(function(i, obj){
			console.log("obj " + obj + " - " + i);
			$(obj).slice(i).remove();
		});
	
	});
	///var textValues = $('.question').map((i, el) => console.log("i : " + i + " el : " + el)).get();

}); 
