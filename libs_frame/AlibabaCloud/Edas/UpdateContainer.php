<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getBuildPackId()
 * @method string getAppId()
 */
class UpdateContainer extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/changeorder/co_update_container';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBuildPackId($value)
    {
        $this->data['BuildPackId'] = $value;
        $this->options['query']['BuildPackId'] = $value;

        return $this;
    }

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
