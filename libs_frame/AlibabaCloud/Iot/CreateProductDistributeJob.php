<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getCaptcha()
 * @method $this withCaptcha($value)
 * @method string getSourceInstanceId()
 * @method $this withSourceInstanceId($value)
 * @method string getTargetAliyunId()
 * @method $this withTargetAliyunId($value)
 * @method string getProductKey()
 * @method $this withProductKey($value)
 * @method string getTargetInstanceId()
 * @method $this withTargetInstanceId($value)
 * @method string getApiProduct()
 * @method string getApiRevision()
 * @method string getTargetUid()
 * @method $this withTargetUid($value)
 */
class CreateProductDistributeJob extends Rpc
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
