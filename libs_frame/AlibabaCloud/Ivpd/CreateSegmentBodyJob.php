<?php

namespace AlibabaCloud\Ivpd;

/**
 * @method array getDataList()
 * @method string getAsync()
 * @method string getJobId()
 * @method string getTimeToLive()
 */
class CreateSegmentBodyJob extends Rpc
{
    /**
     * @return $this
     */
    public function withDataList(array $dataList)
    {
        $this->data['DataList'] = $dataList;
        foreach ($dataList as $depth1 => $depth1Value) {
            if (isset($depth1Value['DataId'])) {
                $this->options['form_params']['DataList.' . ($depth1 + 1) . '.DataId'] = $depth1Value['DataId'];
            }
            if (isset($depth1Value['ImageUrl'])) {
                $this->options['form_params']['DataList.' . ($depth1 + 1) . '.ImageUrl'] = $depth1Value['ImageUrl'];
            }
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAsync($value)
    {
        $this->data['Async'] = $value;
        $this->options['form_params']['Async'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withJobId($value)
    {
        $this->data['JobId'] = $value;
        $this->options['form_params']['JobId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTimeToLive($value)
    {
        $this->data['TimeToLive'] = $value;
        $this->options['form_params']['TimeToLive'] = $value;

        return $this;
    }
}
