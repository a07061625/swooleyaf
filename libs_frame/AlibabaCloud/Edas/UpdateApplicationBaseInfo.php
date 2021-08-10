<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getAppName()
 * @method string getAppId()
 * @method string getDesc()
 */
class UpdateApplicationBaseInfo extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/app/update_app_info';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppName($value)
    {
        $this->data['AppName'] = $value;
        $this->options['query']['AppName'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDesc($value)
    {
        $this->data['Desc'] = $value;
        $this->options['query']['desc'] = $value;

        return $this;
    }
}
