<?php
/**
 * Thankyou page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


global $woocommerce;

$swipezoom_config = get_option('woocommerce_swipezoom_internationalshipping_settings',null);

$shippingMethodDetail = $order->get_shipping_methods();

foreach ($shippingMethodDetail as $key => $value) {
	$shippingMethod = $shippingMethodDetail[$key]['method_id'];
}

if(strpos($shippingMethod,"swipezoom") !== FALSE && $swipezoom_config['payment-enabled'] != 'yes') {
	$swipezoomOrderNumber = $woocommerce->session->get('swipezoomOrderNumber');	
	$extraShippingCharges = $woocommerce->session->get('extraShippingCharges');	

	$orderId = $order->id;
	add_post_meta($orderId,'swipezoom_id',$swipezoomOrderNumber,true);
	add_post_meta($orderId,'shipping_charges',$extraShippingCharges["shipping"],true);
	add_post_meta($orderId,'duties',$extraShippingCharges["CustCourierDuties"],true);
	add_post_meta($orderId,'insurance',$extraShippingCharges["CustInsuranceCharges"],true);
	add_post_meta($orderId,'duties_applied',$extraShippingCharges["CustCourierDutiesState"],true);
	add_post_meta($orderId,'insurance_applied',$extraShippingCharges["CustInsuranceChargesState"],true);
	add_post_meta($orderId,'cust_item_subtotal',$extraShippingCharges["CustItemSubtotal"],true);
	$confirmResponse = swConfirmTransLogisticsRequest($shippingMethod,$swipezoomOrderNumber,$orderId);

	if($confirmResponse[0] == "000") {
		add_post_meta($orderId,'order_confirmed',1,true);
	} else {
		add_post_meta($orderId,'order_confirmed',0,true);
		add_post_meta($orderId,'order_confirmation_error',$confirmResponse[1],true);
	}

	$paymentMethod = get_post_meta($orderId, '_payment_method', true);

}

WC()->session->__unset('extraShippingCharges');
WC()->session->__unset('swipezoomOrderNumber');
WC()->session->__unset('fingerprint');
WC()->session->__unset('TransLogisticsReq');
WC()->session->__unset('TransLogisticsReqData');
WC()->session->__unset('swipezoomTitle');

if ( $order ) : ?>

	<?php if ( $order->has_status( 'failed' ) ) : ?>

		<p><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction.', 'woocommerce' ); ?></p>

		<p><?php
			if ( is_user_logged_in() )
				_e( 'Please attempt your purchase again or go to your account page.', 'woocommerce' );
			else
				_e( 'Please attempt your purchase again.', 'woocommerce' );
		?></p>

		<p>
			<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', 'woocommerce' ) ?></a>
			<?php if ( is_user_logged_in() ) : ?>
			<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php _e( 'My Account', 'woocommerce' ); ?></a>
			<?php endif; ?>
		</p>

	<?php else : ?>

		<p><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), $order ); ?></p>

		<ul class="order_details">
			<li class="order">
				<?php _e( 'Order Number:', 'woocommerce' ); ?>
				<strong><?php echo $order->get_order_number(); ?></strong>
			</li>
			<li class="date">
				<?php _e( 'Date:', 'woocommerce' ); ?>
				<strong><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></strong>
			</li>
			<li class="total">
				<?php _e( 'Total:', 'woocommerce' ); ?>
				<strong><?php echo $order->get_formatted_order_total(); ?></strong>
			</li>
			<?php if ( $order->payment_method_title ) : ?>
			<li class="method">
				<?php _e( 'Payment Method:', 'woocommerce' ); ?>
				<strong><?php echo $order->payment_method_title; ?></strong>
			</li>
			<?php endif; ?>
		</ul>
		<div class="clear"></div>

	<?php endif; ?>

	<?php do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?>
	<?php do_action( 'woocommerce_thankyou', $order->id ); ?>

<?php else : ?>

	<p><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), null ); ?></p>

<?php endif; ?>
