<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 10:30
 */
namespace SyPay\Union\Channels\Wap;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;
use SyPay\Union\Channels\BaseWap;
use SyPay\Union\Channels\Traits\AccessTypeTrait;
use SyPay\Union\Channels\Traits\CertIdTrait;
use SyPay\Union\Channels\Traits\FileTypeTrait;
use SyPay\Union\Channels\Traits\ReqReservedTrait;
use SyPay\Union\Channels\Traits\SettleDateTrait;
use SyPay\UtilUnionChannels;

/**
 * 文件传输接口
 * 对账文件下载
 *
 * @package SyPay\Union\Channels\Wap
 */
class FileTransfer extends BaseWap
{
    use AccessTypeTrait;
    use SettleDateTrait;
    use FileTypeTrait;
    use CertIdTrait;
    use ReqReservedTrait;

    public function __construct(string $merId, string $envType)
    {
        $this->reqDomains = [
            self::ENV_TYPE_PRODUCT => 'https://filedownload.95516.com',
            self::ENV_TYPE_DEV => 'https://101.231.204.80:9080',
        ];
        parent::__construct($merId, $envType);
        $this->reqDomain .= '/';
        $this->reqData['bizType'] = '000000';
        $this->reqData['txnType'] = '76';
        $this->reqData['txnSubType'] = '01';
        $this->reqData['accessType'] = 0;
    }

    public function __clone()
    {
    }

    /**
     * @return array
     *
     * @throws \SyException\Pay\UnionException
     */
    public function getDetail() : array
    {
        if (!isset($this->reqData['settleDate'])) {
            throw new UnionException('清算日期不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        if (!isset($this->reqData['fileType'])) {
            throw new UnionException('文件类型不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        if (!isset($this->reqData['certId'])) {
            throw new UnionException('证书ID不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        UtilUnionChannels::createSign($this->reqData['merId'], $this->reqData);

        return $this->getChannelsContent();
    }
}
