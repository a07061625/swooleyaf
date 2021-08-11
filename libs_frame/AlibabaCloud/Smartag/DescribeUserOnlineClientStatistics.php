<?php

namespace AlibabaCloud\Smartag;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method array getUserNames()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getSmartAGId()
 * @method $this withSmartAGId($value)
 */
class DescribeUserOnlineClientStatistics extends Rpc
{
    /**
     * @return $this
     */
    public function withUserNames(array $userNames)
    {
        $this->data['UserNames'] = $userNames;
        foreach ($userNames as $i => $iValue) {
            $this->options['query']['UserNames.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
