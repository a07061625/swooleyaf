<?php

namespace AlibabaCloud\Multimediaai;

/**
 * @method string getTemplateId()
 * @method $this withTemplateId($value)
 * @method string getVideoUrl()
 * @method $this withVideoUrl($value)
 * @method string getScales()
 * @method string getVideoName()
 * @method $this withVideoName($value)
 * @method string getCallbackUrl()
 * @method $this withCallbackUrl($value)
 * @method string getApplicationId()
 * @method $this withApplicationId($value)
 */
class CreateCoverTask extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScales($value)
    {
        $this->data['Scales'] = $value;
        $this->options['form_params']['Scales'] = $value;

        return $this;
    }
}
