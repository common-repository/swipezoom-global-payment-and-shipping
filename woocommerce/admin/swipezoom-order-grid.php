<?php
	
	$orderId = $_REQUEST['post'];
	$order_post_meta = get_post_meta($orderId);

	$swipezoom_id = $order_post_meta['swipezoom_id'][0];
	$shipping_charges = $order_post_meta['shipping_charges'][0];
	$duties = $order_post_meta['duties'][0];
	$insurance = $order_post_meta['insurance'][0];
	$duties_applied = $order_post_meta['duties_applied'][0];
	$insurance_applied = $order_post_meta['insurance_applied'][0];
	$order_confirmed = $order_post_meta['order_confirmed'][0];

?>


<div class="wc-order-data-row">
	<table class="">
		<tbody>
		<tr>
			<td class="label">Swipezoom Order #</td>
			<td>
				<span><?php echo $swipezoom_id; ?></span></td>
			<td width="1%"></td>
		</tr>
		<tr>
			<td class="label">Shipping Charges :</td>
			<td>
				<span><?php echo $shipping_charges;?></span></td>
			<td width="1%"></td>
		</tr>
		<tr>
			<td class="label">Prepaid duties & taxes :</td>
			<td>
				<span><?php echo $duties; ?></span></td>
			<td width="1%"></td>
		</tr>
		<tr>
			<td class="label">Insurance :</td>
			<td>
				<span><?php echo $insurance; ?></span></td>
			<td width="1%"></td>
		</tr>
		<tr>
			<td class="label">Duties Taxes Prepaid :</td>
			<td>
				<span><?php echo ($duties_applied == "Y") ? "Yes" : "No"; ?></span></td>
			<td width="1%"></td>
		</tr>
		<tr>
			<td class="label">Insurance Paid :</td>
			<td>
				<span><?php echo ($insurance_applied == "Y") ? "Yes" : "No"; ?></span></td>
			<td width="1%"></td>
		</tr>
		<tr>
			<td class="label">Confirmation Call :</td>
			<td>
				<span><?php echo ($order_confirmed==1) ? "Yes" : "No" ?></span></td>
			<td width="1%"></td>
		</tr>
	</tbody></table>
	<div class="clear"></div>
</div>
