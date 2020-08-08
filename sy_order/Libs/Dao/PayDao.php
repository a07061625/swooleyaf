<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 18-3-10
 * Time: 下午4:32
 */
namespace Dao;

use DesignPatterns\Factories\CacheSimpleFactory;
use Factories\SyBaseMysqlFactory;
use Interfaces\PayContainer;
use SyConstant\ErrorCode;
use SyConstant\Project;
use SyException\Common\CheckException;
use SyLog\Log;
use SyTool\Tool;
use SyTrait\SimpleDaoTrait;

class PayDao
{
    use SimpleDaoTrait;

    private static $payApplyMap = [
        Project::PAY_TYPE_WX_ACCOUNT_JS => '\DesignPatterns\Facades\PayApply\WxAccountJs',
        Project::PAY_TYPE_WX_ACCOUNT_NATIVE_DYNAMIC => '\DesignPatterns\Facades\PayApply\WxAccountNativeDynamic',
        Project::PAY_TYPE_WX_ACCOUNT_NATIVE_STATIC => '\DesignPatterns\Facades\PayApply\WxAccountNativeStatic',
        Project::PAY_TYPE_WX_MINI_JS => '\DesignPatterns\Facades\PayApply\WxMiniJs',
        Project::PAY_TYPE_ALI_CODE => '\DesignPatterns\Facades\PayApply\AliCode',
        Project::PAY_TYPE_ALI_WEB => '\DesignPatterns\Facades\PayApply\AliWeb',
    ];

    /**
     * @var \Interfaces\PayContainer
     */
    private static $payContainer = null;

    public static function applyPay(array $data)
    {
        $redisKey = Project::REDIS_PREFIX_PAY_HASH . $data['pay_hash'];
        $cacheData = CacheSimpleFactory::getRedisInstance()->get($redisKey);
        if ($cacheData !== false) {
            throw new CheckException('支付处理中,请不要重复申请', ErrorCode::COMMON_PARAM_ERROR);
        }

        $payApplyClass = Tool::getArrayVal(self::$payApplyMap, $data['pay_type'], null);
        if (is_null($payApplyClass)) {
            throw new CheckException('支付类型不支持', ErrorCode::COMMON_PARAM_ERROR);
        }
        $payCheckRes = $payApplyClass::handleCheckParams($data);
        $nowData = array_merge($data, $payCheckRes);

        $payService = self::getPayService($nowData['pay_content']);
        if (is_null($payService)) {
            throw new CheckException('支付内容不支持', ErrorCode::COMMON_PARAM_ERROR);
        }
        $contentParams = $payService->checkPayParams();
        $nowData['content_result'] = $payService->getPayInfo($contentParams);
        CacheSimpleFactory::getRedisInstance()->set($redisKey, '1', 5);
        unset($payService);

        return $payApplyClass::handleApply($nowData);
    }

    public static function completePay(array $data)
    {
        //添加支付原始记录
        $payHistory = SyBaseMysqlFactory::getPayHistoryEntity();
        $payHistory->trade_type = $data['pay_type'];
        $payHistory->trade_sn = $data['pay_tradesn'];
        $payHistory->seller_sn = $data['pay_sellersn'];
        $payHistory->app_id = $data['pay_appid'];
        $payHistory->buyer_id = $data['pay_buyerid'];
        $payHistory->money = $data['pay_money'];
        $payHistory->attach = $data['pay_attach'];
        $payHistory->content = Tool::jsonEncode($data['pay_data'], JSON_UNESCAPED_UNICODE);
        $payHistory->status = $data['pay_status'];
        $payHistory->created = Tool::getNowTime();
        $ormResult1 = $payHistory->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`seller_sn`=?', [$data['pay_sellersn']]);
        $historyInfo = $payHistory->getContainer()->getModel()->findOne($ormResult1);
        if (empty($historyInfo)) {
            $payHistory->getContainer()->getModel()->insert($payHistory->getEntityDataArray());
        }

        $payContent = substr($data['pay_sellersn'], 0, 4);
        $payService = self::getPayService($payContent);
        if (is_null($payService)) {
            throw new CheckException('支付内容不支持', ErrorCode::COMMON_PARAM_ERROR);
        }

        $successRes = [];

        try {
            $payHistory->getContainer()->getModel()->openTransaction();
            $successRes = $payService->handlePaySuccess($data);
            $payHistory->getContainer()->getModel()->commitTransaction();
        } catch (\Exception $e) {
            $payHistory->getContainer()->getModel()->rollbackTransaction();
            Log::error($e->getMessage(), $e->getCode(), $e->getTraceAsString());

            throw new CheckException('支付处理失败', ErrorCode::COMMON_SERVER_ERROR);
        } finally {
            if (!empty($successRes)) {
                $payService->handlePaySuccessAttach($successRes);
            }
            unset($ormResult1, $payHistory, $payService);
        }
    }

    /**
     * @param string $payContent
     *
     * @return \Interfaces\PayService|null
     */
    private static function getPayService(string $payContent)
    {
        if (is_null(self::$payContainer)) {
            self::$payContainer = new PayContainer();
        }

        return self::$payContainer->getObj($payContent);
    }
}
