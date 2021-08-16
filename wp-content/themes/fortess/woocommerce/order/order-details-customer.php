<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.4
 */

defined( 'ABSPATH' ) || exit;

$show_shipping = ! wc_ship_to_billing_address_only() && $order->needs_shipping_address();
?>


<div class="account-grid">
										<div class="account-grid__item">
											<div class="account-edit">
												<div class="account-edit__item">
													<div class="font-lg"><?php esc_html_e( 'Billing address', 'woocommerce' ); ?></div>
												</div>
											</div>

											<div class="account-info">
                                                <?php if ( $order->get_billing_first_name() || $order->get_billing_last_name()) : ?>
                                                 
                                                 <div class="account-info__row">
													<div class="account-info__item">
														<div class="account-info__caption"><?php esc_html_e( 'Name', THEME_TEXTDOMAIN ); ?></div>
													</div>
													<div class="account-info__item"><?php echo esc_html( $order->get_billing_first_name() ); ?> <?php echo esc_html( $order->get_billing_last_name() ); ?></div>
												</div>
                                                
                                                <?php endif; ?>
          
                                                <?php if ( $order->get_billing_company() ) : ?>

												<div class="account-info__row">
													<div class="account-info__item">
														<div class="account-info__caption"><?php esc_html_e( 'Company', THEME_TEXTDOMAIN ); ?></div>
													</div>
													<div class="account-info__item"><?php echo esc_html($order->get_billing_company() ); ?> </div>
												</div>
                                                
                                                <?php endif; ?>

                                                <?php if ( $order->get_billing_address_1() || $order->get_billing_address_2()) : ?>

												<div class="account-info__row">
													<div class="account-info__item">
														<div class="account-info__caption"><?php esc_html_e( 'Address', THEME_TEXTDOMAIN ); ?></div>
													</div>
													<div class="account-info__item"><?php echo esc_html($order->get_billing_address_1() ); ?> <?php echo esc_html($order->get_billing_address_2()) ; ?></div>
												</div>
                                                
                                                <?php endif; ?>
                                                
                                                <?php if ($order -> get_billing_city() || $order -> get_billing_country() || $order -> get_billing_postcode()) : ?>
												<div class="account-info__row">
													<div class="account-info__item">
														<div class="account-info__caption"><?php esc_html_e( 'ZIP code', THEME_TEXTDOMAIN ); ?></div>
													</div>
													<div class="account-info__item"><?php echo $order -> get_billing_city(); ?>, <?php echo $order -> get_billing_country(); ?> <?php echo $order -> get_billing_postcode(); ?></div>
												</div>
                                                
                                                <?php endif; ?>
											</div>
										</div>
                                        

										<div class="account-grid__item">
											<div class="account-edit">
												<div class="account-edit__item">
													<div class="font-lg"><?php esc_html_e( 'Shipping address', 'woocommerce' ); ?></div>
												</div>
											</div>

											<div class="account-info">
												<?php if ( $order->get_shipping_first_name() || $order->get_shipping_last_name()) : ?>
                                                 
                                                 <div class="account-info__row">
													<div class="account-info__item">
														<div class="account-info__caption"><?php esc_html_e( 'Name', THEME_TEXTDOMAIN ); ?></div>
													</div>
													<div class="account-info__item"><?php echo esc_html( $order->get_shipping_first_name() ); ?> <?php echo esc_html( $order->get_shipping_last_name() ); ?></div>
												</div>
                                                
                                                 <?php endif; ?>
          
                                                <?php if ( $order->get_shipping_company() ) : ?>

												<div class="account-info__row">
													<div class="account-info__item">
														<div class="account-info__caption"><?php esc_html_e( 'Company', THEME_TEXTDOMAIN ); ?></div>
													</div>
													<div class="account-info__item"><?php echo esc_html($order->get_shipping_company() ); ?> </div>
												</div>
                                                
                                                <?php endif; ?>

                                                <?php if ( $order->get_shipping_address_1() || $order->get_shipping_address_2()) : ?>

												<div class="account-info__row">
													<div class="account-info__item">
														<div class="account-info__caption"><?php esc_html_e( 'Address', THEME_TEXTDOMAIN ); ?></div>
													</div>
													<div class="account-info__item"><?php echo esc_html($order->get_shipping_address_1() ); ?> <?php echo esc_html($order->get_shipping_address_2()); ?></div>
												</div>
                                                
                                                <?php endif; ?>
                                                
                                                <?php if ($order -> get_shipping_city() || $order -> get_shipping_country() || $order -> get_shipping_postcode()) : ?>
												<div class="account-info__row">
													<div class="account-info__item">
														<div class="account-info__caption"><?php esc_html_e( 'ZIP code', THEME_TEXTDOMAIN ); ?></div>
													</div>
													<div class="account-info__item"><?php echo $order -> get_shipping_city(); ?>, <?php echo $order -> get_shipping_country(); ?> <?php echo $order -> get_shipping_postcode(); ?></div>
												</div>
                                                
                                                <?php endif; ?>
											</div>
										</div>

</div>

<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>