<?php

namespace AlibabaCloud\Alimt;

/**
 * @method string getSourceLanguage()
 * @method string getCertificateType()
 * @method string getResultType()
 * @method string getImageUrl()
 * @method string getTargetLanguage()
 */
class TranslateCertificate extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSourceLanguage($value)
    {
        $this->data['SourceLanguage'] = $value;
        $this->options['form_params']['SourceLanguage'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCertificateType($value)
    {
        $this->data['CertificateType'] = $value;
        $this->options['form_params']['CertificateType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withResultType($value)
    {
        $this->data['ResultType'] = $value;
        $this->options['form_params']['ResultType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withImageUrl($value)
    {
        $this->data['ImageUrl'] = $value;
        $this->options['form_params']['ImageUrl'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTargetLanguage($value)
    {
        $this->data['TargetLanguage'] = $value;
        $this->options['form_params']['TargetLanguage'] = $value;

        return $this;
    }
}
