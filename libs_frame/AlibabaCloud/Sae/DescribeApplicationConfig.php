<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getVersionId()
 * @method string getAppId()
 */
class DescribeApplicationConfig extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/sam/app/describeApplicationConfig';

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
}
