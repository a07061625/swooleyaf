<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getViewName()
 * @method string getClientToken()
 * @method string getSelectSQL()
 * @method string getSelectWhere()
 * @method string getSelectTableName()
 * @method string getComment()
 * @method string getSelectColumn()
 * @method string getAppGuid()
 * @method array getViewColumn()
 */
class CreateView extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withViewName($value)
    {
        $this->data['ViewName'] = $value;
        $this->options['form_params']['ViewName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClientToken($value)
    {
        $this->data['ClientToken'] = $value;
        $this->options['form_params']['ClientToken'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSelectSQL($value)
    {
        $this->data['SelectSQL'] = $value;
        $this->options['form_params']['SelectSQL'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSelectWhere($value)
    {
        $this->data['SelectWhere'] = $value;
        $this->options['form_params']['SelectWhere'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSelectTableName($value)
    {
        $this->data['SelectTableName'] = $value;
        $this->options['form_params']['SelectTableName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withComment($value)
    {
        $this->data['Comment'] = $value;
        $this->options['form_params']['Comment'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSelectColumn($value)
    {
        $this->data['SelectColumn'] = $value;
        $this->options['form_params']['SelectColumn'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppGuid($value)
    {
        $this->data['AppGuid'] = $value;
        $this->options['form_params']['AppGuid'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withViewColumn(array $viewColumn)
    {
        $this->data['ViewColumn'] = $viewColumn;
        foreach ($viewColumn as $depth1 => $depth1Value) {
            if (isset($depth1Value['Comment'])) {
                $this->options['form_params']['ViewColumn.' . ($depth1 + 1) . '.Comment'] = $depth1Value['Comment'];
            }
            if (isset($depth1Value['ColumnName'])) {
                $this->options['form_params']['ViewColumn.' . ($depth1 + 1) . '.ColumnName'] = $depth1Value['ColumnName'];
            }
        }

        return $this;
    }
}
