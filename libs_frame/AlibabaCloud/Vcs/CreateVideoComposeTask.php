<?php

namespace AlibabaCloud\Vcs;

/**
 * @method string getCorpId()
 * @method string getDomainName()
 * @method string getVideoFrameRate()
 * @method string getImageFileNames()
 * @method string getAudioFileName()
 * @method string getBucketName()
 * @method string getImageParameters()
 * @method string getVideoFormat()
 */
class CreateVideoComposeTask extends Rpc
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
    public function withDomainName($value)
    {
        $this->data['DomainName'] = $value;
        $this->options['form_params']['DomainName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVideoFrameRate($value)
    {
        $this->data['VideoFrameRate'] = $value;
        $this->options['form_params']['VideoFrameRate'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withImageFileNames($value)
    {
        $this->data['ImageFileNames'] = $value;
        $this->options['form_params']['ImageFileNames'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAudioFileName($value)
    {
        $this->data['AudioFileName'] = $value;
        $this->options['form_params']['AudioFileName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBucketName($value)
    {
        $this->data['BucketName'] = $value;
        $this->options['form_params']['BucketName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withImageParameters($value)
    {
        $this->data['ImageParameters'] = $value;
        $this->options['form_params']['ImageParameters'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVideoFormat($value)
    {
        $this->data['VideoFormat'] = $value;
        $this->options['form_params']['VideoFormat'] = $value;

        return $this;
    }
}
