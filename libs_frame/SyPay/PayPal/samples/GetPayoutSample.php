<?php
namespace Sample;

require __DIR__ . '/../vendor/autoload.php';

use SyPay\PayPal\Payouts\PayoutsGetRequest;

class GetPayoutSample
{
    /**
     * This function can be used to create payout.
     *
     * @param mixed $batchId
     * @param mixed $debug
     */
    public static function GetPayout($batchId, $debug = false)
    {
        $request = new PayoutsGetRequest($batchId);
        $client = PayPalClient::client();
        $response = $client->execute($request);
        if ($debug) {
            echo "Status Code: {$response->statusCode}\n";
            echo "Status: {$response->result->batch_header->batch_status}\n";
            echo "Batch ID: {$response->result->batch_header->payout_batch_id}\n";
            echo "First Item ID: {$response->result->items[0]->payout_item_id}\n";

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
    $response = CreatePayoutSample::CreatePayout(true);
    GetPayoutSample::GetPayout($response->result->batch_header->payout_batch_id, true);
}
