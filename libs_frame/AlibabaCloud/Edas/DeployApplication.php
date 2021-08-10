<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getBuildPackId()
 * @method string getComponentIds()
 * @method string getGroupId()
 * @method string getBatchWaitTime()
 * @method string getReleaseType()
 * @method string getBatch()
 * @method string getAppEnv()
 * @method string getPackageVersion()
 * @method string getAppId()
 * @method string getImageUrl()
 * @method string getWarUrl()
 * @method string getDesc()
 * @method string getDeployType()
 */
class DeployApplication extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/changeorder/co_deploy';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBuildPackId($value)
    {
        $this->data['BuildPackId'] = $value;
        $this->options['query']['BuildPackId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withComponentIds($value)
    {
        $this->data['ComponentIds'] = $value;
        $this->options['query']['ComponentIds'] = $value;

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
    public function withReleaseType($value)
    {
        $this->data['ReleaseType'] = $value;
        $this->options['query']['ReleaseType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBatch($value)
    {
        $this->data['Batch'] = $value;
        $this->options['query']['Batch'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppEnv($value)
    {
        $this->data['AppEnv'] = $value;
        $this->options['query']['AppEnv'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPackageVersion($value)
    {
        $this->data['PackageVersion'] = $value;
        $this->options['query']['PackageVersion'] = $value;

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
    public function withImageUrl($value)
    {
        $this->data['ImageUrl'] = $value;
        $this->options['query']['ImageUrl'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withWarUrl($value)
    {
        $this->data['WarUrl'] = $value;
        $this->options['query']['WarUrl'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDesc($value)
    {
        $this->data['Desc'] = $value;
        $this->options['query']['Desc'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDeployType($value)
    {
        $this->data['DeployType'] = $value;
        $this->options['query']['DeployType'] = $value;

        return $this;
    }
}
