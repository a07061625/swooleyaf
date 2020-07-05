<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/7/5 0005
 * Time: 15:20
 */
namespace SyMessageHandler\Producers;

/**
 * Class BaseWxCorp
 * @package SyMessageHandler\Producers
 */
abstract class BaseWxCorp extends BaseWx
{
    public function __construct(int $handlerType)
    {
        parent::__construct($handlerType);
    }

    protected function checkAgentTag(array $data) : string
    {
        $agentTag = $data['agent_tag'] ?? '';
        if (!is_string($agentTag)) {
            return '应用标识不合法';
        } elseif (strlen($agentTag) == 0) {
            return '应用标识不能为空';
        }

        $this->msgData['ext_data']['agent_tag'] = $agentTag;
        return '';
    }
}
