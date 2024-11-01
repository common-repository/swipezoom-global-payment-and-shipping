// function for storing sensitive data to the Wirecard data storage
function storeData() {
  jQuery(".place-order").hide();
  jQuery('#sz_save_payment').attr('disabled',true);
  jQuery(".cc-checkout-errors").html('');
  // creates a new JavaScript object containing the Wirecard data storage functionality
  var dataStorage = new WirecardCEE_DataStorage();
  // initializes the JavaScript object containing the payment specific information and data
  var paymentInformation = {};

  var card_number = jQuery("#swipezoom_payment-card-number").val();
  var expiry_date = jQuery("#swipezoom_payment-card-expiry").val();

  card_number = card_number.replace(/ /g,'');
  expiry_date = expiry_date.replace(/ /g,'');
  expiry_array = expiry_date.split('/');

  if(jQuery("#swipezoom_payment-card-name").val() == "") {
    s = 'Card holder name is missing';
    jQuery(".cc-checkout-errors").html(s);
    jQuery('#sz_save_payment').prop('disabled',false);

    return false;
  } else if(card_number == "") {
    s = 'Card number is missing';
    jQuery(".cc-checkout-errors").html(s);
    jQuery('#sz_save_payment').prop('disabled',false);

    return false;
  } else if(jQuery("#swipezoom_payment-card-cvc").val() == "") {
    s = 'Card security code is missing';
    jQuery(".cc-checkout-errors").html(s);
    jQuery('#sz_save_payment').prop('disabled',false);

    return false;
  } else if(expiry_array[0] == "") {
    s = 'Expiry month is missing';
    jQuery(".cc-checkout-errors").html(s);
    jQuery('#sz_save_payment').prop('disabled',false);

    return false;
  } else if(expiry_array[1] == "") {
    s = 'Expiry year is missing';
    jQuery(".cc-checkout-errors").html(s);
    jQuery('#sz_save_payment').prop('disabled',false);

    return false;
  } 

    // gets all sensitive data of corresponding input fields of HTML form and stores them
    // in the JavaScript object
    paymentInformation.pan = card_number;
    paymentInformation.expirationMonth = expiry_array[0];
    paymentInformation.expirationYear = expiry_array[1];
    paymentInformation.cardholdername = document.getElementById('swipezoom_payment-card-name').value;
    paymentInformation.cardverifycode = document.getElementById('swipezoom_payment-card-cvc').value;
    
    dataStorage.storeCreditCardInformation(paymentInformation, callbackFunction);

}

// callback function for displaying the results of storing the
// sensitive data to the Wirecard data storage
callbackFunction = function(aResponse) {
  // initiates the result string presented to the user
  var s = "";
  console.log(aResponse);
  // checks if response status is without errors
  if (aResponse.getStatus() == 0) {
    // saves all anonymized payment information to a JavaScript object
    var info = aResponse.getAnonymizedPaymentInformation();
    console.log(info);
    jQuery("#place_order").trigger('click');
    jQuery("#sz_save_payment").addClass('sw-hidden');
    jQuery('#sz_save_payment').prop('disabled',false);

  } else {
    // collects all occured errors and adds them to the result string
    var errors = aResponse.getErrors();
    var error_message = [];
    for (e in errors) {
      error_message.push(errors[e].consumerMessage);
    }

    jQuery.each(jQuery.unique(error_message), function( index, value ) {
      s += value + "<br>";
    });

    console.log(s);
    jQuery(".cc-checkout-errors").html(s);
    jQuery('#sz_save_payment').prop('disabled',false);
  }
  // presents result string to the user
}


