<?php

namespace AlibabaCloud\Vcs;

/**
 * @method string getCorpId()
 * @method string getFaceImageContent()
 * @method string getGender()
 * @method string getPlateNo()
 * @method string getIdNumber()
 * @method string getFaceImageUrl()
 * @method string getUserId()
 * @method string getAttachment()
 * @method string getIsvSubId()
 * @method string getAddress()
 * @method string getUserGroupId()
 * @method string getPhoneNo()
 * @method string getBizId()
 * @method string getAge()
 * @method string getUserName()
 */
class UpdateUser extends Rpc
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
    public function withFaceImageContent($value)
    {
        $this->data['FaceImageContent'] = $value;
        $this->options['form_params']['FaceImageContent'] = $value;

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
    public function withFaceImageUrl($value)
    {
        $this->data['FaceImageUrl'] = $value;
        $this->options['form_params']['FaceImageUrl'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUserId($value)
    {
        $this->data['UserId'] = $value;
        $this->options['form_params']['UserId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAttachment($value)
    {
        $this->data['Attachment'] = $value;
        $this->options['form_params']['Attachment'] = $value;

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
    public function withAddress($value)
    {
        $this->data['Address'] = $value;
        $this->options['form_params']['Address'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUserGroupId($value)
    {
        $this->data['UserGroupId'] = $value;
        $this->options['form_params']['UserGroupId'] = $value;

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
    public function withAge($value)
    {
        $this->data['Age'] = $value;
        $this->options['form_params']['Age'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUserName($value)
    {
        $this->data['UserName'] = $value;
        $this->options['form_params']['UserName'] = $value;

        return $this;
    }
}
