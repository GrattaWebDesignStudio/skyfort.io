<?php
/**
 * Change Subscription's Payment method Page
 *
 * @author   WooCommerce
 * @category WooCommerce Subscriptions/Templates
 * @version  3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<?php do_action( 'woocommerce_subscription_before_actions', $subscription ); ?>

<?php $actions = wcs_get_all_user_actions_for_subscription( $subscription, $subscription->get_user_id() ); ?>

<?php $subscription_total = $subscription->get_order_item_totals(); ?>

<ul class="order_details">
	<li class="order">
		<?php
		// translators: placeholder is the subscription order number wrapped in <strong> tags
		echo wp_kses( sprintf( esc_html__( 'Subscription Number: %s', 'woocommerce-subscriptions' ), '<strong>' . esc_html( $subscription->get_order_number() ) . '</strong>' ), array( 'strong' => true ) );
		?>
	</li>
	<li class="date">
		<?php
		// translators: placeholder is the subscription's next payment date (either human readable or normal date) wrapped in <strong> tags
		echo wp_kses( sprintf( esc_html__( 'Next Payment Date: %s', 'woocommerce-subscriptions' ), '<strong>' . esc_html( $subscription->get_date_to_display( 'next_payment' ) ) . '</strong>' ), array( 'strong' => true ) );
		?>
	</li>
	<li class="total">
        <?php foreach ( $subscription->get_items() as $item ) : ?>
            <?php
		        // translators: placeholder is the formatted total to be paid for the subscription wrapped in <strong> tags
	           	echo wp_kses_post( sprintf( esc_html__( 'Total: %s', 'woocommerce-subscriptions' ), '<strong>' . $subscription->get_formatted_line_subtotal( $item ) . '</strong>' ) );
		      ?>
		<?php endforeach; ?>
        
	</li>
	<?php if ( $subscription->get_payment_method_title() ) : ?>
		<li class="method">
			<?php
			// translators: placeholder is the display name of the payment method
			echo wp_kses( sprintf( esc_html__( 'Payment Method: %s', 'woocommerce-subscriptions' ), '<strong>' . esc_html( $subscription->get_payment_method_to_display() ) . '</strong>' ), array( 'strong' => true ) );
			?>
		</li>
	<?php endif; ?>
</ul>

<?php do_action( 'woocommerce_receipt_' . $subscription->get_payment_method(), $subscription->get_id() ); ?>

        <div class="table__row">
            <div class="table__cell table__hide">
						<div class="table__content">
												<a href="<?php echo wcs_get_early_renewal_url( $subscription ); ?>" class="btn btn_outline btn_sm "><?php echo esc_html( __( 'Pay now', 'woocommerce-subscriptions' ) ); ?></a>
  
						</div>
			</div>
            <div class="table__cell">
											<div class="table__content" data-label="">
                                                
                                            </div>
			</div>
        </div>   

<div class="clear"></div>
