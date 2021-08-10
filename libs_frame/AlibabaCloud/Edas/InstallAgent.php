<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getInstanceIds()
 * @method string getDoAsync()
 * @method string getClusterId()
 */
class InstallAgent extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/ecss/install_agent';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceIds($value)
    {
        $this->data['InstanceIds'] = $value;
        $this->options['query']['InstanceIds'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDoAsync($value)
    {
        $this->data['DoAsync'] = $value;
        $this->options['query']['DoAsync'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClusterId($value)
    {
        $this->data['ClusterId'] = $value;
        $this->options['query']['ClusterId'] = $value;

        return $this;
    }
}
