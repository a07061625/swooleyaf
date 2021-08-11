<?php

namespace AlibabaCloud\Cloudmarketing;

/**
 * @method string getOptionType()
 * @method string getTagName()
 * @method string getColumnIndex()
 * @method string getTagId()
 * @method $this withTagId($value)
 * @method string getTagDesc()
 * @method string getValidTime()
 * @method array getOptionDefines()
 * @method string getCategoryId()
 * @method string getFileId()
 */
class RedefineTag extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOptionType($value)
    {
        $this->data['OptionType'] = $value;
        $this->options['form_params']['OptionType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTagName($value)
    {
        $this->data['TagName'] = $value;
        $this->options['form_params']['TagName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withColumnIndex($value)
    {
        $this->data['ColumnIndex'] = $value;
        $this->options['form_params']['ColumnIndex'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTagDesc($value)
    {
        $this->data['TagDesc'] = $value;
        $this->options['form_params']['TagDesc'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withValidTime($value)
    {
        $this->data['ValidTime'] = $value;
        $this->options['form_params']['ValidTime'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withOptionDefines(array $optionDefines)
    {
        $this->data['OptionDefines'] = $optionDefines;
        foreach ($optionDefines as $depth1 => $depth1Value) {
            $this->options['form_params']['OptionDefines.' . ($depth1 + 1) . '.Name'] = $depth1Value['Name'];
            $this->options['form_params']['OptionDefines.' . ($depth1 + 1) . '.Define'] = $depth1Value['Define'];
            $this->options['form_params']['OptionDefines.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCategoryId($value)
    {
        $this->data['CategoryId'] = $value;
        $this->options['form_params']['CategoryId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFileId($value)
    {
        $this->data['FileId'] = $value;
        $this->options['form_params']['FileId'] = $value;

        return $this;
    }
}
