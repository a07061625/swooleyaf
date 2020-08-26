<?php
namespace SyPay\PayPal\Core;

use SyPay\PayPal\Http\Injector;

class GzipInjector implements Injector
{
    public function inject($httpRequest)
    {
        $httpRequest->headers['Accept-Encoding'] = 'gzip';
    }
}
