<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getMinHeapSize()
 * @method string getAppId()
 * @method string getGroupId()
 * @method string getOptions()
 * @method string getMaxPermSize()
 * @method string getMaxHeapSize()
 */
class UpdateJvmConfiguration extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/app/app_jvm_config';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMinHeapSize($value)
    {
        $this->data['MinHeapSize'] = $value;
        $this->options['query']['MinHeapSize'] = $value;

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
    public function withOptions($value)
    {
        $this->data['Options'] = $value;
        $this->options['query']['Options'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMaxPermSize($value)
    {
        $this->data['MaxPermSize'] = $value;
        $this->options['query']['MaxPermSize'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMaxHeapSize($value)
    {
        $this->data['MaxHeapSize'] = $value;
        $this->options['query']['MaxHeapSize'] = $value;

        return $this;
    }
}