jQuery( function( $ ) {

	if(site_url)
		base_url = site_url;
	else
		base_url = '';

	jQuery('#billing_country').change(function(data){

		$( '.logistic_billing_fields' ).block({
			message: null,
			overlayCSS: {
				background: '#fff',
				opacity: 0.6
			}
		});

		var data = {
				action:	'get_user_address_fields',
				country: $( '#billing_country' ).val(),
				type: 'billing'
			};

		jQuery.ajax({
				type:		'POST',
				url:		base_url+'/wp-admin/admin-ajax.php',
				data:		data,
				success:	function( data ) {
					// Always update the fragments	
					if ( data && data.fragments ) {
						$( '.woocommerce-error, .woocommerce-message' ).remove();
						$.each( data.fragments, function ( key, value ) {
							
							$( key ).replaceWith( value );
							autocomplete_functions('billing_changed');
							$( key ).unblock();
						} );
					}

					// Check for error
					if ( 'failure' == data.result ) {

						var $form = $( 'form.checkout' );

						if ( 'true' === data.reload ) {
							window.location.reload();
							return;
						}

						$( '.woocommerce-error, .woocommerce-message' ).remove();

						// Add new errors
						if ( data.messages ) {
							$form.prepend( data.messages );
						} else {
							$form.prepend( data );
						}

						// Lose focus for all fields
						$form.find( '.input-text, select' ).blur();

						// Scroll to top
						$( 'html, body' ).animate( {
							scrollTop: ( $( 'form.checkout' ).offset().top - 100 )
						}, 1000 );

					}

					setTimeout(function(){
					  $('#billing_state').replaceWith( '<input type="text" class="input-text" value="" placeholder="Make a selection" name="billing_state" id="billing_state">');	
					  if(!$('#billing_state_field').is(":visible")) {
						  $( '#billing_state_field' ).css('display','block');
						  $( '#billing_state' ).attr('type','text');
						  $( '#billing_state' ).attr('class','input-text');
					  }
					  load_states('billing');
					  
					}, 500);


					setTimeout(function(){
						jQuery("#billing_postcode").val('');
					},100);
					
				
				}

		});
	});

	jQuery('#shipping_country').change(function(data){

		$( '.logistic_shipping_fields' ).block({
			message: null,
			overlayCSS: {
				background: '#fff',
				opacity: 0.6
			}
		});
		
	
		var data = {
				action:	'get_user_address_fields',
				country: $( '#shipping_country' ).val(),
				type: 'shipping'
			};

		jQuery.ajax({
				type:		'POST',
				url:		base_url+'/wp-admin/admin-ajax.php',
				data:		data,
				success:	function( data ) {

					// Always update the fragments
					if ( data && data.fragments ) {
						$( '.woocommerce-error, .woocommerce-message' ).remove();
						$.each( data.fragments, function ( key, value ) {
							$( key ).replaceWith( value );
							autocomplete_functions('shipping_changed');
							$( key ).unblock();
						} );
					}

					// Check for error
					if ( 'failure' == data.result ) {

						var $form = $( 'form.checkout' );

						if ( 'true' === data.reload ) {
							window.location.reload();
							return;
						}

						$( '.woocommerce-error, .woocommerce-message' ).remove();

						// Add new errors
						if ( data.messages ) {
							$form.prepend( data.messages );
						} else {
							$form.prepend( data );
						}

						// Lose focus for all fields
						$form.find( '.input-text, select' ).blur();

						// Scroll to top
						$( 'html, body' ).animate( {
							scrollTop: ( $( 'form.checkout' ).offset().top - 100 )
						}, 1000 );

					}

					setTimeout(function(){
					  $('#shipping_state').replaceWith( '<input type="text" class="input-text" value="" placeholder="Make a selection" name="shipping_state" id="shipping_state">');	
					  if(!$('#shipping_state_field').is(":visible")) {	
						  $( '#shipping_state_field' ).css('display','block');
						  $( '#shipping_state' ).attr('type','text');
						  $( '#shipping_state' ).attr('class','input-text');
					  }
					  load_states('shipping');
					  
					}, 500);


					setTimeout(function(){
						jQuery("#shipping_postcode").val('');
					},100);
				}

		});
	});

	function load_states(event_captured) {
		if(event_captured == 'billing') {
			if(jQuery("#billing_state").length) {
								if(jQuery('#billing_state').length) {
									jQuery('#billing_state').addClass('ac_loading');
									// get valus for drop down
									jQuery("#billing_state").css('background','#eee');
      								jQuery("#billing_state").attr('disabled','disabled');
									jQuery.post(base_url+'/wp-admin/admin-ajax.php',
											 { 
									            countrycode: function() { return jQuery('#billing_country').val();},
									     		action: function() { return 'get_city_states'; }
											 },
											function(data){
												
												 parseString = jQuery.parseJSON(data);
												 recordCheck = 0;
												 
												 jQuery.each(parseString, function(idx, obj) {	
												 	if(obj.stateCode != "")
												 		recordCheck = 1;
												 });

												 if(parseString != 0 && recordCheck == 1) {
												 	jQuery('#billing_state').replaceWith( '<select name="billing_state" id="billing_state" class="state_select" placeholder="billing_state"></select>' );

												 	jQuery('#billing_state option').each(function(i, option){ jQuery(option).remove(); });
													jQuery('#billing_state').append(jQuery('<option></option>').val("").html("-- Select One --"));
													jQuery.each(jQuery.parseJSON(data), function(idx, obj) {
													 	//console.log(obj.stateCode);
														jQuery('#billing_state').append(jQuery('<option></option>').val(obj.stateCode).html(obj.stateName));	
													});
												} else {
													jQuery('#billing_state').replaceWith( '<input type="text" class="input-text " value="" placeholder="Make a selection" name="billing_state" id="billing_state">');
												}

												jQuery("#billing_state").css('background','white');
												jQuery("#billing_state").prop('disabled', false);
												jQuery('#billing_state').removeClass('ac_loading');
									}); // end post function
									 
								}
							//	checkout.setLoadWaiting(false); 
							 }//End if
		} else {
			if(jQuery("#shipping_state").length) {
								if(jQuery('#shipping_state').length) {
									// get valus for drop down
									jQuery("#shipping_state").css('background','#eee');
      								jQuery("#shipping_state").attr('disabled','disabled');
									jQuery('#shipping_state').addClass('ac_loading');
									jQuery.post(base_url+'/wp-admin/admin-ajax.php',
											 { 
									            countrycode: function() { return jQuery('#shipping_country').val();},
									            action: function() { return 'get_city_states'; }
											 },
											function(data){

												 parseString = jQuery.parseJSON(data);
												 recordCheck = 0;
												 
												 jQuery.each(parseString, function(idx, obj) {
												 	if(obj.stateCode != "")
												 		recordCheck = 1;
												 });

												 if(parseString != 0 && recordCheck == 1) {
												 	jQuery('#shipping_state').replaceWith( '<select name="shipping_state" id="shipping_state" class="state_select" placeholder="shipping_state"></select>' );

												 	jQuery('#shipping_state option').each(function(i, option){ jQuery(option).remove(); });
													 jQuery('#shipping_state').append(jQuery('<option></option>').val("").html("-- Select One --"));
													 jQuery.each(jQuery.parseJSON(data), function(idx, obj) {
														jQuery('#shipping_state').append(jQuery('<option></option>').val(obj.stateCode).html(obj.stateName));	
													});
												 } else {
												 	jQuery('#shipping_state').replaceWith('<input type="text" class="input-text " value="" placeholder="Make a selection" name="shipping_state" id="shipping_state">');
												 }

												 jQuery("#shipping_state").css('background','white');
												 jQuery("#shipping_state").prop('disabled', false);
												 jQuery('#shipping_state').removeClass('ac_loading');
									}); // end post function
									 
								}
							 }//End if
		}
	}
	
	function autocomplete_functions(event_captured) {

		jQuery("#order_review_heading").hide();
		jQuery("#order_review").hide();

		jQuery(".woocommerce-billing-fields,.woocommerce-shipping-fields,.logistic_billing_fields,.logistic_shipping_fields").live('input change',function(){
				jQuery("#order_review_heading").hide();
				jQuery("#order_review").hide();
				jQuery("#validate_address").show();
				jQuery("#progress_status").val(1);
		});

		if(event_captured == 'billing_changed' || event_captured == 'onload') {
			if(jQuery("#billing_city").length) {
					/*jQuery("#billing_city").autocomplete(base_url+'/wp-admin/admin-ajax.php', {
						extraParams: {
							countrycode: function() { return jQuery('#billing_country').val();},
							city: function() { return jQuery("#billing_city").val(); },
							action: function() { return 'get_cities'; }
						},	   
						minChars: 0,
						max: 200,
						multiple:false,
						scrollHeight: 220,
						autoFill: false,
					   	mustMatch: false,
					   	selectFirst:true,
						cacheLength:1
					});*/
			}
				
		}

		if(event_captured == 'shipping_changed' || event_captured == 'onload') {
			if(jQuery("#shipping_city").length) {
				if(jQuery("#shipping_city").length) {
					/*jQuery("#shipping_city").autocomplete(base_url+'/wp-admin/admin-ajax.php', {
						extraParams: {
							countrycode: function() { return jQuery('#shipping_country').val();},
							city: function() { return jQuery("#shipping_city").val(); },
							action: function() { return 'get_cities'; }
						},	   
						minChars: 0,
						max: 200,
						multiple:false,
						scrollHeight: 220,
						autoFill: false,
					   	mustMatch: false,
					   	selectFirst:true,
						cacheLength:1
					}).focusout(function(data){ 
					});*/
					
				}		
				
			}
					
		}
	}

	autocomplete_functions('onload');

});
