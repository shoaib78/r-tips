<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        // Load helpers
        $this->load->helper('url');

        // Load session library
        $this->load->library('session');

        // Load PayPal library config
        $this->config->load('paypal');

        $config = array(
            'Sandbox' => $this->config->item('Sandbox'),            // Sandbox / testing mode option.
            'APIUsername' => $this->config->item('APIUsername'),    // PayPal API username of the API caller
            'APIPassword' => $this->config->item('APIPassword'),    // PayPal API password of the API caller
            'APISignature' => $this->config->item('APISignature'),    // PayPal API signature of the API caller
            'APISubject' => '',                                    // PayPal API subject (email address of 3rd party user that has granted API permission for your app)
            'APIVersion' => $this->config->item('APIVersion'),        // API version you'd like to use for your call.  You can set a default version in the class and leave this blank if you want.
            'DeviceID' => $this->config->item('DeviceID'),
            'ApplicationID' => $this->config->item('ApplicationID'),
            'DeveloperEmailAccount' => $this->config->item('DeveloperEmailAccount')
        );

        // Show Errors
        if ($config['Sandbox']) {
            error_reporting(E_ALL);
            ini_set('display_errors', '1');
        }

        // Load PayPal library
        $this->load->library('paypal/paypal_pro', $config);
        $paypal_details = array(
            // you can get this from your Paypal account, or from your
            // test accounts in Sandbox
            'API_username' => $this->config->item('APIUsername'),
            'API_signature' => $this->config->item('APISignature'),
            'API_password' => $this->config->item('APIPassword'),
            // Paypal_ec defaults sandbox status to true
            // Change to false if you want to go live and
            // update the API credentials above
            // 'sandbox_status' => false,
        );
        $this->load->library('paypal_ec', $paypal_details);
        $this->load->library('Paypal_express');
    }

    public function process(){
        //-------------------- prepare products -------------------------

        //Mainly we need 4 variables from product page Item Name, Item Price, Item Number and Item Quantity.

        //Please Note : People can manipulate hidden field amounts in form,
        //In practical world you must fetch actual price from database using item id. Eg:
        //$products[0]['ItemPrice'] = $mysqli->query("SELECT item_price FROM products WHERE id = Product_Number");
        $cart = $this->session->userdata('cart');
        $products = [];



        // set an item via POST request

        $products[0]['ItemName'] = isset($cart['itemname']) ? $cart['itemname']:'Banner'; //Item Name
        $products[0]['ItemPrice'] = isset($cart['amount']) ? $cart['amount'] : round(1 * 2,2); //Item Price
        $products[0]['ItemNumber'] = isset($cart['item_number']) ? $cart['item_number']:'xxx1'; //Item Number
        $products[0]['ItemDesc'] = isset($cart['itemdesc']) ? $cart['itemdesc'] :'Advertisement Banners'; //Item Number
        $products[0]['ItemQty']	= isset($cart['itemQty']) ? $cart['itemQty'] : 1; // Item Quantity


        /*$products[0]['ItemName'] = 'my item 1'; //Item Name
        $products[0]['ItemPrice'] = 0.5; //Item Price
        $products[0]['ItemNumber'] = 'xxx1'; //Item Number
        $products[0]['ItemDesc'] = 'good item'; //Item Number
        $products[0]['ItemQty']	= 1; // Item Quantity*/

        /*

        // set a second item

        $products[1]['ItemName'] = 'my item 2'; //Item Name
        $products[1]['ItemPrice'] = 10; //Item Price
        $products[1]['ItemNumber'] = 'xxx2'; //Item Number
        $products[1]['ItemDesc'] = 'good item 2'; //Item Number
        $products[1]['ItemQty']	= 3; // Item Quantity
        */

        //-------------------- prepare charges -------------------------

        $charges = [];

        //Other important variables like tax, shipping cost
        $charges['TotalTaxAmount'] = 0;  //Sum of tax for all items in this order.
        $charges['HandalingCost'] = 0;  //Handling cost for this order.
        $charges['InsuranceCost'] = 0;  //shipping insurance cost for this order.
        $charges['ShippinDiscount'] = 0; //Shipping discount for this order. Specify this as negative number.
        $charges['ShippinCost'] = 0; //Although you may change the value later, try to pass in a shipping amount that is reasonably accurate.

        //------------------SetExpressCheckOut-------------------

        //We need to execute the "SetExpressCheckOut" method to obtain paypal token

        $this->paypal_express->SetExpressCheckOut($products, $charges);
    }

    public function doExpress(){
        if($this->input->get('token') && $this->input->get('token') !='' && $this->input->get('PayerID') && $this->input->get('PayerID') !=''){
            //------------------DoExpressCheckoutPayment-------------------

            //Paypal redirects back to this page using ReturnURL, We should receive TOKEN and Payer ID
            //we will be using these two variables to execute the "DoExpressCheckoutPayment"
            //Note: we haven't received any payment yet.
            $cart = $this->session->userdata('cart');
            $httpParsedResponseAr = $this->paypal_express->DoExpressCheckoutPayment();
            $transaction_id = '';

            //Check if everything went ok..
            if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])){
                $transaction_id = urldecode($httpParsedResponseAr["PAYMENTINFO_0_TRANSACTIONID"]);

                if('Completed' == $httpParsedResponseAr["PAYMENTINFO_0_PAYMENTSTATUS"]){
                    $this->common_model->initialize('banners');
                    $update_id = $this->common_model->update(array("status"=>1, "payment_status"=>1),array("banner_id"=>$cart['insert_id']));
                    $this->session->set_flashdata('payment_success','Your payment has been successfully processed.');
                }
                elseif('Pending' == $httpParsedResponseAr["PAYMENTINFO_0_PAYMENTSTATUS"]){
                    $this->session->set_flashdata('payment_success','Transaction Complete, but payment may still be pending! '.
                        'If that\'s the case, You can manually authorize this payment in your <a target="_new" href="http://www.paypal.com">Paypal Account</a></div>');
                }
                    $response = $this->paypal_express->GetTransactionDetails();
                    if("SUCCESS" == strtoupper($response["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($response["ACK"])){
                        $transaction['transaction_id'] = $transaction_id;
                        $transaction['item_number'] = $response['L_PAYMENTREQUEST_0_NUMBER0'];
                        $transaction['status'] = $httpParsedResponseAr["PAYMENTINFO_0_PAYMENTSTATUS"];
                        $transaction['banner_id'] = $cart['insert_id'];
                        $transaction['created_date'] = date("Y-m-d H:i:s");
                        $this->load->model('common_model');
                        $this->common_model->initialize('transaction');
                        $insert_id = $this->common_model->insert($transaction);
                        $this->session->unset_userdata('cart');
                        redirect('home/paymentSuccess', 'Location');
                    }
                    else  {
                        $error = '<b>GetTransactionDetails failed:</b>'.urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]);
                        $this->session->set_flashdata('payment_error',$error);
                        $this->session->unset_userdata('cart');
                        redirect('home/paymentSuccess', 'Location');
                    }
            }
            else{

                $error =  'Error : </b>'.urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]);

                $this->session->set_flashdata('payment_error',$error);
                $this->session->unset_userdata('cart');
                redirect('home/paymentSuccess', 'Location');
            }
        }else{
            $this->session->unset_userdata('cart');
            redirect(current_url(), 'Location');
        }
    }

    function SetExpressCheckout() {
        $cart = $this->session->userdata('cart');
        $products = array();
        $to_buy = array(
            'desc' => isset($cart['itemdesc']) ? $cart['itemdesc'] :'Purchase  Advertisement Banners Membershib',
            'currency' => $this->config->item('currency'),
            'type' => $this->config->item('type'),
            'return_URL' => $this->config->item('return_url'),
            // see below have a function for this -- function back()
            // whatever you use, make sure the URL is live and can process
            // the next steps
            'cancel_URL' => $this->config->item('cancel_url'), // this goes to this controllers index()
            'shipping_amount' => 0.00,
            'get_shipping' => false);
        // I am just iterating through $this->product from defined
        // above. In a live case, you could be iterating through
        // the content of your shopping cart.
        $products[0]['ItemName'] = isset($cart['itemname']) ? $cart['itemname']:'Banner'; //Item Name
        $products[0]['ItemPrice'] = isset($cart['amount']) ? $cart['amount'] : round(1 * 2,2); //Item Price
        $products[0]['ItemNumber'] = isset($cart['item_number']) ? $cart['item_number']:'xxx1'; //Item Number
        $products[0]['ItemDesc'] = isset($cart['itemdesc']) ? $cart['itemdesc'] :'Advertisement Banners'; //Item Number
        $products[0]['ItemQty']	= isset($cart['itemQty']) ? $cart['itemQty'] : 1; // Item Quantity

        foreach($products as $p) {
            $temp_product = array(
                'name' => $p['ItemName'],
                'desc' => $p['ItemDesc'],
                'number' => $p['ItemNumber'],
                'quantity' => $p['ItemQty'], // simple example -- fixed to 1
                'amount' => $p['ItemPrice']);

            // add product to main $to_buy array
            $to_buy['products'][] = $temp_product;
        }
        // enquire Paypal API for token
        $set_ec_return = $this->paypal_ec->set_ec($to_buy);
        if (isset($set_ec_return['ec_status']) && ($set_ec_return['ec_status'] === true)) {
            // redirect to Paypal
            $this->paypal_ec->redirect_to_paypal($set_ec_return['TOKEN']);
            // You could detect your visitor's browser and redirect to Paypal's mobile checkout
            // if they are on a mobile device. Just add a true as the last parameter. It defaults
            // to false
            // $this->paypal_ec->redirect_to_paypal( $set_ec_return['TOKEN'], true);
        } else {
            $this->_error($set_ec_return);
        }
    }

    /* -------------------------------------------------------------------------------------------------
    * a sample back function that handles
    * --------------------------------------------------------------------------------------------------
    */
    function DoExpressCheckout() {
        // we are back from Paypal. We need to do GetExpressCheckoutDetails
        // and DoExpressCheckoutPayment to complete.
        $token = $_GET['token'];
        $payer_id = $_GET['PayerID'];
        // GetExpressCheckoutDetails
        $get_ec_return = $this->paypal_ec->get_ec($token);
        if (isset($get_ec_return['ec_status']) && ($get_ec_return['ec_status'] === true)) {
            // at this point, you have all of the data for the transaction.
            // you may want to save the data for future action. what's left to
            // do is to collect the money -- you do that by call DoExpressCheckoutPayment
            // via $this->paypal_ec->do_ec();
            //
            // I suggest to save all of the details of the transaction. You get all that
            // in $get_ec_return array
            $ec_details = array(
                'token' => $token,
                'payer_id' => $payer_id,
                'currency' => $this->config->item('currency'),
                'amount' => $get_ec_return['PAYMENTREQUEST_0_AMT'],
                'IPN_URL' => $this->config->item('ipn_url'),
                // in case you want to log the IPN, and you
                // may have to in case of Pending transaction
                'type' => $this->config->item('type'));

            // DoExpressCheckoutPayment
            $do_ec_return = $this->paypal_ec->do_ec($ec_details);
            if (isset($do_ec_return['ec_status']) && ($do_ec_return['ec_status'] === true)) {
                // at this point, you have collected payment from your customer
                // you may want to process the order now.
                echo "<h1>Thank you. We will process your order now.</h1>";
                echo "<pre>";
                echo "\nGetExpressCheckoutDetails Data\n" . print_r($get_ec_return, true);
                echo "\n\nDoExpressCheckoutPayment Data\n" . print_r($do_ec_return, true);
                echo "</pre>";
            } else {
                //$this->_error($do_ec_return);
                $error =  'Message:' . $this->session->userdata('curl_error_msg');

                $this->session->set_flashdata('payment_error',$error);
                $this->session->unset_userdata('cart');
                redirect('home/paymentSuccess', 'Location');
            }
        } else {
            //$this->_error($get_ec_return);
            $error =  'Message:' . $this->session->userdata('curl_error_msg');

            $this->session->set_flashdata('payment_error',$error);
            $this->session->unset_userdata('cart');
            redirect('home/paymentSuccess', 'Location');
        }
    }

    /* -------------------------------------------------------------------------------------------------
    * The location for your IPN_URL that you set for $this->paypal_ec->do_ec(). obviously more needs to
    * be done here. this is just a simple logging example. The /ipnlog folder should the same level as
    * your CodeIgniter's index.php
    * --------------------------------------------------------------------------------------------------
    */
    function ipn() {
        $logfile = 'ipnlog/' . uniqid() . '.html';
        $logdata = "<pre>\r\n" . print_r($_POST, true) . '</pre>';
        file_put_contents($logfile, $logdata);
    }


    /**
     * SetExpressCheckout
     */
    function SetExpressCheckoutPayment()
    {
        // Clear PayPalResult from session userdata
        $this->session->unset_userdata('PayPalResult');

        // Get cart data from session userdata
        $cart = $this->session->userdata('cart');

        /**
         * Here we are setting up the parameters for a basic Express Checkout flow.
         *
         * The template provided at /vendor/angelleye/paypal-php-library/templates/SetExpressCheckout.php
         * contains a lot more parameters that we aren't using here, so I've removed them to keep this clean.
         *
         * $domain used here is set in the config file.
         */
        $SECFields = array(
            'maxamt' => round($cart['amount'] * 2,2), 					// The expected maximum total amount the order will be, including S&H and sales tax.
            'returnurl' => base_url('payment/GetExpressCheckoutDetails'), 							    // Required.  URL to which the customer will be returned after returning from PayPal.  2048 char max.
            'cancelurl' => base_url('payment/OrderCancelled'), 							    // Required.  URL to which the customer will be returned if they cancel payment on PayPal's site.
            'hdrimg' => base_url().'assets/images/logo.png', 			// URL for the image displayed as the header during checkout.  Max size of 750x90.  Should be stored on an https:// server or you'll get a warning message in the browser.
            'logoimg' => base_url().'assets/images/logo.png', 					// A URL to your logo image.  Formats:  .gif, .jpg, .png.  190x60.  PayPal places your logo image at the top of the cart review area.  This logo needs to be stored on a https:// server.
            'brandname' => 'Tips and Go', 							                                // A label that overrides the business name in the PayPal account on the PayPal hosted checkout pages.  127 char max.
            'customerservicenumber' => '123-123-1234', 				                                // Merchant Customer Service number displayed on the PayPal Review page. 16 char max.
        );

        /**
         * Now we begin setting up our payment(s).
         *
         * Express Checkout includes the ability to setup parallel payments,
         * so we have to populate our $Payments array here accordingly.
         *
         * For this sample (and in most use cases) we only need a single payment,
         * but we still have to populate $Payments with a single $Payment array.
         *
         * Once again, the template file includes a lot more available parameters,
         * but for this basic sample we've removed everything that we're not using,
         * so all we have is an amount.
         */
        $Payments = array();
        $Payment = array(
            'amt' => $cart['amount'], 	// Required.  The total cost of the transaction to the customer.  If shipping cost and tax charges are known, include them in this value.  If not, this value should be the current sub-total of the order.
        );

        /**
         * Here we push our single $Payment into our $Payments array.
         */
        array_push($Payments, $Payment);

        /**
         * Now we gather all of the arrays above into a single array.
         */
        $PayPalRequestData = array(
            'SECFields' => $SECFields,
            'Payments' => $Payments,
        );

        /**
         * Here we are making the call to the SetExpressCheckout function in the library,
         * and we're passing in our $PayPalRequestData that we just set above.
         */
        $PayPalResult = $this->paypal_pro->SetExpressCheckout($PayPalRequestData);

        /**
         * Now we'll check for any errors returned by PayPal, and if we get an error,
         * we'll save the error details to a session and redirect the user to an
         * error page to display it accordingly.
         *
         * If all goes well, we save our token in a session variable so that it's
         * readily available for us later, and then redirect the user to PayPal
         * using the REDIRECTURL returned by the SetExpressCheckout() function.
         */
        if(!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK']))
        {
            $errors = array('Errors'=>$PayPalResult['ERRORS']);

            // Load errors to variable
            $this->load->vars('errors', $errors);

            $this->load->view('payment/paypal_error');
        }
        else
        {
            // Successful call.

            // Set PayPalResult into session userdata (so we can grab data from it later on a 'payment complete' page)
            $this->session->set_userdata('PayPalResult', $PayPalResult);

            // In most cases you would automatically redirect to the returned 'RedirectURL' by using: redirect($PayPalResult['REDIRECTURL'],'Location');
            // Move to PayPal checkout
            redirect($PayPalResult['REDIRECTURL'], 'Location');
        }
    }

    /**
     * GetExpressCheckoutDetails
     */
    function GetExpressCheckoutDetails()
    {
        // Get cart data from session userdata
        $cart = $this->session->userdata('cart');

        // Get PayPal data from session userdata
        $SetExpressCheckoutPayPalResult = $this->session->userdata('PayPalResult');
        $PayPal_Token = $SetExpressCheckoutPayPalResult['TOKEN'];

        /**
         * Now we pass the PayPal token that we saved to a session variable
         * in the SetExpressCheckout.php file into the GetExpressCheckoutDetails
         * request.
         */
        $PayPalResult = $this->paypal_pro->GetExpressCheckoutDetails($PayPal_Token);
        /**
         * Now we'll check for any errors returned by PayPal, and if we get an error,
         * we'll save the error details to a session and redirect the user to an
         * error page to display it accordingly.
         *
         * If the call is successful, we'll save some data we might want to use
         * later into session variables.
         */
        if(!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK']))
        {
            $errors = array('Errors'=>$PayPalResult['ERRORS']);

            // Load errors to variable
            $this->load->vars('errors', $errors);

            $this->load->view('payment/paypal_error');
        }
        else
        {
            // Successful call.

            /**
             * Here we'll pull out data from the PayPal response.
             * Refer to the PayPal API Reference for all of the variables available
             * in $PayPalResult['variablename']
             *
             * https://developer.paypal.com/docs/classic/api/merchant/GetExpressCheckoutDetails_API_Operation_NVP/
             *
             * Again, Express Checkout allows for parallel payments, so what we're doing here
             * is usually the library to parse out the individual payments using the GetPayments()
             * method so that we can easily access the data.
             *
             * We only have a single payment here, which will be the case with most checkouts,
             * but we will still loop through the $Payments array returned by the library
             * to grab our data accordingly.
             */
            $cart['paypal_payer_id'] = isset($PayPalResult['PAYERID']) ? $PayPalResult['PAYERID'] : '';
            $cart['phone_number'] = isset($PayPalResult['PHONENUM']) ? $PayPalResult['PHONENUM'] : '';
            $cart['email'] = isset($PayPalResult['EMAIL']) ? $PayPalResult['EMAIL'] : '';
            $cart['first_name'] = isset($PayPalResult['FIRSTNAME']) ? $PayPalResult['FIRSTNAME'] : '';
            $cart['last_name'] = isset($PayPalResult['LASTNAME']) ? $PayPalResult['LASTNAME'] : '';

            foreach($PayPalResult['PAYMENTS'] as $payment) {
                $cart['shipping_name'] = isset($payment['SHIPTONAME']) ? $payment['SHIPTONAME'] : '';
                $cart['shipping_street'] = isset($payment['SHIPTOSTREET']) ? $payment['SHIPTOSTREET'] : '';
                $cart['shipping_city'] = isset($payment['SHIPTOCITY']) ? $payment['SHIPTOCITY'] : '';
                $cart['shipping_state'] = isset($payment['SHIPTOSTATE']) ? $payment['SHIPTOSTATE'] : '';
                $cart['shipping_zip'] = isset($payment['SHIPTOZIP']) ? $payment['SHIPTOZIP'] : '';
                $cart['shipping_country_code'] = isset($payment['SHIPTOCOUNTRYCODE']) ? $payment['SHIPTOCOUNTRYCODE'] : '';
                $cart['shipping_country_name'] = isset($payment['SHIPTOCOUNTRYNAME']) ? $payment['SHIPTOCOUNTRYNAME'] : '';
            }

            /**
             * At this point, we now have the buyer's shipping address available in our app.
             * We could now run the data through a shipping calculator to retrieve rate
             * information for this particular order.
             *
             * This would also be the time to calculate any sales tax you may need to
             * add to the order, as well as handling fees.
             *
             * We're going to set static values for these things in our static
             * shopping cart, and then re-calculate our grand total.
             */
            /*$cart['shopping_cart']['shipping'] = 10.00;
            $cart['shopping_cart']['handling'] = 2.50;
            $cart['shopping_cart']['tax'] = 1.50;

            $cart['shopping_cart']['grand_total'] = number_format(
                $cart['shopping_cart']['subtotal']
                + $cart['shopping_cart']['shipping']
                + $cart['shopping_cart']['handling']
                + $cart['shopping_cart']['tax'],2);*/

            $cart['grand_total'] = number_format($cart['amount'],2);
            /**
             * Now we will redirect the user to a final review
             * page so they can see the shipping/handling/tax
             * that has been added to the order.
             */
            // Set example cart data into session
            $this->session->set_userdata('cart', $cart);
            redirect('payment/DoExpressCheckoutPayment', 'Location');
            // Load example cart data to variable
            /*$this->load->vars('cart', $cart);

            // Example - Load Review Page
            $this->load->view('paypal/demos/express_checkout/review', $cart);*/
        }
    }

    /**
     * DoExpressCheckoutPayment
     */
    function DoExpressCheckoutPayment()
    {
        /**
         * Now we'll setup the request params for the final call in the Express Checkout flow.
         * This is very similar to SetExpressCheckout except that now we can include values
         * for the shipping, handling, and tax amounts, as well as the buyer's name and
         * shipping address that we obtained in the GetExpressCheckoutDetails step.
         *
         * If this information is not included in this final call, it will not be
         * available in PayPal's transaction details data.
         *
         * Once again, the template for DoExpressCheckoutPayment provides
         * many more params that are available, but we've stripped everything
         * we are not using in this basic demo out.
         */

        // Get cart data from session userdata
        $cart = $this->session->userdata('shopping_cart');

        // Get cart data from session userdata
        $SetExpressCheckoutPayPalResult = $this->session->userdata('PayPalResult');
        $PayPal_Token = $SetExpressCheckoutPayPalResult['TOKEN'];

        $DECPFields = array(
            'token' => $PayPal_Token, 								// Required.  A timestamped token, the value of which was returned by a previous SetExpressCheckout call.
            'payerid' => $cart['paypal_payer_id'], 							// Required.  Unique PayPal customer id of the payer.  Returned by GetExpressCheckoutDetails, or if you used SKIPDETAILS it's returned in the URL back to your RETURNURL.
        );

        /**
         * Just like with SetExpressCheckout, we need to gather our $Payment
         * data to pass into our $Payments array.  This time we can include
         * the shipping, handling, tax, and shipping address details that we
         * now have.
         */
        $Payments = array();
        $Payment = array(
            'amt' => number_format($cart['grand_total'],2), 	    // Required.  The total cost of the transaction to the customer.  If shipping cost and tax charges are known, include them in this value.  If not, this value should be the current sub-total of the order.
            'itemamt' => number_format($cart['grand_total'],2),       // Subtotal of items only.
            'currencycode' => 'EUR', 					                                // A three-character currency code.  Default is USD.
            /*'shippingamt' => number_format($cart['shopping_cart']['shipping'],2), 	// Total shipping costs for this order.  If you specify SHIPPINGAMT you mut also specify a value for ITEMAMT.
            'handlingamt' => number_format($cart['shopping_cart']['handling'],2), 	// Total handling costs for this order.  If you specify HANDLINGAMT you mut also specify a value for ITEMAMT.
            'taxamt' => number_format($cart['shopping_cart']['tax'],2), 			// Required if you specify itemized L_TAXAMT fields.  Sum of all tax items in this order.*/
            'shiptoname' => $cart['shipping_name'], 					            // Required if shipping is included.  Person's name associated with this address.  32 char max.
            'shiptostreet' => $cart['shipping_street'], 					        // Required if shipping is included.  First street address.  100 char max.
            'shiptocity' => $cart['shipping_city'], 					            // Required if shipping is included.  Name of city.  40 char max.
            'shiptostate' => $cart['shipping_state'], 					            // Required if shipping is included.  Name of state or province.  40 char max.
            'shiptozip' => $cart['shipping_zip'], 						            // Required if shipping is included.  Postal code of shipping address.  20 char max.
            'shiptocountrycode' => $cart['shipping_country_code'], 				    // Required if shipping is included.  Country code of shipping address.  2 char max.
            'shiptophonenum' => $cart['phone_number'],  				            // Phone number for shipping address.  20 char max.
            'paymentaction' => 'Sale', 					                                // How you want to obtain the payment.  When implementing parallel payments, this field is required and must be set to Order.
        );

        /**
         * Here we push our single $Payment into our $Payments array.
         */
        array_push($Payments, $Payment);

        /**
         * Now we gather all of the arrays above into a single array.
         */
        $PayPalRequestData = array(
            'DECPFields' => $DECPFields,
            'Payments' => $Payments,
        );

        /**
         * Here we are making the call to the DoExpressCheckoutPayment function in the library,
         * and we're passing in our $PayPalRequestData that we just set above.
         */
        $PayPalResult = $this->paypal_pro->DoExpressCheckoutPayment($PayPalRequestData);
        echo "<pre>"; print_r($PayPalResult);exit;
        /**
         * Now we'll check for any errors returned by PayPal, and if we get an error,
         * we'll save the error details to a session and redirect the user to an
         * error page to display it accordingly.
         *
         * If the call is successful, we'll save some data we might want to use
         * later into session variables, and then redirect to our final
         * thank you / receipt page.
         */
        if(!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK']))
        {
            $errors = array('Errors'=>$PayPalResult['ERRORS']);

            // Load errors to variable
            $this->load->vars('errors', $errors);

            $this->load->view('payment/paypal_error');
        }
        else
        {
            // Successful call.
            /**
             * Once again, since Express Checkout allows for multiple payments in a single transaction,
             * the DoExpressCheckoutPayment response is setup to provide data for each potential payment.
             * As such, we need to loop through all the payment info in the response.
             *
             * The library helps us do this using the GetExpressCheckoutPaymentInfo() method.  We'll
             * load our $payments_info using that method, and then loop through the results to pull
             * out our details for the transaction.
             *
             * Again, in this case we are you only working with a single payment, but we'll still
             * loop through the results accordingly.
             *
             * Here, we're only pulling out the PayPal transaction ID and fee amount, but you may
             * refer to the API reference for all the additional parameters you have available at
             * this point.
             *
             * https://developer.paypal.com/docs/classic/api/merchant/DoExpressCheckoutPayment_API_Operation_NVP/
             */
            foreach($PayPalResult['PAYMENTS'] as $payment)
            {
                $cart['paypal_transaction_id'] = isset($payment['TRANSACTIONID']) ? $payment['TRANSACTIONID'] : '';
                $cart['paypal_fee'] = isset($payment['FEEAMT']) ? $payment['FEEAMT'] : '';
            }

            // Set example cart data into session
            $this->session->set_userdata('shopping_cart', $cart);

            // Successful Order
            redirect('express_checkout/OrderComplete');
        }
    }

    /**
     * Order Complete - Pay Return Url
     */
    function OrderComplete()
    {
        // Get cart from session userdata
        $cart = $this->session->userdata('shopping_cart');

        if(empty($cart)) redirect('express_checkout');

        // Set cart data into session userdata
        $this->load->vars('cart', $cart);

        // Successful call.  Load view or whatever you need to do here.
        $this->load->view('payment/payment_complete');
    }

    /**
     * Order Cancelled - Pay Cancel Url
     */
    function OrderCancelled()
    {
        // Clear PayPalResult from session userdata
        $this->session->unset_userdata('PayPalResult');

        // Clear cart from session userdata
        $this->session->unset_userdata('shopping_cart');

        // Successful call.  Load view or whatever you need to do here.
        $this->load->view('payment/order_cancelled');
    }

    function _error($ecd) {
        echo "<br>error at Express Checkout<br>";
        echo "<pre>" . print_r($ecd, true) . "</pre>";
        echo "<br>CURL error message<br>";
        echo 'Message:' . $this->session->userdata('curl_error_msg') . '<br>';
        echo 'Number:' . $this->session->userdata('curl_error_no') . '<br>';
    }
}