<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.2.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_lost_password_form' );
?>
	<p>{{ apply_filters('woocommerce_lost_password_message', __('Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce')) }}</p>
<x-form-container  title="reset">
<form method="post" class="">
<div class="flex flex-col space-y-2">


	<duv class="space-y-2">
		<x-label for="user_login" text="{{ __('Username or email', 'woocommerce') }}" style="red" />
		<x-input type="text" name="user_login" id="user_login" autocomplete="username" required aria-required="true" />
		<?php do_action( 'woocommerce_lostpassword_form' ); ?>
		<x-input type="hidden" name="wc_reset_password" value="true" />		
		<x-button type="submit" name="login" value="{{ __('Reset password', 'woocommerce') }}" title="{{ __('Reset password', 'woocommerce') }}" />
		<?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>
	</div>
	

	
</div>

</form>
</x-form-container>

<?php
do_action( 'woocommerce_after_lost_password_form' );
