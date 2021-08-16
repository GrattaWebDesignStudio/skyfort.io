<?php
/**
 * Edit address form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

$page_title = ( 'billing' === $load_address ) ? esc_html__( 'Billing address', 'woocommerce' ) : esc_html__( 'Shipping address', 'woocommerce' );

do_action( 'woocommerce_before_edit_account_address_form' ); ?>

<?php if ( ! $load_address ) : ?>
	<?php wc_get_template( 'myaccount/my-address.php' ); ?>
<?php else : ?>


<div class="box box_pa">
									<div class="account-main__top">
										<div class="account-main__top-item">
											<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-address' ) ); ?>" class="link-main">
												<span class="link-main__icon">
													<svg width="31" height="31" viewBox="0 0 31 32">
														<path d="M15.4997 28.9168C22.6334 28.9168 28.4163 23.1338 28.4163 16.0002C28.4163 8.86648 22.6334 3.0835 15.4997 3.0835C8.366 3.0835 2.58301 8.86648 2.58301 16.0002C2.58301 23.1338 8.366 28.9168 15.4997 28.9168Z" stroke-width="2.58333" stroke-linecap="round" stroke-linejoin="round"></path>
														<path d="M15.4997 10.8335L10.333 16.0002L15.4997 21.1668" stroke-width="2.58333" stroke-linecap="round" stroke-linejoin="round"></path>
														<path d="M20.6663 16H10.333" stroke-width="2.58333" stroke-linecap="round" stroke-linejoin="round"></path>
													</svg>
												</span>
												<span class="link-main__txt"><?php echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title, $load_address ); ?></span> <?php // @codingStandardsIgnoreLine ?>
											</a>
										</div>
									</div>		

									<form method="post">
                                    
                                        <?php do_action( "woocommerce_before_edit_address_form_{$load_address}" ); ?>
                                    
										<div class="form-block">
											<div class="form-group">
                                            
                                                <?php foreach ([$load_address.'_first_name', $load_address.'_last_name'] as $key) : ?>
                                                
                                                    <?php if (isset($address[$key])) : ?>
                                                    
                                                        <?php $field = $address[$key]; ?>
                                                        
                                                        <div class="form-group__item">
													        <?php woocommerce_form_field( $key, $field, wc_get_post_data_by_key( $key, $field['value'] ) ); ?>
												        </div>
                                                        
                                                        <?php unset($address[$key]); ?>
                                                    
                                                    <?php endif; ?>
                                                
                                                <?php endforeach; ?>	
											</div>
                                            
                                            <?php foreach ([$load_address.'_company'] as $key) : ?>
                                                
                                            <?php if (isset($address[$key])) : ?>
                                                    
                                            <?php $field = $address[$key]; ?>

											<div>
												<?php woocommerce_form_field( $key, $field, wc_get_post_data_by_key( $key, $field['value'] ) ); ?>
											</div>
                                            
                                            <?php unset($address[$key]); ?>
                                                    
                                            <?php endif; ?>
                                                
                                            <?php endforeach; ?>	
										</div>

										<div class="form-block">
											<div class="heading-3 mb-0"><?php esc_html_e( 'Location', THEME_TEXTDOMAIN ); ?></div>

											<div class="form-group">
                                            
                                                <?php foreach ([$load_address.'_country', $load_address.'_city'] as $key) : ?>
                                                
                                                <?php if (isset($address[$key])) : ?>
                                                    
                                                <?php $field = $address[$key]; ?>
                                            
												<div class="form-group__item">
													<?php woocommerce_form_field( $key, $field, wc_get_post_data_by_key( $key, $field['value'] ) ); ?>
												</div>

												<?php unset($address[$key]); ?>
                                                    
                                                <?php endif; ?>
                                                
                                                <?php endforeach; ?>	
											</div>
                                            
                                            <?php foreach ([$load_address.'_address_1', $load_address.'_address_2'] as $key) : ?>
                                                
                                            <?php if (isset($address[$key])) : ?>
                                                    
                                            <?php $field = $address[$key]; ?>

											<div>
												<?php woocommerce_form_field( $key, $field, wc_get_post_data_by_key( $key, $field['value'] ) ); ?>
											</div>

                                            <?php unset($address[$key]); ?>
                                                    
                                            <?php endif; ?>
                                                
                                            <?php endforeach; ?>	

											<div class="form-group">
                                            
                                                <?php foreach ([$load_address.'_state', $load_address.'_postcode'] as $key) : ?>
                                                
                                                <?php if (isset($address[$key])) : ?>
                                                    
                                                <?php $field = $address[$key]; ?>
                                            
												<div class="form-group__item">
													<?php woocommerce_form_field( $key, $field, wc_get_post_data_by_key( $key, $field['value'] ) ); ?>
												</div>
                                                
                                                <?php unset($address[$key]); ?>
                                                    
                                                <?php endif; ?>
                                                
                                                <?php endforeach; ?>		
											</div>
                                            
                                            <?php if (sizeof($address)) : ?>
                                            
                                             <?php foreach ( $address as $key => $field ) { ?>
                                        
                                                <div>
											         <?php woocommerce_form_field( $key, $field, wc_get_post_data_by_key( $key, $field['value'] ) ); ?>
									           </div>
                                        
                                               <?php } ?>
                                               
                                           <?php endif; ?>  
										</div>
                                        
                                        <?php do_action( "woocommerce_after_edit_address_form_{$load_address}" ); ?>

										<div class="form-block mt-30">
											<button class="btn account-main__btn" type="submit" name="save_address"><?php esc_html_e( 'Save changes', THEME_TEXTDOMAIN ); ?></button>
										</div>
                                        
                                        <?php wp_nonce_field( 'woocommerce-edit_address', 'woocommerce-edit-address-nonce' ); ?>
				                        <input type="hidden" name="action" value="edit_address" />
									</form>
								</div>
    
<?php endif; ?>

<?php do_action( 'woocommerce_after_edit_account_address_form' ); ?>
