$('#button1').click(
function(){
 var comment=$('#message').val()
 
 $.post('comment.php', {comment:comment}, function(data)
 {
	$('#message').text(data);
 });

});