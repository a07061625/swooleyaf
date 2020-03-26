<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/8/1 0001
 * Time: 10:09
 */
namespace SyIM\Tencent;

use SyConstant\ErrorCode;
use SyException\IM\TencentException;
use SyTool\Tool;

class SingleChatMsg
{
    /**
     * 同步标识 1:同步 2:不同步
     * @var int
     */
    private $syncTag = 0;
    /**
     * 发送方帐号
     * @var string
     */
    private $fromAccount = '';
    /**
     * 接收方帐号
     * @var string
     */
    private $toAccount = '';
    /**
     * 离线保存秒数,0为不保存
     * @var int
     */
    private $lifeTime = 0;
    /**
     * 随机数
     * @var int
     */
    private $random = 0;
    /**
     * 时间戳
     * @var int
     */
    private $timeStamp = 0;
    /**
     * 消息内容
     * @var array
     */
    private $body = [];
    /**
     * 离线推送数据
     * @var array
     */
    private $offlinePush = [];

    public function __construct()
    {
        $this->syncTag = 1;
        $this->lifeTime = 604800;
        $this->random = random_int(10000000, 99999999);
        $this->timeStamp = Tool::getNowTime();
    }

    private function __clone()
    {
    }

    /**
     * @return int
     */
    public function getSyncTag() : int
    {
        return $this->syncTag;
    }

    /**
     * @param int $syncTag
     * @throws \SyException\IM\TencentException
     */
    public function setSyncTag(int $syncTag)
    {
        if (in_array($syncTag, [1, 2], true)) {
            $this->syncTag = $syncTag;
        } else {
            throw new TencentException('同步标识不合法', ErrorCode::IM_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getFromAccount() : string
    {
        return $this->fromAccount;
    }

    /**
     * @param string $fromAccount
     */
    public function setFromAccount(string $fromAccount)
    {
        $this->fromAccount = $fromAccount;
    }

    /**
     * @return string
     */
    public function getToAccount() : string
    {
        return $this->toAccount;
    }

    /**
     * @param string $toAccount
     * @throws \SyException\IM\TencentException
     */
    public function setToAccount(string $toAccount)
    {
        if (strlen($toAccount) > 0) {
            $this->toAccount = $toAccount;
        } else {
            throw new TencentException('接收方帐号不合法', ErrorCode::IM_PARAM_ERROR);
        }
    }

    /**
     * @return int
     */
    public function getLifeTime() : int
    {
        return $this->lifeTime;
    }

    /**
     * @param int $lifeTime
     * @throws \SyException\IM\TencentException
     */
    public function setLifeTime(int $lifeTime)
    {
        if (($lifeTime >= 0) && ($lifeTime <= 604800)) {
            $this->lifeTime = $lifeTime;
        } else {
            throw new TencentException('离线保存时间不合法', ErrorCode::IM_PARAM_ERROR);
        }
    }

    /**
     * @return int
     */
    public function getRandom() : int
    {
        return $this->random;
    }

    /**
     * @return int
     */
    public function getTimeStamp() : int
    {
        return $this->timeStamp;
    }

    /**
     * @param int $timeStamp
     */
    public function setTimeStamp(int $timeStamp)
    {
        $this->timeStamp = $timeStamp;
    }

    /**
     * @return array
     */
    public function getBody() : array
    {
        return $this->body;
    }

    /**
     * @param array $body
     * @throws \SyException\IM\TencentException
     */
    public function addBody(array $body)
    {
        if (!empty($body)) {
            $this->body[] = $body;
        } else {
            throw new TencentException('消息内容不合法', ErrorCode::IM_PARAM_ERROR);
        }
    }

    /**
     * @return array
     */
    public function getOfflinePush() : array
    {
        return $this->offlinePush;
    }

    /**
     * @param array $offlinePush
     */
    public function setOfflinePush(array $offlinePush)
    {
        $this->offlinePush = $offlinePush;
    }

    public function getDetail() : array
    {
        if (strlen($this->toAccount) == 0) {
            throw new TencentException('接收方帐号不能为空', ErrorCode::IM_PARAM_ERROR);
        }
        if (empty($this->body)) {
            throw new TencentException('消息内容不能为空', ErrorCode::IM_PARAM_ERROR);
        }

        $detail = [
            'SyncOtherMachine' => $this->syncTag,
            'To_Account' => $this->toAccount,
            'MsgLifeTime' => $this->lifeTime,
            'MsgRandom' => $this->random,
            'MsgTimeStamp' => $this->timeStamp,
            'MsgBody' => $this->body,
        ];
        if (strlen($this->fromAccount) > 0) {
            $detail['From_Account'] = $this->fromAccount;
        }
        if (!empty($this->offlinePush)) {
            $detail['OfflinePushInfo'] = $this->offlinePush;
        }

        return $detail;
    }
}
