<?php

namespace AlibabaCloud\MoPen;

/**
 * @method string getCanvasId()
 * @method string getEndY()
 * @method string getEndX()
 * @method string getJsonConf()
 * @method string getExportType()
 * @method string getStartY()
 * @method string getStartX()
 */
class MoPenDoRecognize extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCanvasId($value)
    {
        $this->data['CanvasId'] = $value;
        $this->options['form_params']['CanvasId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEndY($value)
    {
        $this->data['EndY'] = $value;
        $this->options['form_params']['EndY'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEndX($value)
    {
        $this->data['EndX'] = $value;
        $this->options['form_params']['EndX'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withJsonConf($value)
    {
        $this->data['JsonConf'] = $value;
        $this->options['form_params']['JsonConf'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExportType($value)
    {
        $this->data['ExportType'] = $value;
        $this->options['form_params']['ExportType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStartY($value)
    {
        $this->data['StartY'] = $value;
        $this->options['form_params']['StartY'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStartX($value)
    {
        $this->data['StartX'] = $value;
        $this->options['form_params']['StartX'] = $value;

        return $this;
    }
}
