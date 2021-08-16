<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_edit_account_form' ); ?>

<?php $user = wp_get_current_user(); ?>

<form  class="woocommerce-EditAccountForm edit-account box box_pa" action="" method="post" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?>>
                                    <?php do_action( 'woocommerce_edit_account_form_start' ); ?>

									<div class="form-block">
										<div class="heading-3 mb-0">Account details</div>
										<div class="form-group">
											<div class="form-group__item">
												<div class="form__label"><?php esc_html_e( 'First name', 'woocommerce' ); ?></div>
												<input type="text" name="account_first_name" id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr( $user->first_name ); ?>">
											</div>

											<div class="form-group__item">
												<div class="form__label"><?php esc_html_e( 'Last name', 'woocommerce' ); ?></div>
												<input type="text"  name="account_last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr( $user->last_name ); ?>">
											</div>		
										</div>

										<div class="form-group">
											<div class="form-group__item">
												<div class="form__label"><?php esc_html_e( 'Email address', 'woocommerce' ); ?></div>
												<input type="text" name="account_email" id="account_email" autocomplete="email" value="<?php echo esc_attr( $user->user_email ); ?>">
											</div>

											<div class="form-group__item">
												<div class="form__label"><?php esc_html_e( 'Phone', THEME_TEXTDOMAIN ); ?></div>
												<input type="text" name="user-phone" id="user-phone" value="<?php echo esc_attr( get_user_meta($user->ID, 'user-phone', true) ); ?>">
											</div>		
										</div>
                                        

										<div>
												<div class="form__label"><?php esc_html_e( 'Company name (Optional)', 'woocommerce' ); ?></div>
												<input type="text" name="billing_company" id="billing_company" value="<?php echo esc_attr( get_user_meta($user->ID, 'billing_company', true) ); ?>">
										</div>	
                                        
									</div>

									<div class="form-block">
										<div class="heading-3 mb-0"><?php esc_html_e( 'Password change', THEME_TEXTDOMAIN ); ?></div>
										<div class="form-group">
											<div class="form-group__item">
												<div class="form__label"><?php esc_html_e( 'Current password', 'woocommerce' ); ?></div>
												<input type="password" placeholder="<?php esc_html_e( 'Enter new password', THEME_TEXTDOMAIN ); ?>" name="password_current" id="password_current" autocomplete="off">
											</div>

											<div class="form-group__item">
												<div class="form__label"><?php esc_html_e( 'New password', 'woocommerce' ); ?></div>
												<input type="password" placeholder="<?php esc_html_e( 'Enter new password agin', THEME_TEXTDOMAIN ); ?>" name="password_1" id="password_1" autocomplete="off">
											</div>		
										</div>

										<div class="form-group">
											<div class="form-group__item">
												<div class="form__label"><?php esc_html_e( 'Confirm new password', 'woocommerce' ); ?></div>
												<input type="password" placeholder="<?php esc_html_e( 'Enter new password agin', THEME_TEXTDOMAIN ); ?>" name="password_2" id="password_2" autocomplete="off" >
											</div>	
										</div>
									</div>
                                    
                                    <?php do_action( 'woocommerce_edit_account_form' ); ?>
                                    
                                    <?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>

									<div class="form-block mt-30">
										<button class="btn account-main__btn" type="submit" name="save_account_details"><?php esc_html_e( 'Save changes', THEME_TEXTDOMAIN ); ?></button>
									</div>
                                    
                                    <input type="hidden" name="action" value="save_account_details" />
                                    
                                    <?php do_action( 'woocommerce_edit_account_form_end' ); ?>
</form>


<?php do_action( 'woocommerce_after_edit_account_form' ); ?>
