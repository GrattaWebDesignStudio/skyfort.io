jQuery(document).ready(function () {
    
    jQuery(document).on("click", 'form#login_form button[type="submit"]', function (event) { 
        
            let loginForm =  jQuery(this).closest("form");
            
            if (loginForm.get(0).checkValidity() )  {
            
                jQuery.ajax({
			                 url: ajaxurl.ajaxurl,
		                   	 type: 'POST',
			                 data: loginForm.serialize(), 
                             dataType: 'json', 
			                 success: function( data ) {
                        
                                    if (data.status) {
                                        
                                        var redirect = data.redirect;
                                        
                                        if (redirect != '') {
  
                                            window.location.href = redirect;
                                            
                                        } else {
                                            window.location.href = '/';
                                        }
                                        
                                    } else {
                                        
                                       loginForm.find('.is-error').removeClass( "is-error" );
                                       
                                       loginForm.find('.error-txt').remove();
                                        
                                       jQuery.each(data.errors,function(i, value){
                                                
                                                    loginForm.find('[name="'+i+'"]').addClass('is-error');
                                                    
                                                    loginForm.find('[name="'+i+'"]').after('<div class="error-txt"><span class="error-txt__icon"><img src="/wp-content/themes/fortess/assets/img/svg/error.svg" decoding="async" loading="lazy" alt=""></span>'+value+'</div>');
                                       });
                                    }
			                 }
		             });
                     
            } 
        
            return false;
    });
}); 