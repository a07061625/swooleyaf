<?php
/**
 * 指定模板发送语音通知
 * User: 姜伟
 * Date: 2020/5/6 0006
 * Time: 19:56
 */
namespace SyVms\QCloud;

use SyConstant\ErrorCode;
use SyException\Vms\QCloudException;
use SyVms\BaseQCloud;

/**
 * Class TemplateVoiceSend
 *
 * @package SyVms\QCloud
 */
class TemplateVoiceSend extends BaseQCloud
{
    /**
     * 模板ID
     *
     * @var int
     */
    private $tplId = 0;
    /**
     * 模板参数
     *
     * @var array
     */
    private $tplParams = [];
    /**
     * 播放次数
     *
     * @var int
     */
    private $playTimes = 0;
    /**
     * 电话号码
     *
     * @var string
     */
    private $telMobile = '';
    /**
     * 国家码
     *
     * @var string
     */
    private $telNationCode = '';
    /**
     * 用户session内容
     *
     * @var string
     */
    private $ext = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUrl = 'https://cloud.tim.qq.com/v5/tlsvoicesvr/sendtvoice';
        $this->reqData = [
            'params' => [],
            'playtimes' => 2,
            'tel' => [
                'nationcode' => '86',
            ],
            'ext' => '',
        ];
    }

    private function __clone()
    {
    }

    /**
     * @param int $tplId
     *
     * @throws \SyException\Vms\QCloudException
     */
    public function setTplId(int $tplId)
    {
        if ($tplId > 0) {
            $this->reqData['tpl_id'] = $tplId;
        } else {
            throw new QCloudException('模板ID不合法', ErrorCode::VMS_PARAM_ERROR);
        }
    }

    /**
     * @param array $tplParams
     */
    public function setTplParams(array $tplParams)
    {
        $this->reqData['params'] = $tplParams;
    }

    /**
     * @param int $playTimes
     *
     * @throws \SyException\Vms\QCloudException
     */
    public function setPlayTimes(int $playTimes)
    {
        if (($playTimes > 0) && ($playTimes <= 3)) {
            $this->reqData['playtimes'] = $playTimes;
        } else {
            throw new QCloudException('播放次数不合法', ErrorCode::VMS_PARAM_ERROR);
        }
    }

    /**
     * @param string $telMobile
     *
     * @throws \SyException\Vms\QCloudException
     */
    public function setTelMobile(string $telMobile)
    {
        if (ctype_digit($telMobile)) {
            $this->reqData['tel']['mobile'] = $telMobile;
        } else {
            throw new QCloudException('电话号码不合法', ErrorCode::VMS_PARAM_ERROR);
        }
    }

    /**
     * @param string $telNationCode
     *
     * @throws \SyException\Vms\QCloudException
     */
    public function setTelNationCode(string $telNationCode)
    {
        if (ctype_digit($telNationCode)) {
            $this->reqData['tel']['nationcode'] = $telNationCode;
        } else {
            throw new QCloudException('国家码不合法', ErrorCode::VMS_PARAM_ERROR);
        }
    }

    /**
     * @param string $ext
     */
    public function setExt(string $ext)
    {
        $this->reqData['ext'] = trim($ext);
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['tpl_id'])) {
            throw new QCloudException('模板ID不能为空', ErrorCode::VMS_PARAM_ERROR);
        }
        if (!isset($this->reqData['tel']['mobile'])) {
            throw new QCloudException('电话号码不能为空', ErrorCode::VMS_PARAM_ERROR);
        }
        $this->refreshSign([
            'mobile' => $this->reqData['tel']['mobile'],
        ]);

        return $this->curlConfigs;
    }
}
