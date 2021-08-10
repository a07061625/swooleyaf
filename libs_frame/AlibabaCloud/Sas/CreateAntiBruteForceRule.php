<?php

namespace AlibabaCloud\Sas;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getForbiddenTime()
 * @method $this withForbiddenTime($value)
 * @method string getFailCount()
 * @method $this withFailCount($value)
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 * @method string getEnableSmartRule()
 * @method $this withEnableSmartRule($value)
 * @method array getUuidList()
 * @method string getName()
 * @method $this withName($value)
 * @method string getSpan()
 * @method $this withSpan($value)
 * @method string getDefaultRule()
 * @method $this withDefaultRule($value)
 */
class CreateAntiBruteForceRule extends Rpc
{
    /**
     * @return $this
     */
    public function withUuidList(array $uuidList)
    {
        $this->data['UuidList'] = $uuidList;
        foreach ($uuidList as $i => $iValue) {
            $this->options['query']['UuidList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
