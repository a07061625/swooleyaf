<?php

namespace AlibabaCloud\AcmsOpen;

/**
 * @method string getDataId()
 * @method string getNamespaceId()
 * @method string getGroup()
 */
class DescribeConfiguration extends Roa
{
    /** @var string */
    public $pathPattern = '/diamond-ops/pop/configuration';

    /** @var string */
    public $method = 'GET';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDataId($value)
    {
        $this->data['DataId'] = $value;
        $this->options['query']['DataId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNamespaceId($value)
    {
        $this->data['NamespaceId'] = $value;
        $this->options['query']['NamespaceId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withGroup($value)
    {
        $this->data['Group'] = $value;
        $this->options['query']['Group'] = $value;

        return $this;
    }
}
