<?php

namespace AlibabaCloud\Airec;

/**
 * @method string getItemId()
 * @method string getInstanceId()
 * @method string getItemType()
 * @method string getUserType()
 * @method string getUserId()
 * @method string getTable()
 */
class QueryRawData extends Roa
{
    /** @var string */
    public $pathPattern = '/v2/openapi/instances/[instanceId]/tables/[table]/raw-data';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withItemId($value)
    {
        $this->data['ItemId'] = $value;
        $this->options['query']['itemId'] = $value;

        return $this;
    }

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
    public function withItemType($value)
    {
        $this->data['ItemType'] = $value;
        $this->options['query']['itemType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUserType($value)
    {
        $this->data['UserType'] = $value;
        $this->options['query']['userType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUserId($value)
    {
        $this->data['UserId'] = $value;
        $this->options['query']['userId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTable($value)
    {
        $this->data['Table'] = $value;
        $this->pathParameters['table'] = $value;

        return $this;
    }
}
