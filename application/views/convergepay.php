<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Page</title>
    <script src="https://api.demo.convergepay.com/hosted-payments/Checkout.js"></script> <!-- Ensure this URL is correct -->
</head>
<body>
    
    <button id="clicktopay-button">Pay with MasterPass</button>

    <script>
   
        var baseUrl = '<?php echo base_url(); ?>';

        var paymentData = {
            ssl_txn_auth_token: '<?=$transaction_token?>',  
            ssl_callback_url: baseUrl + 'Order/process_payment'
        };

        var callback = {
            onError: function (error) {
                console.error("Error:", error);
            },
            onDeclined: function (response) {
                console.log("Payment Declined:", response);
            },
            onApproval: function (response) {
                console.log("Payment Approved:", response);
            },
            onCancelled: function () {
                console.log("Payment Cancelled");
            }
        };

        // Initialize MasterPass payment
        ConvergeEmbeddedPayment.initMasterPass('clicktopay-button', paymentData, callback);

        document.addEventListener('DOMContentLoaded', function () {
            var button = document.getElementById('clicktopay-button');
            if (button) {
                button.click();
            }
        });
    </script>
</body>
</html>
