<?php
	
	$orderId = $_REQUEST['post'];
	$order_post_meta = get_post_meta($orderId);

	echo '<table style="width:100%">
	  <tr>
	    <td>CourierName</td>
	    <td>CourierServiceName</td>		
	    <td>CourierWaybillNo</td>
	    <td>PickupDue</td>
	  </tr>';

		$response_cont = array_map("rtrim", explode("\n", $order_post_meta['shipping_handling'][0]));
		foreach ($response_cont as $rvalue) {
			$fieldvalue = explode(':',$rvalue);
			$changedResponse[$fieldvalue[0]] = $fieldvalue[1];
		}

		echo '<tr>';
		foreach ($changedResponse as $gridvalue) {
			echo '<td>'.$gridvalue.'</td>';
		}
		echo "</tr>";

	echo '</table>';

?>

