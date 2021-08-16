<?php
/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
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

defined( 'ABSPATH' ) || exit;

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing'  => __( 'Billing address', 'woocommerce' ),
			'shipping' => __( 'Shipping address', 'woocommerce' ),
		),
		$customer_id
	);
} else {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing' => __( 'Billing address', 'woocommerce' ),
		),
		$customer_id
	);
}

$oldcol = 1;
$col    = 1;
?>

<?php $user = wp_get_current_user(); ?>

<?php $customer = new \WC_Customer( $user->ID ); ?>

<div class="box box_pa">
									<div class="account-grid">
                                    
                                        <?php foreach ( $get_addresses as $name => $address_title ) : ?>
                                        
                                        <?php $getter  = "get_{$name}"; ?>
                                        
                                        <?php $address = $customer->$getter(); ?>
                                        
                                        <?php
		                                   $address_formatted = wc_get_account_formatted_address( $name );
                                        ?>
                                        
										<div class="account-grid__item">
											<div class="account-edit">
												<div class="account-edit__item">
													<div class="font-lg"><?php echo esc_html( $address_title ); ?></div>
												</div>
												<div class="account-edit__item">
													<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', $name ) ); ?>" class="text-styled"><?php esc_html_e( 'edit', THEME_TEXTDOMAIN ); ?></a>
												</div>
											</div>

											<div class="account-info">
                                            
                                                <?php if ($address_formatted) { ?>
                                                
                                                <?php if ($address['first_name'] != '' || $address['last_name'] != '') : ?>
                                            
                                                <div class="account-info__row">
													<div class="account-info__item">
														<div class="account-info__caption"><?php esc_html_e( 'Name', THEME_TEXTDOMAIN ); ?></div>
													</div>
													<div class="account-info__item"><?php echo $address['first_name']; ?> <?php echo $address['last_name']; ?></div>
												</div>
                                                
                                                <?php endif; ?>
                                                
                                                <?php if ($address['company'] != '') : ?>

												<div class="account-info__row">
													<div class="account-info__item">
														<div class="account-info__caption"><?php esc_html_e( 'Company', THEME_TEXTDOMAIN ); ?></div>
													</div>
													<div class="account-info__item"><?php echo $address['company']; ?></div>
												</div>
                                                
                                                <?php endif; ?>
                                                
                                                <?php if ($address['address_1'] != '' || $address['address_2'] != '') : ?>

												<div class="account-info__row">
													<div class="account-info__item">
														<div class="account-info__caption"><?php esc_html_e( 'Address', THEME_TEXTDOMAIN ); ?></div>
													</div>
													<div class="account-info__item"><?php echo $address['address_1']; ?> <?php echo $address['address_2']; ?></div>
												</div>
                                                
                                                <?php endif; ?>
                                                
                                                <?php if ($address['city'] != '' || $address['postcode'] != '') : ?>

												<div class="account-info__row">
													<div class="account-info__item">
														<div class="account-info__caption"><?php esc_html_e( 'ZIP code', THEME_TEXTDOMAIN ); ?></div>
													</div>
													<div class="account-info__item"><?php if ($address['city'] != '') { ?><?php echo $address['city']; ?>, <?php } ?> <?php echo $address['postcode']; ?></div>
												</div>
                                                
                                                <?php endif; ?>
                                                
                                                <?php } else { ?>
                                                
                                                    <div class="account-info__row">
                                                        <?php esc_html_e( 'You have not set up this type of address yet.', 'woocommerce' ); ?>
                                                    </div>
                                                
                                                <?php } ?>
											</div>
										</div>
                                        
                                        <?php endforeach; ?>
									</div>

									<div class="account-note color-opacity">
										<?php esc_html_e( 'This addresses will be used on the checkout page by default.', THEME_TEXTDOMAIN ); ?>
									</div>
</div>