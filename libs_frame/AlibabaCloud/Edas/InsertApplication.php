<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getWebContainer()
 * @method string getEcuInfo()
 * @method string getBuildPackId()
 * @method string getHealthCheckURL()
 * @method string getReservedPortStr()
 * @method string getDescription()
 * @method string getCpu()
 * @method string getClusterId()
 * @method string getApplicationName()
 * @method string getJdk()
 * @method string getMem()
 * @method string getLogicalRegionId()
 * @method string getPackageType()
 */
class InsertApplication extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/changeorder/co_create_app';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withWebContainer($value)
    {
        $this->data['WebContainer'] = $value;
        $this->options['query']['WebContainer'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEcuInfo($value)
    {
        $this->data['EcuInfo'] = $value;
        $this->options['query']['EcuInfo'] = $value;

        return $this;
    }

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
    public function withHealthCheckURL($value)
    {
        $this->data['HealthCheckURL'] = $value;
        $this->options['query']['HealthCheckURL'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withReservedPortStr($value)
    {
        $this->data['ReservedPortStr'] = $value;
        $this->options['query']['ReservedPortStr'] = $value;

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
    public function withCpu($value)
    {
        $this->data['Cpu'] = $value;
        $this->options['query']['Cpu'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApplicationName($value)
    {
        $this->data['ApplicationName'] = $value;
        $this->options['query']['ApplicationName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withJdk($value)
    {
        $this->data['Jdk'] = $value;
        $this->options['query']['Jdk'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMem($value)
    {
        $this->data['Mem'] = $value;
        $this->options['query']['Mem'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLogicalRegionId($value)
    {
        $this->data['LogicalRegionId'] = $value;
        $this->options['query']['LogicalRegionId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPackageType($value)
    {
        $this->data['PackageType'] = $value;
        $this->options['query']['PackageType'] = $value;

        return $this;
    }
}
