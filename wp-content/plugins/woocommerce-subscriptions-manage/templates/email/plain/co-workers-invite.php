<?php if(!defined('ABSPATH')) return; ?>    

<?php 
echo "=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n";
echo esc_html( wp_strip_all_tags( $email_heading ) );
echo "\n=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n\n";
?>

<?php esc_html_e( 'Hello',WOOCOMMERCE_SUBCRIPTIONS_MANAGE_TEXTDOMAIN ); ?>.

<?php esc_html_e( 'Registration invitation link ', WOOCOMMERCE_SUBCRIPTIONS_MANAGE_TEXTDOMAIN ); ?> <?php echo $coworker_ref_link; ?>

<?php
/**
 * Show user-defined additional content - this is set in each email's settings.
 */
if ( $additional_content ) {
	echo esc_html( wp_strip_all_tags( wptexturize( $additional_content ) ) );
	echo "\n\n----------------------------------------\n\n";
}

echo wp_kses_post( apply_filters( 'woocommerce_email_footer_text', get_option( 'woocommerce_email_footer_text' ) ) );