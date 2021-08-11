<?php

namespace AlibabaCloud\Alimt;

/**
 * @method string getCatLevelThreeId()
 * @method string getCatLevelTwoId()
 * @method string getKeywords()
 * @method string getPlatform()
 * @method string getExtra()
 */
class GetTitleIntelligence extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCatLevelThreeId($value)
    {
        $this->data['CatLevelThreeId'] = $value;
        $this->options['form_params']['CatLevelThreeId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCatLevelTwoId($value)
    {
        $this->data['CatLevelTwoId'] = $value;
        $this->options['form_params']['CatLevelTwoId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withKeywords($value)
    {
        $this->data['Keywords'] = $value;
        $this->options['form_params']['Keywords'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPlatform($value)
    {
        $this->data['Platform'] = $value;
        $this->options['form_params']['Platform'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExtra($value)
    {
        $this->data['Extra'] = $value;
        $this->options['form_params']['Extra'] = $value;

        return $this;
    }
}
