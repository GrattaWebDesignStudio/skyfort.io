<?php if(!defined('ABSPATH')) return; ?>    

<?php
/*
 * @hooked WC_Emails::email_header() Output the email header
*/
do_action( 'woocommerce_email_header', $email_heading, $email ); 
?>

<table style="margin: 0; padding: 0;" border="0" width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="padding-top: 52px; padding-left: 10px; padding-right: 10px;" align="center" valign="top">
<table style="margin: 0; padding: 0;" border="0" width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="padding-bottom: 10px;" align="center" valign="top"><span style="color: #284bdd; font-family: Tahoma, Geneva, sans-serif; font-size: 15px; line-height: 20px; font-weight: bold; text-transform: uppercase;">
Skyfort
</span></td>
</tr>
<tr>
<td style="padding-bottom: 25px;" align="center" valign="top"><span style="color: #ffffff; font-family: Arial, Helvetica, sans-serif; font-size: 35px; line-height: 52px; font-weight: bold;">
Your subscription has expired
</span></td>
</tr>
<tr>
<td style="padding-bottom: 23px;" align="center" valign="top"><span style="color: #a6a6a6; font-family: Arial, Helvetica, sans-serif; font-size: 17px; line-height: 25px;">
The balance on your card is either insufficient or your card details need to be updated. If you do not pay for your subscription within 3 days, you will be disconnected from SkyFort.
</span></td>
</tr>
<tr>
<td style="padding-top: 15px;" align="center" valign="top"><a style="border-radius: 50px; background-color: #004ae2; text-decoration: none; border: 2px solid #132c7b; padding: 17px 30px 17px 30px;" href="<?php echo $pay_url; ?>" target="_blank" rel="noopener"><span style="color: #ffffff; font-family: Arial, Helvetica, sans-serif; font-size: 17px; line-height: 1.2; text-transform: uppercase; font-weight: bold;">pay now</span></a></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table style="margin: 0; padding: 0;" border="0" width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="padding-top: 80px;" align="center" valign="top"><img src="<?php echo get_template_directory_uri(); ?>/images/img-4.png" alt="" width="540" border="0" /></td>
</tr>
</tbody>
</table>


<?php 
/**
 * Show user-defined additional content - this is set in each email's settings.
 */
if ( $additional_content ) {
	echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
}

/*
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action( 'woocommerce_email_footer', $email );
