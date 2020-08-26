<?php
namespace Sample\CaptureIntentExamples;

require __DIR__ . '/../../vendor/autoload.php';

use Sample\PayPalClient;
use SyPay\PayPal\Orders\OrdersCreateRequest;

class CreateOrder
{
    /**
     * This is the sample function which can be sued to create an order. It uses the
     * JSON body returned by buildRequestBody() to create an new Order.
     *
     * @param mixed $debug
     */
    public static function createOrder($debug = false)
    {
        $request = new OrdersCreateRequest();
        $request->headers['prefer'] = 'return=representation';
        $request->body = self::buildRequestBody();

        $client = PayPalClient::client();
        $response = $client->execute($request);
        if ($debug) {
            echo "Status Code: {$response->statusCode}\n";
            echo "Status: {$response->result->status}\n";
            echo "Order ID: {$response->result->id}\n";
            echo "Intent: {$response->result->intent}\n";
            echo "Links:\n";
            foreach ($response->result->links as $link) {
                echo "\t{$link->rel}: {$link->href}\tCall Type: {$link->method}\n";
            }
            // To toggle printing the whole response body comment/uncomment below line
            echo json_encode($response->result, JSON_PRETTY_PRINT), "\n";
        }

        return $response;
    }
    /**
     * Setting up the JSON request body for creating the Order. The Intent in the
     * request body should be set as "CAPTURE" for capture intent flow.
     */
    private static function buildRequestBody()
    {
        return [
            'intent' => 'CAPTURE',
            'application_context' => [
                'return_url' => 'https://example.com/return',
                'cancel_url' => 'https://example.com/cancel',
                'brand_name' => 'EXAMPLE INC',
                'locale' => 'en-US',
                'landing_page' => 'BILLING',
                'shipping_preference' => 'SET_PROVIDED_ADDRESS',
                'user_action' => 'PAY_NOW',
            ],
            'purchase_units' => [
                0 => [
                    'reference_id' => 'PUHF',
                    'description' => 'Sporting Goods',
                    'custom_id' => 'CUST-HighFashions',
                    'soft_descriptor' => 'HighFashions',
                    'amount' => [
                        'currency_code' => 'USD',
                        'value' => '220.00',
                        'breakdown' => [
                            'item_total' => [
                                'currency_code' => 'USD',
                                'value' => '180.00',
                            ],
                            'shipping' => [
                                'currency_code' => 'USD',
                                'value' => '20.00',
                            ],
                            'handling' => [
                                'currency_code' => 'USD',
                                'value' => '10.00',
                            ],
                            'tax_total' => [
                                'currency_code' => 'USD',
                                'value' => '20.00',
                            ],
                            'shipping_discount' => [
                                'currency_code' => 'USD',
                                'value' => '10.00',
                            ],
                        ],
                    ],
                    'items' => [
                        0 => [
                            'name' => 'T-Shirt',
                            'description' => 'Green XL',
                            'sku' => 'sku01',
                            'unit_amount' => [
                                'currency_code' => 'USD',
                                'value' => '90.00',
                            ],
                            'tax' => [
                                'currency_code' => 'USD',
                                'value' => '10.00',
                            ],
                            'quantity' => '1',
                            'category' => 'PHYSICAL_GOODS',
                        ],
                        1 => [
                            'name' => 'Shoes',
                            'description' => 'Running, Size 10.5',
                            'sku' => 'sku02',
                            'unit_amount' => [
                                'currency_code' => 'USD',
                                'value' => '45.00',
                            ],
                            'tax' => [
                                'currency_code' => 'USD',
                                'value' => '5.00',
                            ],
                            'quantity' => '2',
                            'category' => 'PHYSICAL_GOODS',
                        ],
                    ],
                    'shipping' => [
                        'method' => 'United States Postal Service',
                        'name' => [
                            'full_name' => 'John Doe',
                        ],
                        'address' => [
                            'address_line_1' => '123 Townsend St',
                            'address_line_2' => 'Floor 6',
                            'admin_area_2' => 'San Francisco',
                            'admin_area_1' => 'CA',
                            'postal_code' => '94107',
                            'country_code' => 'US',
                        ],
                    ],
                ],
            ],
        ];
    }
}

/**
 * This is the driver function which invokes the createOrder function to create
 * an sample order.
 */
if (!count(debug_backtrace())) {
    CreateOrder::createOrder(true);
}
