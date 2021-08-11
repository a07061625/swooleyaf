<?php

namespace AlibabaCloud\Vcs;

/**
 * @method string getProfileIdList()
 * @method string getCorpId()
 * @method string getGender()
 * @method string getPlateNo()
 * @method string getIdNumber()
 * @method string getPageNumber()
 * @method string getFaceImageId()
 * @method string getFaceUrl()
 * @method string getPageSize()
 * @method string getPersonIdList()
 * @method string getLiveAddress()
 * @method string getIsvSubId()
 * @method string getSceneType()
 * @method string getPhoneNo()
 * @method string getCatalogId()
 * @method string getName()
 * @method string getBizId()
 * @method string getMatchingRateThreshold()
 */
class GetProfileList extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProfileIdList($value)
    {
        $this->data['ProfileIdList'] = $value;
        $this->options['form_params']['ProfileIdList'] = $value;

        return $this;
    }

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
    public function withGender($value)
    {
        $this->data['Gender'] = $value;
        $this->options['form_params']['Gender'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPlateNo($value)
    {
        $this->data['PlateNo'] = $value;
        $this->options['form_params']['PlateNo'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIdNumber($value)
    {
        $this->data['IdNumber'] = $value;
        $this->options['form_params']['IdNumber'] = $value;

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
    public function withFaceImageId($value)
    {
        $this->data['FaceImageId'] = $value;
        $this->options['form_params']['FaceImageId'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLiveAddress($value)
    {
        $this->data['LiveAddress'] = $value;
        $this->options['form_params']['LiveAddress'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIsvSubId($value)
    {
        $this->data['IsvSubId'] = $value;
        $this->options['form_params']['IsvSubId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSceneType($value)
    {
        $this->data['SceneType'] = $value;
        $this->options['form_params']['SceneType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPhoneNo($value)
    {
        $this->data['PhoneNo'] = $value;
        $this->options['form_params']['PhoneNo'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCatalogId($value)
    {
        $this->data['CatalogId'] = $value;
        $this->options['form_params']['CatalogId'] = $value;

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
    public function withBizId($value)
    {
        $this->data['BizId'] = $value;
        $this->options['form_params']['BizId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMatchingRateThreshold($value)
    {
        $this->data['MatchingRateThreshold'] = $value;
        $this->options['form_params']['MatchingRateThreshold'] = $value;

        return $this;
    }
}
