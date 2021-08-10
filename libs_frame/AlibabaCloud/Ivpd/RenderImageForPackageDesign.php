<?php

namespace AlibabaCloud\Ivpd;

/**
 * @method string getDisplayType()
 * @method string getMaterialName()
 * @method string getJobId()
 * @method string getMaterialType()
 * @method string getModelType()
 * @method string getTargetWidth()
 * @method array getElementList()
 * @method string getCategory()
 * @method string getTargetHeight()
 */
class RenderImageForPackageDesign extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDisplayType($value)
    {
        $this->data['DisplayType'] = $value;
        $this->options['form_params']['DisplayType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMaterialName($value)
    {
        $this->data['MaterialName'] = $value;
        $this->options['form_params']['MaterialName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withJobId($value)
    {
        $this->data['JobId'] = $value;
        $this->options['form_params']['JobId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMaterialType($value)
    {
        $this->data['MaterialType'] = $value;
        $this->options['form_params']['MaterialType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withModelType($value)
    {
        $this->data['ModelType'] = $value;
        $this->options['form_params']['ModelType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTargetWidth($value)
    {
        $this->data['TargetWidth'] = $value;
        $this->options['form_params']['TargetWidth'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withElementList(array $elementList)
    {
        $this->data['ElementList'] = $elementList;
        foreach ($elementList as $depth1 => $depth1Value) {
            if (isset($depth1Value['ImageUrl'])) {
                $this->options['form_params']['ElementList.' . ($depth1 + 1) . '.ImageUrl'] = $depth1Value['ImageUrl'];
            }
            if (isset($depth1Value['SideName'])) {
                $this->options['form_params']['ElementList.' . ($depth1 + 1) . '.SideName'] = $depth1Value['SideName'];
            }
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCategory($value)
    {
        $this->data['Category'] = $value;
        $this->options['form_params']['Category'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTargetHeight($value)
    {
        $this->data['TargetHeight'] = $value;
        $this->options['form_params']['TargetHeight'] = $value;

        return $this;
    }
}
