$(document).ready(function(){
	cust_layout.pageLoad();
	cust_layout.events();

});
cust_layout = {
	pageLoad: function() {

		$(window).on('scroll', function() {
			scrollPosition = $(this).scrollTop();
		    // console.log(scrollPosition);
		    if (scrollPosition > 53) {
		    	if (!$('nav').hasClass('navbar-translucent')) {
		    		$('nav').addClass('navbar-translucent');
		    	};
		    } else if (scrollPosition < 53){
		    	if ($('nav').hasClass('navbar-translucent')) {
		    		$('nav').removeClass('navbar-translucent');
		    	};
		    }
		});
			  // Calls the selectBoxIt method on your HTML select box
		  $(".layout-select").selectBoxIt({
		    // Uses the jQueryUI theme for the drop down
		    theme: "jqueryui",
		  });

		$('#web-img').click(function(){
			window.location = "/";
			window.open('http://stackoverflow.com/', '_blank');
		});
		$('.cocoon-tag').click(function(){
			window.location = "/";
			window.open('http://cocoon-us.com/', '_blank');
		});
		$('#wendyjomorrison').click(function(){
			window.location = "/";
			window.open('http://wendyjomorrison.com/', '_blank');
		});

		


	},
	events: function() {
		$("#layout-option-select").change(function(){
			window.location.replace($( "#layout-option-select option:selected" ).val());
		});
		$(document).on('click','.delete-single-item-cart',function(){
			var item_id = $(this).attr('item-id');
			var option_id = $(this).attr('option-id');
			window.location.replace("/invoices/delete-item-cart/"+item_id+'-'+option_id);
        });
		$(document).on('click','.delete-single-item-liked',function(){
			var id = $(this).attr('item-id');
			window.location.replace("/invoices/delete-item-liked/"+id);
        });
		$('.back-to-home').click(function(){
			window.location = "/";
		});
        $(document).on('click','#add-to-cart-btn',function(){
        	var $this = $(this);
        	var item_id = $('#item-id-modal').val();
        	requestw.add_to_cart(item_id);
        });
        $(document).on('click','#view_item',function(){
	       var this_href = $(this).attr('this-item');
	       window.location.replace("/items/"+this_href);
        });

        $(document).on('click','.login-btn',function(){
			$('#login-modal').modal('show');
        });
        $(document).on('click','.logout-btn',function(){
			$('#logout-modal').modal('show');
        });

        $(document).on('click','.layout-btn',function(){
        	//CHECKBOX
            var $this = $(this);
		    // $this will contain a reference to the checkbox   
		    if ($this.is(':checked')) {
		       var this_href = $this.attr('this-href');
		       window.location.replace("/"+this_href);
		    } 
        });


	}
}
requestws = {

};

