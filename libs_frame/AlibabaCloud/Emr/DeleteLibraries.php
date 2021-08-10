<?php

namespace AlibabaCloud\Emr;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method array getLibraryBizIdList()
 */
class DeleteLibraries extends Rpc
{
    /**
     * @return $this
     */
    public function withLibraryBizIdList(array $libraryBizIdList)
    {
        $this->data['LibraryBizIdList'] = $libraryBizIdList;
        foreach ($libraryBizIdList as $i => $iValue) {
            $this->options['query']['LibraryBizIdList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
