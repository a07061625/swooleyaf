<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getFuzzyJoinPermissionName()
 * @method string getType()
 * @method string getEnabled()
 * @method string getBoundNodeGroup()
 * @method string getFuzzyJoinEui()
 * @method string getFuzzyOwnerAliyunId()
 */
class CountRentedJoinPermissions extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFuzzyJoinPermissionName($value)
    {
        $this->data['FuzzyJoinPermissionName'] = $value;
        $this->options['form_params']['FuzzyJoinPermissionName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withType($value)
    {
        $this->data['Type'] = $value;
        $this->options['form_params']['Type'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEnabled($value)
    {
        $this->data['Enabled'] = $value;
        $this->options['form_params']['Enabled'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBoundNodeGroup($value)
    {
        $this->data['BoundNodeGroup'] = $value;
        $this->options['form_params']['BoundNodeGroup'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFuzzyJoinEui($value)
    {
        $this->data['FuzzyJoinEui'] = $value;
        $this->options['form_params']['FuzzyJoinEui'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFuzzyOwnerAliyunId($value)
    {
        $this->data['FuzzyOwnerAliyunId'] = $value;
        $this->options['form_params']['FuzzyOwnerAliyunId'] = $value;

        return $this;
    }
}
