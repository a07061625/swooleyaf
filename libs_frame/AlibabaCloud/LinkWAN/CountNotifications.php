<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getEndMillis()
 * @method string getHandleState()
 * @method array getCategory()
 * @method string getBeginMillis()
 */
class CountNotifications extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEndMillis($value)
    {
        $this->data['EndMillis'] = $value;
        $this->options['form_params']['EndMillis'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withHandleState($value)
    {
        $this->data['HandleState'] = $value;
        $this->options['form_params']['HandleState'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withCategory(array $category)
    {
        $this->data['Category'] = $category;
        foreach ($category as $i => $iValue) {
            $this->options['form_params']['Category.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBeginMillis($value)
    {
        $this->data['BeginMillis'] = $value;
        $this->options['form_params']['BeginMillis'] = $value;

        return $this;
    }
}
