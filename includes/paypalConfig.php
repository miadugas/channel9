<?php
require_once("PayPal-PHP-SDK/autoload.php");

// After Step 1
$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'Aan2OPFp5YOg5QQ3lrP6V_hKGbrHh61OyKgNusbhITP4vIIjgDabGa4XLORpIELc-h5SUClXB_4iaCUv',     // ClientID
        'EJSVZ-axvivfq41t2A7zXaYGhTEt2QATmZ3foAiorYbjn_wGyl8bSVYGFQvXb6_8j3tsjfHKSRabcHcY'      // ClientSecret
    )
);

?>