<?php

namespace AlibabaCloud\Crm;

/**
 * @method array getPkList()
 */
class BatchGetAliyunIdByAliyunPk extends Rpc
{
    /**
     * @return $this
     */
    public function withPkList(array $pkList)
    {
        $this->data['PkList'] = $pkList;
        foreach ($pkList as $i => $iValue) {
            $this->options['query']['PkList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
