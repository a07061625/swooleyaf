<?php
require __DIR__ . '/../../vendor/autoload.php';

use Sample\AuthorizeIntentExamples\AuthorizeOrder;
use Sample\AuthorizeIntentExamples\CaptureOrder;
use Sample\AuthorizeIntentExamples\CreateOrder;
use Sample\RefundOrder;

$order = CreateOrder::createOrder();

echo "Creating Order...\n";
$orderId = '';
if ($order->statusCode == 201) {
    $orderId = $order->result->id;
    echo "Links:\n";
    for ($i = 0; $i < count($order->result->links); ++$i) {
        $link = $order->result->links[$i];
        echo "\t{$link->rel}: {$link->href}\tCall Type: {$link->method}\n";
    }
    echo "Created Successfully\n";
    echo "Copy approve link and paste it in browser. Login with buyer account and follow the instructions.\nOnce approved hit enter...\n";
} else {
    exit(1);
}

$handle = fopen('php://stdin', 'r');
$line = fgets($handle);
fclose($handle);

echo "Authorizing Order...\n";
$response = AuthorizeOrder::authorizeOrder($orderId);
$authId = '';

if ($response->statusCode == 201) {
    echo "Authorized Successfully\n";
    $authId = $response->result->purchase_units[0]->payments->authorizations[0]->id;
} else {
    exit(1);
}

echo "\nCapturing Order...\n";
$response = CaptureOrder::captureOrder($authId);
if ($response->statusCode == 201) {
    echo "Captured Successfully\n";
    echo "Status Code: {$response->statusCode}\n";
    echo "Status: {$response->result->status}\n";
    $captureId = $response->result->id;
    echo "Capture ID: {$captureId}\n";
    echo "Links:\n";
    for ($i = 0; $i < count($response->result->links); ++$i) {
        $link = $response->result->links[$i];
        echo "\t{$link->rel}: {$link->href}\tCall Type: {$link->method}\n";
    }
} else {
    exit(1);
}

echo "\nRefunding Order...\n";
$response = RefundOrder::refundOrder($captureId);
if ($response->statusCode == 201) {
    echo "Refunded Successfully\n";
    echo "Status Code: {$response->statusCode}\n";
    echo "Status: {$response->result->status}\n";
    echo "Refund ID: {$response->result->id}\n";
    echo "Links:\n";
    for ($i = 0; $i < count($response->result->links); ++$i) {
        $link = $response->result->links[$i];
        echo "\t{$link->rel}: {$link->href}\tCall Type: {$link->method}\n";
    }
} else {
    exit(1);
}
