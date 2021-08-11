<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getMinReadyInstances()
 * @method string getReplicas()
 * @method string getAppId()
 */
class RescaleApplication extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/sam/app/rescaleApplication';

    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMinReadyInstances($value)
    {
        $this->data['MinReadyInstances'] = $value;
        $this->options['query']['MinReadyInstances'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withReplicas($value)
    {
        $this->data['Replicas'] = $value;
        $this->options['query']['Replicas'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppId($value)
    {
        $this->data['AppId'] = $value;
        $this->options['query']['AppId'] = $value;

        return $this;
    }
}
