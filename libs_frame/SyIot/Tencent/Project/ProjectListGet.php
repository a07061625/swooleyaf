<?php
/**
 * 获取项目列表
 * User: 姜伟
 * Date: 2019/7/24 0024
 * Time: 14:07
 */
namespace SyIot\Tencent\Project;

use DesignPatterns\Singletons\IotConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Iot\TencentIotException;
use SyIot\BaseTencent;

class ProjectListGet extends BaseTencent
{
    /**
     * 偏移量
     *
     * @var int
     */
    private $Offset = 0;
    /**
     * 每页个数
     *
     * @var int
     */
    private $Limit = 0;

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'GetProjectList';
        $this->reqData['Offset'] = 0;
        $this->reqData['Limit'] = 10;
    }

    private function __clone()
    {
    }

    /**
     * @param int $offset
     *
     * @throws \SyException\Iot\TencentIotException
     */
    public function setOffset(int $offset)
    {
        if ($offset >= 0) {
            $this->reqData['Offset'] = $offset;
        } else {
            throw new TencentIotException('偏移量不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param int $limit
     *
     * @throws \SyException\Iot\TencentIotException
     */
    public function setLimit(int $limit)
    {
        if ($limit > 0) {
            $this->reqData['Limit'] = $limit;
        } else {
            throw new TencentIotException('每页个数不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        $config = IotConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
