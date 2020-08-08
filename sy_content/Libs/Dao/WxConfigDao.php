<?php
namespace Dao;

use Factories\SyBaseMysqlFactory;
use SyConstant\ErrorCode;
use SyConstant\Project;
use SyException\Common\CheckException;
use SyTool\Tool;
use SyTrait\SimpleDaoTrait;
use Wx\Payment\Company\BankPublicKey;

class WxConfigDao
{
    use SimpleDaoTrait;

    public static function setConfig(array $data)
    {
        $nowTime = Tool::getNowTime();

        $wxConfigBase = SyBaseMysqlFactory::getWxconfigBaseEntity();
        $ormResult1 = $wxConfigBase->getContainer()->getModel()->getOrmDbTable();
        $wxConfigBase->getContainer()->getModel()->insertOrUpdate($ormResult1, [
            'app_id' => $data['app_id'],
        ], [
            'app_id' => $data['app_id'],
            'app_secret' => $data['app_secret'],
            'app_clientip' => Project::WX_CONFIG_DEFAULT_CLIENT_IP,
            'app_templates' => $data['app_templates'],
            'origin_id' => $data['origin_id'],
            'pay_mchid' => $data['pay_mchid'],
            'pay_key' => $data['pay_key'],
            'payssl_cert' => $data['payssl_cert'],
            'payssl_key' => $data['payssl_key'],
            'payssl_companybank' => '',
            'merchant_appid' => $data['merchant_appid'],
            'status' => Project::WX_CONFIG_STATUS_ENABLE,
            'created' => $nowTime,
            'updated' => $nowTime,
        ], [
            'app_secret' => $data['app_secret'],
            'app_templates' => $data['app_templates'],
            'origin_id' => $data['origin_id'],
            'pay_mchid' => $data['pay_mchid'],
            'pay_key' => $data['pay_key'],
            'payssl_cert' => $data['payssl_cert'],
            'payssl_key' => $data['payssl_key'],
            'payssl_companybank' => '',
            'merchant_appid' => $data['merchant_appid'],
            'updated' => $nowTime,
        ]);
        unset($ormResult1, $wxConfigBase);

        return [
            'msg' => '设置配置成功',
        ];
    }

    public static function refreshSslCompanyBank(array $data)
    {
        $wxConfigBase = SyBaseMysqlFactory::getWxconfigBaseEntity();
        $ormResult1 = $wxConfigBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`app_id`=?', [$data['app_id']]);
        $configInfo = $wxConfigBase->getContainer()->getModel()->findOne($ormResult1);
        if (empty($configInfo)) {
            throw new CheckException('微信配置不存在', ErrorCode::COMMON_PARAM_ERROR);
        } elseif (strlen($configInfo['pay_mchid']) == 0) {
            throw new CheckException('商户号不能为空', ErrorCode::COMMON_PARAM_ERROR);
        } elseif (strlen($configInfo['pay_key']) == 0) {
            throw new CheckException('支付密钥不能为空', ErrorCode::COMMON_PARAM_ERROR);
        }

        $bankPublicKey = new BankPublicKey($data['app_id']);
        $detail = $bankPublicKey->getDetail();
        unset($bankPublicKey);
        if ($detail['code'] > 0) {
            throw new CheckException($detail['message'], $detail['code']);
        }

        $fileName = Tool::getConfig('project.' . SY_ENV . SY_PROJECT . '.dir.store.resources') . '/certs/wxcompanybank_' . $configInfo['pay_mchid'] . '.pem';
        if (!file_put_contents($fileName, $detail['data']['pub_key'])) {
            throw new CheckException('写入银行公钥文件失败', ErrorCode::COMMON_PARAM_ERROR);
        }

        $execRes = Tool::execSystemCommand('openssl rsa -RSAPublicKey_in -in ' . $fileName . ' -out ' . $fileName);
        if ($execRes['code'] > 0) {
            throw new CheckException('生成银行公钥文件失败', ErrorCode::COMMON_PARAM_ERROR);
        }

        $wxConfigBase->getContainer()->getModel()->update($ormResult1, [
            'payssl_companybank' => file_get_contents($fileName),
            'updated' => Tool::getNowTime(),
        ]);
        unset($ormResult1, $wxConfigBase);
        unlink($fileName);

        return [
            'msg' => '刷新企业付款银行卡公钥成功',
        ];
    }
}
