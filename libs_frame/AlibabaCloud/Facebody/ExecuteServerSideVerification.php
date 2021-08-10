<?php

namespace AlibabaCloud\Facebody;

/**
 * @method string getFacialPictureData()
 * @method string getSceneType()
 * @method string getCertificateNumber()
 * @method string getCertificateName()
 * @method string getFacialPictureUrl()
 */
class ExecuteServerSideVerification extends Roa
{
    /** @var string */
    public $pathPattern = '/viapi/thirdparty/realperson/execServerSideVerification';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFacialPictureData($value)
    {
        $this->data['FacialPictureData'] = $value;
        $this->options['form_params']['facialPictureData'] = $value;

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
        $this->options['form_params']['sceneType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCertificateNumber($value)
    {
        $this->data['CertificateNumber'] = $value;
        $this->options['form_params']['certificateNumber'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCertificateName($value)
    {
        $this->data['CertificateName'] = $value;
        $this->options['form_params']['certificateName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFacialPictureUrl($value)
    {
        $this->data['FacialPictureUrl'] = $value;
        $this->options['form_params']['facialPictureUrl'] = $value;

        return $this;
    }
}
