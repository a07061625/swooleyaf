<?php

namespace AlibabaCloud\Cms;

/**
 * @method string getRuleName()
 * @method $this withRuleName($value)
 * @method array getDstNames()
 * @method string getNamespace()
 * @method $this withNamespace($value)
 * @method string getTargetWindows()
 * @method $this withTargetWindows($value)
 * @method string getDescribe()
 * @method $this withDescribe($value)
 * @method string getMetricName()
 * @method $this withMetricName($value)
 */
class PutExporterRule extends Rpc
{
    /**
     * @return $this
     */
    public function withDstNames(array $dstNames)
    {
        $this->data['DstNames'] = $dstNames;
        foreach ($dstNames as $i => $iValue) {
            $this->options['query']['DstNames.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
