<?php

namespace AliOpen\Imm;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DecodeBlindWatermark
 *
 * @method string getImageQuality()
 * @method string getProject()
 * @method string getWatermarkType()
 * @method string getTargetUri()
 * @method string getModel()
 * @method string getImageUri()
 * @method string getOriginalImageUri()
 */
class DecodeBlindWatermarkRequest extends RpcAcsRequest
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
        parent::__construct('imm', '2017-09-06', 'DecodeBlindWatermark', 'imm');
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

    /**
     * @param string $originalImageUri
     *
     * @return $this
     */
    public function setOriginalImageUri($originalImageUri)
    {
        $this->requestParameters['OriginalImageUri'] = $originalImageUri;
        $this->queryParameters['OriginalImageUri'] = $originalImageUri;

        return $this;
    }
}
