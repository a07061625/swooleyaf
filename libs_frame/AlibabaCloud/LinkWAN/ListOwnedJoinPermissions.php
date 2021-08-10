<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getFuzzyJoinPermissionName()
 * @method string getOffset()
 * @method string getFuzzyRenterAliyunId()
 * @method string getEnabled()
 * @method string getFuzzyJoinEui()
 * @method string getLimit()
 * @method string getSortingField()
 * @method string getAscending()
 */
class ListOwnedJoinPermissions extends Rpc
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
    public function withOffset($value)
    {
        $this->data['Offset'] = $value;
        $this->options['form_params']['Offset'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLimit($value)
    {
        $this->data['Limit'] = $value;
        $this->options['form_params']['Limit'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSortingField($value)
    {
        $this->data['SortingField'] = $value;
        $this->options['form_params']['SortingField'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAscending($value)
    {
        $this->data['Ascending'] = $value;
        $this->options['form_params']['Ascending'] = $value;

        return $this;
    }
}
