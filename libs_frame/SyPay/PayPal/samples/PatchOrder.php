<?php
namespace Sample;

require __DIR__ . '/../vendor/autoload.php';

use Sample\AuthorizeIntentExamples\CreateOrder;
use SyPay\PayPal\Orders\OrdersGetRequest;
use SyPay\PayPal\Orders\OrdersPatchRequest;

class PatchOrder
{
    public static function patchOrder($orderId)
    {
        $client = PayPalClient::client();

        $request = new OrdersPatchRequest($orderId);
        $request->body = self::buildRequestBody();
        $client->execute($request);

        $response = $client->execute(new OrdersGetRequest($orderId));

        echo "Status Code: {$response->statusCode}\n";
        echo "Status: {$response->result->status}\n";
        echo "Order ID: {$response->result->id}\n";
        echo "Intent: {$response->result->intent}\n";
        echo "Links:\n";
        foreach ($response->result->links as $link) {
            echo "\t{$link->rel}: {$link->href}\tCall Type: {$link->method}\n";
        }

        echo "Gross Amount: {$response->result->purchase_units[0]->amount->currency_code} {$response->result->purchase_units[0]->amount->value}\n";

        // To toggle printing the whole response body comment/uncomment below line
        echo json_encode($response->result, JSON_PRETTY_PRINT), "\n";
    }
    private static function buildRequestBody()
    {
        return [
            0 => [
                'op' => 'replace',
                'path' => '/intent',
                'value' => 'CAPTURE',
            ],
            1 => [
                'op' => 'replace',
                'path' => '/purchase_units/@reference_id==\'PUHF\'/amount',
                'value' => [
                    'currency_code' => 'USD',
                    'value' => '200.00',
                    'breakdown' => [
                        'item_total' => [
                            'currency_code' => 'USD',
                            'value' => '180.00',
                        ],
                        'tax_total' => [
                            'currency_code' => 'USD',
                            'value' => '20.00',
                        ],
                    ],
                ],
            ],
        ];
    }
}

if (!count(debug_backtrace())) {
    echo "Before PATCH:\n";
    $createdOrder = CreateOrder::createOrder(true)->result;
    echo "\nAfter PATCH (Changed Intent and Amount):\n";
    PatchOrder::patchOrder($createdOrder->id);
}
