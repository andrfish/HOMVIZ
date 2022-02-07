$(document).ready(function(){
	results.pageLoad();
	results.modal_stepy();
	results.events();
	results.file_upload();

});
results = {

	pageLoad: function() {
		$.ajaxSetup({
			headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
		});
		var popupTemplate='<li class="spam-popup">Report as spam</li>';
			$('.popbutton').popover({
			    animation:true, 
			    content:popupTemplate, 
			    html:true
			});
		},

	modal_stepy: function(){
		$('.next-btn').click(function(){

			var _this = $(this).parents('.modal:first').find('.step[state="active"]');
			var current_step = parseInt(_this.attr('step'));
			if (current_step < 4) {
				if (current_step == 1) {
					var search_text = $('#comment_text').val();
					//CHECK IF THE SEARCH AREA WAS NOT EMPTY
					if (!$.isBlank(search_text)) {

						var next_step = current_step + 1;

						//DEACTIVE THE PREVIOUS STATE AND HIDE IT
						_this.attr('state',null);
						_this.addClass('hide');
						//SHOW AND ACTIVE THE NEXT STEP
						$('.step-'+next_step).removeClass('hide').attr('state','active');

						//ADD THE QUERY TO NEXT STEP
						$('#you-asked').html(search_text);

						//SEND SEARCH REQUEST TO PHP 
						request.search_query(search_text);

					};

				} else {

					//THIS IS THE FINAL STEP SHOW SUBMIT BTN
					if (current_step == 3) {
						$('#nxt-btn').addClass('hide');
						$('#qst-submit').removeClass('hide');						
					} else {
						$('#nxt-btn').removeClass('hide');
						$('#qst-submit').addClass('hide');
					}
					var next_step = current_step + 1;
					if (next_step == 3) {
						var search_text = $('#comment_text').val();
						$('#question-title').html(search_text);
					}
					//DEACTIVE THE PREVIOUS STATE AND HIDE IT
					_this.attr('state',null);
					_this.addClass('hide');
					//SHOW AND ACTIVE THE NEXT STEP
					$('.step-'+next_step).removeClass('hide').attr('state','active');
				}

			}
			//SETTING THE HEADER TITLE
			switch(next_step){
				case 2:
					$(this).parents('.modal:first').find('.modal-title').html('<h4>Is your question unique?</h4>');
					$('.back-btn').removeClass('hide');
				break;
				case 3:
					$(this).parents('.modal:first').find('.modal-title').html('<h4>Add question details</h4>');
					$('.back-btn').removeClass('hide');
				break;
				case 4:
					$(this).parents('.modal:first').find('.modal-title').html('<h4>Pick Categories</h4>');
					$('.back-btn').removeClass('hide');
				break;
			}
		});
		$('.back-btn').click(function(){
			var _this = $(this).parents('.modal:first').find('.step[state="active"]');
			var current_step = parseInt(_this.attr('step'));
			if (current_step > 1) {
				//THIS IS THE FINAL STEP SHOW SUBMIT BTN
				if (current_step == 4) {
					$('#nxt-btn').removeClass('hide');
					$('#qst-submit').addClass('hide');
				}
				var next_step = current_step - 1;
				//DEACTIVE THE PREVIOUS STATE AND HIDE IT
				_this.attr('state',null);
				_this.addClass('hide');
				//SHOW AND ACTIVE THE NEXT STEP
				$('.step-'+next_step).removeClass('hide').attr('state','active');
			}
			//SETTING THE HEADER TITLE
			switch(next_step){
				case 1:
					$(this).parents('.modal:first').find('.modal-title').html('<h4>Your Question</h4>');
					$('.back-btn').addClass('hide');
				break;
				case 2:
					$(this).parents('.modal:first').find('.modal-title').html('<h4>Is your question unique?</h4>');
				break;
				case 3:
					$(this).parents('.modal:first').find('.modal-title').html('<h4>Add question details</h4>');
				break;
				case 4:
					$(this).parents('.modal:first').find('.modal-title').html('<h4>Pick Categories</h4>');
				break;
			}
		});


	},
	events: function() {

		$( ".custom-dropdown__select" ).change(function() {
			var this_val = $(this).find('option:selected').val();
			var this_text = $(this).find('option:selected').text();
			add_new_category(this_val,this_text);

		});

		$('.ask_q_btn').click(function(){
			request.user_auth();
		});


		$(document).find('.remove-label').click(function(){
			$(this).parents('.label:first').remove();
		});



		//WANT TO REPLY
		$('.reply-text').click(function(){

			//DELETE ALL OTHER REPLY BOXES
			$(document).find('.reply-media').remove();
			
			var state = parseInt($('#right-arr').attr('state'));
		    // CREATE REPLY BOX
		    var reply_html = '<div class="media reply-media">'+
								'<div class="media-left">'+
								'<a href="#">'+
								'<img class="media-object" data-src="holder.js/64x64" alt="64x64" src="assets/images/blank_male.png" data-holder-rendered="true" style="width: 64px; height: 64px;">'+
								'</a>'+
								'</div>'+
								'<div class="media-body">'+
								' <div class="form-group reply-form">'+
								'<label for="comment">Reply:</label>'+
								'<textarea class="form-control" rows="5" id="comment" placeholder="type somthing..."></textarea>'+
								'</div>'+
								'<div class="reply-btns pull-right">'+
								'<a class="btn btn-default left-btn">Cancel</a>'+
								'<a class="btn btn-primary reply-btn">Reply</a>'+
								'</div>'+
								'</div>'+
							'</div>';

			$(this).parents('.dialogbox-container:first').find('.reply-box:first').append(reply_html); 

		});

		//HIDE RIGHT BOX
		$('#right-arr').click(function(){
			var state = parseInt($('#right-arr').attr('state'));
		});
		//REPLY CANCEL BTN WAS CLICKED
		$(document).on('click','.left-btn',function(){
				$(this).parents('.dialogbox-container:first').find('.reply-media:first').remove();
		});


		//FLAG UP CLICKED
		$(document).on('click','.thumb-up',function(){

		});
		//FLAG DOWN CLICKED
		$(document).on('click','.thumb-down',function(){

		});
		//SPAM FLAG CLICKED
		$(document).on('click','.spam-popup',function(){

		});
		//Reply FLAG CLICKED
		$(document).on('click','.reply-btn',function(){
		
		});
		$(document).on('click','.thread-title',function(){
			var id = $(this).attr('thread-id');
			window.location = '/threads/view/'+id;
		});
		

		$(document).find('.login-btn').click(function(){
			$('#login-form').submit();
		});
		$('#forgot').click(function(){
			window.location = '/password-reset';
		});
		$('#qst-submit').click(function(){
			$('#question_add').submit();
		});

		//MORE CLICKED
		$('.more').click(function(){
			
			var current_height = parseInt($(this).parents('.right-data:first').css('height'));
			var expended = parseInt($(this).parents('.right-data:first').attr('expended'));
			// EXPENDED 0 = CLOSE, 1 = OPEN
			if (expended == 0) {
				//CHANGE THE EXPENDED TO OPEN
				$(this).parents('.right-data:first').attr('expended','1');
				$(this).parents('.right-data:first').css('height','100%');
				// CHANGE THE ARROW 
				$(this).removeClass('glyphicon-chevron-down')
						.addClass('glyphicon-chevron-up');

				//BRING THE GLYPHICON TO BOTTOM
				$(this).removeClass('icon-top').addClass('icon-bottom');
			} else {
				// CHANGE THE EXPENDED TO CLOSE
				$(this).parents('.right-data:first').attr('expended','0');
				$(this).parents('.right-data:first').css('height','105px');
				// CHANGE THE ARROW
				$(this).removeClass('glyphicon-chevron-up')
						.addClass('glyphicon-chevron-down');

				//BRING THE GLYPHICON TO top	
				$(this).removeClass('icon-bottom').addClass('icon-top');
			}

		});
		


	// $('a #right-arr').click(function(e)
	// {
	// 	alert();
	//     // e.preventDefault();
	// });
		//FLAG WAS CLICKED
		$('.flags').click(function(){
			//MOUSE OVER POPUP MESSAGE
		    $(document).find( ".popover" ).mouseout(function() {
		    	var i = false;
		    	//MOUSE CAME BACK OVER MESSAGE 
 			$(document).find( ".popover" ).mouseover(function() {
 				//IF TRUE DONT HIDE PUPUP
 				over = true;
 				i = true;
 			});
			  setTimeout(function(){ 
			  	if (i == false) {//IF MOUSE DIDNT COME BACK HIDE
			  		$('.popbutton').popover('hide') ;
			  	};
			  }, 1000);
			});
			//IF MOUSE DID NOT ENTER CLOSE AFTER FEW SECONDS
			var over = false;
			$(document).find( ".popover" ).mouseover(function() {
 				over = true;
 			});
			setTimeout(function(){ 
			  	if (over == false) {//IF MOUSE DIDNT COME BACK HIDE
			  		$('.popbutton').popover('hide') ;
			  	};
			}, 3000);
		});
	},
	file_upload: function(){
		$('#form-submit-btn').change(function (e) {
			e.stopPropagation(); // Stop stuff happening
		    e.preventDefault(); // Totally stop stuff happening

		    // START A LOADING SPINNER HERE

		    // Create a formdata object and add the files
		    var this_file = new FormData();
		    $.each(this.files, function(key, value)
		    {
		        this_file.append(key, value);
		    });
		 	$.ajax({
			        url: '/users/send-file',
			        type: 'POST',
			        data: this_file,
			        cache: false,
			        dataType: 'json',
			        processData: false, // Don't process the files
			        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
			        success: function(data, textStatus, jqXHR)
			        {
			        	var status = data.status;
			        	switch (status){
			        		case 'success':
			        			var image_name = data.image_name;
			        			var image_type = data.image_type;
			        			var html = '/assets/images/profile-images/perm/'+image_name+'.'+image_type;
			        			$('.profile-picture').attr('src',html);
			        			$('#saved').removeClass('hide');
			        		break;
			        		case 'error':
			        		break;
			        	}
			        },
			        error: function(jqXHR, textStatus, errorThrown)
			        {

			        }
			    });
			});
		},
}
request = {
	sendfile: function(file) {
	var token = $('meta[name=csrf-token]').attr('content');
	$.post(
		'/users/send-file',
		{
			"_token": token,
			"file":file
		},
		function(result){
			var status = result.status;
			switch(status) {
				case 200: // Approved

				break;				
				case 400: // Approved

				break;
				default:
				break;
			}
		}
		);
	},
	search_query: function(search_text) {
	$('.existing-query').html('');
	var token = $('meta[name=csrf-token]').attr('content');
	$.post(
		'/threads/search-query',
		{
			"_token": token,
			"search_text":search_text
		},
		function(result){

			var status = result.status;
			var search_results = result.search_results;
			switch(status) {
				case 200: // Approved

				var html = '';

				var array_l = Object.keys(search_results).length;

				var counter = 0

				$.each(search_results, function( key, value ) {
					if (counter == array_l-1) {
						html += '<div class="search-single">'+
				                '<a class="search-single-a" thread-id="'+value["id"]+'"> <span>'+value["description"]+'</span></br>'+
				                '<span class="search-reply">1 reply</h5></a>'+
				   		'</div>';
					} else {
						html += '<div class="search-single search-single-first">'+
				                '<a class="search-single-a" thread-id="'+value["id"]+'"> <span>'+value["description"]+'</span></br>'+
				                '<span class="search-reply">1 reply</h5></a>'+
				   		'</div>';
					}
					counter++;
				});    
				$('.existing-query').html(html); 

				$('.search-single-a').click(function(){
					var id = $(this).attr('thread-id');
					window.open('/thread/'+id);
				});

				break;				
				case 400: // Approved
				
				break;

				default:
				break;
			}
		}
		);
	},
	user_auth: function() {
	var token = $('meta[name=csrf-token]').attr('content');
	$.post(
		'/users/user-auth',
		{
			"_token": token
		},
		function(result){
			var status = result.status;
			switch(status) {
				case 200: // Approved
					$('#ask_modal').modal('show');
				break;				
				case 400: // Approved
					$('#myModal').modal('toggle');
				break;
				default:
				break;
			}
		}
		);
	}
};
function add_new_category(val , text){
	$('#duplicate-error').addClass('hide');

	var total = $('.category-tag').length;
	var is_set = false;

	//CHECK IF IT EXISTS
	if (total > 0) {
		$( ".category-tag" ).each(function() {
		  var current_val = $( this ).attr('this-val');
		  if (current_val == val) {
		  	is_set = true;
		  	//SHOW ERROR
		  	$('#duplicate-error').removeClass('hide');
		  };
		});
	};
	//THERE WAS NO DUPLICATE
	if (is_set == false) {
		var html =  '<span class="tag label label-primary category-tag" this-val="'+val+'">'+
	                '<span>'+text+'</span>'+
	                '<a><i class="remove-label glyphicon glyphicon-remove-sign glyphicon-white"></i></a>'+
	                '<input name="categories['+total+']" type="hidden" value="'+val+'" text="'+text+'">'+
	                '</span>';
	    $('#h3-wrapper').append(html);
	    $(document).find('.remove-label').click(function(){
			$(this).parents('.label:first').remove();
	});
	};
}
(function($){
  $.isBlank = function(obj){
    return(!obj || $.trim(obj) === "");
  };
})(jQuery);
function uploadFiles(event)
{alert()}
