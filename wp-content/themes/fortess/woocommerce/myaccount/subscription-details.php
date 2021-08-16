<?php
/**
 * Subscription details table
 *
 * @author  Prospress
 * @package WooCommerce_Subscription/Templates
 * @since 2.2.19
 * @version 2.6.5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<?php do_action( 'woocommerce_subscription_before_actions', $subscription ); ?>

<?php $actions = wcs_get_all_user_actions_for_subscription( $subscription, get_current_user_id() ); ?>

                                        <div class="account-main__top">
										<div class="account-main__top-item">
											<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'subscriptions' ) ); ?>" class="link-main nowrap">
												<span class="link-main__icon">
													<svg width="31" height="31" viewBox="0 0 31 32">
														<path d="M15.4997 28.9168C22.6334 28.9168 28.4163 23.1338 28.4163 16.0002C28.4163 8.86648 22.6334 3.0835 15.4997 3.0835C8.366 3.0835 2.58301 8.86648 2.58301 16.0002C2.58301 23.1338 8.366 28.9168 15.4997 28.9168Z" stroke-width="2.58333" stroke-linecap="round" stroke-linejoin="round"></path>
														<path d="M15.4997 10.8335L10.333 16.0002L15.4997 21.1668" stroke-width="2.58333" stroke-linecap="round" stroke-linejoin="round"></path>
														<path d="M20.6663 16H10.333" stroke-width="2.58333" stroke-linecap="round" stroke-linejoin="round"></path>
													</svg>
												</span>
												<span class="link-main__txt">Subscription #<?php echo $subscription->get_order_number(); ?></span>
											</a>
										</div>

										<div class="account-main__top-item">
											<div class="details">
												<div class="details__item">
													<div class="order-time">
														<?php echo esc_html( $subscription->get_date_to_display( 'start_date'  ) ); ?>
													</div>
												</div>
												<div class="details__item">
													<div class="order-status"><?php echo esc_html( wcs_get_subscription_status_name( $subscription->get_status() ) ); ?></div>
												</div>
											</div>
										</div>
                                        </div>

		<?php do_action( 'wcs_subscription_details_table_before_dates', $subscription ); ?>
        
<div class="table">
        <div class="table__row table__caption table__hide">
       
                                        <div class="table__cell woocommerce-orders-table__header-last_order_date_created">
                                            <div class="color-opacity"><?php esc_html_e( 'Last order date', 'woocommerce-subscriptions' ); ?></div>
										</div>
			                            <div class="table__cell woocommerce-orders-table__header-next_payment"><div class="color-opacity"><?php esc_html_e( 'Next payment date', 'woocommerce-subscriptions' ); ?></div>
										</div>
			                            <div class="table__cell woocommerce-orders-table__header-end"><div class="color-opacity"><?php echo esc_html_x( 'End date', 'table heading', 'woocommerce-subscriptions' ); ?></div>
										</div>
                                        
                                        <div class="table__cell"><div class="color-opacity"></div>
										</div>
                                        
		</div>
        <div class="table__row">
            <div class="table__cell">
											<div class="table__content" data-label="<?php esc_html_e( 'Last order date', 'woocommerce-subscriptions' ); ?>">
                                                <?php echo esc_html( $subscription->get_date_to_display( 'last_order_date_created' ) ); ?>
                                            </div>
			</div>
            <div class="table__cell">
											<div class="table__content" data-label="<?php esc_html_e( 'Next payment date', 'woocommerce-subscriptions' ); ?>">
                                                <?php echo esc_html( $subscription->get_date_to_display( 'next_payment' ) ); ?>
                                            </div>
			</div>
            <div class="table__cell">
											<div class="table__content" data-label="<<?php echo esc_html_x( 'End date', 'table heading', 'woocommerce-subscriptions' ); ?>">
                                                <?php echo esc_html( $subscription->get_date_to_display( 'end'  ) ); ?>
                                            </div>
			</div>
            
            <div class="table__cell">
											<div class="table__content" data-label="">
                                                
                                            </div>
			</div>
        </div>                             
</div>

        <div class="table__row">
	        <?php if ( ! empty( $actions ) ) : ?>
            <?php foreach ( $actions as $key => $action ) : ?>
            <div class="table__cell table__hide">
						<div class="table__content">
												<a href="<?php echo esc_url( $action['url'] ); ?>" class="btn btn_outline btn_sm <?php echo sanitize_html_class( $key ) ?>"><?php echo esc_html( $action['name'] ); ?></a>
  
						</div>
			</div>
            <?php endforeach; ?>
            <div class="table__cell">
											<div class="table__content" data-label="">
                                                
                                            </div>
			</div>
            <?php endif; ?>
        </div>                             