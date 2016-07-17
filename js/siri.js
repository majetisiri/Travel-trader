$(document).ready(function() {

	$('.listing_item').click(function(){
		var id=$(this).attr('id');
		var _this =$(this);
		
		$.post("detiled_info.php", {'vehicle_id': id},function(response){
			
					 
		});
		
	});

});
