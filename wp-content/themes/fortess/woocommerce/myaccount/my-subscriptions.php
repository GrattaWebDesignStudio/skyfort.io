<?php
/**
 * My Subscriptions section on the My Account page
 *
 * @author   Prospress
 * @category WooCommerce Subscriptions/Templates
 * @version  2.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<?php if ( ! empty( $subscriptions ) ) : ?>

                        <div class="account-main__content">
                          <div class="table">
									<div class="table__row table__caption table__hide">
       
                                        <div class="table__cell woocommerce-orders-table__header-subscription-id">
                                            <div class="color-opacity"><?php esc_html_e( 'Subscription', 'woocommerce-subscriptions' ); ?></div>
										</div>
			                            <div class="table__cell woocommerce-orders-table__header-subscription-status"><div class="color-opacity"><?php esc_html_e( 'Status', 'woocommerce-subscriptions' ); ?></div>
										</div>
			                            <div class="table__cell woocommerce-orders-table__header-subscription-next-payment"><div class="color-opacity"><?php echo esc_html_x( 'Next payment', 'table heading', 'woocommerce-subscriptions' ); ?></div>
										</div>
			                           <div class="table__cell woocommerce-orders-table__header-subscription-total"><div class="color-opacity"><?php echo esc_html_x( 'Total', 'table heading', 'woocommerce-subscriptions' ); ?></div>
								       </div>
			                           <div class="table__cell woocommerce-orders-table__header-subscription-actions"><div class="color-opacity"><?php esc_html_e( 'Actions', 'woocommerce-subscriptions' ); ?></div>
										</div>
                                        
									</div>
                                    
                                    <?php foreach ( $subscriptions as $subscription_id => $subscription ) : ?>
									<div class="table__row">
                                    
                                        <div class="table__cell">
                                            <div class="table__group">
												                    <div class="table__num" data-label="<?php esc_attr_e( 'ID', 'woocommerce-subscriptions' ); ?>"><?php echo esc_html( _x( '#', 'hash before order number', 'woocommerce' ) . $subscription->get_order_number() ); ?></div>
											                 	    <div class="table__btn">
													                       <a href="<?php echo esc_url( $subscription->get_view_order_url() ); ?>" class="btn btn_outline btn_sm"><?php esc_html_e( 'view', THEME_TEXTDOMAIN ); ?></a>
											
                                            	                    </div>
                                            </div>
										</div>
              
                                        <div class="table__cell">
											<div class="table__content" data-label="<?php esc_attr_e( 'Status', 'woocommerce-subscriptions' ); ?>">
                                                <?php echo esc_attr( wcs_get_subscription_status_name( $subscription->get_status() ) ); ?>
                                            </div>
										</div>
                                        
                                        <div class="table__cell">
											<div class="table__content" data-label="<?php echo esc_attr_x( 'Next Payment', 'table heading', 'woocommerce-subscriptions' ); ?>">
                                                <?php echo esc_attr( $subscription->get_date_to_display( 'next_payment' ) ); ?>
				                                <?php if ( ! $subscription->is_manual() && $subscription->has_status( 'active' ) && $subscription->get_time( 'next_payment' ) > 0 ) : ?>
			                                 	<br/><small><?php echo esc_attr( $subscription->get_payment_method_to_display( 'customer' ) ); ?></small>
				                                <?php endif; ?>
                                            </div>
										</div>
                                        
                                        <div class="table__cell">
											<div class="table__content" data-label="<?php echo esc_attr_x( 'Total', 'Used in data attribute. Escaped', 'woocommerce-subscriptions' ); ?>">
                                            
                                                	<?php echo wp_kses_post( $subscription->get_formatted_order_total() ); ?>
                                            </div>
										</div>
                                        
                                        <div class="table__cell">
											<div class="table__content" data-label="<?php echo esc_attr_x( 'Total', 'Used in data attribute. Escaped', 'woocommerce-subscriptions' ); ?>">
                                                <a href="<?php echo esc_url( $subscription->get_view_order_url() ) ?>" class="woocommerce-button button view"><?php echo esc_html_x( 'View', 'view a subscription', 'woocommerce-subscriptions' ); ?></a>
				                                <?php do_action( 'woocommerce_my_subscriptions_actions', $subscription ); ?>
                                            </div>
										</div>
                                      </div>
					                  <?php endforeach; ?>
                            </div>
						</div>
		<?php if ( 1 < $max_num_pages ) : ?>
			<div class="woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination">
			<?php if ( 1 !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button" href="<?php echo esc_url( wc_get_endpoint_url( 'subscriptions', $current_page - 1 ) ); ?>"><?php esc_html_e( 'Previous', 'woocommerce-subscriptions' ); ?></a>
			<?php endif; ?>

			<?php if ( intval( $max_num_pages ) !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--next woocommerce-Button woocommerce-Button--next button" href="<?php echo esc_url( wc_get_endpoint_url( 'subscriptions', $current_page + 1 ) ); ?>"><?php esc_html_e( 'Next', 'woocommerce-subscriptions' ); ?></a>
			<?php endif; ?>
			</div>
		<?php endif; ?>
<?php else : ?>
		<p class="no_subscriptions woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
			<?php if ( 1 < $current_page ) :
				printf( esc_html__( 'You have reached the end of subscriptions. Go to the %sfirst page%s.', 'woocommerce-subscriptions' ), '<a href="' . esc_url( wc_get_endpoint_url( 'subscriptions', 1 ) ) . '">', '</a>' );
			else :
				esc_html_e( 'You have no active subscriptions.', 'woocommerce-subscriptions' );
				?>
				<a class="woocommerce-Button button" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
					<?php esc_html_e( 'Browse products', 'woocommerce-subscriptions' ); ?>
				</a>
			<?php
		endif; ?>
		</p>

<?php endif; ?>