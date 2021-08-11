<?php

namespace AlibabaCloud\Objectdet;

/**
 * @method array getDamageImageList()
 */
class GenerateVehicleRepairPlan extends Rpc
{
    /**
     * @return $this
     */
    public function withDamageImageList(array $damageImageList)
    {
        $this->data['DamageImageList'] = $damageImageList;
        foreach ($damageImageList as $depth1 => $depth1Value) {
            if (isset($depth1Value['ImageUrl'])) {
                $this->options['form_params']['DamageImageList.' . ($depth1 + 1) . '.ImageUrl'] = $depth1Value['ImageUrl'];
            }
            if (isset($depth1Value['CreateTimeStamp'])) {
                $this->options['form_params']['DamageImageList.' . ($depth1 + 1) . '.CreateTimeStamp'] = $depth1Value['CreateTimeStamp'];
            }
        }

        return $this;
    }
}
