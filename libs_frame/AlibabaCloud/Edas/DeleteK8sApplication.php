<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getAppId()
 */
class DeleteK8sApplication extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/k8s/acs/k8s_apps';

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
