jQuery(document).ready(function () {
    
    jQuery(document).on("click", '.mt-20.text-center a.btn', function (event) { 
        
            event.preventDefault();

            var page = parseInt(jQuery(this).attr('data-next-page'));
            
            var totalPages = parseInt(jQuery(this).attr('data-total-pages'));
            
            var page_url = jQuery(this).attr('data-page-url');
            
            jQuery(this).attr('data-next-page', page + 1)
            
            if (totalPages == page) {
                jQuery('.mt-20.text-center').remove();
            }
            
            
            jQuery.ajax({
			                 url: page_url,
		                   	 type: 'GET',
			                 data: 'paged=' + page, 
			                 success: function( data ) {

                                    jQuery( ".grid.grid-md-3.grid-xs-2" ).append( data );
			                 }
		             });
        
            return false;
    });
    
    jQuery(document).on("click", '.btn.coworkers-invite__btn', function (event) { 
        
         event.preventDefault();
         
         var trFirst = jQuery('#form-coworkers-invite > div.form-block.email-invite:nth-of-type(1)');
 
         var trLast = jQuery('#form-coworkers-invite > div.form-block.email-invite:last');
        
         var trNew = trFirst.clone();
    
         trLast.after('<div class="form-block email-invite">' + trNew.html() + '</div>');
        
         return false;
    });
    
    jQuery(document).on("click", 'form#form-coworkers-invite button.account-main__btn', function (event) { 
        
         event.preventDefault();
        
         var errors = 0; 
         
         var i = 0;
  
         jQuery('form#form-coworkers-invite .is-error').removeClass( "is-error" );
                                       
         jQuery('form#form-coworkers-invite .error-txt').remove();
         
         jQuery('form#form-coworkers-invite input[name="emails[]"]').each(function(){
            
            if (i > 0) {
               
               if (!isEmail(jQuery(this).val())) {
                
                    jQuery(this).addClass('is-error');
                                                    
                    jQuery(this).after('<div class="error-txt"><span class="error-txt__icon"><img src="/wp-content/themes/fortess/assets/img/svg/error.svg" decoding="async" loading="lazy" alt=""></span>Please, enter correct E-mail</div>');
                    
                    errors++;
               }
            }    
            i++;
         });
         
         if (errors == 0) {
            jQuery('form#form-coworkers-invite').submit();            
         } 
    });
}); 


jQuery(function() {
                    document.addEventListener( 'wpcf7mailsent', function( even ) {
                        
                        jQuery('.is-error').removeClass( "is-error" );
                                       
                        jQuery('.error-txt').remove();
     
                        if(jQuery('#modal-contact').css('display') == 'block') {
                            jQuery('.modal-content__inner').html(event.detail.apiResponse.message);
                            jQuery('#modal-contact').hide();
                            jQuery('#modal-notification').show();
                        } else {
                            jQuery('.notification__content').html(event.detail.apiResponse.message);
                            jQuery('.box-overlay').show();
                            jQuery('.notification').show();
                        }
                        
                    }, false );
                    
                    jQuery('.notification__close').click(function() {
                        
                          if(jQuery('#modal-notification').css('display') == 'block') {
                                jQuery('#modal-notification').hide();
                          } else {
                               jQuery('.box-overlay').hide();             
                               jQuery('.notification').hide();
                          }  
                    });
                    
                    document.addEventListener( 'wpcf7submit', function( event ) {
                        
                    }, false );
                    
                    document.addEventListener( 'wpcf7invalid', function( event ) {
                        
                        var inputs = event.detail.apiResponse.invalid_fields;
                        
                        var input_name;
                        
                        var formId = event.detail.id;
                        
                        jQuery('#'+formId + ' .is-error').removeClass( "is-error" );
                                       
                        jQuery('#'+formId + ' .error-txt').remove();
                        
                        for ( var i = 0; i < inputs.length; i++ ) {
                            
                              input_name = inputs[i].into.replace('span.wpcf7-form-control-wrap.', '');
                              
                              if (jQuery('#'+formId + ' [name="'+input_name+'"]').attr('type') == 'checkbox') {
        
                                     jQuery('#'+formId + ' [name="'+input_name+'"]').closest('.input-choice').after('<div class="error-txt"><span class="error-txt__icon"><img src="/wp-content/themes/fortess/assets/img/svg/error.svg" decoding="async" loading="lazy" alt=""></span>'+inputs[i].message+'</div>');
                                
                              } else {
                                    jQuery('#'+formId + ' [name="'+input_name+'"]').addClass('is-error');
                                                    
                                    jQuery('#'+formId + ' [name="'+input_name+'"]').after('<div class="error-txt"><span class="error-txt__icon"><img src="/wp-content/themes/fortess/assets/img/svg/error.svg" decoding="async" loading="lazy" alt=""></span>'+inputs[i].message+'</div>');
                              }
                             
                            
                        }

                    }, false );
                    
                    var uri = window.location.href.split("#")[0];

                    var hash = window.location.hash; 

                    if (hash != '') {
                        
                            jQuery('body').scrollTo(hash);

                    }
    
});

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}