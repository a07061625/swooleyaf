<?php
namespace Sample;

require __DIR__ . '/../vendor/autoload.php';

use SyPay\PayPal\Payouts\PayoutsPostRequest;

class CreatePayoutSample
{
    public static function buildRequestBody()
    {
        return json_decode('{
                "sender_batch_header":
                {
                  "email_subject": "SDK payouts test txn"
                },
                "items": [
                {
                  "recipient_type": "EMAIL",
                  "receiver": "payouts2342@paypal.com",
                  "note": "Your 1$ payout",
                  "sender_item_id": "Test_txn_12",
                  "amount":
                  {
                    "currency": "USD",
                    "value": "1.00"
                  }
                }]
              }', true);
    }

    /**
     * This function can be used to create payout.
     *
     * @param mixed $debug
     */
    public static function CreatePayout($debug = false)
    {
        $request = new PayoutsPostRequest();
        $request->body = self::buildRequestBody();
        $client = PayPalClient::client();
        $response = $client->execute($request);
        if ($debug) {
            echo "Status Code: {$response->statusCode}\n";
            echo "Status: {$response->result->batch_header->batch_status}\n";
            echo "Batch ID: {$response->result->batch_header->payout_batch_id}\n";
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

if (!count(debug_backtrace())) {
    CreatePayoutSample::CreatePayout(true);
}
