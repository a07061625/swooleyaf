<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getIntranet()
 * @method string getIntranetSlbId()
 * @method string getInternetSlbId()
 * @method string getAppId()
 * @method string getInternet()
 */
class BindSlb extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/sam/app/slb';

    /** @var string */
    public $method = 'POST';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIntranet($value)
    {
        $this->data['Intranet'] = $value;
        $this->options['query']['Intranet'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIntranetSlbId($value)
    {
        $this->data['IntranetSlbId'] = $value;
        $this->options['query']['IntranetSlbId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInternetSlbId($value)
    {
        $this->data['InternetSlbId'] = $value;
        $this->options['query']['InternetSlbId'] = $value;

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
    public function withInternet($value)
    {
        $this->data['Internet'] = $value;
        $this->options['query']['Internet'] = $value;

        return $this;
    }
}
