<?php

namespace AlibabaCloud\Scsp;

/**
 * @method string getEntityBizCode()
 * @method string getInstanceId()
 * @method string getEntityName()
 * @method string getEntityId()
 * @method string getEntityRelationNumber()
 * @method string getUniqueId()
 */
class GetEntityRoute extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEntityBizCode($value)
    {
        $this->data['EntityBizCode'] = $value;
        $this->options['form_params']['EntityBizCode'] = $value;

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
        $this->options['form_params']['InstanceId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEntityName($value)
    {
        $this->data['EntityName'] = $value;
        $this->options['form_params']['EntityName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEntityId($value)
    {
        $this->data['EntityId'] = $value;
        $this->options['form_params']['EntityId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEntityRelationNumber($value)
    {
        $this->data['EntityRelationNumber'] = $value;
        $this->options['form_params']['EntityRelationNumber'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUniqueId($value)
    {
        $this->data['UniqueId'] = $value;
        $this->options['form_params']['UniqueId'] = $value;

        return $this;
    }
}
