<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getAppId()
 */
class ListRecentChangeOrder extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/changeorder/change_order_list';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppId($value)
    {
        $this->data['AppId'] = $value;
        $this->options['query']['AppId'] = $value;

        return $this;
    }
}
