<?php
/**
 * Order details table shown in emails.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

$text_align = is_rtl() ? 'right' : 'left';

do_action( 'woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text, $email ); ?>

																<tr>
																	<td valign="top" style="padding-bottom:15px">
																		<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin:0; padding:0">
																			<tr>
																				<td valign="top" style="padding-bottom:15px;">
																					<span style="color:#ffffff; font-family:Arial, Helvetica, sans-serif; font-size:18px; line-height:27px; display: block;">
																						<?php
	                                                                                       if ( $sent_to_admin ) {
	                                                                                   	         $before = '<a class="link" href="' . esc_url( $order->get_edit_order_url() ) . '">';
	                                                                                           	 $after  = '</a>';
	                                                                                       } else {
	                                                                                             $before = '';
		                                                                                         $after  = '';
	                                                                                       }
	                                                                                       echo wp_kses_post( $before . sprintf( __( '[Order #%s]', 'woocommerce' ) . $after . ' (<time datetime="%s">%s</time>)', $order->get_order_number(), $order->get_date_created()->format( 'c' ), wc_format_datetime( $order->get_date_created() ) ) );
                                                                                        	?>
																					</span>
																				</td>
																			</tr>
																		</table>

																		<table cellpadding="0" cellspacing="0" width="100%" style="margin:0 0 15px 0; padding:5px 20px; background:#060C24; border:2px solid #1a1a1a;">
																			<tr>
																				<td valign="center" style="padding-top:20px; padding-bottom:13px; padding-right:20px; border-bottom: 1px solid #1a1a1a;">
																					<span style="color:#b3b3b3; font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:22px; display: block; letter-spacing:0.02em;">
																						<?php esc_html_e( 'Product', 'woocommerce' ); ?>
																					</span>
																				</td>
																				<td valign="center" style="padding-top:20px; padding-bottom:13px; padding-right:20px; border-bottom: 1px solid #1a1a1a;">
																					<span style="color:#b3b3b3; font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:22px; display: block; letter-spacing:0.02em;">
																						<?php esc_html_e( 'Quantity', 'woocommerce' ); ?>
																					</span>
																				</td>
																				<td valign="center" style="padding-top:20px; padding-bottom:13px; padding-right:20px; border-bottom: 1px solid #1a1a1a;">
																					<span style="color:#b3b3b3; font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:22px; display: block; letter-spacing:0.02em;">
																						<?php esc_html_e( 'Price', 'woocommerce' ); ?>
																					</span>
																				</td>
																			</tr>
                                                                            <?php
			echo wc_get_email_order_items( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				$order,
				array(
					'show_sku'      => $sent_to_admin,
					'show_image'    => false,
					'image_size'    => array( 32, 32 ),
					'plain_text'    => $plain_text,
					'sent_to_admin' => $sent_to_admin,
				)
			);
			?>
																		</table>


																		<table cellpadding="0" cellspacing="0" width="100%" style="margin:0 0 15px 0; padding:5px 20px; background:#060C24; border:2px solid #1a1a1a;">
                                                                        
                                                                         	<?php
		                                                                     	$item_totals = $order->get_order_item_totals();

			                                                                    if ( $item_totals ) {
			                                                                     	$i = 0;
			                                                                     	foreach ( $item_totals as $total ) {
				                                                                   	$i++;
                                                                            ?>
																			<tr>
																				<td valign="center" style="padding-top:20px; padding-bottom:20px; padding-right:20px; border-bottom: 1px solid #1a1a1a;">
																					<span style="color:#b3b3b3; font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:22px; display: block; letter-spacing:0.02em;">
																						<?php echo wp_kses_post( $total['label'] ); ?>
																					</span>
																				</td>
																				<td valign="center" style="padding-top:20px; padding-bottom:20px; padding-right:20px; border-bottom: 1px solid #1a1a1a;">
																					<span style="color:#ffffff; font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:19px; display: block; letter-spacing:0.02em;">
																					   <?php echo wp_kses_post( $total['value'] ); ?>
																					</span>
																				</td>
																			</tr>
                                                                            <?php 
                                                                                	}
			                                                                     }
                                                                            ?>
                                                                            <?php if ( $order->get_customer_note() ) { ?>
																			<tr>
																				<td valign="center" style="padding-top:20px; padding-bottom:20px; padding-right:20px; border-bottom: 1px solid #1a1a1a;">
																					<span style="color:#b3b3b3; font-family:Arial, Helvetica, sans-serif; font-size:15px; line-height:22px; display: block; letter-spacing:0.02em;">
																						<?php esc_html_e( 'Note:', 'woocommerce' ); ?>
																					</span>
																				</td>
																				<td valign="center" style="padding-top:20px; padding-bottom:20px; padding-right:20px; border-bottom: 1px solid #1a1a1a;">
																					<span style="color:#ffffff; font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:19px; display: block; letter-spacing:0.02em;">
																						<?php echo wp_kses_post( nl2br( wptexturize( $order->get_customer_note() ) ) ); ?>
																					</span>
																				</td>
																			</tr>
                                                                            <?php } ?>
																		</table>
																	</td>
																</tr>
                                                <?php do_action( 'woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text, $email ); ?>