<?php
/**
 * Woocommerce Overridden Functions 
 */
    // if not logged-in user
    $ajaxCallParam = "nopriv_";

	$swipezoom_config = get_option('woocommerce_swipezoom_internationalshipping_settings',null);

	// iso2 code to iso3 mapping
	$iso2_to_iso3 = '{"BD": "BGD", "BE": "BEL", "BF": "BFA", "BG": "BGR", "BA": "BIH", "BB": "BRB", "WF": "WLF", "BL": "BLM", "BM": "BMU", "BN": "BRN", "BO": "BOL", "BH": "BHR", "BI": "BDI", "BJ": "BEN", "BT": "BTN", "JM": "JAM", "BV": "BVT", "BW": "BWA", "WS": "WSM", "BQ": "BES", "BR": "BRA", "BS": "BHS", "JE": "JEY", "BY": "BLR", "BZ": "BLZ", "RU": "RUS", "RW": "RWA", "RS": "SRB", "TL": "TLS", "RE": "REU", "TM": "TKM", "TJ": "TJK", "RO": "ROU", "TK": "TKL", "GW": "GNB", "GU": "GUM", "GT": "GTM", "GS": "SGS", "GR": "GRC", "GQ": "GNQ", "GP": "GLP", "JP": "JPN", "GY": "GUY", "GG": "GGY", "GF": "GUF", "GE": "GEO", "GD": "GRD", "GB": "GBR", "GA": "GAB", "SV": "SLV", "GN": "GIN", "GM": "GMB", "GL": "GRL", "GI": "GIB", "GH": "GHA", "OM": "OMN", "TN": "TUN", "JO": "JOR", "HR": "HRV", "HT": "HTI", "HU": "HUN", "HK": "HKG", "HN": "HND", "HM": "HMD", "VE": "VEN", "PR": "PRI", "PS": "PSE", "PW": "PLW", "PT": "PRT", "SJ": "SJM", "PY": "PRY", "IQ": "IRQ", "PA": "PAN", "PF": "PYF", "PG": "PNG", "PE": "PER", "PK": "PAK", "PH": "PHL", "PN": "PCN", "PL": "POL", "PM": "SPM", "ZM": "ZMB", "EH": "ESH", "EE": "EST", "EG": "EGY", "ZA": "ZAF", "EC": "ECU", "IT": "ITA", "VN": "VNM", "SB": "SLB", "ET": "ETH", "SO": "SOM", "ZW": "ZWE", "SA": "SAU", "ES": "ESP", "ER": "ERI", "ME": "MNE", "MD": "MDA", "MG": "MDG", "MF": "MAF", "MA": "MAR", "MC": "MCO", "UZ": "UZB", "MM": "MMR", "ML": "MLI", "MO": "MAC", "MN": "MNG", "MH": "MHL", "MK": "MKD", "MU": "MUS", "MT": "MLT", "MW": "MWI", "MV": "MDV", "MQ": "MTQ", "MP": "MNP", "MS": "MSR", "MR": "MRT", "IM": "IMN", "UG": "UGA", "TZ": "TZA", "MY": "MYS", "MX": "MEX", "IL": "ISR", "FR": "FRA", "IO": "IOT", "SH": "SHN", "FI": "FIN", "FJ": "FJI", "FK": "FLK", "FM": "FSM", "FO": "FRO", "NI": "NIC", "NL": "NLD", "NO": "NOR", "NA": "NAM", "VU": "VUT", "NC": "NCL", "NE": "NER", "NF": "NFK", "NG": "NGA", "NZ": "NZL", "NP": "NPL", "NR": "NRU", "NU": "NIU", "CK": "COK", "XK": "XKX", "CI": "CIV", "CH": "CHE", "CO": "COL", "CN": "CHN", "CM": "CMR", "CL": "CHL", "CC": "CCK", "CA": "CAN", "CG": "COG", "CF": "CAF", "CD": "COD", "CZ": "CZE", "CY": "CYP", "CX": "CXR", "CR": "CRI", "CW": "CUW", "CV": "CPV", "CU": "CUB", "SZ": "SWZ", "SY": "SYR", "SX": "SXM", "KG": "KGZ", "KE": "KEN", "SS": "SSD", "SR": "SUR", "KI": "KIR", "KH": "KHM", "KN": "KNA", "KM": "COM", "ST": "STP", "SK": "SVK", "KR": "KOR", "SI": "SVN", "KP": "PRK", "KW": "KWT", "SN": "SEN", "SM": "SMR", "SL": "SLE", "SC": "SYC", "KZ": "KAZ", "KY": "CYM", "SG": "SGP", "SE": "SWE", "SD": "SDN", "DO": "DOM", "DM": "DMA", "DJ": "DJI", "DK": "DNK", "VG": "VGB", "DE": "DEU", "YE": "YEM", "DZ": "DZA", "US": "USA", "UY": "URY", "YT": "MYT", "UM": "UMI", "LB": "LBN", "LC": "LCA", "LA": "LAO", "TV": "TUV", "TW": "TWN", "TT": "TTO", "TR": "TUR", "LK": "LKA", "LI": "LIE", "LV": "LVA", "TO": "TON", "LT": "LTU", "LU": "LUX", "LR": "LBR", "LS": "LSO", "TH": "THA", "TF": "ATF", "TG": "TGO", "TD": "TCD", "TC": "TCA", "LY": "LBY", "VA": "VAT", "VC": "VCT", "AE": "ARE", "AD": "AND", "AG": "ATG", "AF": "AFG", "AI": "AIA", "VI": "VIR", "IS": "ISL", "IR": "IRN", "AM": "ARM", "AL": "ALB", "AO": "AGO", "AQ": "ATA", "AS": "ASM", "AR": "ARG", "AU": "AUS", "AT": "AUT", "AW": "ABW", "IN": "IND", "AX": "ALA", "AZ": "AZE", "IE": "IRL", "ID": "IDN", "UA": "UKR", "QA": "QAT", "MZ": "MOZ"}';

	if (!function_exists('write_log')) {
	  /**
		* Function to write to log file
		*/  	
      function write_log ( $log )  {
      	global $swipezoom_config;
      	if($swipezoom_config['debug-enabled'] == "yes"){
	        if ( is_array( $log ) || is_object( $log ) ) {
	            error_log( print_r( $log, true ) );
	        } else {
	            error_log( $log );
	        }
        }
      }
    }
	

	add_action('wp_enqueue_scripts','swCustomJsLoad');

	/**
	  * Custom JS files loaded
	  */
	function swCustomJsLoad() {

		wp_enqueue_style( 'custom_style_css', plugins_url( 'assets/css/custom-style.css', __FILE__ ));
		$site_url = site_url();
		?>
			<script type='text/javascript'>
				site_url = "<?php echo $site_url; ?>";
			</script>
		<?php
		wp_enqueue_script( 'swCustomJsLoad', plugins_url( 'assets/js/custom.js', __FILE__ ),array('jquery','jquery-ui-autocomplete'));
	    wp_deregister_script('wc-checkout');
	    wp_enqueue_script('wc-checkout', plugins_url('assets/js/frontend/checkout.js',__FILE__), array('jquery', 'woocommerce', 'wc-country-select', 'wc-address-i18n'), null, true);
	}

	add_action( 'wp_enqueue_scripts', 'wsis_dequeue_stylesandscripts_select2', 100 );

	function wsis_dequeue_stylesandscripts_select2() {
	    if ( class_exists( 'woocommerce' ) ) {
	        wp_dequeue_style( 'select2' );
	        wp_deregister_style( 'select2' );

	        wp_dequeue_script( 'select2');
	        wp_deregister_script('select2');

	    } 
	} 

	/**
	  * Swipezoom caller function to get services
	  */
	function swGetCaller(){
		global $swipezoom_config;
		$merchantRefNo = "";

		$callerObj = array("MerchantID" => $swipezoom_config['merchant-id'], "MerchantKey" => $swipezoom_config['merchant-key'],
					        "Version" => "SW0101", "Datetime" => date("Y-m-d h:i:s"), "MerchantRefNo"  => '123');
		return $callerObj;
	}


	/**
	  * Swipezoom create soap client connection
	  */
	function swCreateSoapClientConnection($type = "admin") {
		global $swipezoom_config;

		if($type=="admin") { // if admin side
			
			$wsdl = plugins_url( 'etc/WsWsdl/GecaWs.wsdl', __FILE__ );
	        $client = new SoapClient($wsdl, array('trace' => 0, "exceptions" => 0, "cache_wsdl" => 0));
	        $client->__setLocation( $swipezoom_config['admin-url']);

		} else {  // if client side
			$client = new SoapClient($swipezoom_config['url'], array("trace" => 0, "exceptions" => 0, "cache_wsdl" => 0));
		}

		return $client;
	}


	/**
	  *  Swipezoom process checkout functionality
	  */
	add_action('woocommerce_checkout_process', 'swProcessCheckout');
 	
	function swProcessCheckout() {

	    global $woocommerce,$iso2_to_iso3,$swipezoom_config;
		$countrycode_iso3 = ""; 
		$country = "";

		if($_POST["progress_status"] != 1) 
			return;

		$address_type = array("billing","shipping");
		
		// check for swipezoom address labeling for billing and shipping country
		foreach ($address_type as $address_value) {

			$countrycode_iso3 = ""; 
			$country = "";
			
			$current_country = WC()->checkout->get_value($address_value.'_country');
			$check_session = WC()->session->get("AddressLabel_".WC()->checkout->get_value($address_value.'_country')."_".$address_value);

			if(!empty($current_country) && empty($check_session) ) {
				$post_type = $address_value;

				$country = WC()->checkout->get_value($address_value.'_country');

				$lang = explode('-', get_bloginfo('language'));
				$lang = $lang[0];

				$country_codes = json_decode($iso2_to_iso3,true);
				foreach ($country_codes as $key => $value) {
					if($key == $country)
						$countrycode_iso3 = $value;
				}
				
				$ratesRequest = array("Caller" => swGetCaller(),
		            "LanguageCode" => $lang,                                            
		        	"CountryCode" => $countrycode_iso3
				);

				$requestString = serialize($ratesRequest);
				$debugData = array('request' => $ratesRequest);
				try {
					
				    $address_country = WC()->session->get('TransAddressLabeling_'.$countrycode_iso3);

				    if(empty($address_country)) {
						$client = swCreateSoapClientConnection("frontend");

						write_log($ratesRequest);
						$response = $client->TransAddressLabeling($ratesRequest);
						write_log($response);
					} else {
						$response = WC()->session->get('TransAddressLabeling_'.$countrycode_iso3);
					}

					if($response->ResponseStatusCode == '000') {
						WC()->session->set('TransAddressLabeling_'.$countrycode_iso3,$response);						
					}
					
					$chk=json_decode(json_encode($response), true);
					$chk1=$chk['AddressFormats'];
					$chk2=$chk1['AddressFormat'];
					$labelcol = array();
					for($i=0;$i<count($chk2);$i++)
					{
						$labelcol[]=$chk2[$i];
					}

					$debugData['result'] = $response;
				} catch (Exception $e) {
					$debugData['result'] = array('error' => $e->getMessage(), 'code' => $e->getCode());
				}		

				$fieldType = array();

				foreach ($labelcol as $key => $value) {
					$fieldType[] = $value['FieldType'];

					if($value['FieldType'] == 1) {
						WC()->checkout->checkout_fields[$post_type][$post_type."_address_1"]["required"] = ($value['IsMandatory'] == "Y") ? 1 : 0;
						WC()->checkout->checkout_fields[$post_type][$post_type."_address_1"]["label"] = $value['FieldLabel'];
					}
					if($value['FieldType'] == 2) {
						WC()->checkout->checkout_fields[$post_type][$post_type."_address_2"]["required"] = ($value['IsMandatory'] == "Y") ? 1 : 0;
						WC()->checkout->checkout_fields[$post_type][$post_type."_address_2"]["label"] = $value['FieldLabel'];
					}
					if($value['FieldType'] == "C") {
						WC()->checkout->checkout_fields[$post_type][$post_type."_city"]["required"] = ($value['IsMandatory'] == "Y") ? 1 : 0;
						WC()->checkout->checkout_fields[$post_type][$post_type."_city"]["label"] = $value['FieldLabel'];
					}
					if($value['FieldType'] == "D") {
						WC()->checkout->checkout_fields[$post_type][$post_type."_state"]["required"] = ($value['IsMandatory'] == "Y") ? 1 : 0;
						WC()->checkout->checkout_fields[$post_type][$post_type."_state"]["label"] = $value['FieldLabel'];
					}
					if($value['FieldType'] == "P") {
						WC()->checkout->checkout_fields[$post_type][$post_type."_postcode"]["required"] = ($value['IsMandatory'] == "Y") ? 1 : 0;
						WC()->checkout->checkout_fields[$post_type][$post_type."_postcode"]["label"] = $value['FieldLabel'];
					}
				}

				if(!in_array(1, $fieldType)) {
					unset(WC()->checkout->checkout_fields[$post_type][$post_type."_address_1"]);
				}
				if(!in_array(2, $fieldType)) {
					unset(WC()->checkout->checkout_fields[$post_type][$post_type."_address_2"]);
				}
				if(!in_array("C", $fieldType)) {
					unset(WC()->checkout->checkout_fields[$post_type][$post_type."_city"]);
				}
				if(!in_array("D", $fieldType)) {
					unset(WC()->checkout->checkout_fields[$post_type][$post_type."_state"]);

					foreach (WC()->checkout->checkout_fields[$post_type][$post_type."_postcode"]["class"] as $key => $value) {
						if($value == "form-row-last")
							unset(WC()->checkout->checkout_fields[$post_type][$post_type."_postcode"]["class"][$key]);
					}

					WC()->checkout->checkout_fields[$post_type][$post_type."_postcode"]["class"][] = "form-row-wide";
				}
				if(!in_array("P", $fieldType)) {
					unset(WC()->checkout->checkout_fields[$post_type][$post_type."_postcode"]);
				}

				if($response->ResponseStatusCode == "000")
					WC()->session->set("AddressLabel_".WC()->checkout->get_value($address_value.'_country')."_".$address_value,WC()->checkout->checkout_fields[$post_type]);

			}  
			else if ( !empty($check_session) && !empty($current_country) && !empty($address_value)) {
				WC()->checkout->checkout_fields[$address_value] = WC()->session->get("AddressLabel_".WC()->checkout->get_value($address_value.'_country')."_".$address_value);
			}

		}
		// check for swipezoom address validation
		foreach ($address_type as $address_value) {

			$countrycode_iso3 = "";

			if(isset($_POST['ship_to_different_address']) && $address_value == "shipping" || $address_value == "billing") {

				// fetches users billing country
				$country = $_POST[$address_value.'_country'];

				$country_codes = json_decode($iso2_to_iso3,true);
				foreach ($country_codes as $key => $value) {
					if($key == $country)
						$countrycode_iso3 = $value;
				}

			    $country = $countrycode_iso3;
				$type = $value;

				$city = $_POST[$address_value.'_city'];
				$zipcode = $_POST[$address_value.'_postcode'];
				$street1 = $_POST[$address_value.'_address_1'];
				$street2 = $_POST[$address_value.'_address_2'];
				$region = $_POST[$address_value.'_state'];

				$client = swCreateSoapClientConnection("frontend");

				$params = array("Caller" => swGetCaller(),
						        "CountryCode" => "$country" ,                                            
						        "FieldValues" => array(array("FieldType"=>1,"FieldValue"=>"$street1"),
								array("FieldType"=>2,"FieldValue"=>"$street2"),
								array("FieldType"=>"C","FieldValue"=>"$city"),
								array("FieldType"=>"D","FieldValue"=>"$region"),
								array("FieldType"=>"P","FieldValue"=>"$zipcode")));

				write_log($params);
				$response = $client->TransAddressValidation($params);
				write_log($response);
				
				$statuscheck=$response->ResponseStatusCode;
				$ResponseStatusDesc=$response->ResponseStatusDesc;
				if($statuscheck=="000")
				{
				}
				else
				{
					$response1=json_decode(json_encode($response), true);
					$errormessage1=$response1['AddressValidationErrors']['AddressValidationError'];
					if(empty($errormessage1['ErrorDescription']))
					{
						for($i=0;$i<count($errormessage1);$i++)
						{
							if($errormessage1[$i]["AddressLabelType"] == "C")
							{
								wc_add_notice($errormessage1[$i]['ErrorDescription'],'error');
							}
							if($errormessage1[$i]["AddressLabelType"] == "D"){
								wc_add_notice($errormessage1[$i]['ErrorDescription'],'error');
							}
							if($errormessage1[$i]["AddressLabelType"] == "P"){
								wc_add_notice($errormessage1[$i]['ErrorDescription'],'error');
							}
							if($errormessage1[$i]["AddressLabelType"] == "1"){
								wc_add_notice($errormessage1[$i]['ErrorDescription'],'error');
							}
						}
					}
					else
					{
						if($errormessage1["AddressLabelType"] == "C")
						{
							wc_add_notice($errormessage1['ErrorDescription'],'error');
						}
						if($errormessage1["AddressLabelType"] == "D"){
							wc_add_notice($errormessage1['ErrorDescription'],'error');
						}
						if($errormessage1["AddressLabelType"] == "P"){
							wc_add_notice($errormessage1['ErrorDescription'],'error');
						}
						if($errormessage1["AddressLabelType"] == "1"){
							wc_add_notice($errormessage1['ErrorDescription'],'error');
						}
					}
				}

				if(empty($_POST[$address_value.'_first_name']))
					wc_add_notice('Please enter '.ucfirst($address_value).' First Name','error');

				if(empty($_POST[$address_value.'_last_name']))
					wc_add_notice('Please enter '.ucfirst($address_value).' Last Name','error');


				if($address_value == 'billing') {
					if(empty($_POST[$address_value.'_email'])) {
						wc_add_notice('Please enter Email Address','error');
					} else if (!filter_var($_POST[$address_value.'_email'], FILTER_VALIDATE_EMAIL) === true) {
						wc_add_notice('Please enter a valid Email Address','error');
					}
					
					if(empty($_POST[$address_value.'_phone']))
						wc_add_notice('Please enter Phone','error');
				}
			}
		}

		// if some error exists then print those errors
		if ( wc_notice_count('error') != 0 ) {  

			// only print notices if not reloading the checkout, otherwise they're lost in the page reload
			if ( ! isset( $woocommerce->session->reload_checkout ) ) {
				ob_start();
				wc_print_notices();
				$messages = ob_get_clean();
			}

			
			$resultant_array =	array(
					'result'	=> 'failure',
					'messages' 	=> isset( $messages ) ? $messages : '',
					'refresh' 	=> isset( $woocommerce->session->refresh_totals ) ? 'true' : 'false',
					'reload'    => isset( $woocommerce->session->reload_checkout ) ? 'true' : 'false'
				);
			wp_send_json($resultant_array);
			

			unset( $woocommerce->session->refresh_totals, $woocommerce->session->reload_checkout );
			exit;

		} else {

			// if no error exists, then proceed
			if ( wc_notice_count('error') == 0 ) {

					global $iso2_to_iso3,$woocommerce;

					$countrycode_iso3 = $countrycodeship_iso3 = "";
					$lang = explode('-', get_bloginfo('language'));
					$lang = $lang[0];

					// fetches users billing country
					$country = $_POST["billing_country"];
					$country_shipping = $_POST["shipping_country"];

					$country_codes = json_decode($iso2_to_iso3,true);
					foreach ($country_codes as $key => $value) {
						if($key == $country)
							$countrycode_iso3 = $value;

						if($key == $country_shipping)
							$countrycodeship_iso3 = $value;
					}
					
					$sameasShipping = "Y";
					
					$billingArray = array(
				        "Country"=>$countrycode_iso3,
				        "FirstName"=>$_POST['billing_first_name'],
				        "LastName"=>$_POST['billing_last_name'],
				        "AddressLine1"=>$_POST['billing_address_1'],
				        "AddressLine2"=>$_POST['billing_address_2'],
				        "City"=>ucfirst($_POST['billing_city']),
				        "StateDivision"=>$_POST['billing_state'],
				        "PostalCode"=>$_POST['billing_postcode'],
				        "PhoneNumber"=>$_POST['billing_phone'],
				        "Email"=>$_POST['billing_email']
					);
					if(empty($billingArray["AddressLine1"])) unset($billingArray["AddressLine2"]);


					if(isset($_POST['ship_to_different_address'])){

						$sameasShipping = "N";
						$shippingArray = array(
				        "Country"=>$countrycodeship_iso3,
				        "FirstName"=>$_POST['shipping_first_name'],
				        "LastName"=>$_POST['shipping_last_name'],
				        "AddressLine1"=>$_POST['shipping_address_1'],
				        "AddressLine2"=>$_POST['shipping_address_2'],
				        "City"=>ucfirst($_POST['shipping_city']),
				        "StateDivision"=>$_POST['shipping_state'],
				        "PostalCode"=>$_POST['shipping_postcode'],
				        "PhoneNumber"=>$_POST['billing_phone'],
				        "Email"=>$_POST['billing_email']
						);

						if(empty($shippingArray["AddressLine1"])) unset($shippingArray["AddressLine2"]);
					}

					$cart_contents = $woocommerce->cart->get_cart();

					$listItems = array();
					$count = 0;
					$OrderTotalAmount = 0;
					foreach($cart_contents as $key => $quoteItem){
								
								$image_url = '';							
								$product = new WC_Product($quoteItem['product_id']);
							    $SKU = $product->get_sku();

							    $image_id = $product->get_image_id();

							    if(!empty($image_id))
							    	$image_url = wp_get_attachment_url( $image_id );

								$listItems[$count] = array( "ItemId"=> $SKU,
			                    "ItemDescription"=>$quoteItem['data']->post->post_title,
								"ItemQuantity"=>$quoteItem['quantity'],
			                    "ItemPrice"=>$quoteItem['data']->price,
								"ItemTotalAmount"=>$quoteItem['line_total'],
								"ItemImageURL"=>$image_url,
								);

								$OrderTotalAmount += $quoteItem['line_total'];
								$count++;

					}
					$listItems =  array("LineItem"=>$listItems);
					
					$fPrintToEncript = $swipezoom_config['merchant-id'].$swipezoom_config['merchant-key'].get_woocommerce_currency().$OrderTotalAmount.number_format($woocommerce->cart->get_cart_contents_count(),0).'123';
					$fingurePrint = (md5($fPrintToEncript));
					$woocommerce->session->set('fingerprint',$fingurePrint);

					$ratesRequest = array("Caller" => swGetCaller(),
				        "RequestFingerprint" => $fingurePrint,
				        "Order"=>array("OrderAmount"=>$OrderTotalAmount,
				        "OrderLineItemCount"=>number_format($woocommerce->cart->get_cart_contents_count(),0),
				        "OrderDescription"=>$swipezoom_config['merchant-id'].' WC',
				        "TransactionCurrency"=>get_woocommerce_currency(),
				        "CustomerLanguage"=>$lang),
				        "LineItems"=> $listItems,
				        "Customer"=> array("SameAddForShipping"=>$sameasShipping,
				        "BillingAddress"=>$billingArray
						)
					);

					if($sameasShipping == "N"){
						$ratesRequest["Customer"]["ShippingAddress"] = $shippingArray;
					}

					$reqString = "";
			        $checkerString = $ratesRequest;
			        unset($checkerString["Caller"]["Datetime"]);

				    $a = $checkerString; 
					$it = new RecursiveIteratorIterator(new RecursiveArrayIterator($a)); 
					foreach($it as $v) { 
					   $reqString .= $v; 
					}

					$uniqueString = md5($reqString);

					if($woocommerce->session->get('TransLogisticsReq') != $uniqueString || true) {
				        
				        $client = swCreateSoapClientConnection("frontend");

				        write_log($ratesRequest);
			        	$response = $client->TransLogisticsReq($ratesRequest);
			        	write_log($response);

			        	if($response->ResponseStatusCode == "000") {
				        	$woocommerce->session->set('TransLogisticsReq',$uniqueString);
				        	$woocommerce->session->set('TransLogisticsReqData',serialize($response));
			        	}
			    	} else {
			    		$response = unserialize($woocommerce->session->get('TransLogisticsReqData'));
			    	}

			        $statuscheck=$response->ResponseStatusCode;
			        $woocommerce->session->set("vat_country",0);

			        if($statuscheck == "000") {

			        		$shippingcharges = $response->OrderCustomerDetails->CustShippingcharges;
							$duties = $response->OrderCustomerDetails->CustCourierDuties;
							$insurance = $response->OrderCustomerDetails->CustInsuranceCharges;

							$session_state = $woocommerce->session->get('extraShippingCharges');	

							$extraCharges["shipping"] = number_format((float)$response->OrderCustomerDetails->CustShippingcharges, 2, '.', '');
			                $extraCharges["CustCourierDuties"] = number_format((float)$response->OrderCustomerDetails->CustCourierDuties, 2, '.', '');
			                $extraCharges["CustInsuranceCharges"] = number_format((float)$response->OrderCustomerDetails->CustInsuranceCharges, 2, '.', '');
							$extraCharges["DataStorageUrl"] = "";
			                $extraCharges["CustItemSubtotal"] = number_format((float)$response->OrderCustomerDetails->CustItemSubtotal, 2, '.', '');
			                $extraCharges["PrepaidDutiesAllowed"] = $response->LogisticDetails->PrepaidDutiesAllowed;
			                $extraCharges["CustVatAmount"] = floatval($response->OrderCustomerDetails->CustVatAmount);

			                if(!empty($extraCharges["CustVatAmount"])) {
			                    $woocommerce->session->set("vat_country",1);
			                    $extraCharges["CustVatAmount"] = number_format((float)$response->OrderCustomerDetails->CustVatAmount, 2, '.', '');
			                } else {
			                    $woocommerce->session->set("vat_country",0);
			                    $extraCharges["CustVatAmount"] = 0;
			                }

			                $extraCharges["SzCurrency"] = $response->OrderCustomerDetails->CustCurrency;


			                if(!isset($session_state)) {
			                	if($extraCharges["CustCourierDuties"] > 0)
			                		$extraCharges["CustCourierDutiesState"] = 'Y';

								if($extraCharges["CustInsuranceCharges"] > 0)
									$extraCharges["CustInsuranceChargesState"] = "Y";
			                } else {
								if(isset($session_state["CustCourierDutiesState"]) && $extraCharges["CustCourierDuties"] > 0 && $session_state["CustCourierDutiesState"] == "Y")
									$extraCharges["CustCourierDutiesState"] = $session_state["CustCourierDutiesState"];
								else
									$extraCharges["CustCourierDutiesState"] = "N";

								if(isset($session_state["CustInsuranceChargesState"]) && $extraCharges["CustInsuranceCharges"] > 0 && $session_state["CustInsuranceChargesState"] == "Y")
									$extraCharges["CustInsuranceChargesState"] = $session_state["CustInsuranceChargesState"];
								else
									$extraCharges["CustInsuranceChargesState"] = "N";
							}

							if($_POST["progress_status"] == 1) {
								if($extraCharges["CustCourierDuties"] > 0)
			                		$extraCharges["CustCourierDutiesState"] = 'Y';

								if($extraCharges["CustInsuranceCharges"] > 0)
									$extraCharges["CustInsuranceChargesState"] = "Y";
							}

							if($swipezoom_config['payment-enabled'] == "yes" && !empty($response->OrderPaymentDetails->StorageUrl))
			                    $extraCharges["DataStorageUrl"] = $response->OrderPaymentDetails->StorageUrl;                   

							$woocommerce->session->set("swipezoomOrderNumber",$response->OrderDetails->OrderNo);
							$woocommerce->session->set('extraShippingCharges',$extraCharges);
							$woocommerce->session->set('swipezoomTitle',"<span style='font-size:10px'>(".$response->OrderCustomerDetails->TransitDays." days with tracking)</span>");

			        		// show the order details area
							
							?>

						<?php		
			        		if($_POST["progress_status"] == 1) {
			        			$resultant_array =	array(
									'result'	=> 'step_changed',
									'messages' 	=> isset( $messages ) ? $messages : '',
									'payment_enabled' => $swipezoom_config['payment-enabled'],
									'data_storage_url' => $extraCharges["DataStorageUrl"],
									'refresh' 	=> 'false',
									'reload'    => 'false'
								);
								wp_send_json($resultant_array);
								exit;
			        		}

			        } else {
			        	// if some error returned by trans logistic service then print
			        	
			        	$ResponseStatusDesc=$response->ResponseStatusDesc;
			        	wc_add_notice($ResponseStatusDesc,'error');

			        	if ( wc_notice_count('error') != 0 ) {

							// only print notices if not reloading the checkout, otherwise they're lost in the page reload
							if ( ! isset( $woocommerce->session->reload_checkout ) ) {
								ob_start();
								wc_print_notices();
								$messages = ob_get_clean();
							}

							
							$resultant_array =	array(
									'result'	=> 'failure',
									'messages' 	=> isset( $messages ) ? $messages : '',
									'refresh' 	=> isset( $woocommerce->session->refresh_totals ) ? 'true' : 'false',
									'reload'    => isset( $woocommerce->session->reload_checkout ) ? 'true' : 'false'
							);
							

							wp_send_json($resultant_array);

							unset( $woocommerce->session->refresh_totals, $woocommerce->session->reload_checkout );
							exit;

						}
			        	
			        }

		    	}

		}
	 	
	}

	add_action( 'wp_ajax_'.$ajaxCallParam.'update_session_data', 'update_session_data_callback' );
	add_action( 'wp_ajax_update_session_data', 'update_session_data_callback' );

	/**
	  * Update user session data based on selection
	  */
	function update_session_data_callback() {
		
		$extraCharges = WC()->session->get('extraShippingCharges');
		
		if($_POST["duties"] == "checked")
			$extraCharges["CustCourierDutiesState"] = "Y";
		else
			$extraCharges["CustCourierDutiesState"] = "N";

		if($_POST["insurance"] == "checked")
			$extraCharges["CustInsuranceChargesState"] = "Y";
		else
			$extraCharges["CustInsuranceChargesState"] = "N";

		WC()->session->set('extraShippingCharges',$extraCharges);

		$extraCharges = WC()->session->get('extraShippingCharges');

		die;
	}

	add_action( 'wp_ajax_'.$ajaxCallParam.'get_postal_code', 'get_postal_code_callback' );
	add_action( 'wp_ajax_get_postal_code', 'get_postal_code_callback' );

	/**
	  * get autocomplete postal codes
	  */
	function get_postal_code_callback() {
		
		global $iso2_to_iso3;
		$responseAutoComplete = $countrycode_iso3 = "";
		try {
			$city = $_REQUEST['city'];
			$state_id = $_REQUEST['state'];
			$country= $_REQUEST["countrycode"];
			$state_id = $_REQUEST["state"];
			$postCode =  $_REQUEST['q'];
			
			$country_codes = json_decode($iso2_to_iso3,true);
			foreach ($country_codes as $key => $value) {
				if($key == $_REQUEST["countrycode"])
					$countrycode_iso3 = $value;
			}

			$params = array("Caller" => swGetCaller(),
					        "CityName" => $city,                                            
					        "CountryCode" => $countrycode_iso3,
							"StateCode" => $state_id,
							"PostCode" => $postCode,
							"ResponseSize" => 200
			);

			$client = swCreateSoapClientConnection("frontend");
			
			$response = $client->GlobalPostCodeLookup($params);
			
			$statuscheck=$response->ResponseStatusCode;
			$ResponseStatusDesc=$response->ResponseStatusDesc;
			if($statuscheck=="000") {
				if (1 < sizeof($response->PostCodes->PostCode) ) {
					foreach ($response->PostCodes->PostCode as &$postCodeResp) {
						$responseAutoComplete = $responseAutoComplete.$postCodeResp->PostCode."\n";
					}
				} else if (0 < sizeof($response->PostCodes->PostCode) ) {
					$responseAutoComplete =  $responseAutoComplete.$response->PostCodes->PostCode->PostCode."\n";
				}
				
			}
			
		} catch (Exception $e) {
				$debugData['result'] = array('error' => $e->getMessage(), 'code' => $e->getCode());
		}
		echo $responseAutoComplete;
    	die;

	}

	add_filter( 'woocommerce_checkout_fields' , 'swGetAddressLabeling' );

	/**
	  * get address labeling for billing and shipping country  
	  */
	function swGetAddressLabeling( $fields ) {

		global $woocommerce,$iso2_to_iso3;
		$countrycode_iso3 = $country = "";
        
		$check_session = WC()->session->get("AddressLabel_".$_POST['country']."_".$_POST["type"]);

		if(!empty($_POST['country']) && !empty($_POST["type"]) && empty($check_session) ) {

			$country = $_POST['country'];

			$lang = explode('-', get_bloginfo('language'));
			$lang = $lang[0];

			$country_codes = json_decode($iso2_to_iso3,true);
			foreach ($country_codes as $key => $value) {
				if($key == $country)
					$countrycode_iso3 = $value;
			}
			
			$ratesRequest = array("Caller" => swGetCaller(),
	            "LanguageCode" => $lang,                                            
	        	"CountryCode" => $countrycode_iso3
			);

			$requestString = serialize($ratesRequest);
			$debugData = array('request' => $ratesRequest);
			try {

				$address_country = WC()->session->get('TransAddressLabeling_'.$countrycode_iso3);

				if(empty($address_country)) {
					$client = swCreateSoapClientConnection("frontend");
					
					write_log($ratesRequest);
					$response = $client->TransAddressLabeling($ratesRequest);
					write_log($response);
				} else {
					$response = WC()->session->get('TransAddressLabeling_'.$countrycode_iso3);
				}

				if($response->ResponseStatusCode == '000') {
					WC()->session->set('TransAddressLabeling_'.$countrycode_iso3,$response);						
				}				
				
				$chk=json_decode(json_encode($response), true);
				$chk1=$chk['AddressFormats'];
				$chk2=$chk1['AddressFormat'];
				$labelcol = array();
				for($i=0;$i<count($chk2);$i++)
				{
					$labelcol[]=$chk2[$i];
				}

				$debugData['result'] = $response;
			} catch (Exception $e) {
				$debugData['result'] = array('error' => $e->getMessage(), 'code' => $e->getCode());
			}		

			$fieldType = array();

			foreach ($labelcol as $key => $value) {
				$fieldType[] = $value['FieldType'];

				if($value['FieldType'] == 1) {
					$fields[$_POST["type"]][$_POST["type"]."_address_1"]["required"] = ($value['IsMandatory'] == "Y") ? 1 : 0;
					$fields[$_POST["type"]][$_POST["type"]."_address_1"]["label"] = $value['FieldLabel'];
					$fields[$_POST["type"]][$_POST["type"]."_address_1"]["maxlength"] = $value['MaxLength'];
				}
				if($value['FieldType'] == 2) {
					$fields[$_POST["type"]][$_POST["type"]."_address_2"]["required"] = ($value['IsMandatory'] == "Y") ? 1 : 0;
					$fields[$_POST["type"]][$_POST["type"]."_address_2"]["label"] = $value['FieldLabel'];
					$fields[$_POST["type"]][$_POST["type"]."_address_2"]["maxlength"] = $value['MaxLength'];
				}
				if($value['FieldType'] == "C") {
					$fields[$_POST["type"]][$_POST["type"]."_city"]["required"] = ($value['IsMandatory'] == "Y") ? 1 : 0;
					$fields[$_POST["type"]][$_POST["type"]."_city"]["label"] = $value['FieldLabel'];
					$fields[$_POST["type"]][$_POST["type"]."_city"]["maxlength"] = 30;
				}
				if($value['FieldType'] == "D") {
					$fields[$_POST["type"]][$_POST["type"]."_state"]["required"] = ($value['IsMandatory'] == "Y") ? 1 : 0;
					$fields[$_POST["type"]][$_POST["type"]."_state"]["label"] = $value['FieldLabel'];
					$fields[$_POST["type"]][$_POST["type"]."_state"]["maxlength"] = $value['MaxLength'];
				}
				if($value['FieldType'] == "P") {
					$fields[$_POST["type"]][$_POST["type"]."_postcode"]["required"] = ($value['IsMandatory'] == "Y") ? 1 : 0;
					$fields[$_POST["type"]][$_POST["type"]."_postcode"]["label"] = $value['FieldLabel'];
					$fields[$_POST["type"]][$_POST["type"]."_postcode"]["maxlength"] = $value['MaxLength'];
				}
			}

			if(!in_array(1, $fieldType)) {
				unset($fields[$_POST["type"]][$_POST["type"]."_address_1"]);
			}
			if(!in_array(2, $fieldType)) {
				unset($fields[$_POST["type"]][$_POST["type"]."_address_2"]);
			}
			if(!in_array("C", $fieldType)) {
				unset($fields[$_POST["type"]][$_POST["type"]."_city"]);
			}
			if(!in_array("D", $fieldType)) {
				unset($fields[$_POST["type"]][$_POST["type"]."_state"]);

				foreach ($fields[$_POST["type"]][$_POST["type"]."_postcode"]["class"] as $key => $value) {
					if($value == "form-row-last")
						unset($fields[$_POST["type"]][$_POST["type"]."_postcode"]["class"][$key]);
				}

				$fields[$_POST["type"]][$_POST["type"]."_postcode"]["class"][] = "form-row-wide";
			}
			if(!in_array("P", $fieldType)) {
				unset($fields[$_POST["type"]][$_POST["type"]."_postcode"]);
			}	
			
			if($response->ResponseStatusCode == "000")
				WC()->session->set("AddressLabel_".$_POST['country']."_".$_POST["type"],$fields[$_POST["type"]]);	    
		
		} else if ( !empty($check_session) && !empty($_POST['country']) && !empty($_POST['type']) ) {
			$fields[$_POST["type"]] = WC()->session->get("AddressLabel_".$_POST['country']."_".$_POST["type"]);
		}

		$fields['billing']["billing_phone"]["maxlength"] = 20;
		$fields['billing']["billing_first_name"]["maxlength"] = 30;
		$fields['billing']["billing_last_name"]["maxlength"] = 30;

		$fields['shipping']["shipping_first_name"]["maxlength"] = 30;
		$fields['shipping']["shipping_last_name"]["maxlength"] = 30;

		return $fields;
	}

	add_action( 'wp_ajax_'.$ajaxCallParam.'getProductList', 'getProductList_callback');
	add_action( 'wp_ajax_getProductList', 'getProductList_callback');


	function getProductList_callback() {
		$responseArray =  getProductListDetails();
    	$dom = new DOMDocument;
		$dom->preserveWhiteSpace = FALSE;
		$dom->loadXML($responseArray);
		$dom->formatOutput = TRUE;
		echo $dom->saveXml();
    	die();
	}

	/**
	 * getProductListDetails 
	 */

	function getProductListDetails(){

		global $swipezoom_config,$iso2_to_iso3;

		$response = array();
		try {
			
			if(empty($_POST['MerchantID']) || empty($_POST['MerchantKey']) 
				|| $swipezoom_config['merchant-id'] != $_POST['MerchantID'] 
				|| $swipezoom_config['merchant-key'] != $_POST['MerchantKey']) {
				$response = array();

				$xml = new SimpleXMLElement('<ProductListResponse/>');

				$xml->addChild('error', "Stakeholder credentials are not valid");

				return $xml->asXML();
		
			} else {

				if($_POST['ProductStartingID'])
					$lastId = $_POST['ProductStartingID'];
				else
					$lastId = 0;

				$datefilter = $datefilterdata = array();
				if(!empty($_POST['StartDate'])) {
					$datefilter['from'] = $_POST['StartDate'];
					$from = explode('-', $datefilter['from']);
					$datefilterdata['after'] = array(
                                'year'  => $from[0],
                                'month' => $from[1],
                                'day'   => $from[2],
                    );
					
				}

				if(!empty($_POST['EndDate'])) {
					$datefilter['to'] = $_POST['EndDate'];
					$to = explode('-', $datefilter['to']);
					$datefilterdata['before'] = array(
                                    'year'  => $to[0],
                                    'month' => $to[1],
                                    'day'   => $to[2],
                    );
				}

				if(!empty($datefilterdata['before']) && !empty($datefilterdata['after'])) {
					$datefilterdata['inclusive'] = true;
				}


				$args = array(
					'posts_per_page' => -1,
					'post_type' => 'product',
					'orderby' => 'ID',
					'order'   => 'DESC',
					'date_query' => array(
						array(
								$datefilterdata	
                            ),
					)
				);
				$loop = new WP_Query($args);
				$len = 0;

				if ( $loop->have_posts() ) {
					while ( $loop->have_posts() ) : $loop->the_post();
						
					   $product = wc_get_product( get_the_ID() );

					   if(get_the_ID() <= $lastId)
					   		continue;

					   $len++;	
					   $response[$product->get_id()]['ProductCode'] =  $product->get_sku();
					   $response[$product->get_id()]['ProductDescription'] = $product->get_title();

					   $countrycode_iso3 = '';
					   $country_codes = json_decode($iso2_to_iso3,true);
						foreach ($country_codes as $key => $value) {
							if($key == WC_Countries::get_base_country())
								$countrycode_iso3 = $value;
						}

						$image = '';
						$image_id = $product->get_image_id();
						$image = wp_get_attachment_url( $image_id );
				       $response[$product->get_id()]['CategoryID'] =  $product->get_categories();
					   $response[$product->get_id()]['CategoryName'] =  $product->get_categories();
					   $response[$product->get_id()]['Weight'] =  number_format($product->get_weight(),2);
					   $response[$product->get_id()]['CountryOfManufacture'] = $countrycode_iso3;
					   $response[$product->get_id()]['ImageURL'] =  $image;
					   $response[$product->get_id()]['ProductURL'] = get_permalink();
					   $response[$product->get_id()]['ProductID'] = $product->get_id();
					   $response[$product->get_id()]['Width'] = $product->get_width();
					   $response[$product->get_id()]['Length'] = $product->get_length();
					   $response[$product->get_id()]['Height'] = $product->get_height();
					   
					endwhile;
				} 
				wp_reset_postdata();
                
			if($len == 0) {
				$response = array();
				$xml = new SimpleXMLElement('<ProductListResponse/>');

				$xml->addChild('error', "0 records found");

				return $xml->asXML();
			}

	    	//creating object of SimpleXMLElement
			$xml_user_info = new SimpleXMLElement("<?xml version=\"1.0\"?><ProductListResponse></ProductListResponse>");

			//function call to convert array to xml
			array_to_xml($response,$xml_user_info);

			//saving generated xml file
			return $xml_user_info->asXML();
		  }

		} catch (Exception $e) {
			 //Mage::logException($e);
		}
	
	}

	//function defination to convert array to xml
	function array_to_xml($array, &$xml_user_info) {
	    foreach($array as $key => $value) {
	        if(is_array($value)) {
	            if(!is_numeric($key)){
	                $subnode = $xml_user_info->addChild("$key");
	                array_to_xml($value, $subnode);
	            }else{
	                $subnode = $xml_user_info->addChild("Product");
	                array_to_xml($value, $subnode);
	            }
	        }else {
	            $xml_user_info->addChild("$key",htmlspecialchars("$value"));
	        }
	    }
	}	

	add_action( 'wp_ajax_'.$ajaxCallParam.'get_user_address_fields', 'get_user_address_fields_callback');
	add_action( 'wp_ajax_get_user_address_fields', 'get_user_address_fields_callback');

	/**
	  * get html fragements for billing and shipping swipezoom address fields
	  */
	function get_user_address_fields_callback() {

		add_filter( 'woocommerce_checkout_fields' , 'swGetAddressLabeling' );

		ob_start();

		if ( ! defined( 'WOOCOMMERCE_CHECKOUT' ) ) {
			define( 'WOOCOMMERCE_CHECKOUT', true );
		}

		if ( 0 == sizeof( WC()->cart->get_cart() ) ) {
			$data = array(
				'fragments' => apply_filters( 'woocommerce_update_order_review_fragments', array(
					'form.woocommerce-checkout' => '<div class="woocommerce-error">' . __( 'Sorry, your session has expired.', 'woocommerce' ) . ' <a href="' . home_url() . '" class="wc-backward">' . __( 'Return to homepage', 'woocommerce' ) . '</a></div>'
				) )
			);

			wp_send_json( $data );

			die();
		}

		if($_POST['type'] == 'billing') {
			ob_start();
			WC()->checkout->checkout_form_billing();
			$checkout_form_billing = ob_get_clean();

			$fragment_updated = array('.logistic_billing_fields' => $checkout_form_billing); 
		}

		if($_POST['type'] == 'shipping') {
			ob_start();
			WC()->checkout->checkout_form_shipping();
			$checkout_form_shipping = ob_get_clean();

			$fragment_updated = array('.logistic_shipping_fields' => $checkout_form_shipping); 
		}

		// Get messages if reload checkout is not true
		$messages = '';
		if ( ! isset( WC()->session->reload_checkout ) ) {
			ob_start();
			wc_print_notices();
			$messages = ob_get_clean();
		}

		$data = array(
			'result'    => empty( $messages ) ? 'success' : 'failure',
			'messages'  => $messages,
			'reload'    => isset( WC()->session->reload_checkout ) ? 'true' : 'false',
			'fragments' => apply_filters( 'woocommerce_update_customer_fields_fragments', 
				$fragment_updated		
			 )
		);

		wp_send_json( $data );

		die();

	}

	add_action( 'wp_ajax_'.$ajaxCallParam.'get_cities', 'get_cities_callback');
	add_action( 'wp_ajax_get_cities', 'get_cities_callback');

	/**
	  * get cities 
	  */
	function get_cities_callback() {

		global $iso2_to_iso3;
		$responseAutoComplete = $countrycode_iso3 = "";
		
		try {
			$city = $_REQUEST["city"];
			$country = $_REQUEST["countrycode"];

			$country_codes = json_decode($iso2_to_iso3,true);
			foreach ($country_codes as $key => $value) {
				if($key == $_REQUEST["countrycode"])
					$countrycode_iso3 = $value;
			}

			$params = array("Caller" => swGetCaller(),
					        "CityName" => $city,                                            
					        "CountryCode" => $countrycode_iso3,
							"ResponseSize" => 200
			);
			$client = swCreateSoapClientConnection("frontend");
			
			$response = $client->GlobalCityLookup($params);
			
			$statuscheck=$response->ResponseStatusCode;
			$ResponseStatusDesc=$response->ResponseStatusDesc;
			$cityNamesCol = array();

			if($statuscheck=="000") {

				if (1 < sizeof($response->Cities->City) ) {
					foreach ($response->Cities->City as &$city) {
						// if city name already not added up
						if(!in_array(trim($city->CityName),$cityNamesCol)) {
							$responseAutoComplete = $responseAutoComplete.$city->CityName."\n";
							$cityNamesCol[] = trim($city->CityName);
						}
					}
				} else if (0 < sizeof($response->Cities->City) ) {
					$responseAutoComplete =  $responseAutoComplete.$response->Cities->City->CityName."\n";
				}
			}
		} catch (Exception $e) {
				$debugData['result'] = array('error' => $e->getMessage(), 'code' => $e->getCode());
		}
		echo $responseAutoComplete;
		//return true;
		die;

	}

	add_action( 'wp_ajax_'.$ajaxCallParam.'get_city_states', 'get_city_states_callback' );
	add_action( 'wp_ajax_get_city_states', 'get_city_states_callback' );

	/**
	  * get city states 
	  */
	function get_city_states_callback() {

		global $iso2_to_iso3;
		$responseAutoComplete = $countrycode_iso3 = "";
		try {
			$city = $_REQUEST["city"];
			$country = $_REQUEST["countrycode"];
			
			$country_codes = json_decode($iso2_to_iso3,true);
			foreach ($country_codes as $key => $value) {
				if($key == $_REQUEST["countrycode"])
					$countrycode_iso3 = $value;
			}

			$params = array("Caller" => swGetCaller(),
					        "CityName" => $city,                                            
					        "CountryCode" => $countrycode_iso3,
							"ResponseSize" => 200
			);
			$client = swCreateSoapClientConnection("frontend");
			
			$response = $client->GlobalStateLookup($params);
			
			$statuscheck=$response->ResponseStatusCode;
			$ResponseStatusDesc=$response->ResponseStatusDesc;
			$states = array();
			if($statuscheck=="000") {

				if (1 < sizeof($response->States->State) ) {
					foreach ($response->States->State as &$state) {
						$currentState = array('stateCode'=>$state->StateCode,'stateName'=>$state->StateName);
						array_push($states,$currentState); 
					}
				} else if (0 < sizeof($response->States->State) ) {
					$currentState = array('stateCode'=>$response->States->State->StateCode,'stateName'=>$response->States->State->StateName);
					array_push($states,$currentState); 
				}
			}
			$responseAutoComplete = json_encode($states);
		} catch (Exception $e) {
				$debugData['result'] = array('error' => $e->getMessage(), 'code' => $e->getCode());
		}

		echo $responseAutoComplete;
		die;

	}

	add_action( 'wp_ajax_'.$ajaxCallParam.'get_states', 'get_states_callback' );
	add_action( 'wp_ajax_get_states', 'get_states_callback' );

	/**
	  * get states 
	  */
	function get_states_callback() {

		global $iso2_to_iso3;
		$responseAutoComplete = $countrycode_iso3 = "";
		try {
			$city = $_REQUEST["city"];
			$state_id = $_REQUEST["state"];
			$country = $_REQUEST["countrycode"];
			
			$country_codes = json_decode($iso2_to_iso3,true);
			foreach ($country_codes as $key => $value) {
				if($key == $_REQUEST["countrycode"])
					$countrycode_iso3 = $value;
			}

			//$state_id = "N";

			$params = array("Caller" => swGetCaller(),
					        "CityName" => $city,                                            
					        "CountryCode" => $countrycode_iso3,
							"StateCode" => $state_id,
							"ResponseSize" => 200
			);
			$client = swCreateSoapClientConnection("frontend");

			$response = $client->GlobalStateLookup($params);
			
			$statuscheck=$response->ResponseStatusCode;
			$ResponseStatusDesc=$response->ResponseStatusDesc;
			if($statuscheck=="000") {
				foreach ($response->States->State as &$state) {
					$responseAutoComplete = $responseAutoComplete.$state->StateName.'\n';
				}
			}
		} catch (Exception $e) {
				$debugData['result'] = array('error' => $e->getMessage(), 'code' => $e->getCode());
		}

		echo $responseAutoComplete;

		die;
		
	}

	add_filter( 'woocommerce_ship_to_different_address_checked', '__return_false' );


	function myplugin_plugin_path() {
	  	 // gets the absolute path to this plugin directory
	 	 return untrailingslashit( plugin_dir_path( __FILE__ ) );
	}
 
	add_filter( 'woocommerce_locate_template', 'myplugin_woocommerce_locate_template', 10, 3 );
 	
 	/**
	  * change the template path to the one in Swipezoom plugin
	  */
	function myplugin_woocommerce_locate_template( $template, $template_name, $template_path ) {
	 
	  global $woocommerce;
	  $_template = $template;
	 
	  if ( ! $template_path ) $template_path = $woocommerce->template_url;
	  $plugin_path  = myplugin_plugin_path() . '/woocommerce/';
	 
	  // Look within passed path within the theme - this is priority
	  $template = locate_template(
	    array(
	      $template_path . $template_name,
	      $template_name
	    )
	 
	  );
	 
	  // Modification: Get the template from this plugin, if it exists
	  if ( ! $template && file_exists( $plugin_path . $template_name ) )
	    $template = $plugin_path . $template_name;
	 
	 
	  // Use default template
	  if ( ! $template )
	    $template = $_template;
	 
	 
	  // Return what we found
	  return $template;
	 
	}

	/**
	  * confirm trans logistic request
	  */
	function swConfirmTransLogisticsRequest($swipezoom_method, $swipezoom_id,$orderId) {

		global $woocommerce,$swipezoom_config;

		$extraCharges = $woocommerce->session->get('extraShippingCharges');

		($extraCharges['CustCourierDutiesState'] == "Y")?$PrepaidDuties="Y":$PrepaidDuties="N";
		($extraCharges['CustInsuranceChargesState'] == "Y")?$PrepaidInsurance="Y":$PrepaidInsurance="N";

		$ratesRequest = array("Caller" => array("MerchantID" => $swipezoom_config['merchant-id'],
        "MerchantKey" => $swipezoom_config['merchant-key'],
        "Version"=> "SW0101",
        "Datetime"      => date("Y-m-d h:i:s"),
        "MerchantRefNo"      => $orderId,
        "RequestFingerprint" => $woocommerce->session->get('fingerprint')),
        "OrderNo"=>$swipezoom_id,
        "PrepaidDuties"=>$PrepaidDuties,
        "PrepaidInsurance"=>$PrepaidInsurance);
        
        $response = swConfirmOrderRequest($ratesRequest);
		if (is_object($response)) {
			return array($response->ResponseStatusCode,$response->ResponseStatusDesc);
		}
		return false;
	}


	/**
	  * trans confirm service call
	  */
	function swConfirmOrderRequest($ratesRequest)
	{
		try {
			$client = swCreateSoapClientConnection("frontend");

			write_log($ratesRequest);
			$response = $client->TransLogisticsConfirm($ratesRequest);
			write_log($response);

		} catch (Exception $e) {
			write_log($e);
		}
		return $response;
	}

	add_filter( 'manage_edit-shop_order_columns', 'swAdminOrderGrid' );

	/**
	  * Change admin order grid
	  */
	function swAdminOrderGrid($columns){
	    $new_columns = (is_array($columns)) ? $columns : array();
	    unset( $new_columns['order_actions'] );

	    $new_columns['swipezoom_id'] = 'Swipezoom ID';
	    
	    $new_columns['order_actions'] = $columns['order_actions'];
	    return $new_columns;
	}

	add_action( 'manage_shop_order_posts_custom_column', 'swAdminOrderGridColumn', 2 );

	/**
	  * Change admin order grid value
	  */
	function swAdminOrderGridColumn($column){
	    global $post;
	    $data = get_post_meta( $post->ID );

	    if ( $column == 'swipezoom_id' ) {    
	    	echo (isset($data['swipezoom_id'][0]) ? '<img width="32" alt="Swipezoom Logo" src="'.plugins_url( 'assets/images/logo.jpg', __FILE__ ).'">'.$data['swipezoom_id'][0] : '');
	    }
	}

	/**
	 * Get shipping methods
	 *
	 * @access public
	 * @return void
	 */
	function swCartsTotalShippingHtml() {

		$packages = WC()->shipping->get_packages();

		foreach ( $packages as $i => $package ) {
			$chosen_method = isset( WC()->session->chosen_shipping_methods[ $i ] ) ? WC()->session->chosen_shipping_methods[ $i ] : '';

			wc_get_template( 'cart/cart-shipping.php', array( 'package' => $package, 'available_methods' => $package['rates'], 'show_package_details' => ( sizeof( $packages ) > 1 ), 'index' => $i, 'chosen_method' => $chosen_method ) );
		}
	}

	add_filter( 'woocommerce_cart_shipping_method_full_label', 'swChangeLabelContent', 10, 2 );

	/**
	  * Change swipezoom label content
	  */
	function swChangeLabelContent($full_label, $method){
	   global $woocommerce;
	   
	   if( $method->id == 'swipezoom_internationalshipping' ) {

	   		$extraCharges = $woocommerce->session->get('extraShippingCharges');
			$total = $extraCharges["shipping"];

			 $full_label = $method->label;
			 if ( $method->cost > 0 ) 
				$full_label .= ': <span style="margin-left:74px;font-size:12.5px">' . wc_price( $total ).'</span>';
					
		}

	    return $full_label;
	}

	add_action( 'add_meta_boxes', 'add_meta_boxes' );

	function add_meta_boxes()
	{
		$orderId = $_REQUEST['post'];
		$order = new WC_Order($orderId);

		$shippingMethodDetail = $order->get_shipping_methods();

		foreach ($shippingMethodDetail as $key => $value) {
			$shippingMethod = $shippingMethodDetail[$key]['method_id'];
		}

		if(strpos($shippingMethod,"swipezoom") !== FALSE) {

		    add_meta_box( 
		        'woocommerce-swipezoom-order-details', 
		        __( 'Swipezoom Order Details' ), 
		        'swipezoom_order_details_content', 
		        'shop_order', 
		        'low', 
		        'default' 
		    );
		}
	}

	function swipezoom_order_details_content() {
		wc_get_template( 'admin/swipezoom-order-grid.php');
	}

	function my_enqueue($hook) {
		
		$screen = get_current_screen();

		if( 'shop_order' == $screen->post_type && 'post' == $screen->base ) {
    		wp_enqueue_style( 'autocomplete_css', plugins_url( 'assets/css/jquery.autocomplete.css', __FILE__ ));
		}
	}

	add_action( 'admin_enqueue_scripts', 'my_enqueue' );

	function woo_add_cart_fee() {
 
	  global $woocommerce;
	  
	  $extraCharges = $woocommerce->session->get('extraShippingCharges');

	  if($extraCharges['CustVatAmount'] != 0)
	  	$woocommerce->cart->add_fee( __('VAT', 'woocommerce'), $extraCharges['CustVatAmount'] );
		
	}

	add_action( 'woocommerce_cart_calculate_fees', 'woo_add_cart_fee' );

	function woo_calculate_totals() {
	  global $woocommerce;
	  
	  $extraCharges = $woocommerce->session->get('extraShippingCharges');

	  if(!empty($extraCharges['CustItemSubtotal'])) {
	  	$woocommerce->cart->subtotal = $extraCharges['CustItemSubtotal'];
	  	$woocommerce->cart->subtotal_ex_tax = $extraCharges['CustItemSubtotal'];
	  	$woocommerce->cart->cart_contents_total = $extraCharges['CustItemSubtotal'];
	  }
	}

	add_action( 'woocommerce_calculate_totals', 'woo_calculate_totals' );

	add_filter( 'woocommerce_order_subtotal_to_display' , 'woo_order_subtotal_to_display',10,3 );

	function woo_order_subtotal_to_display($subtotal,$compound,$order) {

		global $woocommerce;	
		
		$order_post_meta = get_post_meta($order->id);
		
		if(!empty($order_post_meta['cust_item_subtotal'][0]))
			$subtotal = wc_price( $order_post_meta['cust_item_subtotal'][0], array('currency' => $order->get_order_currency()) );

		return $subtotal;
	}	

	function filter_woocommerce_default_address_fields( $fields_data ) {
    	
    	$fields_data = array(
			'first_name' => array(
				'label'    => __( 'First Name', 'woocommerce' ),
				'required' => true,
				'class'    => array( 'form-row-first' ),
			),
			'last_name' => array(
				'label'    => __( 'Last Name', 'woocommerce' ),
				'required' => true,
				'class'    => array( 'form-row-last' ),
				'clear'    => true
			),
			'country' => array(
				'type'     => 'country',
				'label'    => __( 'Country', 'woocommerce' ),
				'required' => true,
				'class'    => array( 'form-row-wide', 'address-field', 'update_totals_on_change' ),
			),
			'company' => array(
				'label' => __( 'Company Name', 'woocommerce' ),
				'class' => array( 'form-row-wide' ),
			),
			'address_1' => array(
				'label'       => __( 'Address', 'woocommerce' ),
				'placeholder' => _x( 'Street address', 'placeholder', 'woocommerce' ),
				'required'    => true,
				'class'       => array( 'form-row-wide', 'address-field' )
			),
			'address_2' => array(
				'placeholder' => _x( 'Apartment, suite, unit etc. (optional)', 'placeholder', 'woocommerce' ),
				'class'       => array( 'form-row-wide', 'address-field' ),
				'required'    => false
			),
			'city' => array(
				'label'       => __( 'Town / City', 'woocommerce' ),
				'placeholder' => __( 'Town / City', 'woocommerce' ),
				'required'    => true,
				'class'       => array( 'form-row-wide', 'address-field' )
			),
			'state' => array(
				'type'        => 'state',
				'label'       => __( 'State / County', 'woocommerce' ),
				'placeholder' => __( 'Make a selection', 'woocommerce' ),
				'required'    => true,
				'class'       => array( 'form-row-first', 'address-field' )
			),
			'postcode' => array(
				'label'       => __( 'Postcode / Zip', 'woocommerce' ),
				'placeholder' => __( 'Postcode / Zip', 'woocommerce' ),
				'required'    => true,
				'clear'       => true,
				'class'       => array( 'form-row-last', 'address-field' )
			),
		);

		return $fields_data;
	}
	        
	// add the filter
	add_filter( 'woocommerce_default_address_fields', 'filter_woocommerce_default_address_fields', 10, 1 );

	//show payment gateways based on shipping method
	function sz_payment_gateway( $available_gateways ) {
	    global $woocommerce,$swipezoom_config;

	   if($swipezoom_config['payment-enabled'] == "yes") {

		    $chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
		    $chosen_shipping = $chosen_methods[0];

		    if( $chosen_shipping == 'swipezoom_internationalshipping' ) {
		        foreach ($available_gateways as $key => $value) {
		        	if($key != 'swipezoom_payment')
		        		unset($available_gateways[$key]);
		        }
		    } else {
		    	foreach ($available_gateways as $key => $value) {
		        	if($key == 'swipezoom_payment')
		        		unset($available_gateways[$key]);
		        }
		    }
		} else {
			foreach ($available_gateways as $key => $value) {
	        	if($key == 'swipezoom_payment')
	        		unset($available_gateways[$key]);
	        }
		}

	    return $available_gateways;
	}
	add_filter( 'woocommerce_available_payment_gateways', 'sz_payment_gateway' );

	add_filter( 'woocommerce_billing_fields', 'sz_billing_fields_order', 10, 1 );
	function sz_billing_fields_order( $address_fields ) {
		
		$updated_address_fields = $address_fields;
		$email_address = $phone = array();

		foreach ($address_fields as $key => $value) {
			if($key == 'billing_email') {
				$email_address = $value;
				unset($updated_address_fields['billing_email']);
			}
			if($key == 'billing_phone') {
				$phone = $value;
				unset($updated_address_fields['billing_phone']);
			}
		}

		$extra_fields = array('billing_email' => $email_address,'billing_phone' => $phone);
		$updated_address_fields = array_merge($updated_address_fields,$extra_fields);

		return $updated_address_fields;
	}

	add_filter( 'woocommerce_shipping_fields', 'sz_shipping_fields_order', 10, 1 );
	function sz_shipping_fields_order( $address_fields ) {

		return $address_fields;
	}

	/**
	 * Code goes in functions.php or a custom plugin.
	 */
	add_action( 'woocommerce_email', 'unhook_email_alerts' );

	function unhook_email_alerts( $email_class ) {
		
		// Processing order emails
		remove_action( 'woocommerce_order_status_pending_to_processing_notification', array( $email_class->emails['WC_Email_Customer_Processing_Order'], 'trigger' ) );
		remove_action( 'woocommerce_order_status_pending_to_on-hold_notification', array( $email_class->emails['WC_Email_Customer_Processing_Order'], 'trigger' ) );
		
	}

	add_filter( 'woocommerce_formatted_address_force_country_display', '__return_true' );