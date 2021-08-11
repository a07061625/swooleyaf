<?php

namespace AlibabaCloud\Iot;

/**
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
 * @method string getTargetSelection()
 * @method $this withTargetSelection($value)
 * @method string getScheduleFinishTime()
 * @method $this withScheduleFinishTime($value)
 * @method array getTag()
 * @method string getGrayPercent()
 * @method $this withGrayPercent($value)
 * @method string getDnListFileUrl()
 * @method $this withDnListFileUrl($value)
 * @method string getFirmwareId()
 * @method $this withFirmwareId($value)
 * @method string getProductKey()
 * @method $this withProductKey($value)
 * @method string getRetryInterval()
 * @method $this withRetryInterval($value)
 * @method array getSrcVersion()
 * @method string getScheduleTime()
 * @method $this withScheduleTime($value)
 * @method string getOverwriteMode()
 * @method $this withOverwriteMode($value)
 * @method string getApiProduct()
 * @method string getApiRevision()
 * @method string getMaximumPerMinute()
 * @method $this withMaximumPerMinute($value)
 * @method array getTargetDeviceName()
 */
class CreateOTAStaticUpgradeJob extends Rpc
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

    /**
     * @return $this
     */
    public function withTargetDeviceName(array $targetDeviceName)
    {
        $this->data['TargetDeviceName'] = $targetDeviceName;
        foreach ($targetDeviceName as $i => $iValue) {
            $this->options['query']['TargetDeviceName.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
