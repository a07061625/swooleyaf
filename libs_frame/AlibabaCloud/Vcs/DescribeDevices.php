<?php

namespace AlibabaCloud\Vcs;

/**
 * @method string getPageNum()
 * @method string getCorpIdList()
 * @method string getPageSize()
 */
class DescribeDevices extends Rpc
{
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
    public function withPageSize($value)
    {
        $this->data['PageSize'] = $value;
        $this->options['form_params']['PageSize'] = $value;

        return $this;
    }
}
