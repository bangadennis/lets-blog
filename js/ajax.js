$('#button5').click(function(){
	var name=$('#commenting').val();
	
	$.ajax({
	type: 'POST',
	url: 'comment.php',
	data: 'comment='+name,
	success: function(data)
	{
		$('#message').html(data);
	}
	
	}).error(
	function()
	{
		$('#message').html('<span>error while processing</span>');
	});

else
{
$('#message').text('Cannot Post Empty String');

}

});