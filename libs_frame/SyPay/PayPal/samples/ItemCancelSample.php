<?php
namespace Sample;

require __DIR__ . '/../vendor/autoload.php';

use Sample\PayPalClient;
use SyPay\PayPal\Payouts\PayoutsItemCancelRequest;
use Sample\CreatePayoutSample;
use Sample\GetPayoutSample;

class ItemCancelSample
{
    /**
     * This function can be used to create payout.
     */
    public static function CancelItem($itemId, $debug = false)
    {
        $request = new PayoutsItemCancelRequest($itemId);
        $client = PayPalClient::client();
        $response = $client->execute($request);
        if ($debug) {
            print "Status Code: {$response->statusCode}\n";
            print "Item status: {$response->result->transaction_status}\n";

            print "Links:\n";
            foreach ($response->result->links as $link) {
                print "\t{$link->rel}: {$link->href}\tCall Type: {$link->method}\n";
            }
            // To toggle printing the whole response body comment/uncomment below line
            echo json_encode($response->result, JSON_PRETTY_PRINT), "\n";
        }

        return $response;
    }
}

if (!count(debug_backtrace())) {
    $payout = CreatePayoutSample::CreatePayout(true);
    $response = GetPayoutSample::getPayout($payout->result->batch_header->payout_batch_id, true);
    ItemCancelSample::CancelItem($response->result->items[0]->payout_item_id, true);
}
