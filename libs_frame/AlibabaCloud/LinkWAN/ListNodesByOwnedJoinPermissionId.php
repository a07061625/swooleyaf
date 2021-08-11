<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getOffset()
 * @method string getJoinPermissionId()
 * @method string getFuzzyDevEui()
 * @method string getLimit()
 * @method string getSortingField()
 * @method string getAscending()
 */
class ListNodesByOwnedJoinPermissionId extends Rpc
{
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
    public function withJoinPermissionId($value)
    {
        $this->data['JoinPermissionId'] = $value;
        $this->options['form_params']['JoinPermissionId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFuzzyDevEui($value)
    {
        $this->data['FuzzyDevEui'] = $value;
        $this->options['form_params']['FuzzyDevEui'] = $value;

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
