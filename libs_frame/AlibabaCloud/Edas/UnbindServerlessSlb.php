<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getIntranet()
 * @method string getAppId()
 * @method string getInternet()
 */
class UnbindServerlessSlb extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/k8s/acs/serverless_slb_binding';

    /** @var string */
    public $method = 'DELETE';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIntranet($value)
    {
        $this->data['Intranet'] = $value;
        $this->options['query']['Intranet'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInternet($value)
    {
        $this->data['Internet'] = $value;
        $this->options['query']['Internet'] = $value;

        return $this;
    }
}
