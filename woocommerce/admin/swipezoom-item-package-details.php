<?php
	
	$orderId = $_REQUEST['post'];
	$order_post_meta = get_post_meta($orderId);

	foreach ($order_post_meta as $key => $value) {
		if("package_" == substr($key,0,8)){
		   $package_details[] = $key; 
		}
	}

	$changedResponse = array();
	
	foreach ($package_details as $key => $value) {
		$response[$value] = $order_post_meta[$value][0];
	}

	echo '<table style="width:100%">
	  <tr>
	    <td>ProductCode</td>
	    <td>Quantity</td>		
	    <td>BoxNo</td>
	    <td>BoxCode</td>
	  </tr>';

	foreach ($response as $key => $value) {
			
		$response_cont = array_map("rtrim", explode("\n", $value));
		foreach ($response_cont as $rvalue) {
			$fieldvalue = explode(':',$rvalue);
			$changedResponse[$key][$fieldvalue[0]] = $fieldvalue[1];
		}

		echo '<tr>';
		foreach ($changedResponse[$key] as $gridvalue) {
			echo '<td>'.$gridvalue.'</td>';
		}
		echo "</tr>";

	}

	echo '</table>';

	
?>

