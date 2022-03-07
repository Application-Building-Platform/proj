window.addEventListener("load", function() {
	let qNum = 1;
	let cNum = 1;
	$('#qType').on('change', function() {
		console.log("e.value : " + this.value);
		if(this.value == 'shortAnswer'){
			$('.choiceSection').hide();
		}else{
			$('.choiceSection').show();
		}
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
	
	$('.AddChoiceButton').on('click', function(){
		$(".choiceButtonGroup").html($('.childChoice').clone());

		// $('div.question' + qNum).find('div.childChoice').each(function(i, obj){
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
