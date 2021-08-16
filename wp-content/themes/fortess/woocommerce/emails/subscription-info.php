<?php
/**
 * Subscription information template
 *
 * @author  Brent Shepherd / Chuck Mac
 * @package WooCommerce_Subscriptions/Templates/Emails
 * @version 3.0.4
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( empty( $subscriptions ) ) {
	return;
}

$has_automatic_renewal = false;
$is_parent_order       = wcs_order_contains_subscription( $order, 'parent' );
?>


																<tr>
																	<td valign="top" style="padding-bottom:15px">
																		<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin:0; padding:0">
																			<tr>
																				<td valign="top" style="padding-bottom:15px;">
																					<span style="color:#ffffff; font-family:Arial, Helvetica, sans-serif; font-size:18px; line-height:27px; display: block;">
																						<?php esc_html_e( 'Subscription information', 'woocommerce-subscriptions' ); ?>
																					</span>
																				</td>
																			</tr>
																		</table>


																		<table cellpadding="0" cellspacing="0" width="100%" style="margin:0 0 15px 0; padding:5px 20px; background:#060C24; border:2px solid #1a1a1a;">
																			<tr>
																				<td valign="top" style="padding-top:20px; padding-bottom:13px; padding-right:20px; border-bottom: 1px solid #1a1a1a;">
																					<span style="color:#b3b3b3; font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:22px; display: block; letter-spacing:0.02em;">
																						<?php echo esc_html_x( 'ID', 'subscription ID table heading', 'woocommerce-subscriptions' ); ?>
																					</span>
																				</td>
																				<td valign="top" style="padding-top:20px; padding-bottom:13px; padding-right:20px; border-bottom: 1px solid #1a1a1a;">
																					<span style="color:#b3b3b3; font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:22px; display: block; letter-spacing:0.02em;">
																						<?php echo esc_html_x( 'Start date', 'table heading', 'woocommerce-subscriptions' ); ?>
																					</span>
																				</td>
																				<td valign="top" style="padding-top:20px; padding-bottom:13px; padding-right:20px; border-bottom: 1px solid #1a1a1a;">
																					<span style="color:#b3b3b3; font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:22px; display: block; letter-spacing:0.02em;">
																						<?php echo esc_html_x( 'End date', 'table heading', 'woocommerce-subscriptions' ); ?>
																					</span>
																				</td>
																				<td valign="top" style="padding-top:20px; padding-bottom:13px; padding-right:20px; border-bottom: 1px solid #1a1a1a;">
																					<span style="color:#b3b3b3; font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:22px; display: block; letter-spacing:0.02em;">
																						<?php echo esc_html_x( 'Recurring total', 'table heading', 'woocommerce-subscriptions' ); ?>
																					</span>
																				</td>
																			</tr>
                                                                            <?php foreach ( $subscriptions as $subscription ) : ?>
                                                                            <?php $has_automatic_renewal = $has_automatic_renewal || ! $subscription->is_manual(); ?>
																			<tr>
																				<td valign="top" style="padding-top:19px; padding-bottom:19px; padding-right:20px;">
																					<span style="color:#ffffff; font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:19px; display: block; letter-spacing:0.02em;">
																						<a href="<?php echo esc_url( ( $is_admin_email ) ? wcs_get_edit_post_link( $subscription->get_id() ) : $subscription->get_view_order_url() ); ?>"><?php echo sprintf( esc_html_x( '#%s', 'subscription number in email table. (eg: #106)', 'woocommerce-subscriptions' ), esc_html( $subscription->get_order_number() ) ); ?></a>
																					</span>
																				</td>
																				<td valign="top" style="padding-top:19px; padding-bottom:19px; padding-right:20px;">
																					<span style="color:#ffffff; font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:19px; display: block; letter-spacing:0.02em;">
																					       <?php echo esc_html( date_i18n( wc_date_format(), $subscription->get_time( 'start_date', 'site' ) ) ); ?>
																					</span>
																				</td>
																				<td valign="top" style="padding-top:19px; padding-bottom:19px; padding-right:20px;">
																					<span style="color:#ffffff; font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:19px; display: block; letter-spacing:0.02em;">
																						<?php echo esc_html( ( 0 < $subscription->get_time( 'end' ) ) ? date_i18n( wc_date_format(), $subscription->get_time( 'end', 'site' ) ) : _x( 'When cancelled', 'Used as end date for an indefinite subscription', 'woocommerce-subscriptions' ) ); ?>
																					</span>
																				</td>
																				<td valign="top" style="padding-top:19px; padding-bottom:19px; padding-right:20px;">
																					<span style="color:#ffffff; font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:19px; display: block; letter-spacing:0.02em;">
                                                                                        <?php echo wp_kses_post( $subscription->get_formatted_order_total() ); ?>
			                                                                         	<?php if ( $is_parent_order && $subscription->get_time( 'next_payment' ) > 0 ) : ?>
				                                                                        	<br>
				                                                        	               <span style="color:#ffffff; font-family:Arial, Helvetica, sans-serif; font-size:10px; line-height:15px; display: block; letter-spacing:0.02em;"><?php printf( esc_html__( 'Next payment: %s', 'woocommerce-subscriptions' ), esc_html( date_i18n( wc_date_format(), $subscription->get_time( 'next_payment', 'site' ) ) ) ); ?></span>
				<?php endif; ?>
                                                                                        
																					</span>
																				</td>
																			</tr>
                                                                            <?php endforeach; ?>
																		</table>
																	</td>
																</tr>