<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;
?>

<?php $fields = $checkout->get_checkout_fields( 'billing' ); ?>

                                <?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

								<div class="form-block">
                                    <div class="heading-3 mb-0">Billing details</div>                 

									<div class="form-group">
                                    
                                        <?php if (isset($fields['billing_first_name'])) : ?>
                                    
										<div class="form-group__item">
										
                                            <?php $fields['billing_first_name']['label'] = 'First name'; ?>
                                            
                                            <?php $fields['billing_first_name']['placeholder'] = 'Enter your first name'; ?>
                                            
                                            <?php $fields['billing_first_name']['label_class'] = array('form__label'); ?>
                                            
                                            <?php woocommerce_form_field( $key = 'billing_first_name', $fields['billing_first_name'], $checkout->get_value( 'billing_first_name' ) ); ?>
                                            
                                            <?php unset($fields['billing_first_name']); ?>
                                            
										</div>
                                        
                                        <?php endif; ?>
                                        
                                        <?php if (isset($fields['billing_last_name'])) : ?>

										<div class="form-group__item">
                                        
                                            <?php $fields['billing_last_name']['label'] = 'Last name'; ?>
                                            
                                            <?php $fields['billing_last_name']['placeholder'] = 'Enter your last name'; ?>
                                            
                                            <?php $fields['billing_last_name']['label_class'] = array('form__label'); ?>
                                            
                                            <?php woocommerce_form_field( $key = 'billing_last_name', $fields['billing_last_name'], $checkout->get_value( 'billing_last_name' ) ); ?>
                                            
                                            <?php unset($fields['billing_last_name']); ?>
										</div>	
                                        
                                        <?php endif; ?>	
									</div>
                                    
                                    <?php if (isset($fields['billing_team_status'])) : ?>
                                    
                                    <div class="form-group__item">
                                    <?php 
                                        woocommerce_form_field($key = 'billing_team_status', $fields['billing_team_status'], $checkout->get_value( 'billing_company' ));
                                    ?>
								    </div>	
                                    
                                    <?php unset($fields['billing_team_status']); ?>
                                    
                                    <?php endif; ?>
                                    
                                    <?php if (isset($fields['billing_company'])) : ?>

									<div class="billing_team_company">
                                    
                                        <?php $fields['billing_company']['label'] = 'Company name'; ?>
                                            
                                        <?php $fields['billing_company']['placeholder'] = 'Enter name of your company'; ?>
                                            
                                        <?php $fields['billing_company']['label_class'] = array('form__label'); ?>
                                            
                                        <?php woocommerce_form_field( $key = 'billing_company', $fields['billing_company'], $checkout->get_value( 'billing_company' ) ); ?>
                                            
                                        <?php unset($fields['billing_company']); ?>
									</div>
                                    
                                    <?php endif; ?>
								</div>
                                
                                <div class="form-block">
									<div class="heading-3 mb-0">Location</div>

									<div class="form-group">

                                        <?php if (isset($fields['billing_country'])) : ?>
                                    
										<div class="form-group__item">
                                        
                                            <?php $fields['billing_country']['label'] = 'Country'; ?>
                                            
                                            <?php $fields['billing_country']['placeholder'] = 'Choose country'; ?>
                                            
                                            <?php $fields['billing_country']['label_class'] = array('form__label'); ?>
                                            
                                            <?php $fields['billing_country']['input_class'] = array('js-select'); ?>
    
                                            <?php woocommerce_form_field( $key = 'billing_country', $fields['billing_country'], $checkout->get_value( 'billing_country' ) ); ?>
                                            
                                            <?php unset($fields['billing_country']); ?>
                                        
										</div>
                                        
                                        <?php endif; ?>
                                        
                                        <?php if (isset($fields['billing_city'])) : ?>

										<div class="form-group__item">
                                        
                                            <?php $fields['billing_city']['label'] = 'Town / City'; ?>
                                            
                                            <?php $fields['billing_city']['placeholder'] = 'Enter your town / city'; ?>
                                            
                                            <?php $fields['billing_city']['label_class'] = array('form__label'); ?>
                                            
                                            <?php woocommerce_form_field( $key = 'billing_city', $fields['billing_city'], $checkout->get_value( 'billing_city' ) ); ?>
                                            
                                            <?php unset($fields['billing_city']); ?>
										</div>	
                                        
                                        <?php endif; ?>		
									</div>
                                    
                                    <?php if (isset($fields['billing_address_1'])) : ?>
									<div>
                                        <?php $fields['billing_address_1']['label'] = 'House number and street name'; ?>
                                            
                                        <?php $fields['billing_address_1']['placeholder'] = 'Enter House number and street'; ?>
                                            
                                        <?php $fields['billing_address_1']['label_class'] = array('form__label'); ?>
                                            
                                        <?php woocommerce_form_field( $key = 'billing_address_1', $fields['billing_address_1'], $checkout->get_value( 'billing_address_1' ) ); ?>
                                            
                                        <?php unset($fields['billing_address_1']); ?>
									</div>
                                    <?php endif; ?>

                                    <?php if (isset($fields['billing_address_2'])) : ?>
									<div>
                                        <?php $fields['billing_address_2']['label'] = 'Apartment, suite, unit etc.'; ?>
                                            
                                        <?php $fields['billing_address_2']['placeholder'] = 'Enter additional info'; ?>
                                            
                                        <?php $fields['billing_address_2']['label_class'] = array('form__label'); ?>
                                            
                                        <?php woocommerce_form_field( $key = 'billing_address_2', $fields['billing_address_2'], $checkout->get_value( 'billing_address_2' ) ); ?>
                                            
                                        <?php unset($fields['billing_address_2']); ?>
									</div>
                                    <?php endif; ?>

									<div class="form-group">
                                        <?php if (isset($fields['billing_state'])) : ?>
                                        
										<div class="form-group__item">
                                        
                                            <?php $fields['billing_state']['label'] = 'State'; ?>
                                            
                                            <?php $fields['billing_state']['placeholder'] = 'Enter your state'; ?>
                                            
                                            <?php $fields['billing_state']['label_class'] = array('form__label'); ?>
                                            
                                            <?php woocommerce_form_field( $key = 'billing_state', $fields['billing_state'], $checkout->get_value( 'billing_state' ) ); ?>
                                            
                                            <?php unset($fields['billing_state']); ?>
										</div>
                                        <?php endif; ?>

                                        <?php if (isset($fields['billing_postcode'])) : ?>
										<div class="form-group__item">
                                        
                                            <?php $fields['billing_postcode']['label'] = 'Postcode'; ?>
                                            
                                            <?php $fields['billing_postcode']['placeholder'] = 'Enter your postcode'; ?>
                                            
                                            <?php $fields['billing_postcode']['label_class'] = array('form__label'); ?>
                                            
                                            <?php woocommerce_form_field( $key = 'billing_postcode', $fields['billing_postcode'], $checkout->get_value( 'billing_postcode' ) ); ?>
                                            
                                            <?php unset($fields['billing_postcode']); ?>
										</div>		
                                        <?php endif; ?>
									</div>
                                    
                                    <?php if ($fields) : ?>
                                        <?php foreach ( $fields as $key => $field ) : ?>
                                            <div>
		                                      <?php	woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
                                            </div>  
	                                    <?php endforeach; ?>
                                    <?php endif; ?>
								</div>
                                
                                <?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
                                
                                <?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
                                
                                <?php if ( ! $checkout->is_registration_required() ) : ?>

			<p class="form-row form-row-wide create-account">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ); ?> type="checkbox" name="createaccount" value="1" /> <span><?php esc_html_e( 'Create an account?', 'woocommerce' ); ?></span>
				</label>
			</p>

		<?php endif; ?>
                                
                                <?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

								<div class="form-block">
									<div class="heading-3 mb-0">Account details</div>
                                    
                                    <?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>

									<div class="form-group">
                                    
                                        <?php foreach (['billing_email', 'billing_phone'] as $field_key) : ?>
                                    
										<div class="form-group__item">
                                            <?php woocommerce_form_field( $field_key, $checkout->get_checkout_fields( 'account' )[$field_key], $checkout->get_value( $field_key ) ); ?>
										</div>
                                        
                                        <?php endforeach; ?>	
									</div>
                                    
									<div class="form-group">
										<?php foreach (['account_password', 'account_password-2'] as $field_key) : ?>
                                    
										<div class="form-group__item">
                                            <?php woocommerce_form_field( $field_key, $checkout->get_checkout_fields( 'account' )[$field_key], $checkout->get_value( $field_key ) ); ?>
										</div>
                                        
                                        <?php endforeach; ?>
									</div>
                                    
                                    <?php endif; ?>
								</div>
                                
                                <?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
                                
                                <?php endif; ?>