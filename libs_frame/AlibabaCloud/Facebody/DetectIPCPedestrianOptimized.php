<?php

namespace AlibabaCloud\Facebody;

/**
 * @method string getImageData()
 * @method string getWidth()
 * @method string getHeight()
 */
class DetectIPCPedestrianOptimized extends Roa
{
    /** @var string */
    public $pathPattern = '/viapi/k8s/facebody/detect-ipc-pedestrian-optimized';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withImageData($value)
    {
        $this->data['ImageData'] = $value;
        $this->options['form_params']['imageData'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withWidth($value)
    {
        $this->data['Width'] = $value;
        $this->options['form_params']['width'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withHeight($value)
    {
        $this->data['Height'] = $value;
        $this->options['form_params']['height'] = $value;

        return $this;
    }
}
