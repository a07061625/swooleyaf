<?php

namespace AlibabaCloud\Live;

/**
 * @method string getLayoutId()
 * @method $this withLayoutId($value)
 * @method array getComponentId()
 * @method string getCasterId()
 * @method $this withCasterId($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getSceneId()
 * @method $this withSceneId($value)
 */
class UpdateCasterSceneConfig extends Rpc
{
    /**
     * @return $this
     */
    public function withComponentId(array $componentId)
    {
        $this->data['ComponentId'] = $componentId;
        foreach ($componentId as $i => $iValue) {
            $this->options['query']['ComponentId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
