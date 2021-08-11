<?php

namespace AlibabaCloud\Aegis;

/**
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 * @method string getTagIdList()
 * @method string getRemark()
 */
class DescribeGroupStruct extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTagIdList($value)
    {
        $this->data['TagIdList'] = $value;
        $this->options['query']['tagIdList'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRemark($value)
    {
        $this->data['Remark'] = $value;
        $this->options['query']['remark'] = $value;

        return $this;
    }
}
