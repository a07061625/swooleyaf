<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getRuleName()
 * @method $this withRuleName($value)
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getRuleDescription()
 * @method $this withRuleDescription($value)
 * @method string getRuleContent()
 * @method $this withRuleContent($value)
 * @method string getApiProduct()
 * @method string getApiRevision()
 * @method string getRuleId()
 * @method $this withRuleId($value)
 */
class UpdateSceneRule extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiProduct($value)
    {
        $this->data['ApiProduct'] = $value;
        $this->options['form_params']['ApiProduct'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiRevision($value)
    {
        $this->data['ApiRevision'] = $value;
        $this->options['form_params']['ApiRevision'] = $value;

        return $this;
    }
}
