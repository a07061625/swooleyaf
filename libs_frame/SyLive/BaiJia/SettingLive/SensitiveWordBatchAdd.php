<?php
/**
 * 添加敏感词
 * User: 姜伟
 * Date: 2020/3/31 0031
 * Time: 8:53
 */
namespace SyLive\BaiJia\SettingLive;

use SyLive\BaseBaiJiaSetting;
use SyLive\UtilBaiJia;
use SyConstant\ErrorCode;
use SyException\Live\BaiJiaException;

/**
 * Class SensitiveWordBatchAdd
 * @package SyLive\BaiJia\SettingLive
 */
class SensitiveWordBatchAdd extends BaseBaiJiaSetting
{
    /**
     * 敏感词列表
     * @var array
     */
    private $words = [];

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/live_setting/addSensitiveWordBatch';
    }

    private function __clone()
    {
    }

    /**
     * @param array $words
     */
    public function setWords(array $words)
    {
        $this->words = [];
        foreach ($words as $eWord) {
            $trueWord = trim($eWord);
            if (strlen($trueWord) > 0) {
                $this->words[] = $trueWord;
            }
        }
        array_unique($this->words);
    }

    public function getDetail() : array
    {
        if (empty($this->words)) {
            throw new BaiJiaException('敏感词列表不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        $this->reqData['words'] = implode(',', $this->words);
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
