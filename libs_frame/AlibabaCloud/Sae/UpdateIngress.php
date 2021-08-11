<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getIngressId()
 * @method string getListenerPort()
 * @method string getDescription()
 * @method string getRules()
 * @method string getCertId()
 * @method string getDefaultRule()
 */
class UpdateIngress extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/sam/ingress/Ingress';

    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIngressId($value)
    {
        $this->data['IngressId'] = $value;
        $this->options['query']['IngressId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withListenerPort($value)
    {
        $this->data['ListenerPort'] = $value;
        $this->options['query']['ListenerPort'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDescription($value)
    {
        $this->data['Description'] = $value;
        $this->options['query']['Description'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRules($value)
    {
        $this->data['Rules'] = $value;
        $this->options['form_params']['Rules'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCertId($value)
    {
        $this->data['CertId'] = $value;
        $this->options['query']['CertId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDefaultRule($value)
    {
        $this->data['DefaultRule'] = $value;
        $this->options['query']['DefaultRule'] = $value;

        return $this;
    }
}
