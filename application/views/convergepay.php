<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout.js Click to Pay Demo</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://api.demo.convergepay.com/hosted-payments/Checkout.js"></script>
    <script>
        var transactionToken;
        
        var callback = {
            onError: function (error) {
                showResult("error", error);
            },
            onDeclined: function (response) {
                showResult("declined", JSON.stringify(response));
            },
            onApproval: function (response) {
                showResult("approval", JSON.stringify(response));
            },
            onCancelled: function () {
                showResult("cancelled", "");
            }
        };

        function initiateCheckoutJS() {
            var tokenRequest = {
                ssl_account_id: $("#ssl_account_id").val(),
                ssl_user_id: $("#ssl_user_id").val(),
                ssl_pin: $("#ssl_pin").val(),
                ssl_transaction_type: $("#ssl_transaction_type").val(),
                ssl_amount: $("#ssl_amount").val()
            };

            $.post("https://www.api.demo.convergepay.com/hosted-payments/transaction_token", tokenRequest, function(data) {
                $("#token").html(data);
                transactionToken = data;
                initiateEwallets();
            }).fail(function(xhr, status, error) {
                showResult("error", xhr.responseText);
            });

            return false;
        }
        
        function initiateEwallets() {
            var baseUrl = '<?php echo base_url(); ?>';
            var paymentData = {
                ssl_txn_auth_token: transactionToken,
                ssl_callback_url: baseUrl + 'home/process_payment'
            };
            ConvergeEmbeddedPayment.initMasterPass('clicktopay-button', paymentData, callback);
            return false;
        }
        
        function showResult(status, msg, hash) {
            document.getElementById('txn_status').innerHTML = "<b>" + status + "</b>";
            document.getElementById('txn_response').innerHTML = msg;
            document.getElementById('txn_hash').innerHTML = hash || '';
        }
    </script>
</head>
<body>
    <form name="getSessionTokenForm">
        Converge Account Number: <input type="text" id="ssl_account_id" name="ssl_account_id" size="20" value="2540722"> <br>
        API User ID: <input type="text" id="ssl_user_id" name="ssl_user_id" size="20" value="8043050684"> <br>
        API User Terminal Identifier: <input type="text" id="ssl_pin" name="ssl_pin" size="64" value="4YM8LZKE7G178U0KYYWB8M7Z41573H5VH4MB5HRSTSXHMXTNTBZ9AF38ZRGOGPAP"> <br>
        Transaction Type: <input type="text" id="ssl_transaction_type" name="ssl_transaction_type" value="CCSALE"> <br>
        Transaction Amount: <input type="text" id="ssl_amount" name="ssl_amount" value="1.00"> <br> <br>
        <button onclick="return initiateCheckoutJS();">Initiate Checkout.js</button> <br>
    </form>
    <br>
    Transaction Token: <span id="token"></span> <br><br>
    <div id="clicktopay-button"></div>
    <br>
    Transaction Status:<div id="txn_status"></div>
    <br>
    Transaction Response:<div id="txn_response"></div>
    <br>
    Transaction Hash Value:<div id="txn_hash"></div>
</body>
</html>