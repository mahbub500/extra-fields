let ef_modal = ( show = true ) => {
	if(show) {
		jQuery('#extra-fields-modal').show();
	}
	else {
		jQuery('#extra-fields-modal').hide();
	}
}

jQuery(function($){

	$(".cx-extra-button-1").click(function(e){
		e.preventDefault();
		$(".cx-extra-item-1").slideToggle();	
	});

	$(".cx-extra-button-2").click(function(e){
		e.preventDefault();
		$(".cx-extra-item-2").slideToggle();
	});

	$('input[type="radio"]').change(function(){
        var selectedValue = $("input[name='extra_fields']:checked").val();
    });

	$('input[type="checkbox"]').change(function(){
        var selectedValues = [];
        $('input[name="cx-accessorie"]:checked').each(function() {
          selectedValues.push($(this).val());
        });
		console.log( selectedValues );
      });
})