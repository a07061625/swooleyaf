<?php

namespace AlibabaCloud\Foas;

/**
 * @method string getProjectName()
 * @method string getOssBucket()
 * @method string getOssOwner()
 * @method string getPackageName()
 * @method string getOssEndpoint()
 * @method string getDescription()
 * @method string getTag()
 * @method string getOriginName()
 * @method string getOssPath()
 * @method string getMd5()
 */
class UpdatePackage extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v2/projects/[projectName]/packages/[packageName]';

    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectName($value)
    {
        $this->data['ProjectName'] = $value;
        $this->pathParameters['projectName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOssBucket($value)
    {
        $this->data['OssBucket'] = $value;
        $this->options['form_params']['ossBucket'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOssOwner($value)
    {
        $this->data['OssOwner'] = $value;
        $this->options['form_params']['ossOwner'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPackageName($value)
    {
        $this->data['PackageName'] = $value;
        $this->pathParameters['packageName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOssEndpoint($value)
    {
        $this->data['OssEndpoint'] = $value;
        $this->options['form_params']['ossEndpoint'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDescription($value)
    {
        $this->data['Description'] = $value;
        $this->options['form_params']['description'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag($value)
    {
        $this->data['Tag'] = $value;
        $this->options['form_params']['tag'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOriginName($value)
    {
        $this->data['OriginName'] = $value;
        $this->options['form_params']['originName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOssPath($value)
    {
        $this->data['OssPath'] = $value;
        $this->options['form_params']['ossPath'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMd5($value)
    {
        $this->data['Md5'] = $value;
        $this->options['form_params']['md5'] = $value;

        return $this;
    }
}
