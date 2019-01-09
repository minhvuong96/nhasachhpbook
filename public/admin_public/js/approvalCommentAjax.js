$(document).ready(function() {
	$('.approvalComment').click(function(event) {
		var idComment = $(this).data('id');

		$.ajax({
			url: 'admin/approval-comment',
			type: 'get',
			data: {idComment: idComment},
			success: function(res){
				if(res =='success'){
					$('#'+idComment).remove();
				}
			},error: function() {
				alert('Error');
			}
		});		
	});
	$('.deleteComment').click(function(event) {
		var idComment = $(this).data('id');
		$.ajax({
			url: 'admin/delete-comment/'+idComment,
			type: 'get',
			success: function(res){
				if(res =='success'){
					$('#'+idComment).remove();
				}
			},error: function() {
				alert('Error');
			}
		});		
	});
});