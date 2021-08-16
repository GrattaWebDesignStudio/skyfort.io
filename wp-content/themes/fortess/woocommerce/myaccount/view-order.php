<?php
/**
 * View Order
 *
 * Shows the details of a particular order on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/view-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

defined( 'ABSPATH' ) || exit;

$notes = $order->get_customer_order_notes();
?>


<div class="box box_pa">
									<div class="account-main__top">
										<div class="account-main__top-item">
											<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>" class="link-main nowrap">
												<span class="link-main__icon">
													<svg width="31" height="31" viewBox="0 0 31 32">
														<path d="M15.4997 28.9168C22.6334 28.9168 28.4163 23.1338 28.4163 16.0002C28.4163 8.86648 22.6334 3.0835 15.4997 3.0835C8.366 3.0835 2.58301 8.86648 2.58301 16.0002C2.58301 23.1338 8.366 28.9168 15.4997 28.9168Z" stroke-width="2.58333" stroke-linecap="round" stroke-linejoin="round"></path>
														<path d="M15.4997 10.8335L10.333 16.0002L15.4997 21.1668" stroke-width="2.58333" stroke-linecap="round" stroke-linejoin="round"></path>
														<path d="M20.6663 16H10.333" stroke-width="2.58333" stroke-linecap="round" stroke-linejoin="round"></path>
													</svg>
												</span>
												<span class="link-main__txt">Order #<?php echo $order->get_order_number(); ?></span>
											</a>
										</div>

										<div class="account-main__top-item">
											<div class="details">
												<div class="details__item">
													<div class="order-time">
														<?php echo wc_format_datetime( $order->get_date_created() ); ?>
													</div>
												</div>
												<div class="details__item">
													<div class="order-status"><?php echo wc_get_order_status_name( $order->get_status() ) ; ?></div>
												</div>
											</div>
										</div>
									</div>
                                    
                                    <?php do_action( 'woocommerce_view_order', $order_id ); ?>

</div>
