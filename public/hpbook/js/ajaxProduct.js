$(document).ready(function() {

		$('#sortSelect').change(function(event) {
			/* Act on the event */
			var option = $('#sortSelect').val();
			var cate_id = $(this).data('cate');
			$.ajax({
				url: 'sap-xep-san-pham',
				type: 'GET',
				dataType: 'html',
				data: {option: option, cate_id: cate_id},
			})
			.done(function(response) {
				$('#productLoad').html(response);
				//console.log(response);
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			
		});
		// $(window).on('hashchange',function(){
		// 	page = window.location.hash.replace('#','');
		// 	getProducts(page);
		// });
		// $(document).on('click','.pagination a', function(e){
		// 	e.preventDefault();
		// 	var page = $(this).attr('href').split('page=')[1];
		// 	var option = $('#sortSelect').val();
		// 	var cate_id = $(this).data('cate');
		// 	getProducts(page,option,cate_id);
		// 	location.hash = page;
		// });
		// function getProducts(page,option,cate_id){
		// 	$.ajax({
		// 		url: 'sap-xep-san-pham?page=' + page,
		// 		type: 'GET',
		// 		data: {option: option, cate_id: cate_id},
		// 		dataType: 'html',
		// 	}).done(function(data){
		// 		$('#productLoad').html(data);
		// 		console.log(data);
		// 	});
		// }

});