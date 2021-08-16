<?php if(!defined('ABSPATH')) return; ?>    

<?php if ($users_coworkers) : ?> 
             
        <div class="table">
									<div class="table__row table__caption table__hide">
										<div class="table__cell">
											<div class="color-opacity">№</div>
										</div>
										<div class="table__cell">
											<div class="color-opacity"><?php esc_html_e( 'E-mail', THEME_TEXTDOMAIN ); ?>     </div>
										</div>
										<div class="table__cell">
											<div class="color-opacity"><?php esc_html_e( 'Status', THEME_TEXTDOMAIN ); ?>     </div>
										</div>
                                        <div class="table__cell">
											<div class="color-opacity"><?php esc_html_e( 'Date', THEME_TEXTDOMAIN ); ?>     </div>
										</div>
                                        <div class="table__cell">
											<div class="color-opacity"><?php esc_html_e( 'Actions', THEME_TEXTDOMAIN ); ?>     </div>
										</div>
									</div>
                                    
                                    <?php $i = 1; ?>
                                    
                                    <?php foreach ($users_coworkers as $users_coworker) : ?>

									<div class="table__row">
										<div class="table__cell">
                                            <?php echo $i; ?>
										</div>
										<div class="table__cell">
											<div class="table__content" data-label="<?php esc_html_e( 'E-mail', THEME_TEXTDOMAIN ); ?>"><?php echo $users_coworker -> coworker_email; ?></div>
										</div>
										<div class="table__cell">
											<div class="table__content" data-label="<?php esc_html_e( 'Status', THEME_TEXTDOMAIN ); ?>">
                                                <?php if ($users_coworker -> coworker_user_id > 0) { ?>
                                                     <?php esc_html_e( 'Active', THEME_TEXTDOMAIN ); ?>
                                                <?php } else { ?>
                                                     <?php esc_html_e( 'Pending', THEME_TEXTDOMAIN ); ?>
                                                <?php } ?>
                                            </div>
										</div>
                                        <div class="table__cell">
											<div class="table__content" data-label="<?php esc_html_e( 'Registration date', THEME_TEXTDOMAIN ); ?>     ">
                                                <?php if ($users_coworker -> coworker_user_id > 0) { ?>
                                                     <?php echo $users_coworker -> date_registered; ?>
                                                <?php } else { ?>
                                                     <?php esc_html_e( 'Pending', THEME_TEXTDOMAIN ); ?>
                                                <?php } ?>
                                            </div>
										</div>
                                        <div class="table__cell table__hide">
											<div class="table__content">
												<a href="<?php echo wc_get_account_endpoint_url('co-workers')?>?delete_coworkes&email=<?php echo $users_coworker -> coworker_email; ?>" class="btn btn_outline btn_sm"><?php esc_html_e( 'delete', THEME_TEXTDOMAIN ); ?>     </a>
											</div>
										</div>
									</div>
                                    
                                    <?php $i++; ?>
                                    
                                    <?php endforeach; ?>
                                    
	 </div>
     
     <br/>

<?php endif; ?>

    <div class="account-main__content">
								<div class="box box_pa">
									<div class="account-main__top">
										<div class="account-main__top-item">
											<span class="link-main">
												<span class="link-main__txt"><?php esc_html_e( 'Invites', THEME_TEXTDOMAIN ); ?></span>
											</span>
										</div>
									</div>		

									<form action="<?php echo wc_get_account_endpoint_url('co-workers')?>" method="post" id="form-coworkers-invite">
                                    
                                        <input type="hidden" name="action" value="account_coworkers_invite" />
            
                                        <input type="hidden" name="account_coworkers_invite_nonce" value="<?php echo wp_create_nonce('account_coworkers_invite-nonce'); ?>"/>
										<div class="form-block email-invite">
											<div>
												<div class="form__label"><?php esc_html_e( 'E-mail', THEME_TEXTDOMAIN ); ?></div>
												<input type="text" value="" name="emails[]">
											</div>
										</div>
                                        <div class="form-block email-invite">
											<div>
												<div class="form__label"><?php esc_html_e( 'E-mail', THEME_TEXTDOMAIN ); ?></div>
												<input type="text" value="" name="emails[]">
											</div>
										</div>
                                        <div class="form-block mt-30">
                                            <button class="btn coworkers-invite__btn btn-left" type="submit">+</button>  
                                            
                                            <button class="btn account-main__btn btn-right" type="submit"><?php esc_html_e( 'Send', THEME_TEXTDOMAIN ); ?></button>
										</div>
									</form>
								</div>
  </div>