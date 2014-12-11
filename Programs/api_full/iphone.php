<?php

// My device token here (without spaces):
$deviceToken = '7970c71e949aba127fbd77a7faab38a9b10a8b7ba83212c3ce52055713fd25bd';

// My private key's passphrase here:
$passphrase = 'F0mac2k44';

// My alert message here:
$message = 'New Push Notification!';

//badge
$badge = 1;

$ctx = stream_context_create();
stream_context_set_option($ctx, 'ssl', 'local_cert', 'c2k.pem');
stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

// Open a connection to the APNS server
$fp = stream_socket_client(
    'ssl://gateway.sandbox.push.apple.com:2195', $err,
    $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

if (!$fp)
exit("Failed to connect: $err $errstr" . PHP_EOL);

echo 'Connected to APNS' . PHP_EOL;

// Create the payload body
$body['aps'] = array(
    'alert' => "testing notifications",
    'badge' => 70,
    'sound' => 'newMessage.wav'
);

// Encode the payload as JSON
$payload = json_encode($body);

// Build the binary notification
$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

// Send it to the server
$result = fwrite($fp, $msg, strlen($msg));

if (!$result)
    echo 'Error, notification not sent' . PHP_EOL;
else
    echo 'notification sent!' . PHP_EOL;

// Close the connection to the server
fclose($fp);
?>