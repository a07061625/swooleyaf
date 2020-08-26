<?php

require __DIR__ . '/../vendor/autoload.php';

use Sample\PayPalClient;
use SyPay\PayPal\Http\HttpException;
use SyPay\PayPal\Orders\OrdersCreateRequest;

class ErrorSample
{
    public static function prettyPrint($jsonData, $pre = '')
    {
        $pretty = '';
        foreach ($jsonData as $key => $val) {
            $pretty .= $pre . ucfirst($key) . ': ';
            if (strcmp(gettype($val), 'array') == 0) {
                $pretty .= "\n";
                $sno = 1;
                foreach ($val as $value) {
                    $pretty .= $pre . "\t" . $sno++ . ":\n";
                    $pretty .= self::prettyPrint($value, $pre . "\t\t");
                }
            } else {
                $pretty .= $val . "\n";
            }
        }

        return $pretty;
    }

    /**
     * Body has no required parameters (intent, purchase_units)
     */
    public static function createError1()
    {
        $request = new OrdersCreateRequest();
        $request->body = '{}';
        echo "Request Body: {}\n\n";

        echo "Response:\n";

        try {
            $client = PayPalClient::client();
            $response = $client->execute($request);
        } catch (HttpException $exception) {
            $message = json_decode($exception->getMessage(), true);
            echo "Status Code: {$exception->statusCode}\n";
            echo self::prettyPrint($message);
        }
    }

    /**
     * Body has invalid parameter value for intent
     */
    public static function createError2()
    {
        $request = new OrdersCreateRequest();
        $request->body = [
            'intent' => 'INVALID',
            'purchase_units' => [
                0 => [
                    'amount' => [
                        'currency_code' => 'USD',
                        'value' => '100.00',
                    ],
                ],
            ],
        ];
        echo "Request Body:\n" . json_encode($request->body, JSON_PRETTY_PRINT) . "\n\n";

        try {
            $client = PayPalClient::client();
            $response = $client->execute($request);
        } catch (HttpException $exception) {
            echo "Response:\n";
            $message = json_decode($exception->getMessage(), true);
            echo "Status Code: {$exception->statusCode}\n";
            echo self::prettyPrint($message);
        }
    }
}

echo "Calling createError1 (Body has no required parameters (intent, purchase_units))\n";
ErrorSample::createError1();

echo "\n\nCalling createError2 (Body has invalid parameter value for intent)\n";
ErrorSample::createError2();
