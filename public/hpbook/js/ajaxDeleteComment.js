$(document).ready(function() {
	$(".deleteComment").click(function(event) {
		var idComment = $(this).data('id');
		$.ajax({
			url: 'xoa-binh-luan',
			type: 'GET',
			data: {idComment: idComment},
		})
		.done(function(data) {
			if(data=='success'){
				$('#'+idComment).remove();
			}
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	});
});