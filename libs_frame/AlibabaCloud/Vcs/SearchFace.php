<?php

namespace AlibabaCloud\Vcs;

/**
 * @method string getCorpId()
 * @method string getGbId()
 * @method string getStartTimeStamp()
 * @method string getEndTimeStamp()
 * @method string getPageNo()
 * @method string getPageSize()
 * @method string getOptionList()
 */
class SearchFace extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCorpId($value)
    {
        $this->data['CorpId'] = $value;
        $this->options['form_params']['CorpId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withGbId($value)
    {
        $this->data['GbId'] = $value;
        $this->options['form_params']['GbId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStartTimeStamp($value)
    {
        $this->data['StartTimeStamp'] = $value;
        $this->options['form_params']['StartTimeStamp'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEndTimeStamp($value)
    {
        $this->data['EndTimeStamp'] = $value;
        $this->options['form_params']['EndTimeStamp'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageNo($value)
    {
        $this->data['PageNo'] = $value;
        $this->options['form_params']['PageNo'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageSize($value)
    {
        $this->data['PageSize'] = $value;
        $this->options['form_params']['PageSize'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOptionList($value)
    {
        $this->data['OptionList'] = $value;
        $this->options['form_params']['OptionList'] = $value;

        return $this;
    }
}
