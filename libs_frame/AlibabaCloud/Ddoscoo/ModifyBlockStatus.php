<?php

namespace AlibabaCloud\Ddoscoo;

/**
 * @method string getDuration()
 * @method $this withDuration($value)
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 * @method string getLang()
 * @method $this withLang($value)
 * @method array getLines()
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getStatus()
 * @method $this withStatus($value)
 */
class ModifyBlockStatus extends Rpc
{
    /**
     * @return $this
     */
    public function withLines(array $lines)
    {
        $this->data['Lines'] = $lines;
        foreach ($lines as $i => $iValue) {
            $this->options['query']['Lines.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
