<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getAppId()
 */
class DeleteApplication extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/changeorder/co_delete_app';

    /** @var string */
    public $method = 'DELETE';

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
