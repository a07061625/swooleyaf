<?php

namespace AlibabaCloud\Sas;

/**
 * @method string getReason()
 * @method $this withReason($value)
 * @method string getType()
 * @method $this withType($value)
 * @method array getVulNames()
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 * @method string getPrecondition()
 * @method $this withPrecondition($value)
 * @method string getOperateType()
 * @method $this withOperateType($value)
 * @method array getUuids()
 */
class OperateVuls extends Rpc
{
    /**
     * @return $this
     */
    public function withVulNames(array $vulNames)
    {
        $this->data['VulNames'] = $vulNames;
        foreach ($vulNames as $i => $iValue) {
            $this->options['query']['VulNames.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withUuids(array $uuids)
    {
        $this->data['Uuids'] = $uuids;
        foreach ($uuids as $i => $iValue) {
            $this->options['query']['Uuids.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
