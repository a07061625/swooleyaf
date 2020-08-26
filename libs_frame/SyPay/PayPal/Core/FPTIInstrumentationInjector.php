<?php
namespace SyPay\PayPal\Core;

use SyPay\PayPal\Http\Injector;

class FPTIInstrumentationInjector implements Injector
{
    const SDK_NAME_PAYOUTS = 'Payouts SDK';
    const SDK_NAME_CHECKOUT = 'Checkout SDK';

    public function __construct()
    {
    }

    public function inject($request)
    {
        $request->headers['sdk_name'] = 'SyPay SDK';
        $request->headers['sdk_version'] = '1.0.1';
        $request->headers['sdk_tech_stack'] = 'PHP ' . PHP_VERSION;
        $request->headers['api_integration_type'] = 'PAYPALSDK';
    }
}
