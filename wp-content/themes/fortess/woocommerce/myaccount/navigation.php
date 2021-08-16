<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );
?>

<?php global $wp; ?>

<?php $request = explode( '/', $wp->request ); ?>

<ul class="account-nav">

                                    <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
                                    
                                    <?php if ($endpoint == 'customer-logout') continue; ?>
                                    
									<li class="account-nav__item <?php if (end($request) == $endpoint) { ?>is-current<?php } ?> <?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
										<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>" class="account-nav__link">
                                        
                                            <?php if ($endpoint == 'orders' || $endpoint == 'subscriptions') { ?>
											<span class="account-nav__icon">
												<img src="<?php echo get_stylesheet_directory_uri();?>/assets/img/account-icons/orders.svg" decoding="async" loading="lazy" alt="">
											</span>
                                            <?php } elseif ($endpoint == 'edit-address') { ?>
                                            <span class="account-nav__icon">
												<img src="<?php echo get_stylesheet_directory_uri();?>/assets/img/account-icons/addresses.svg" decoding="async" loading="lazy" alt="">
											</span>
                                            <?php } elseif ($endpoint == 'edit-account' || $endpoint == 'co-workers') { ?>
                                            <span class="account-nav__icon">
												<img src="<?php echo get_stylesheet_directory_uri();?>/assets/img/account-icons/details.svg" decoding="async" loading="lazy" alt="">
											</span>
                                            <?php } ?>
											<span class="account-nav__txt"><?php echo esc_html( $label ); ?></span>
										</a>
									</li>
                                    
                                    <?php endforeach; ?>
								</ul>

								<div class="account-main__footer account-main__inner">
									<button type="button" class="logout-btn" onclick="window.location.href='<?php echo esc_url( wc_get_account_endpoint_url( 'customer-logout' ) ); ?>'">
										<span class="logout-btn__icon">
											<svg width="40" height="40" viewBox="0 0 40 40">
												<path opacity="0.4" d="M24.1678 11.667C24.1678 12.5875 24.9136 13.3337 25.8337 13.3337C26.7538 13.3337 27.4997 12.5875 27.4997 11.667V10.0003C27.4997 6.31843 24.5162 3.33366 20.8359 3.33366H10.8417C7.16137 3.33366 4.1779 6.31843 4.1779 10.0003V30.0003C4.1779 33.6822 7.16137 36.667 10.8417 36.667H20.8475C24.5278 36.667 27.5112 33.6822 27.5112 30.0003V28.3337C27.5112 27.4132 26.7654 26.667 25.8453 26.667C24.9252 26.667 24.1793 27.4132 24.1793 28.3337V30.0003C24.1793 31.8413 22.6876 33.3337 20.8475 33.3337H10.8417C9.00152 33.3337 7.50978 31.8413 7.50978 30.0003V10.0003C7.50978 8.15937 9.00152 6.66699 10.8417 6.66699H20.8359C22.676 6.66699 24.1678 8.15937 24.1678 10.0003V11.667Z" fill="white"/>
												<rect class="logout-btn__arrow" x="34.1665" y="18.333" width="3.33333" height="20" rx="1" transform="rotate(90 34.1665 18.333)" fill="white"/>
												<path class="logout-btn__arrow" d="M29.6547 16.1788C29.0038 15.528 29.0038 14.4727 29.6547 13.8218C30.3055 13.1709 31.3608 13.1709 32.0117 13.8218L37.0117 18.8218C37.6626 19.4727 37.6626 20.528 37.0117 21.1788L32.0117 26.1788C31.3608 26.8297 30.3055 26.8297 29.6547 26.1788C29.0038 25.528 29.0038 24.4727 29.6547 23.8218L33.4761 20.0003L29.6547 16.1788Z" fill="white"/>
											</svg>
										</span>
										<span class="logout-btn__txt"><?php esc_html_e( 'logout', THEME_TEXTDOMAIN ); ?></span>
									</button>
								</div>	

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
