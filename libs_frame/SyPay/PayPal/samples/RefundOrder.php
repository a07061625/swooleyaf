<?php
namespace Sample;

require __DIR__ . '/../vendor/autoload.php';

use SyPay\PayPal\Payments\CapturesRefundRequest;

class RefundOrder
{
    /**
     * Function to create an refund capture request. Payload can be updated to issue partial refund.
     */
    public static function buildRequestBody()
    {
        return [
            'amount' => [
                'value' => '20.00',
                'currency_code' => 'USD',
            ],
        ];
    }

    /**
     * This function can be used to preform refund on the capture.
     *
     * @param mixed $captureId
     * @param mixed $debug
     */
    public static function refundOrder($captureId, $debug = false)
    {
        $request = new CapturesRefundRequest($captureId);
        $request->body = self::buildRequestBody();
        $client = PayPalClient::client();
        $response = $client->execute($request);

        if ($debug) {
            echo "Status Code: {$response->statusCode}\n";
            echo "Status: {$response->result->status}\n";
            echo "Order ID: {$response->result->id}\n";
            echo "Links:\n";
            foreach ($response->result->links as $link) {
                echo "\t{$link->rel}: {$link->href}\tCall Type: {$link->method}\n";
            }
            // To toggle printing the whole response body comment/uncomment below line
            echo json_encode($response->result, JSON_PRETTY_PRINT), "\n";
        }

        return $response;
    }
}

/**
 * This is the driver function which invokes the refund capture function with
 * Capture Id to perform refund on capture.
 */
if (!count(debug_backtrace())) {
    RefundOrder::refundOrder('8XL09935J2224701N', true);
}
