$(document).ready(function(){
	registration.pageLoad();
	registration.events();
});
registration = {
	pageLoad: function() {

	},
	events: function() {
		$("#username").keyup(function(){
			console.log('here0')
		  	request.check_username($(this).val())
		});
	}
}
request = {

	check_username: function(username) {

		console.log('here')

	    var token = $('input[name=_token]').attr('value');

	    $.ajax({
	        url: "/check-username",
	        type:"POST",
	        data: { '_token': token,'username': username},
	        success:function(data){

	        	if (data.status==0) {
	        		$('#submit-btn').attr('disabled','1')
	        		$('#username-error').css('display','block')

	        	} else {
	        		$('#submit-btn').removeAttr('disabled')
	        		$('#username-error').css('display','none')
	        	}

	        },error:function(e){

	        }

	    });

	}

};