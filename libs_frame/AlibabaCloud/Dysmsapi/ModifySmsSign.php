<?php

namespace AlibabaCloud\Dysmsapi;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getRemark()
 * @method $this withRemark($value)
 * @method string getSignName()
 * @method $this withSignName($value)
 * @method array getSignFileList()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getSignSource()
 * @method $this withSignSource($value)
 */
class ModifySmsSign extends Rpc
{
    /**
     * @return $this
     */
    public function withSignFileList(array $signFileList)
    {
        $this->data['SignFileList'] = $signFileList;
        foreach ($signFileList as $depth1 => $depth1Value) {
            $this->options['query']['SignFileList.' . ($depth1 + 1) . '.FileContents'] = $depth1Value['FileContents'];
            $this->options['query']['SignFileList.' . ($depth1 + 1) . '.FileSuffix'] = $depth1Value['FileSuffix'];
        }

        return $this;
    }
}
