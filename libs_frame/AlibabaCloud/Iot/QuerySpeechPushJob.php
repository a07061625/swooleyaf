<?php

namespace AlibabaCloud\Iot;

/**
 * @method array getStatusList()
 * @method string getProjectCode()
 * @method string getPageId()
 * @method string getIotInstanceId()
 * @method string getPageSize()
 * @method string getPushMode()
 * @method string getApiProduct()
 * @method string getJobCode()
 * @method $this withJobCode($value)
 * @method string getApiRevision()
 */
class QuerySpeechPushJob extends Rpc
{
    /**
     * @return $this
     */
    public function withStatusList(array $statusList)
    {
        $this->data['StatusList'] = $statusList;
        foreach ($statusList as $i => $iValue) {
            $this->options['form_params']['StatusList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectCode($value)
    {
        $this->data['ProjectCode'] = $value;
        $this->options['form_params']['ProjectCode'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageId($value)
    {
        $this->data['PageId'] = $value;
        $this->options['form_params']['PageId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIotInstanceId($value)
    {
        $this->data['IotInstanceId'] = $value;
        $this->options['form_params']['IotInstanceId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageSize($value)
    {
        $this->data['PageSize'] = $value;
        $this->options['form_params']['PageSize'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPushMode($value)
    {
        $this->data['PushMode'] = $value;
        $this->options['form_params']['PushMode'] = $value;

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
