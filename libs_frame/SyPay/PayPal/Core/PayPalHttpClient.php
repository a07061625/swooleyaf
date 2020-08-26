<?php
namespace SyPay\PayPal\Core;

use SyPay\PayPal\Http\HttpClient;
use SyTrait\SimpleConfigTrait;

class PayPalHttpClient extends HttpClient
{
    use SimpleConfigTrait;
    public $authInjector;

    private $refreshToken;

    public function __construct(PayPalEnvironment $environment, $refreshToken = null)
    {
        parent::__construct($environment);
        $this->refreshToken = $refreshToken;
        $this->authInjector = new AuthorizationInjector($this, $environment, $refreshToken);
        $this->addInjector($this->authInjector);
        $this->addInjector(new GzipInjector());
        $this->addInjector(new FPTIInstrumentationInjector());
    }

    public function userAgent()
    {
        return UserAgent::getValue();
    }
}
