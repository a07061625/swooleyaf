<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getForceStatus()
 * @method string getAppId()
 * @method string getEccInfo()
 * @method string getGroupName()
 */
class ChangeDeployGroup extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/changeorder/co_change_group';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withForceStatus($value)
    {
        $this->data['ForceStatus'] = $value;
        $this->options['query']['ForceStatus'] = $value;

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
    public function withEccInfo($value)
    {
        $this->data['EccInfo'] = $value;
        $this->options['query']['EccInfo'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withGroupName($value)
    {
        $this->data['GroupName'] = $value;
        $this->options['query']['GroupName'] = $value;

        return $this;
    }
}
