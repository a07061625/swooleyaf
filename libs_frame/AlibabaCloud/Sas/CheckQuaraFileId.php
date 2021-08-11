<?php

namespace AlibabaCloud\Sas;

/**
 * @method array getQuaraFileIds()
 * @method string getUuid()
 * @method $this withUuid($value)
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 */
class CheckQuaraFileId extends Rpc
{
    /**
     * @return $this
     */
    public function withQuaraFileIds(array $quaraFileIds)
    {
        $this->data['QuaraFileIds'] = $quaraFileIds;
        foreach ($quaraFileIds as $i => $iValue) {
            $this->options['query']['QuaraFileIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
