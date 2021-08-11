<?php

namespace AlibabaCloud\Ivpd;

/**
 * @method string getMaterialName()
 * @method array getElementList()
 * @method string getDataId()
 * @method string getMaterialType()
 * @method string getModelType()
 * @method string getCategory()
 */
class PreviewModelForPackageDesign extends Rpc
{
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
    public function withDataId($value)
    {
        $this->data['DataId'] = $value;
        $this->options['form_params']['DataId'] = $value;

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
    public function withCategory($value)
    {
        $this->data['Category'] = $value;
        $this->options['form_params']['Category'] = $value;

        return $this;
    }
}
