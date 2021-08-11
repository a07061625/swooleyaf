<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getVServerGroupId()
 * @method string getListenerPort()
 * @method string getSlbId()
 * @method string getAppId()
 * @method string getSlbIp()
 * @method string getType()
 */
class BindSlb extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/app/bind_slb_json';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVServerGroupId($value)
    {
        $this->data['VServerGroupId'] = $value;
        $this->options['query']['VServerGroupId'] = $value;

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
    public function withSlbId($value)
    {
        $this->data['SlbId'] = $value;
        $this->options['query']['SlbId'] = $value;

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
    public function withSlbIp($value)
    {
        $this->data['SlbIp'] = $value;
        $this->options['query']['SlbIp'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withType($value)
    {
        $this->data['Type'] = $value;
        $this->options['query']['Type'] = $value;

        return $this;
    }
}
