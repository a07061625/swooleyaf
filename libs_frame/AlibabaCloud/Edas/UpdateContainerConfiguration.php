<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getUseBodyEncoding()
 * @method string getMaxThreads()
 * @method string getURIEncoding()
 * @method string getAppId()
 * @method string getGroupId()
 * @method string getHttpPort()
 * @method string getContextPath()
 */
class UpdateContainerConfiguration extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/app/container_config';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUseBodyEncoding($value)
    {
        $this->data['UseBodyEncoding'] = $value;
        $this->options['query']['UseBodyEncoding'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMaxThreads($value)
    {
        $this->data['MaxThreads'] = $value;
        $this->options['query']['MaxThreads'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withURIEncoding($value)
    {
        $this->data['URIEncoding'] = $value;
        $this->options['query']['URIEncoding'] = $value;

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
    public function withGroupId($value)
    {
        $this->data['GroupId'] = $value;
        $this->options['query']['GroupId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withHttpPort($value)
    {
        $this->data['HttpPort'] = $value;
        $this->options['query']['HttpPort'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withContextPath($value)
    {
        $this->data['ContextPath'] = $value;
        $this->options['query']['ContextPath'] = $value;

        return $this;
    }
}
