<?php
/**
 * Admin new order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/admin-new-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails\HTML
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

/*
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $email_heading, $email ); ?>


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
																		<?php echo esc_html__( 'New Order', 'woocommerce'); ?>: #<?php echo $order->get_order_number(); ?>
																	</span>
																</td>
															</tr>
															<tr>
																<td valign="top" align="center" style=" padding-bottom:23px;">
																	<span style="color:#b3b3b3; font-family:Arial, Helvetica, sans-serif; font-size:17px; line-height:25px; display: block;">
																		<?php printf( esc_html__( 'You’ve received the following order from %s:', 'woocommerce' ), $order->get_formatted_billing_full_name() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
																	</span>
																</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>	

											<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin:0; padding:0">
												<tr>
													<td valign="top" align="left" style="padding-top:23px; padding-left:30px; padding-right:30px;">
															<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin:0; padding:0">
<?php

/*
 * @hooked WC_Emails::order_details() Shows the order details table.
 * @hooked WC_Structured_Data::generate_order_data() Generates structured data.
 * @hooked WC_Structured_Data::output_structured_data() Outputs structured data.
 * @since 2.5.0
 */
do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );

/*
 * @hooked WC_Emails::order_meta() Shows order meta data.
 */
do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );

/*
 * @hooked WC_Emails::customer_details() Shows customer details
 * @hooked WC_Emails::email_address() Shows email address
 */
do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * Show user-defined additional content - this is set in each email's settings.
 */
//if ( $additional_content ) {
//	echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
//}

?>
                                                                                                        </table>
                                                													</td>
												</tr>
</table>
<?php

/*
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action( 'woocommerce_email_footer', $email );
