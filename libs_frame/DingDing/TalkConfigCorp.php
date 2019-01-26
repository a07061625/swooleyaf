<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/26 0026
 * Time: 11:26
 */
namespace DingDing;

use Constant\ErrorCode;
use Exception\DingDing\TalkException;

class TalkConfigCorp {
    /**
     * 企业ID
     * @var string
     */
    private $corpId = '';
    /**
     * 应用列表
     * @var array
     */
    private $agents = [];
    /**
     * 配置有效状态
     * @var bool
     */
    private $valid = false;
    /**
     * 配置过期时间戳
     * @var int
     */
    private $expireTime = 0;

    public function __construct() {
    }

    private function __clone() {
    }

    /**
     * @return string
     */
    public function getCorpId() : string {
        return $this->corpId;
    }

    /**
     * @param string $corpId
     * @throws \Exception\DingDing\TalkException
     */
    public function setCorpId(string $corpId){
        if(ctype_alnum($corpId)){
            $this->corpId = $corpId;
        } else {
            throw new TalkException('企业ID不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @return array
     */
    public function getAgents() : array {
        return $this->agents;
    }

    /**
     * @param string $agentTag
     * @return array
     * 返回数据结构:
     *   id: 应用ID
     *   key: 应用标识
     *   secret: 应用密钥
     */
    public function getAgentInfo(string $agentTag) : array {
        return $this->agents[$agentTag] ?? [];
    }

    /**
     * @param array $agents
     */
    public function setAgents(array $agents){
        $this->agents = $agents;
    }

    /**
     * @return bool
     */
    public function isValid() : bool {
        return $this->valid;
    }

    /**
     * @param bool $valid
     */
    public function setValid(bool $valid){
        $this->valid = $valid;
    }

    /**
     * @return int
     */
    public function getExpireTime() : int {
        return $this->expireTime;
    }

    /**
     * @param int $expireTime
     */
    public function setExpireTime(int $expireTime){
        $this->expireTime = $expireTime;
    }
}