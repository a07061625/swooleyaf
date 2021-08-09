<?php

namespace AliOpen\Imm;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of EncodeBlindWatermark
 *
 * @method string getImageQuality()
 * @method string getWatermarkUri()
 * @method string getProject()
 * @method string getContent()
 * @method string getWatermarkType()
 * @method string getTargetUri()
 * @method string getModel()
 * @method string getTargetImageType()
 * @method string getImageUri()
 */
class EncodeBlindWatermarkRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('imm', '2017-09-06', 'EncodeBlindWatermark', 'imm');
    }

    /**
     * @param string $imageQuality
     *
     * @return $this
     */
    public function setImageQuality($imageQuality)
    {
        $this->requestParameters['ImageQuality'] = $imageQuality;
        $this->queryParameters['ImageQuality'] = $imageQuality;

        return $this;
    }

    /**
     * @param string $watermarkUri
     *
     * @return $this
     */
    public function setWatermarkUri($watermarkUri)
    {
        $this->requestParameters['WatermarkUri'] = $watermarkUri;
        $this->queryParameters['WatermarkUri'] = $watermarkUri;

        return $this;
    }

    /**
     * @param string $project
     *
     * @return $this
     */
    public function setProject($project)
    {
        $this->requestParameters['Project'] = $project;
        $this->queryParameters['Project'] = $project;

        return $this;
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setContent($content)
    {
        $this->requestParameters['Content'] = $content;
        $this->queryParameters['Content'] = $content;

        return $this;
    }

    /**
     * @param string $watermarkType
     *
     * @return $this
     */
    public function setWatermarkType($watermarkType)
    {
        $this->requestParameters['WatermarkType'] = $watermarkType;
        $this->queryParameters['WatermarkType'] = $watermarkType;

        return $this;
    }

    /**
     * @param string $targetUri
     *
     * @return $this
     */
    public function setTargetUri($targetUri)
    {
        $this->requestParameters['TargetUri'] = $targetUri;
        $this->queryParameters['TargetUri'] = $targetUri;

        return $this;
    }

    /**
     * @param string $model
     *
     * @return $this
     */
    public function setModel($model)
    {
        $this->requestParameters['Model'] = $model;
        $this->queryParameters['Model'] = $model;

        return $this;
    }

    /**
     * @param string $targetImageType
     *
     * @return $this
     */
    public function setTargetImageType($targetImageType)
    {
        $this->requestParameters['TargetImageType'] = $targetImageType;
        $this->queryParameters['TargetImageType'] = $targetImageType;

        return $this;
    }

    /**
     * @param string $imageUri
     *
     * @return $this
     */
    public function setImageUri($imageUri)
    {
        $this->requestParameters['ImageUri'] = $imageUri;
        $this->queryParameters['ImageUri'] = $imageUri;

        return $this;
    }
}
