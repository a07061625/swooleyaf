<?php

namespace AlibabaCloud\Vcs;

/**
 * @method string getCorpId()
 * @method string getFaceMatchingRateThreshold()
 * @method string getPageNumber()
 * @method string getCorpIdList()
 * @method string getFaceUrl()
 * @method string getPageSize()
 * @method string getPersonIdList()
 */
class GetPersonList extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCorpId($value)
    {
        $this->data['CorpId'] = $value;
        $this->options['form_params']['CorpId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFaceMatchingRateThreshold($value)
    {
        $this->data['FaceMatchingRateThreshold'] = $value;
        $this->options['form_params']['FaceMatchingRateThreshold'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageNumber($value)
    {
        $this->data['PageNumber'] = $value;
        $this->options['form_params']['PageNumber'] = $value;

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
    public function withFaceUrl($value)
    {
        $this->data['FaceUrl'] = $value;
        $this->options['form_params']['FaceUrl'] = $value;

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
    public function withPersonIdList($value)
    {
        $this->data['PersonIdList'] = $value;
        $this->options['form_params']['PersonIdList'] = $value;

        return $this;
    }
}
