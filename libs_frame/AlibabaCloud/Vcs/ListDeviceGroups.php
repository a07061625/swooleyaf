<?php

namespace AlibabaCloud\Vcs;

/**
 * @method string getIsPage()
 * @method string getPageNum()
 * @method string getCorpIdList()
 * @method string getDeviceCodeList()
 * @method string getName()
 * @method string getPageSize()
 * @method string getGroup()
 */
class ListDeviceGroups extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIsPage($value)
    {
        $this->data['IsPage'] = $value;
        $this->options['form_params']['IsPage'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageNum($value)
    {
        $this->data['PageNum'] = $value;
        $this->options['form_params']['PageNum'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCorpIdList($value)
    {
        $this->data['CorpIdList'] = $value;
        $this->options['form_params']['CorpIdList'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDeviceCodeList($value)
    {
        $this->data['DeviceCodeList'] = $value;
        $this->options['form_params']['DeviceCodeList'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withName($value)
    {
        $this->data['Name'] = $value;
        $this->options['form_params']['Name'] = $value;

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
    public function withGroup($value)
    {
        $this->data['Group'] = $value;
        $this->options['form_params']['Group'] = $value;

        return $this;
    }
}
