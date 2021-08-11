<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getDynamicMode()
 * @method $this withDynamicMode($value)
 * @method string getRetryCount()
 * @method $this withRetryCount($value)
 * @method string getTimeoutInMinutes()
 * @method $this withTimeoutInMinutes($value)
 * @method string getNeedConfirm()
 * @method $this withNeedConfirm($value)
 * @method string getNeedPush()
 * @method $this withNeedPush($value)
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method array getTag()
 * @method string getFirmwareId()
 * @method $this withFirmwareId($value)
 * @method string getProductKey()
 * @method $this withProductKey($value)
 * @method string getRetryInterval()
 * @method $this withRetryInterval($value)
 * @method array getSrcVersion()
 * @method string getOverwriteMode()
 * @method $this withOverwriteMode($value)
 * @method string getApiProduct()
 * @method string getApiRevision()
 * @method string getMaximumPerMinute()
 * @method $this withMaximumPerMinute($value)
 */
class CreateOTADynamicUpgradeJob extends Rpc
{
    /**
     * @return $this
     */
    public function withTag(array $tag)
    {
        $this->data['Tag'] = $tag;
        foreach ($tag as $depth1 => $depth1Value) {
            if (isset($depth1Value['Value'])) {
                $this->options['query']['Tag.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            }
            if (isset($depth1Value['Key'])) {
                $this->options['query']['Tag.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withSrcVersion(array $srcVersion)
    {
        $this->data['SrcVersion'] = $srcVersion;
        foreach ($srcVersion as $i => $iValue) {
            $this->options['query']['SrcVersion.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiProduct($value)
    {
        $this->data['ApiProduct'] = $value;
        $this->options['form_params']['ApiProduct'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiRevision($value)
    {
        $this->data['ApiRevision'] = $value;
        $this->options['form_params']['ApiRevision'] = $value;

        return $this;
    }
}
