<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getData()
 * @method string getNamespaceId()
 * @method string getName()
 * @method string getDescription()
 */
class CreateConfigMap extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/sam/configmap/configMap';

    /** @var string */
    public $method = 'POST';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withData($value)
    {
        $this->data['Data'] = $value;
        $this->options['form_params']['Data'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNamespaceId($value)
    {
        $this->data['NamespaceId'] = $value;
        $this->options['query']['NamespaceId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withName($value)
    {
        $this->data['Name'] = $value;
        $this->options['query']['Name'] = $value;

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
}
