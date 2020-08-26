<?php
namespace SyPay\PayPal\Core;

use SyPay\PayPal\Http\HttpRequest;

class AccessTokenRequest extends HttpRequest
{
    public function __construct(PayPalEnvironment $environment, $refreshToken = null)
    {
        parent::__construct('/v1/oauth2/token', 'POST');
        $this->headers['Authorization'] = 'Basic ' . $environment->authorizationString();
        $body = [
            'grant_type' => 'client_credentials'
        ];

        if (!is_null($refreshToken)) {
            $body['grant_type'] = 'refresh_token';
            $body['refresh_token'] = $refreshToken;
        }

        $this->body = $body;
        $this->headers['Content-Type'] = 'application/x-www-form-urlencoded';
    }
}
