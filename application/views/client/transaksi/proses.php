<?php
// This is just for very basic implementation reference, in production, you should validate the incoming requests and implement your backend more securely.
// Please refer to this docs for snap-redirect:
// https://docs.midtrans.com/en/snap/integration-guide?id=alternative-way-to-display-snap-payment-page-via-redirect

namespace Midtrans;

require_once dirname(__FILE__) . '/../../../libraries/midtrans-php/Midtrans.php';
// Set Your server key
// can find in Merchant Portal -> Settings -> Access keys
Config::$serverKey = $server_key;

// can find in Merchant Portal -> Settings -> Access keys

Config::$clientKey = 'SB-Mid-client-G699eb4x0NgQLdEL';

// Add new notification url(s) alongside the settings on Midtrans Dashboard Portal (MAP)
Config::$appendNotifUrl = "	https://webhook.site/eba8afb9-c39b-42ea-9078-8e33577f6be8";
// Use new notification url(s) disregarding the settings on Midtrans Dashboard Portal (MAP)
Config::$overrideNotifUrl = "https://webhook.site/eba8afb9-c39b-42ea-9078-8e33577f6be8";

// non-relevant function only used for demo/example purpose
printExampleWarningMessage();


// Uncomment for production environment
// Config::$isProduction = true;
Config::$isSanitized = Config::$is3ds = true;
// Uncomment for production environment
// Config::$isProduction = true;

// Uncomment to enable sanitization
// Config::$isSanitized = true;

// Uncomment to enable 3D-Secure
// Config::$is3ds = true;

// Required

// Fill SNAP API parameter
$params = array(
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
    'item_details' => $item_details,
);

// try {
    
//     // Get Snap Payment Page URL
//     $paymentUrl = Snap::createTransaction($params)->redirect_url;
  
//     // Redirect to Snap Payment Page
//     header('Location: ' . $paymentUrl);
// }
// catch (\Exception $e) {
//     echo $e->getMessage()+"hello";
// }

// function printExampleWarningMessage() {
//     if (strpos(Config::$serverKey, $server_key) != false ) {
//         echo "<code>";
//         echo "<h4>Please set your server key from sandbox</h4>";
//         echo "In file: " . __FILE__;
//         echo "<br>";
//         echo "<br>";
//         die();
//     } 
// }





$snap_token = '';
try {
    $snap_token = Snap::getSnapToken($params);
}
catch (\Exception $e) {
    echo $e->getMessage();
}
echo "snapToken = ".$snap_token;

function printExampleWarningMessage() {
    if (strpos(Config::$serverKey, 'your ') != false ) {
        echo "<code>";
        echo "<h4>Please set your server key from sandbox</h4>";
        echo "In file: " . __FILE__;
        echo "<br>";
        echo "<br>";
        echo htmlspecialchars('Config::$serverKey = \'<your server key>\';');
        die();
    } 
}

?>

<!DOCTYPE html>
<html>
    <body>
        <button id="pay-button">Pay!</button>
        <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo Config::$clientKey;?>"></script>
        <script type="text/javascript">
            document.getElementById('pay-button').onclick = function(){
                // SnapToken acquired from previous step
                snap.pay('<?php echo $snap_token?>');
            };
        </script>
    </body>
</html>