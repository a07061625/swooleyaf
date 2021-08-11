<?php

namespace AlibabaCloud\Cloudesl;

/**
 * @method string getActionType()
 * @method string getExtraParams()
 * @method string getStoreId()
 * @method string getLayer()
 * @method string getLayerOrigin()
 * @method string getBeAutoRefresh()
 * @method string getShelf()
 * @method array getShelfPositionInfo()
 */
class ComposePlanogramPositions extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withActionType($value)
    {
        $this->data['ActionType'] = $value;
        $this->options['form_params']['ActionType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExtraParams($value)
    {
        $this->data['ExtraParams'] = $value;
        $this->options['form_params']['ExtraParams'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStoreId($value)
    {
        $this->data['StoreId'] = $value;
        $this->options['form_params']['StoreId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLayer($value)
    {
        $this->data['Layer'] = $value;
        $this->options['form_params']['Layer'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLayerOrigin($value)
    {
        $this->data['LayerOrigin'] = $value;
        $this->options['form_params']['LayerOrigin'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBeAutoRefresh($value)
    {
        $this->data['BeAutoRefresh'] = $value;
        $this->options['form_params']['BeAutoRefresh'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withShelf($value)
    {
        $this->data['Shelf'] = $value;
        $this->options['form_params']['Shelf'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withShelfPositionInfo(array $shelfPositionInfo)
    {
        $this->data['ShelfPositionInfo'] = $shelfPositionInfo;
        foreach ($shelfPositionInfo as $depth1 => $depth1Value) {
            if (isset($depth1Value['OffsetFrom'])) {
                $this->options['form_params']['ShelfPositionInfo.' . ($depth1 + 1) . '.OffsetFrom'] = $depth1Value['OffsetFrom'];
            }
            if (isset($depth1Value['Depth'])) {
                $this->options['form_params']['ShelfPositionInfo.' . ($depth1 + 1) . '.Depth'] = $depth1Value['Depth'];
            }
            if (isset($depth1Value['Column'])) {
                $this->options['form_params']['ShelfPositionInfo.' . ($depth1 + 1) . '.Column'] = $depth1Value['Column'];
            }
            if (isset($depth1Value['Facing'])) {
                $this->options['form_params']['ShelfPositionInfo.' . ($depth1 + 1) . '.Facing'] = $depth1Value['Facing'];
            }
            if (isset($depth1Value['OffsetTo'])) {
                $this->options['form_params']['ShelfPositionInfo.' . ($depth1 + 1) . '.OffsetTo'] = $depth1Value['OffsetTo'];
            }
            if (isset($depth1Value['ItemBarCode'])) {
                $this->options['form_params']['ShelfPositionInfo.' . ($depth1 + 1) . '.ItemBarCode'] = $depth1Value['ItemBarCode'];
            }
        }

        return $this;
    }
}
