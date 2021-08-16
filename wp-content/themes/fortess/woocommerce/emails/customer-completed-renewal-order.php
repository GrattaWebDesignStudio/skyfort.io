<?php
/**
 * Customer completed renewal order email
 *
 * @author  Brent Shepherd
 * @package WooCommerce_Subscriptions/Templates/Emails
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<?php $order_id = $order->get_id(); ?>


                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin:0; padding:0">
												<tr>
													<td valign="top" align="center" style="padding-top:52px; padding-left:10px; padding-right:10px;">
														<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin:0; padding:0">
															<tr>
																<td valign="top" align="center" style=" padding-bottom:10px;">
																	<span style="color:#284bdd; font-family: Tahoma, Geneva, sans-serif; font-size:15px; line-height:20px; font-weight: bold; text-transform:uppercase; display: block;">
																		Skyfort 
																	</span>
																</td>
															</tr>
															<tr>
																<td valign="top" align="center" style=" padding-bottom:25px;">
																	<span style="color:#ffffff; font-family:Arial, Helvetica, sans-serif; font-size:35px; line-height:52px; font-weight: bold; display: block;">
																		<?php esc_html_e( 'Subscription renewed', THEME_TEXTDOMAIN ); ?>
																	</span>
																</td>
															</tr>
                                                            
                                                            <?php  $subscriptions_ids = wcs_get_subscriptions_for_order( $order_id, array( 'order_type' => 'any' ) ); ?>
                                                            
                                                            <?php foreach( $subscriptions_ids as $subscription_id => $subscription ) : ?>
                                                            
                                                            
															<tr>
																<td valign="top" align="center" style=" padding-bottom:23px;">
																	<span style="color:#a6a6a6; font-family:Arial, Helvetica, sans-serif; font-size:17px; line-height:25px; display: block;">
																		<?php esc_html_e( 'Your subscription was renewed on', THEME_TEXTDOMAIN ); ?> <?php echo esc_html( date_i18n( wc_date_format(), $subscription->get_time( 'start_date', 'site' ) ) ); ?><br>
                                                                        <?php printf( esc_html__( 'Next payment will be debited on %s', 'woocommerce-subscriptions' ), esc_html( date_i18n( wc_date_format(), $subscription->get_time( 'next_payment', 'site' ) ) ) ); ?>
                                                                        
																	</span>
																</td>
															</tr>
                                                            
                                                            <?php endforeach; ?>
                                                            
														</table>
													</td>
												</tr>
											</table>

											<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin:0; padding:0">
												<tr>
													<td valign="top" align="center" style="padding-top:62px;">
														<img src="<?php echo get_template_directory_uri(); ?>/images/img-3.png" alt="" border="0" width="540" style="display:block;">
													</td>
												</tr>
											</table>
<?php
do_action( 'woocommerce_email_footer', $email );