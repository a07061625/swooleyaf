<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getFuzzyJoinPermissionName()
 * @method string getFuzzyRenterAliyunId()
 * @method string getEnabled()
 * @method string getFuzzyJoinEui()
 */
class CountOwnedJoinPermissions extends Rpc
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
    public function withFuzzyRenterAliyunId($value)
    {
        $this->data['FuzzyRenterAliyunId'] = $value;
        $this->options['form_params']['FuzzyRenterAliyunId'] = $value;

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
    public function withFuzzyJoinEui($value)
    {
        $this->data['FuzzyJoinEui'] = $value;
        $this->options['form_params']['FuzzyJoinEui'] = $value;

        return $this;
    }
}
