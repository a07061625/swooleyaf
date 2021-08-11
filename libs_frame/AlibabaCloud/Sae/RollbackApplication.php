<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getMinReadyInstances()
 * @method string getVersionId()
 * @method string getAppId()
 * @method string getBatchWaitTime()
 * @method string getAutoEnableApplicationScalingRule()
 * @method string getUpdateStrategy()
 */
class RollbackApplication extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/sam/app/rollbackApplication';

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
    public function withVersionId($value)
    {
        $this->data['VersionId'] = $value;
        $this->options['query']['VersionId'] = $value;

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
    public function withBatchWaitTime($value)
    {
        $this->data['BatchWaitTime'] = $value;
        $this->options['query']['BatchWaitTime'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAutoEnableApplicationScalingRule($value)
    {
        $this->data['AutoEnableApplicationScalingRule'] = $value;
        $this->options['query']['AutoEnableApplicationScalingRule'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUpdateStrategy($value)
    {
        $this->data['UpdateStrategy'] = $value;
        $this->options['query']['UpdateStrategy'] = $value;

        return $this;
    }
}
