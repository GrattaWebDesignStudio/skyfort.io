<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<?php
/*
 * @hooked WC_Emails::email_header() Output the email header
*/
do_action( 'woocommerce_email_header', $email_heading, $email ); 
?>


<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin:0; padding:0">
												<tr>
													<td valign="top" align="center" style="padding-top:52px; padding-left:10px; padding-right:10px;">
														<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin:0; padding:0">
															<tr>
																<td valign="top" align="center" style=" padding-bottom:10px;">
																	<span style="color:#284bdd; font-family: Tahoma, Geneva, sans-serif; font-size:15px; line-height:20px; font-weight: bold; text-transform:uppercase; display: block;">
																		<?php esc_html_e( 'SkyFort', THEME_TEXTDOMAIN ); ?>
																	</span>
																</td>
															</tr>
															<tr>
																<td valign="top" align="center" style=" padding-bottom:25px;">
																	<span style="color:#ffffff; font-family:Arial, Helvetica, sans-serif; font-size:35px; line-height:52px; font-weight: bold; display: block;">
																		<?php esc_html_e( 'Registration', THEME_TEXTDOMAIN ); ?>
																	</span>
																</td>
															</tr>
															<tr>
																<td valign="top" align="center" style=" padding-bottom:23px;">
																	<span style="color:#a6a6a6; font-family:Arial, Helvetica, sans-serif; font-size:17px; line-height:25px; display: block;">
																		<?php esc_html_e( 'Follow the link to confirm.', THEME_TEXTDOMAIN ); ?>
																	</span>
																</td>
															</tr>
															<tr>
																<td valign="top" align="center" style=" padding-top:15px;">
                                                                    <a href="<?php echo esc_url($url_confirmation); ?>" style="display: inline-block; padding-right: 30px; padding-left:30px;
																		padding-top: 17px; padding-bottom: 17px;
																		border-radius: 50px; background-color:#004ae2; text-decoration: none; border:2px solid #132c7b; position: relative;" target="_blank">
																		<span style="color:#ffffff; font-family:Arial, Helvetica, sans-serif; font-size:17px; line-height: 1.2; text-transform:uppercase; font-weight: bold; display: block;">
																			<?php esc_html_e( 'Registration', THEME_TEXTDOMAIN ); ?>
																		</span>
																	</a>
                                                                    
																</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>

											<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin:0; padding:0">
												<tr>
													<td valign="top" align="center" style="padding-top:62px;">
														<img src="<?php echo get_template_directory_uri(); ?>/images/img-1.png" alt="" border="0" width="540" height="339" style="display:block;">
													</td>
												</tr>
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
