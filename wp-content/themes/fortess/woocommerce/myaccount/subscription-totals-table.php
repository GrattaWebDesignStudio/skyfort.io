<?php
/**
 * Subscription details table
 *
 * @author  Prospress
 * @package WooCommerce_Subscription/Templates
 * @since 2.6.0
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>


<div class="account-main__block">
										<div class="order">
											<div class="order__row">
												<div class="order__item">
													<div class="order__caption"><?php echo esc_html_x( 'Product', 'table headings in notification email', 'woocommerce-subscriptions' ); ?></div>
												</div>
												<div class="order__item">
													<div class="order__caption"><?php echo esc_html_x( 'Total', 'table heading', 'woocommerce-subscriptions' ); ?></div>
												</div>
											</div>
                                            <?php
		                                      foreach ( $subscription->get_items() as $item_id => $item ) {
		                                          	$_product  = apply_filters( 'woocommerce_subscriptions_order_item_product', $item->get_product(), $item );
			                                          if ( apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
				                            ?>
											             <div class="order__row">
												            <div class="order__item">
                                                                <?php
						if ( $_product && ! $_product->is_visible() ) {
							echo wp_kses_post( apply_filters( 'woocommerce_order_item_name', $item['name'], $item, false ) );
						} else {
							echo wp_kses_post( apply_filters( 'woocommerce_order_item_name', sprintf( '<a href="%s">%s</a>', get_permalink( $item['product_id'] ), $item['name'] ), $item, false ) );
						}

						echo wp_kses_post( apply_filters( 'woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf( '&times; %s', $item['qty'] ) . '</strong>', $item ) );

						/**
						 * Allow other plugins to add additional product information here.
						 *
						 * @param int $item_id The subscription line item ID.
						 * @param WC_Order_Item|array $item The subscription line item.
						 * @param WC_Subscription $subscription The subscription.
						 * @param bool $plain_text Wether the item meta is being generated in a plain text context.
						 */
						do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $subscription, false );

						wcs_display_item_meta( $item, $subscription );

						/**
						 * Allow other plugins to add additional product information here.
						 *
						 * @param int $item_id The subscription line item ID.
						 * @param WC_Order_Item|array $item The subscription line item.
						 * @param WC_Subscription $subscription The subscription.
						 * @param bool $plain_text Wether the item meta is being generated in a plain text context.
						 */
						do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $subscription, false );
						?>
                                                            </div>
												            <div class="order__item"><?php echo wp_kses_post( $subscription->get_formatted_line_subtotal( $item ) ); ?></div>
											             </div>
                                            <?php
                                                    }
                                            	}
		                                    ?>
										</div>

                                        <?php foreach ( $totals as $key => $total ) : ?>
										<div class="order-total">
											<div class="order-total__item">
												<div class="order__caption"><?php echo esc_html( $total['label'] ); ?></div>
											</div>
											<div class="order-total__item">
												<div class="font-lg"><?php echo wp_kses_post( $total['value'] ); ?></div>
											</div>
										</div>
                                        <?php endforeach; ?>
</div>