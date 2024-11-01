<?php
/**
 * Shipping Methods Display
 *
 * In 2.1 we show methods per package. This allows for multiple methods per order if so desired.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */



if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<tr class="shipping">
	<th><?php
		if ( $show_package_details ) {
			printf( __( 'Shipping #%d', 'woocommerce' ), $index + 1 );
		} else {
			_e( 'Shipping', 'woocommerce' );
		}
	?></th>
	<td style='background:#f4f4f4'>
		<?php
		global $woocommerce;
				
		 if ( ! empty( $available_methods ) ) : ?>

			<?php if ( 1 === count( $available_methods ) ) :
				$method = current( $available_methods );

				if($method->id == "swipezoom_internationalshipping") { ?>
						<?php global $woocommerce; $ExtraRates = $woocommerce->session->get('extraShippingCharges'); ?>
							<li>
								<?php echo wp_kses_post( wc_cart_totals_shipping_method_label( $method ) ); ?>
								<input type="hidden" name="shipping_method[<?php echo $index; ?>]" data-index="<?php echo $index; ?>" id="shipping_method_<?php echo $index; ?>" value="<?php echo esc_attr( $method->id ); ?>" class="shipping_method" />

									<?php if($ExtraRates['PrepaidDutiesAllowed'] == 'Y') { ?>
                                    <li>
                                        <input type="checkbox" value="<?php echo $ExtraRates["CustCourierDuties"] ?>" id="duties" <?php echo ($ExtraRates["CustCourierDuties"] > 0 )? "": "disabled";  ?> <?php echo ($ExtraRates["CustCourierDutiesState"] == "Y" && $ExtraRates["CustCourierDuties"] > 0) ? "checked='true'": "";  ?> name="swipezoom" class="checkbox duties-checkbox" >
                                        <label for="swipezoom_duty_taxes" style='font-size: 11px;font-weight: normal;'><?php echo "Prepaid duties & taxes"; ?>

                                            <a href="#" id="tool-tip-duties" class="tool-tip-anchor tool-tip-duties" >
                                                <img src="<?php echo plugins_url( '/assets/images/que.png', __FILE__ ); ?>" title="<?php echo 'For your convenience, we provide you the option to pre-pay Duties and Taxes. If you choose to pre-pay such Duties and Taxes, you may avoid customs delays and we guarantee that you will not be required to pay anything upon arrival of your shipment. If you do not choose the option to prepay the Duties and Taxes, you will be responsible for paying all Duties, Taxes and any related charges that may be due upon delivery. Duties and Taxes are calculated and charged as per the rules and regulations of the customs authority in your country.'; ?>" class="fadeeffect" style='padding:1.2px;max-width:30px;display:inline;'/></a>
                                            <?php (!empty($ExtraRates["CustCourierDuties"]))?$dutiesRate = $ExtraRates["CustCourierDuties"]: $dutiesRate = "N/A";?> </label>
                                            &nbsp;&nbsp;&nbsp;<span class="price-notice"><span class="price" style="font-size:12.5px;margin-left:32px"><?php echo ($ExtraRates["CustCourierDuties"] > 0 )? get_woocommerce_currency_symbol().$ExtraRates["CustCourierDuties"]: "N/A";  ?> </span></span>

                                        <p id="alert-content-duties" class="alert-content-duties" style="display: none;"><?php echo 'You have chosen to NOT prepay duties & taxes for this order and therefore will be responsible to pay these charges at the time of delivery.';  ?>
                                        </p>
                                    </li>
                                    <?php } ?>
                                    <?php  if($ExtraRates["CustInsuranceCharges"] > 0) { ?>
                                    <li>
                                        <input type="checkbox" value="<?php echo $ExtraRates["CustInsuranceCharges"] ?>" <?php echo ($ExtraRates["CustInsuranceCharges"] > 0 )? "": "disabled";  ?>  <?php echo ($ExtraRates["CustInsuranceChargesState"] == "Y" && $ExtraRates["CustInsuranceCharges"] > 0 )? "checked='true'": "";  ?>  id="insurance" name="swipezoom" class="checkbox">
                                        <label for="swipezoom_insurance" style='font-size: 11px;font-weight: normal;'><?php echo "Insurance"; ?>

                                            <a href="#" id="tool-tip-insurance" class="tool-tip-anchor tool-tip-insurance" >
                                                <img src="<?php echo plugins_url( '/assets/images/que.png', __FILE__ ); ?>" title="<?php echo "If you wish to insure your shipment against damage or loss during transit, you may purchase shipment insurance by selecting this option. In the event of loss or damage during transit, you will be reimbursed the value of the goods and shipping costs only. you will not be reimbursed amounts paid towards customs duties or taxes. If insurance is not purchased, your shipment will not be covered for loss or damage during transit."; ?>" class="fadeeffect" style='padding:1.2px;max-width:30px;display:inline;'/></a>
                                            <?php (!empty($ExtraRates["CustInsuranceCharges"]))?$insuranceRate = $ExtraRates["CustInsuranceCharges"]: $insuranceRate = "N/A";?>
                                           </label>
                                            &nbsp;&nbsp;&nbsp;<span class="price-notice"><span class="price" style="font-size:12.5px;margin-left:92px"><?php echo ($ExtraRates["CustInsuranceCharges"] > 0 )? get_woocommerce_currency_symbol().$ExtraRates["CustInsuranceCharges"]: "N/A";  ?> </span></span>
                                    </li>
                                    <?php  } ?>
                                
							</li>
						<?php } else { 
							echo wp_kses_post( wc_cart_totals_shipping_method_label( $method ) ); ?>
							<input type="hidden" name="shipping_method[<?php echo $index; ?>]" data-index="<?php echo $index; ?>" id="shipping_method_<?php echo $index; ?>" value="<?php echo esc_attr( $method->id ); ?>" class="shipping_method" />
						<?php } 

				
			 elseif ( get_option( 'woocommerce_shipping_method_format' ) === 'select' ) : ?>

				<select name="shipping_method[<?php echo $index; ?>]" data-index="<?php echo $index; ?>" id="shipping_method_<?php echo $index; ?>" class="shipping_method">
					<?php foreach ( $available_methods as $method ) : ?>
						<option value="<?php echo esc_attr( $method->id ); ?>" <?php selected( $method->id, $chosen_method ); ?>><?php echo wp_kses_post( wc_cart_totals_shipping_method_label( $method ) ); ?></option>
					<?php endforeach; ?>
				</select>

			<?php else : ?>

				<ul id="shipping_method">
					<?php foreach ( $available_methods as $method ) : ?>
						<?php if($method->id == "swipezoom_internationalshipping") { ?>
						<?php global $woocommerce; $ExtraRates = $woocommerce->session->get('extraShippingCharges'); ?>
							<li>
								<input type="radio" name="shipping_method[<?php echo $index; ?>]" data-index="<?php echo $index; ?>" id="shipping_method_<?php echo $index; ?>_<?php echo sanitize_title( $method->id ); ?>" value="<?php echo esc_attr( $method->id ); ?>" <?php checked( $method->id, $chosen_method ); ?> class="shipping_method" />
								<label for="shipping_method_<?php echo $index; ?>_<?php echo sanitize_title( $method->id ); ?>"><?php echo wp_kses_post( wc_cart_totals_shipping_method_label( $method ) ); ?></label>

									<?php if($ExtraRates['PrepaidDutiesAllowed'] == 'Y') { ?>
                                    <li>
                                        <input type="checkbox" value="<?php echo $ExtraRates["CustCourierDuties"] ?>" id="duties" <?php echo ($ExtraRates["CustCourierDuties"] > 0 )? "": "disabled";  ?> <?php echo ($ExtraRates["CustCourierDutiesState"] == "Y" && $ExtraRates["CustCourierDuties"] > 0) ? "checked='true'": "";  ?> name="swipezoom" class="checkbox duties-checkbox" >
                                        <label for="swipezoom_duty_taxes" style='font-size: 11px;font-weight: normal;'><?php echo "Prepaid duties & taxes"; ?>

                                            <a href="#" id="tool-tip-duties" class="tool-tip-anchor tool-tip-duties" >
                                                <img src="<?php echo plugins_url( '/assets/images/que.png', __FILE__ ); ?>" title="<?php echo 'For your convenience, we provide you the option to pre-pay Duties and Taxes. If you choose to pre-pay such Duties and Taxes, you may avoid customs delays and we guarantee that you will not be required to pay anything upon arrival of your shipment. If you do not choose the option to prepay the Duties and Taxes, you will be responsible for paying all Duties, Taxes and any related charges that may be due upon delivery. Duties and Taxes are calculated and charged as per the rules and regulations of the customs authority in your country.'; ?>" class="fadeeffect" style='padding:1.2px;max-width:30px;display:inline;'/></a>
                                            <?php (!empty($ExtraRates["CustCourierDuties"]))?$dutiesRate = $ExtraRates["CustCourierDuties"]: $dutiesRate = "N/A";?> </label>
                                                &nbsp;&nbsp;&nbsp;<span class="price-notice"><span class="price" style="font-size:12.5px;margin-left:32px"><?php echo ($ExtraRates["CustCourierDuties"] > 0 )? get_woocommerce_currency_symbol().$ExtraRates["CustCourierDuties"]: "N/A";  ?> </span></span>

                                        <p id="alert-content-duties" class="alert-content-duties" style="display: none;"><?php echo 'You have chosen to NOT prepay duties & taxes for this order and therefore will be responsible to pay these charges at the time of delivery.';  ?>
                                        </p>
                                    </li>
                                    <?php } ?>
                                    <?php if($ExtraRates["CustInsuranceCharges"] > 0) { ?>
                                    <li>
                                        <input type="checkbox" value="<?php echo $ExtraRates["CustInsuranceCharges"] ?>" <?php echo ($ExtraRates["CustInsuranceCharges"] > 0 )? "": "disabled";  ?>  <?php echo ($ExtraRates["CustInsuranceChargesState"] == "Y" && $ExtraRates["CustInsuranceCharges"] > 0 )? "checked='true'": "";  ?>  id="insurance" name="swipezoom" class="checkbox">
                                        <label for="swipezoom_insurance" style='font-size: 11px;font-weight: normal;'><?php echo "Insurance"; ?>

                                            <a href="#" id="tool-tip-insurance" class="tool-tip-anchor tool-tip-insurance" >
                                                <img src="<?php echo plugins_url( '/assets/images/que.png', __FILE__ ); ?>" title="<?php echo "If you wish to insure your shipment against damage or loss during transit, you may purchase shipment insurance by selecting this option. In the event of loss or damage during transit, you will be reimbursed the value of the goods and shipping costs only. you will not be reimbursed amounts paid towards customs duties or taxes. If insurance is not purchased, your shipment will not be covered for loss or damage during transit."; ?>" class="fadeeffect" style='padding:1.2px;max-width:30px;display:inline;'/></a>
                                            <?php (!empty($ExtraRates["CustInsuranceCharges"]))?$insuranceRate = $ExtraRates["CustInsuranceCharges"]: $insuranceRate = "N/A";?>
                                           </label>
                                            &nbsp;&nbsp;&nbsp;<span class="price-notice"><span class="price" style="font-size:12.5px;margin-left:92px"><?php echo ($ExtraRates["CustInsuranceCharges"] > 0 )? get_woocommerce_currency_symbol().$ExtraRates["CustInsuranceCharges"]: "N/A";  ?> </span></span>
                                    </li>
                                    <?php } ?>
                                
							</li>
						<?php } else { ?>
							<li>
								<input type="radio" name="shipping_method[<?php echo $index; ?>]" data-index="<?php echo $index; ?>" id="shipping_method_<?php echo $index; ?>_<?php echo sanitize_title( $method->id ); ?>" value="<?php echo esc_attr( $method->id ); ?>" <?php checked( $method->id, $chosen_method ); ?> class="shipping_method" />
								<label for="shipping_method_<?php echo $index; ?>_<?php echo sanitize_title( $method->id ); ?>"><?php echo wp_kses_post( wc_cart_totals_shipping_method_label( $method ) ); ?></label>
							</li>
						<?php } ?>
					<?php endforeach; ?>
				</ul>

			<?php endif; ?>

		<?php elseif ( ! WC()->customer->get_shipping_state() || ! WC()->customer->get_shipping_postcode() ) : ?>

			<?php if ( is_cart() && get_option( 'woocommerce_enable_shipping_calc' ) === 'yes' ) : ?>

				<p><?php _e( 'Please use the shipping calculator to see available shipping methods.', 'woocommerce' ); ?></p>

			<?php elseif ( is_cart() ) : ?>

				<p><?php _e( 'Please continue to the checkout and enter your full address to see if there are any available shipping methods.', 'woocommerce' ); ?></p>

			<?php else : ?>

				<p><?php _e( 'Please fill in your details to see available shipping methods.', 'woocommerce' ); ?></p>

			<?php endif; ?>

		<?php else : ?>

			<?php if ( is_cart() ) : ?>

				<?php echo apply_filters( 'woocommerce_cart_no_shipping_available_html',
					'<p>' . __( 'There are no shipping methods available. Please double check your address, or contact us if you need any help.', 'woocommerce' ) . '</p>'
				); ?>

			<?php else : ?>

				<?php echo apply_filters( 'woocommerce_no_shipping_available_html',
					'<p>' . __( 'There are no shipping methods available. Please double check your address, or contact us if you need any help.', 'woocommerce' ) . '</p>'
				); ?>

			<?php endif; ?>

		<?php endif; ?>

		<?php if ( $show_package_details ) : ?>
			<?php
				foreach ( $package['contents'] as $item_id => $values ) {
					if ( $values['data']->needs_shipping() ) {
						$product_names[] = $values['data']->get_title() . ' &times;' . $values['quantity'];
					}
				}

				echo '<p class="woocommerce-shipping-contents"><small>' . __( 'Shipping', 'woocommerce' ) . ': ' . implode( ', ', $product_names ) . '</small></p>';
			?>
		<?php endif; ?>

		<?php if ( is_cart() ) : ?>
			<?php woocommerce_shipping_calculator(); ?>
		<?php endif; ?>
	</td>
</tr>
