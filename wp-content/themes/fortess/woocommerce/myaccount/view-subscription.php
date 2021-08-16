<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="account-main__content">
    <div class="box box_pa">
<?php

wc_print_notices();

/**
 * Gets subscription details table template
 * @param WC_Subscription $subscription A subscription object
 * @since 2.2.19
 */
do_action( 'woocommerce_subscription_details_table', $subscription );

/**
 * Gets subscription totals table template
 * @param WC_Subscription $subscription A subscription object
 * @since 2.2.19
 */
do_action( 'woocommerce_subscription_totals_table', $subscription );

do_action( 'woocommerce_subscription_details_after_subscription_table', $subscription );

wc_get_template( 'order/order-details-customer.php', array( 'order' => $subscription ) );
?>
    </div>
</div>