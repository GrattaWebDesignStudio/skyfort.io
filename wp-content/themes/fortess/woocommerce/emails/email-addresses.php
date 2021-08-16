<?php
/**
 * Email Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-addresses.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$text_align = is_rtl() ? 'right' : 'left';
$address    = $order->get_formatted_billing_address();
$shipping   = $order->get_formatted_shipping_address();

?>


																<tr>
																	<td valign="top" style="padding-bottom:15px">
																		<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin:0; padding:0">
																			<tr>
																				<td valign="top" style="padding-bottom:15px;">
																					<span style="color:#ffffff; font-family:Arial, Helvetica, sans-serif; font-size:18px; line-height:27px; display: block;">
																						<?php esc_html_e( 'Billing address', 'woocommerce' ); ?>
																					</span>
																				</td>
																			</tr>
																		</table>

																		<table cellpadding="0" cellspacing="0" width="100%" style="margin:0; padding:17px 20px; background:#060C24; border:2px solid #1a1a1a;">
                                                                        
                                                                            <?php if ( $order->get_billing_first_name() || $order->get_billing_last_name()) : ?>
                                                                        
																			<tr>
																				<td valign="top" style="padding-top:7px; padding-bottom:7px;">
																					<span style="color:#ffffff; font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:22px; display: block; letter-spacing:0.02em;">
																						<?php echo esc_html( $order->get_billing_first_name() ); ?> <?php echo esc_html( $order->get_billing_last_name() ); ?>
																					</span>
																				</td>
																			</tr>
                                                                            <?php endif; ?>
                                                                            
                                                                            <?php if ( $order->get_billing_company() ) : ?>

																			<tr>
																				<td valign="top" style="padding-top:7px; padding-bottom:7px;">
																					<span style="color:#ffffff; font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:22px; display: block; letter-spacing:0.02em;">
																						<?php echo esc_html($order->get_billing_company() ); ?>
																					</span>
																				</td>
																			</tr>
                                                                            
                                                                            <?php endif; ?>
                                                                            <?php if ( $order->get_billing_address_1() || $order->get_billing_address_2()) : ?>

																			<tr>
																				<td valign="top" style="padding-top:7px; padding-bottom:7px;">
																					<span style="color:#ffffff; font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:22px; display: block; letter-spacing:0.02em;">
																						<?php echo esc_html($order->get_billing_address_1() ); ?> <?php echo esc_html($order->get_billing_address_2()) ; ?>
																					</span>
																				</td>
																			</tr>
                                                                            
                                                                            <?php endif; ?>
                                                                            
                                                                            <?php if ($order -> get_billing_city() || $order -> get_billing_country() || $order -> get_billing_postcode()) : ?>

																			<tr>
																				<td valign="top" style="padding-top:7px; padding-bottom:7px;">
																					<span style="color:#ffffff; font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:22px; display: block; letter-spacing:0.02em;">
																						<?php echo $order -> get_billing_city(); ?>, <?php echo $order -> get_billing_country(); ?> <?php echo $order -> get_billing_postcode(); ?>
																					</span>
																				</td>
																			</tr>
                                                                            
                                                                            <?php endif; ?>
                                                                            <?php if ( $order->get_billing_phone() ) : ?>      
																			<tr>
																				<td valign="top" style="padding-top:7px; padding-bottom:7px;">
																					<span style="color:#ffffff; font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:22px; display: inline-block; text-decoration:underline; letter-spacing:0.02em;">
																						380635757439
																					</span>
																				</td>
																			</tr>
                                                                            <?php endif; ?>

                                                                            <?php if ( $order->get_billing_email() ) : ?>     
																			<tr>
																				<td valign="top" style="padding-top:7px; padding-bottom:7px;">
																					<span style="color:#ffffff; font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:22px; display: inline-block; text-decoration:underline; letter-spacing:0.02em;">
																						<?php echo esc_html( $order->get_billing_email() ); ?>
																					</span>
																				</td>
																			</tr>
                                                                            <?php endif; ?>
																	  </table>
																	</td>
																</tr>
                                                                
<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() && $shipping ) : ?>
	<tr>
																	<td valign="top" style="padding-bottom:15px">
																		<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin:0; padding:0">
																			<tr>
																				<td valign="top" style="padding-bottom:15px;">
																					<span style="color:#ffffff; font-family:Arial, Helvetica, sans-serif; font-size:18px; line-height:27px; display: block;">
																						<?php esc_html_e( 'Shipping address', 'woocommerce' ); ?>
																					</span>
																				</td>
																			</tr>
																		</table>

																		<table cellpadding="0" cellspacing="0" width="100%" style="margin:0; padding:17px 20px; background:#060C24; border:2px solid #1a1a1a;">
                                                                            <?php if ( $order->get_shipping_first_name() || $order->get_shipping_last_name()) : ?>
                                                                            <tr>
																				<td valign="top" style="padding-top:7px; padding-bottom:7px;">
																					<span style="color:#ffffff; font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:22px; display: block; letter-spacing:0.02em;">
																					  <?php echo esc_html( $order->get_shipping_first_name() ); ?> <?php echo esc_html( $order->get_shipping_last_name() ); ?>
																					</span>
																				</td>
																			</tr>
                                                                            <?php endif; ?>
                                                                            <?php if ( $order->get_shipping_company() ) : ?>
                                                                            <tr>
																				<td valign="top" style="padding-top:7px; padding-bottom:7px;">
																					<span style="color:#ffffff; font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:22px; display: block; letter-spacing:0.02em;">
																					  <?php echo esc_html($order->get_shipping_company() ); ?>
																					</span>
																				</td>
																			</tr>
                                                                            <?php endif; ?>
                                                                            <?php if ( $order->get_shipping_address_1() || $order->get_shipping_address_2()) : ?>
                                                                            <tr>
																				<td valign="top" style="padding-top:7px; padding-bottom:7px;">
																					<span style="color:#ffffff; font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:22px; display: block; letter-spacing:0.02em;">
																					  <?php echo esc_html($order->get_shipping_address_1() ); ?> <?php echo esc_html($order->get_shipping_address_2()); ?>
																					</span>
																				</td>
																			</tr>
                                                                            <?php endif; ?>
                                                                            <?php if ($order -> get_shipping_city() || $order -> get_shipping_country() || $order -> get_shipping_postcode()) : ?>
                                                                            <tr>
																				<td valign="top" style="padding-top:7px; padding-bottom:7px;">
																					<span style="color:#ffffff; font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:22px; display: block; letter-spacing:0.02em;">
																					  <?php echo $order -> get_shipping_city(); ?>, <?php echo $order -> get_shipping_country(); ?> <?php echo $order -> get_shipping_postcode(); ?>
																					</span>
																				</td>
																			</tr>
                                                                            <?php endif; ?>
																	  </table>
																	</td>
  </tr>

<?php endif; ?>