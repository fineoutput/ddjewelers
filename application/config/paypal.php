<?php
/** set your paypal credential **/

$config['client_id'] = 'ATuNwrbV--RFQAPxKKbtC2_2-6wnphpS5aD-FTXHxJ6zY0uOfZd0FQFzV8goAxiQ3Pgqxlcnkmm1UQX3';
$config['secret'] = 'ECwjgvX-BYfDa2rw9_FKxU8gim3mFf3t93BgxuRMhUwOQCHlSOJBuBnFOKvFKIZpede1NpzDtABn4oZy';


/**
 * SDK configuration
 */
/**
 * Available option 'sandbox' or 'live'
 */
$config['settings'] = array(

    'mode' => 'sandbox',
    /**
     * Specify the max request time in seconds
     */
    'http.ConnectionTimeOut' => 1000,
    /**
     * Whether want to log to a file
     */
    'log.LogEnabled' => true,
    /**
     * Specify the file that want to write on
     */
    'log.FileName' => 'application/logs/paypal.log',
    /**
     * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
     *
     * Logging is most verbose in the 'FINE' level and decreases as you
     * proceed towards ERROR
     */
    'log.LogLevel' => 'FINE'
);
