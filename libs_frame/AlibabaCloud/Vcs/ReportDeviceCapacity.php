<?php

namespace AlibabaCloud\Vcs;

/**
 * @method array getStreamCapacities()
 * @method string getLatitude()
 * @method string getPresetNum()
 * @method string getDeviceTimeStamp()
 * @method string getDeviceSn()
 * @method string getAudioFormat()
 * @method string getPTZCapacity()
 * @method string getLongitude()
 */
class ReportDeviceCapacity extends Rpc
{
    /**
     * @return $this
     */
    public function withStreamCapacities(array $streamCapacities)
    {
        $this->data['StreamCapacities'] = $streamCapacities;
        foreach ($streamCapacities as $depth1 => $depth1Value) {
            if (isset($depth1Value['BitrateRange'])) {
                $this->options['form_params']['StreamCapacities.' . ($depth1 + 1) . '.BitrateRange'] = $depth1Value['BitrateRange'];
            }
            if (isset($depth1Value['MaxStream'])) {
                $this->options['form_params']['StreamCapacities.' . ($depth1 + 1) . '.MaxStream'] = $depth1Value['MaxStream'];
            }
            if (isset($depth1Value['EncodeFormat'])) {
                $this->options['form_params']['StreamCapacities.' . ($depth1 + 1) . '.EncodeFormat'] = $depth1Value['EncodeFormat'];
            }
            if (isset($depth1Value['MaxFrameRate'])) {
                $this->options['form_params']['StreamCapacities.' . ($depth1 + 1) . '.MaxFrameRate'] = $depth1Value['MaxFrameRate'];
            }
            if (isset($depth1Value['GovLengthRange'])) {
                $this->options['form_params']['StreamCapacities.' . ($depth1 + 1) . '.GovLengthRange'] = $depth1Value['GovLengthRange'];
            }
            if (isset($depth1Value['Resolution'])) {
                $this->options['form_params']['StreamCapacities.' . ($depth1 + 1) . '.Resolution'] = $depth1Value['Resolution'];
            }
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLatitude($value)
    {
        $this->data['Latitude'] = $value;
        $this->options['form_params']['Latitude'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPresetNum($value)
    {
        $this->data['PresetNum'] = $value;
        $this->options['form_params']['PresetNum'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDeviceTimeStamp($value)
    {
        $this->data['DeviceTimeStamp'] = $value;
        $this->options['form_params']['DeviceTimeStamp'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDeviceSn($value)
    {
        $this->data['DeviceSn'] = $value;
        $this->options['form_params']['DeviceSn'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAudioFormat($value)
    {
        $this->data['AudioFormat'] = $value;
        $this->options['form_params']['AudioFormat'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPTZCapacity($value)
    {
        $this->data['PTZCapacity'] = $value;
        $this->options['form_params']['PTZCapacity'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLongitude($value)
    {
        $this->data['Longitude'] = $value;
        $this->options['form_params']['Longitude'] = $value;

        return $this;
    }
}
