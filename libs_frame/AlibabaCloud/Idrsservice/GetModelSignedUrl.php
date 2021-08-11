<?php

namespace AlibabaCloud\Idrsservice;

/**
 * @method array getModelPath()
 */
class GetModelSignedUrl extends Rpc
{
    /**
     * @return $this
     */
    public function withModelPath(array $modelPath)
    {
        $this->data['ModelPath'] = $modelPath;
        foreach ($modelPath as $i => $iValue) {
            $this->options['form_params']['ModelPath.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
