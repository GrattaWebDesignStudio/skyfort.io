<?php
/**
 * Email Header
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-header.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 4.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>">
	<title><?php echo get_bloginfo( 'name', 'display' ); ?></title>

	<style type="text/css">
		body {width: 100%; background-color: #03091e; color: #ffffff; margin:0; padding:0; -webkit-font-smoothing: antialiased;}
	</style>
</head>
<body <?php echo is_rtl() ? 'rightmargin' : 'leftmargin'; ?>="0">
	<table bgcolor="#03091e" border="0" cellpadding="0" cellspacing="0" width="100%" style="margin:0; padding:0; color:#ffffff;">
		<tr>
			<td width="100%" height="100%">

				<!-- start content -->
				<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin:0; padding:0">
					<tr>
						<td align="center" style="padding-bottom: 40px;">
							<center style="width: 600px;">
						        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin:0; padding:0">
									<tr>
										<td>
											<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin:0; padding:0">
												<tr>
													<td valign="top" align="center" style="padding-top:28px; padding-bottom:28px;">
														<a href="<?php echo site_url('/'); ?>" style="display: block;"  target="_blank">
															<img src="<?php echo get_template_directory_uri(); ?>/images/skyFort-logo.png" alt="" border="0" width="153" height="44" style="display:block;">
														</a>
													</td>
												</tr>
											</table>