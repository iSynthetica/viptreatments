<?php

$smsService = new BA_Sms();

$args = array(
    'utf' => true,
    'another' => false
);
$smsService->sendSms('+380509863673', 'Some sms text', false, $args);

//require_once(MNB_INCLUDES . '/Twilio/autoload.php');
//use Twilio\Rest\Client;

// -- Plivo --
//try {
//    use Plivo\RestAPI;
//} catch(Exception $e){
//    echo "Error: " . $e->getMessage();
//}

//
//$auth_id = "MANZKXMWY4NDVMMMI4OT";
//$auth_token = "OGJiMzA5MWJjM2UxZDc5NmY4NTM1OGU1N2NmY2Fl";
//
//try {
//    $p = new RestAPI($auth_id, $auth_token);
//    var_dump($p);
//} catch(Exception $e){
//    echo "Error: " . $e->getMessage();
//}
//
//$params = array(
//    'src' => 'VIPTreat', // Sender's phone number with country code
//    'dst' => '380509863673', // Receiver's phone number with country code
//    'text' => 'Hi, Message from Plivo', // Your SMS text message
//    // To send Unicode text
//    //'text' => 'こんにちは、元気ですか？' # Your SMS Text Message - Japanese
//    //'text' => 'Ce est texte généré aléatoirement' # Your SMS Text Message - French
//    //'url' => 'http://example.com/report/', // The URL to which with the status of the message is sent
//    'method' => 'POST' // The method used to call the url
//);
//// Send message
//try{
//    var_dump($response = $p->send_message($params));
//} catch(Exception $e){
//    echo "Error: " . $e->getMessage();
//}

// -- Twilio --
//$AccountSid = "ACebe3e9092caeb70caf808dd16d63266d";
//$AuthToken = "52e6743886c768256b7e67019585d5b7";
//
//$client = new Client($AccountSid, $AuthToken);

//$to = '+31615829252';
//$options = array(
//        // Step 6: Change the 'From' number below to be a valid Twilio number
//        // that you've purchased
//        'from' => "VIPTreat",
//
//        // the sms body
//        'body' => "Hey Tim, greetings from Ukraine!"
//    );
//try{
//    //var_dump($client->account->messages->create($to, $options));
//} catch(Exception $e){
//    echo "Error: " . $e->getMessage();
//}



// var_dump($client);

//$order = new WC_Order(3101);
//
//$order_items = $order->get_items();
//
//foreach ($order_items as $order_item) {
//    $product_id = $order_item['product_id'];
//    $booking_id = $order_item['Booking ID'];
//    $booking_vendor_id = WC_Product_Vendors_Utils::get_vendor_id_from_product($product_id);
//
//    //var_dump('Product ID: ' . $product_id);
//    //var_dump('Booking ID: ' . $booking_id);
//    //var_dump('Vendor ID: ' . $booking_vendor_id);
//}

//var_dump($order_items);
//var_dump($order);

//$items = $order->get_items();
//
//$vendors = WC_Product_Vendors_Utils::get_vendors_from_order($order);
//
//foreach ($vendors as $key => $vendor) {
//    $vendor_phone = get_term_meta($key, 'vendor-phone', true) ? get_term_meta($key, 'vendor-phone', true) : false;
//
//    var_dump($vendor_phone);
//
//    if ($vendor_phone) {
//        $vendor_bookings = array();
//
//        foreach ($order_items as $order_item) {
//            $product_id = $order_item['product_id'];
//            $booking_vendor_id = WC_Product_Vendors_Utils::get_vendor_id_from_product($product_id);
//            if ($booking_vendor_id == $key) {
//                $vendor_bookings[] = $booking_id = $order_item['Booking ID'];
//            }
//        }
//
//        $bookings_str = implode(', ', $vendor_bookings);
//        $body_msg = 'You have new ';
//        $body_msg .= (count($vendor_bookings) > 1) ? 'bookings: ' : 'booking: ';
//        $body_msg .= $bookings_str . '.';
//        var_dump($body_msg);
//
//        // send SMS
//        $to = $vendor_phone;
//        $options = array(
//            'from' => "VIPTreat",
//
//            // the sms body
//            'body' => $body_msg
//        );
//        try{
//            //var_dump($client->account->messages->create($to, $options));
//        } catch(Exception $e){
//            echo "Error: " . $e->getMessage();
//        }
//    }
//}

//var_dump($vendors);

?>