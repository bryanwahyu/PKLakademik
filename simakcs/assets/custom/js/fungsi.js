function showData(link){
    $.ajax({
        url : link,
        success : function(msg){
            $('.modal-body').html(msg);
        }
    });
}

function submit(link){
	var data = $('form[name="formSubmit"]').serializeArray();

	$.ajax({
		url : 
	});
}