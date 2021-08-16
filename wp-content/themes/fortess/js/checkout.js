jQuery(document).ready(function () {

    if(jQuery("#billing_team_status").length){
            jQuery('.billing_team_company').hide();
    }
    
    jQuery("#billing_team_status").change(function() {
            if (this.checked) {
                jQuery('.billing_team_company').show();
            } else {
                jQuery('.billing_team_company').hide();
            }
    });
}); 