<?php

namespace AlibabaCloud\Objectdet;

/**
 * @method string getRoadRegions()
 * @method string getImageURL()
 */
class DetectVehicleIllegalParking extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRoadRegions($value)
    {
        $this->data['RoadRegions'] = $value;
        $this->options['form_params']['RoadRegions'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withImageURL($value)
    {
        $this->data['ImageURL'] = $value;
        $this->options['form_params']['ImageURL'] = $value;

        return $this;
    }
}
