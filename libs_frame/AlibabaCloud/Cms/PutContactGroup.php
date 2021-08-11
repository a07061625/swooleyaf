<?php

namespace AlibabaCloud\Cms;

/**
 * @method string getEnableSubscribed()
 * @method $this withEnableSubscribed($value)
 * @method string getContactGroupName()
 * @method $this withContactGroupName($value)
 * @method string getDescribe()
 * @method $this withDescribe($value)
 * @method array getContactNames()
 */
class PutContactGroup extends Rpc
{
    /**
     * @return $this
     */
    public function withContactNames(array $contactNames)
    {
        $this->data['ContactNames'] = $contactNames;
        foreach ($contactNames as $i => $iValue) {
            $this->options['query']['ContactNames.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
