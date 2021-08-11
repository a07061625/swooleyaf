<?php

namespace AlibabaCloud\Scsp;

/**
 * @method string getExtInfo()
 * @method string getDepartmentId()
 * @method string getGroupId()
 * @method string getEntityName()
 * @method string getEntityId()
 * @method string getEntityBizCodeType()
 * @method string getEntityBizCode()
 * @method string getInstanceId()
 * @method string getEntityRelationNumber()
 * @method string getServiceId()
 * @method string getUniqueId()
 */
class EditEntityRoute extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExtInfo($value)
    {
        $this->data['ExtInfo'] = $value;
        $this->options['form_params']['ExtInfo'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDepartmentId($value)
    {
        $this->data['DepartmentId'] = $value;
        $this->options['form_params']['DepartmentId'] = $value;

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
        $this->options['form_params']['GroupId'] = $value;

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
    public function withEntityBizCodeType($value)
    {
        $this->data['EntityBizCodeType'] = $value;
        $this->options['form_params']['EntityBizCodeType'] = $value;

        return $this;
    }

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
    public function withServiceId($value)
    {
        $this->data['ServiceId'] = $value;
        $this->options['form_params']['ServiceId'] = $value;

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
