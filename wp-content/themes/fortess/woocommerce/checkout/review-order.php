<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;
?>


<div class="order order_v1">
		<div class="order__row">
			<div class="order__item">
					<div class="order__caption"><?php esc_html_e( 'Product', 'woocommerce' ); ?></div>
			</div>
		    <div class="order__item">
					<div class="order__caption"><?php esc_html_e( 'Total', 'woocommerce' ); ?></div>
		   </div>
		</div>
        
        <?php do_action( 'woocommerce_review_order_before_cart_contents' ); ?>
        
        <?php 
          foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
		 ?>
            <div class="order__row">
				<div class="order__item">
                        <?php echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf( '&times;&nbsp;%s', $cart_item['quantity'] ) . '</strong>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                </div>
				<div class="order__item"><?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
			</div>
         <?php 
              }
            }
         ?>
                      
         <?php echo do_action( 'woocommerce_review_order_after_cart_contents' ); ?>    
         
         <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

		<?php endif; ?>
        
        <?php do_action( 'woocommerce_review_order_before_order_total' ); ?>
         
         <div class="order__row">
                  <div class="order__item">
					   <?php /*	<button type="button" class="btn order__btn">place order</button> */ ?>
				  </div>
				  <div class="order__item">
					   <div class="font-lg"><?php wc_cart_totals_order_total_html(); ?></div>
				  </div>
	     </div>                
         <?php do_action( 'woocommerce_review_order_after_order_total' ); ?>                                
</div>