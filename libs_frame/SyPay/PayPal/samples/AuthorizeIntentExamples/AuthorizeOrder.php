<?php
namespace Sample\AuthorizeIntentExamples;

require __DIR__ . '/../../vendor/autoload.php';

use Sample\PayPalClient;
use SyPay\PayPal\Orders\OrdersAuthorizeRequest;

class AuthorizeOrder
{
    /**
     * Setting up request body for Authorize. This can be populated with fields as per need. Refer API docs for more details.
     */
    public static function buildRequestBody()
    {
        return '{}';
    }

    /**
     * This function can be used to perform authorization on the approved order.
     * Valid Approved order id should be passed as an argument.
     *
     * @param mixed $orderId
     * @param mixed $debug
     */
    public static function authorizeOrder($orderId, $debug = false)
    {
        $request = new OrdersAuthorizeRequest($orderId);
        $request->body = self::buildRequestBody();

        $client = PayPalClient::client();
        $response = $client->execute($request);
        if ($debug) {
            echo "Status Code: {$response->statusCode}\n";
            echo "Status: {$response->result->status}\n";
            echo "Order ID: {$response->result->id}\n";
            echo "Authorization ID: {$response->result->purchase_units[0]->payments->authorizations[0]->id}\n";
            echo "Links:\n";
            foreach ($response->result->links as $link) {
                echo "\t{$link->rel}: {$link->href}\tCall Type: {$link->method}\n";
            }
            echo "Authorization Links:\n";
            foreach ($response->result->purchase_units[0]->payments->authorizations[0]->links as $link) {
                echo "\t{$link->rel}: {$link->href}\tCall Type: {$link->method}\n";
            }
            // To toggle printing the whole response body comment/uncomment below line
            echo json_encode($response->result, JSON_PRETTY_PRINT), "\n";
        }

        return $response;
    }
}

/**
 * This is an driver function which invokes authorize order.
 */
if (!count(debug_backtrace())) {
    AuthorizeOrder::authorizeOrder('1U242387CB956380X', true);
}
