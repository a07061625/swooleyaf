<?php

namespace AlibabaCloud\Cloudmarketing;

/**
 * @method array getStatusList()
 * @method string getPageNo()
 * @method $this withPageNo($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getIncludeChild()
 * @method $this withIncludeChild($value)
 * @method string getOnlyFavorite()
 * @method $this withOnlyFavorite($value)
 * @method string getKeyword()
 * @method $this withKeyword($value)
 * @method string getCategoryId()
 * @method $this withCategoryId($value)
 */
class DescribeTag extends Rpc
{
    /**
     * @return $this
     */
    public function withStatusList(array $statusList)
    {
        $this->data['StatusList'] = $statusList;
        foreach ($statusList as $i => $iValue) {
            $this->options['query']['StatusList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
