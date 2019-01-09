$(document).ready(function() {
	$('.deleteUnitCart').click(function(event) {
		/* Act on the event */
		var idUnitCart = $(this).data('id');
		$.ajax({
			url: 'xoa-gio-hang',
			type: 'GET',
			
			data: {idUnitCart: idUnitCart},
		})
		.done(function(data) {
				$("#tr"+idUnitCart).remove();
				$('#priceTotal').html(data+' đ');
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	});
});
$(document).ready(function() {
	$('.updateUnitCart').click(function(event) {
		/* Act on the event */
		var idUnitCart = $(this).data('id');
		var quantity = $(this).parent().parent().find('td > .quantityProduct').val();
		$.ajax({
			url: 'cap-nhat-gio-hang',
			type: 'GET',
			
			data: {idUnitCart: idUnitCart,quantity: quantity},
		})
		.done(function(data) {
			
			// var price=$('#priceProduct'+idUnitCart).val();
			// var total = price*data;
			// alert(price);
			// $('.unit_total'+idUnitCart).text($('#priceProduct'+idUnitCart).val());
			//console.log(data);
			$('.unit_total'+idUnitCart).html(data[0]+' đ');
			$('#priceTotal').html(data[1]+' đ');
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	});
});