<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-3-10
 * Time: 21:47
 */

namespace Factories;

use Entities\SyBase\AliconfigPayEntity;
use Entities\SyBase\AttachmentBaseEntity;
use Entities\SyBase\AttachmentReferEntity;
use Entities\SyBase\DingtalkConfigCorpEntity;
use Entities\SyBase\ImBaseEntity;
use Entities\SyBase\LogModuleEntity;
use Entities\SyBase\PayHistoryEntity;
use Entities\SyBase\PermissionBaseEntity;
use Entities\SyBase\RefundBaseEntity;
use Entities\SyBase\RefundHistoryEntity;
use Entities\SyBase\RegionBaseEntity;
use Entities\SyBase\RoleBaseEntity;
use Entities\SyBase\RolePermissionEntity;
use Entities\SyBase\SmsRecordEntity;
use Entities\SyBase\SyTokenBaseEntity;
use Entities\SyBase\TimedTaskEntity;
use Entities\SyBase\UserBaseEntity;
use Entities\SyBase\UserLoginHistoryEntity;
use Entities\SyBase\UserMoneyEntity;
use Entities\SyBase\UserMoneyHistoryEntity;
use Entities\SyBase\UserRoleEntity;
use Entities\SyBase\WithdrawBaseEntity;
use Entities\SyBase\WithdrawHistoryEntity;
use Entities\SyBase\WxconfigAccountEntity;
use Entities\SyBase\WxconfigBaseEntity;
use Entities\SyBase\WxconfigCorpEntity;
use Entities\SyBase\WxconfigMiniEntity;
use Entities\SyBase\WxopenAuthorizerEntity;
use Entities\SyBase\WxproviderCorpAuthorizerEntity;
use SyTrait\SimpleTrait;

class SyBaseMysqlFactory
{
    use SimpleTrait;

    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyBase\AttachmentBaseEntity
     */
    public static function getAttachmentBaseEntity(string $dbTag = '')
    {
        return new AttachmentBaseEntity($dbTag);
    }

    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyBase\AttachmentReferEntity
     */
    public static function getAttachmentReferEntity(string $dbTag = '')
    {
        return new AttachmentReferEntity($dbTag);
    }

    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyBase\ImBaseEntity
     */
    public static function getImBaseEntity(string $dbTag = '')
    {
        return new ImBaseEntity($dbTag);
    }

    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyBase\LogModuleEntity
     */
    public static function getLogModuleEntity(string $dbTag = '')
    {
        return new LogModuleEntity($dbTag);
    }

    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyBase\PayHistoryEntity
     */
    public static function getPayHistoryEntity(string $dbTag = '')
    {
        return new PayHistoryEntity($dbTag);
    }

    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyBase\PermissionBaseEntity
     */
    public static function getPermissionBaseEntity(string $dbTag = '')
    {
        return new PermissionBaseEntity($dbTag);
    }

    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyBase\RefundBaseEntity
     */
    public static function getRefundBaseEntity(string $dbTag = '')
    {
        return new RefundBaseEntity($dbTag);
    }

    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyBase\RefundHistoryEntity
     */
    public static function getRefundHistoryEntity(string $dbTag = '')
    {
        return new RefundHistoryEntity($dbTag);
    }

    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyBase\SmsRecordEntity
     */
    public static function getSmsRecordEntity(string $dbTag = '')
    {
        return new SmsRecordEntity($dbTag);
    }

    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyBase\TimedTaskEntity
     */
    public static function getTimedTaskEntity(string $dbTag = '')
    {
        return new TimedTaskEntity($dbTag);
    }

    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyBase\UserBaseEntity
     */
    public static function getUserBaseEntity(string $dbTag = '')
    {
        return new UserBaseEntity($dbTag);
    }

    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyBase\UserLoginHistoryEntity
     */
    public static function getUserLoginHistoryEntity(string $dbTag = '')
    {
        return new UserLoginHistoryEntity($dbTag);
    }

    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyBase\UserMoneyEntity
     */
    public static function getUserMoneyEntity(string $dbTag = '')
    {
        return new UserMoneyEntity($dbTag);
    }

    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyBase\UserMoneyHistoryEntity
     */
    public static function getUserMoneyHistoryEntity(string $dbTag = '')
    {
        return new UserMoneyHistoryEntity($dbTag);
    }

    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyBase\UserRoleEntity
     */
    public static function getUserRoleEntity(string $dbTag = '')
    {
        return new UserRoleEntity($dbTag);
    }

    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyBase\WithdrawBaseEntity
     */
    public static function getWithdrawBaseEntity(string $dbTag = '')
    {
        return new WithdrawBaseEntity($dbTag);
    }

    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyBase\WithdrawHistoryEntity
     */
    public static function getWithdrawHistoryEntity(string $dbTag = '')
    {
        return new WithdrawHistoryEntity($dbTag);
    }

    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyBase\WxopenAuthorizerEntity
     */
    public static function getWxopenAuthorizerEntity(string $dbTag = '')
    {
        return new WxopenAuthorizerEntity($dbTag);
    }

    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyBase\WxproviderCorpAuthorizerEntity
     */
    public static function getWxproviderCorpAuthorizerEntity(string $dbTag = '')
    {
        return new WxproviderCorpAuthorizerEntity($dbTag);
    }

    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyBase\RegionBaseEntity
     */
    public static function getRegionBaseEntity(string $dbTag = '')
    {
        return new RegionBaseEntity($dbTag);
    }

    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyBase\RoleBaseEntity
     */
    public static function getRoleBaseEntity(string $dbTag = '')
    {
        return new RoleBaseEntity($dbTag);
    }

    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyBase\RolePermissionEntity
     */
    public static function getRolePermissionEntity(string $dbTag = '')
    {
        return new RolePermissionEntity($dbTag);
    }

    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyBase\WxconfigBaseEntity
     */
    public static function getWxconfigBaseEntity(string $dbTag = '')
    {
        return new WxconfigBaseEntity($dbTag);
    }

    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyBase\WxconfigAccountEntity
     */
    public static function getWxconfigShopEntity(string $dbTag = '')
    {
        return new WxconfigAccountEntity($dbTag);
    }

    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyBase\WxconfigMiniEntity
     */
    public static function getWxconfigMiniEntity(string $dbTag = '')
    {
        return new WxconfigMiniEntity($dbTag);
    }

    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyBase\WxconfigCorpEntity
     */
    public static function getWxconfigCorpEntity(string $dbTag = '')
    {
        return new WxconfigCorpEntity($dbTag);
    }

    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyBase\AliconfigPayEntity
     */
    public static function getAliconfigPayEntity(string $dbTag = '')
    {
        return new AliconfigPayEntity($dbTag);
    }

    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyBase\DingtalkConfigCorpEntity
     */
    public static function getDingtalkConfigCorpEntity(string $dbTag = '')
    {
        return new DingtalkConfigCorpEntity($dbTag);
    }

    /**
     * @param string $dbTag 数据库标识
     *
     * @return \Entities\SyBase\SyTokenBaseEntity
     */
    public static function getSyTokenBaseEntity(string $dbTag = '')
    {
        return new SyTokenBaseEntity($dbTag);
    }
}
