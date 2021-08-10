<?php

namespace AlibabaCloud\Airec;

/**
 * @method string getInstanceId()
 * @method string getSize()
 * @method string getPage()
 */
class ListItems extends Roa
{
    /** @var string */
    public $pathPattern = '/v2/openapi/instances/[instanceId]/items/actions/list';

    /** @var string */
    public $method = 'POST';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceId($value)
    {
        $this->data['InstanceId'] = $value;
        $this->pathParameters['instanceId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSize($value)
    {
        $this->data['Size'] = $value;
        $this->options['query']['size'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPage($value)
    {
        $this->data['Page'] = $value;
        $this->options['query']['page'] = $value;

        return $this;
    }
}
