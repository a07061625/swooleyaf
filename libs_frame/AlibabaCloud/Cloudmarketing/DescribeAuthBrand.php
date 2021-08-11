<?php

namespace AlibabaCloud\Cloudmarketing;

/**
 * @method array getAccountIds()
 */
class DescribeAuthBrand extends Rpc
{
    /**
     * @return $this
     */
    public function withAccountIds(array $accountIds)
    {
        $this->data['AccountIds'] = $accountIds;
        foreach ($accountIds as $i => $iValue) {
            $this->options['query']['AccountIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
