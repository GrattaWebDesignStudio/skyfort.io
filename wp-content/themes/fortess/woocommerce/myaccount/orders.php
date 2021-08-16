<?php
/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_account_orders', $has_orders ); ?>

<?php if ( $has_orders ) : ?>


                                <div class="table">
									<div class="table__row table__caption table__hide">
                                        <?php foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) : ?>
										<div class="table__cell woocommerce-orders-table__header-<?php echo esc_attr( $column_id ); ?>">
											<div class="color-opacity"><?php echo esc_html( $column_name ); ?></div>
										</div>
                                        <?php endforeach; ?>
									</div>
                                    
                                    <?php
			                             foreach ( $customer_orders->orders as $customer_order ) {
			                            	$order      = wc_get_order( $customer_order ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
				                            $item_count = $order->get_item_count() - $order->get_item_count_refunded();
				                    ?>

									<div class="table__row">
                                     <?php foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) : ?>
                                     
                                       <div class="table__cell woocommerce-orders-table__cell-<?php echo esc_attr( $column_id ); ?> <?php if ($column_id == 'order-actions') { ?>table__hide<?php } ?>" data-title="<?php echo esc_attr( $column_name ); ?>"> 
                                     
						                  	    <?php if ( has_action( 'woocommerce_my_account_my_orders_column_' . $column_id ) ) : ?>
							                         	<?php do_action( 'woocommerce_my_account_my_orders_column_' . $column_id, $order ); ?>

						                      	<?php elseif ( 'order-number' === $column_id ) : ?>
                                                
                                                        <div class="table__group">
												                    <div class="table__num" data-label="<?php echo esc_attr( $column_name ); ?>"><?php echo esc_html( _x( '#', 'hash before order number', 'woocommerce' ) . $order->get_order_number() ); ?></div>
											                 	    <div class="table__btn">
													                       <a href="<?php echo esc_url( $order->get_view_order_url() ); ?>" class="btn btn_outline btn_sm"><?php esc_html_e( 'view', THEME_TEXTDOMAIN ); ?></a>
												                    </div>
											             </div>
							                 <?php elseif ( 'order-date' === $column_id ) : ?>
								                    
                                                         <div class="table__content" data-label="<?php echo esc_attr( $column_name ); ?>"><time datetime="<?php echo esc_attr( $order->get_date_created()->date( 'c' ) ); ?>"><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></time></div>

							                 <?php elseif ( 'order-status' === $column_id ) : ?>
							                 	       <div class="table__content" data-label="<?php echo esc_attr( $column_name ); ?>"><?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?></div>

						                    <?php elseif ( 'order-total' === $column_id ) : ?>
                                                <div class="table__content" data-label="<?php echo esc_attr( $column_name ); ?>">
							                 	<?php
								                        echo wp_kses_post( sprintf( _n( '%1$s for %2$s item', '%1$s for %2$s items', $item_count, 'woocommerce' ), $order->get_formatted_order_total(), $item_count ) );
								                ?>
                                                </div>
							                 <?php elseif ( 'order-actions' === $column_id ) : ?>
                                                    <div class="table__content">
								                    <?php
								                        $actions = wc_get_account_orders_actions( $order );

								                        if ( ! empty( $actions ) ) {
									                           foreach ( $actions as $key => $action ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited 
                                                                  if ($key != 'view') continue;
                                                               
                                                               
										                          echo '<a href="' . esc_url( $action['url'] ) . '" class="woocommerce-button button btn btn_outline btn_sm ' . sanitize_html_class( $key ) . '">' . esc_html( $action['name'] ) . '</a>';
									                       }
								                    }
								            ?>
                                                    </div>
							                <?php endif; ?>
						              </div>
					                  <?php endforeach; ?>
									</div>
                                    
                                    <?php } ?>
								</div>
                                
<?php else : ?>
	<div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
		<a class="woocommerce-Button button" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>"><?php esc_html_e( 'Browse products', 'woocommerce' ); ?></a>
		<?php esc_html_e( 'No order has been made yet.', 'woocommerce' ); ?>
	</div>
<?php endif;  ?>

<?php do_action( 'woocommerce_after_account_orders', $has_orders ); ?>
