<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/21 0021
 * Time: 15:04
 */
namespace SyVms\XunFei\AiCall;

use SyConstant\ErrorCode;
use SyException\Vms\XunFeiException;
use SyVms\BaseXunFeiAiCall;
use SyVms\UtilXunFei;

/**
 * 查询企业下的各项资源及配置信息
 *
 * @package SyVms\XunFei\AiCall
 */
class ConfigQuery extends BaseXunFeiAiCall
{
    /**
     * 配置项分类 0:全部 1:话术 2:线路 3:接口 4:发音人
     *
     * @var int
     */
    private $type = 0;

    public function __construct()
    {
        parent::__construct();
        $this->serviceUrl = 'https://callapi.xfyun.cn/v1/service/v1/aicall/config/v1/query?token=';
        $this->reqData = [
            'type' => 0,
        ];
    }

    private function __clone()
    {
    }

    /**
     * @param int $type
     *
     * @throws \SyException\Vms\XunFeiException
     */
    public function setType(int $type)
    {
        if (($type >= 0) && ($type <= 5)) {
            $this->reqData['type'] = $type;
        } else {
            throw new XunFeiException('配置项分类不合法', ErrorCode::VMS_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        $this->getContent();
        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . UtilXunFei::getAiCallToken();

        return $this->curlConfigs;
    }
}
