jQuery(document).ready(function () {

    jQuery(document).on("click", 'form#register_form button[type="submit"]', function (event) { 
        
            let registrationForm =  jQuery(this).closest("form");
            
            if (registrationForm.get(0).checkValidity() )  {

                jQuery.ajax({
			                 url: ajaxurl.ajaxurl,
		                   	 type: 'POST',
			                 data: registrationForm.serialize(), 
                             dataType: 'json', 
			                 success: function( data ) {
                        
                                    if (data.status) {
                                        
                                        jQuery('.new-user-name').html(jQuery('input[name="firstname"]').val() + ' ' + jQuery('input[name="lastname"]').val());
                                        jQuery('#modal-registration-complete').show();
      
                                    } else {
                                            registrationForm.find('.is-error').removeClass( "is-error" );
                                       
                                            registrationForm.find('.error-txt').remove();
                                        
                                            jQuery.each(data.errors,function(i, value){
                                                
                                                    registrationForm.find('[name="'+i+'"]').addClass('is-error');
                                                    
                                                    registrationForm.find('[name="'+i+'"]').after('<div class="error-txt"><span class="error-txt__icon"><img src="/wp-content/themes/fortess/assets/img/svg/error.svg" decoding="async" loading="lazy" alt=""></span>'+value+'</div>');
                                            });
                                    }
                        
                            }
		             });
                     
            }  
        
            return false;
    });
}); 