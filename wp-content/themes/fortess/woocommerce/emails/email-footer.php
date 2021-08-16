<?php
/**
 * Email Footer
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-footer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
?>


</td>
									</tr>
								</table>
					    </center> 
						</td>
					</tr>
				</table>
				<!-- end content -->


				<!-- start footer -->
				<table bgcolor="#000000" border="0" cellpadding="0" cellspacing="0" width="100%" style="margin:0; padding:0; color:#ffffff;">
					<tr>
						<td valign="top" align="center">
							<center style="width: 600px;">
								<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin:0; padding:0">
									<tr>
										<td align="left" style="padding-left:30px; padding-right:30px;">

											<!-- start footer top -->
											<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin:0; padding:0; border-bottom: 1px solid #595959;">
												<tr>
													<td valign="center" align="left" style="padding-top:34px; padding-bottom:19px;">
														<a href="<?php echo esc_url($url); ?>" style="display: block;" target="_blank">
															<img src="<?php echo get_template_directory_uri(); ?>/images/skyFort-logo.png" alt="" border="0" width="138" height="38" style="display:block;">
														</a>
													</td>
													<td valign="center" align="right" style="padding-top:34px; padding-bottom:19px;">
                                                        <?php $url = get_field('link', 'options-settings');  ?>
                                                        <?php if ($url) : ?>
														<a href="<?php echo esc_url($url); ?>" style="display:inline-block; vertical-align:middle; margin-left:13px;" target="_blank">
															<img src="<?php echo get_template_directory_uri(); ?>/images/link.png" alt="link" border="0" width="31" height="31" style="display:block;">
														</a>
                                                        <?php endif; ?>
                                                        <?php $url = get_field('twitter', 'options-settings');  ?>
                                                        <?php if ($url) : ?>
														<a href="<?php echo esc_url($url); ?>" style="display:inline-block; vertical-align:middle; margin-left:13px;" target="_blank">
															<img src="<?php echo get_template_directory_uri(); ?>/images/twitter.png" alt="twitter" border="0" width="31" height="31" style="display:block;">
														</a>
                                                        <?php endif; ?>
                                                        <?php $url = get_field('instagram', 'options-settings');  ?>
                                                        <?php if ($url) : ?>
														<a href="<?php echo esc_url($url); ?>" style="display:inline-block; vertical-align:middle; margin-left:13px;" target="_blank">
															<img src="<?php echo get_template_directory_uri(); ?>/images/instagram.png" alt="instagram" border="0" width="31" height="31" style="display:block;">
														</a>
                                                        <?php endif; ?>
													</td>
												</tr>
											</table>
											<!-- end footer top -->


											<!-- start footer bottom -->
											<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin:0; padding:0;">
												<tr>
													<td valign="center" align="left" style="padding-top:22px; padding-bottom:41px;">
														<span style="color:#a6a6a6; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:19px; display: block;">
															&copy; 2021 Fortress Artificial Intelligence Inc.
														</span>
													</td>
													<td valign="center" align="right" style="padding-top:22px; padding-bottom:41px;">
														<a href="#" style="display: inline-block; vertical-align:middle; margin-left:37px;" target="_blank">
															<span style="color:#ffffff; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:19px; font-weight:bold; display: block; text-decoration:underline;">
																Unsubscribe
															</span>
														</a>
														<a href="#" style="display: inline-block; vertical-align:middle; margin-left:37px;" target="_blank">
															<span style="color:#ffffff; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:19px; font-weight:bold; display: block; text-decoration:underline;">
																Privacy Policy
															</span>
														</a>
													</td>
												</tr>
											</table>
											<!-- end footer bottom -->
										</td>
									</tr>
								</table>
							</center>
						</td>
					</tr>
				</table>
				<!-- end footer -->
			</td>
		</tr>
	</table>
</body>
</html>