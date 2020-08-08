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
     * @param string $dbName 数据库名
     *
     * @return \Entities\SyBase\AttachmentBaseEntity
     */
    public static function getAttachmentBaseEntity(string $dbName = '')
    {
        return new AttachmentBaseEntity($dbName);
    }
    /**
     * @param string $dbName 数据库名
     *
     * @return \Entities\SyBase\AttachmentReferEntity
     */
    public static function getAttachmentReferEntity(string $dbName = '')
    {
        return new AttachmentReferEntity($dbName);
    }
    /**
     * @param string $dbName 数据库名
     *
     * @return \Entities\SyBase\ImBaseEntity
     */
    public static function getImBaseEntity(string $dbName = '')
    {
        return new ImBaseEntity($dbName);
    }
    /**
     * @param string $dbName 数据库名
     *
     * @return \Entities\SyBase\LogModuleEntity
     */
    public static function getLogModuleEntity(string $dbName = '')
    {
        return new LogModuleEntity($dbName);
    }
    /**
     * @param string $dbName 数据库名
     *
     * @return \Entities\SyBase\PayHistoryEntity
     */
    public static function getPayHistoryEntity(string $dbName = '')
    {
        return new PayHistoryEntity($dbName);
    }
    /**
     * @param string $dbName 数据库名
     *
     * @return \Entities\SyBase\PermissionBaseEntity
     */
    public static function getPermissionBaseEntity(string $dbName = '')
    {
        return new PermissionBaseEntity($dbName);
    }
    /**
     * @param string $dbName 数据库名
     *
     * @return \Entities\SyBase\RefundBaseEntity
     */
    public static function getRefundBaseEntity(string $dbName = '')
    {
        return new RefundBaseEntity($dbName);
    }
    /**
     * @param string $dbName 数据库名
     *
     * @return \Entities\SyBase\RefundHistoryEntity
     */
    public static function getRefundHistoryEntity(string $dbName = '')
    {
        return new RefundHistoryEntity($dbName);
    }
    /**
     * @param string $dbName 数据库名
     *
     * @return \Entities\SyBase\SmsRecordEntity
     */
    public static function getSmsRecordEntity(string $dbName = '')
    {
        return new SmsRecordEntity($dbName);
    }
    /**
     * @param string $dbName 数据库名
     *
     * @return \Entities\SyBase\TimedTaskEntity
     */
    public static function getTimedTaskEntity(string $dbName = '')
    {
        return new TimedTaskEntity($dbName);
    }
    /**
     * @param string $dbName 数据库名
     *
     * @return \Entities\SyBase\UserBaseEntity
     */
    public static function getUserBaseEntity(string $dbName = '')
    {
        return new UserBaseEntity($dbName);
    }
    /**
     * @param string $dbName 数据库名
     *
     * @return \Entities\SyBase\UserLoginHistoryEntity
     */
    public static function getUserLoginHistoryEntity(string $dbName = '')
    {
        return new UserLoginHistoryEntity($dbName);
    }
    /**
     * @param string $dbName 数据库名
     *
     * @return \Entities\SyBase\UserMoneyEntity
     */
    public static function getUserMoneyEntity(string $dbName = '')
    {
        return new UserMoneyEntity($dbName);
    }
    /**
     * @param string $dbName 数据库名
     *
     * @return \Entities\SyBase\UserMoneyHistoryEntity
     */
    public static function getUserMoneyHistoryEntity(string $dbName = '')
    {
        return new UserMoneyHistoryEntity($dbName);
    }
    /**
     * @param string $dbName 数据库名
     *
     * @return \Entities\SyBase\UserRoleEntity
     */
    public static function getUserRoleEntity(string $dbName = '')
    {
        return new UserRoleEntity($dbName);
    }
    /**
     * @param string $dbName 数据库名
     *
     * @return \Entities\SyBase\WithdrawBaseEntity
     */
    public static function getWithdrawBaseEntity(string $dbName = '')
    {
        return new WithdrawBaseEntity($dbName);
    }
    /**
     * @param string $dbName 数据库名
     *
     * @return \Entities\SyBase\WithdrawHistoryEntity
     */
    public static function getWithdrawHistoryEntity(string $dbName = '')
    {
        return new WithdrawHistoryEntity($dbName);
    }
    /**
     * @param string $dbName 数据库名
     *
     * @return \Entities\SyBase\WxopenAuthorizerEntity
     */
    public static function getWxopenAuthorizerEntity(string $dbName = '')
    {
        return new WxopenAuthorizerEntity($dbName);
    }
    /**
     * @param string $dbName 数据库名
     *
     * @return \Entities\SyBase\WxproviderCorpAuthorizerEntity
     */
    public static function getWxproviderCorpAuthorizerEntity(string $dbName = '')
    {
        return new WxproviderCorpAuthorizerEntity($dbName);
    }
    /**
     * @param string $dbName 数据库名
     *
     * @return \Entities\SyBase\RegionBaseEntity
     */
    public static function getRegionBaseEntity(string $dbName = '')
    {
        return new RegionBaseEntity($dbName);
    }
    /**
     * @param string $dbName 数据库名
     *
     * @return \Entities\SyBase\RoleBaseEntity
     */
    public static function getRoleBaseEntity(string $dbName = '')
    {
        return new RoleBaseEntity($dbName);
    }
    /**
     * @param string $dbName 数据库名
     *
     * @return \Entities\SyBase\RolePermissionEntity
     */
    public static function getRolePermissionEntity(string $dbName = '')
    {
        return new RolePermissionEntity($dbName);
    }
    /**
     * @param string $dbName 数据库名
     *
     * @return \Entities\SyBase\WxconfigBaseEntity
     */
    public static function getWxconfigBaseEntity(string $dbName = '')
    {
        return new WxconfigBaseEntity($dbName);
    }
    /**
     * @param string $dbName 数据库名
     *
     * @return \Entities\SyBase\WxconfigAccountEntity
     */
    public static function getWxconfigShopEntity(string $dbName = '')
    {
        return new WxconfigAccountEntity($dbName);
    }
    /**
     * @param string $dbName 数据库名
     *
     * @return \Entities\SyBase\WxconfigMiniEntity
     */
    public static function getWxconfigMiniEntity(string $dbName = '')
    {
        return new WxconfigMiniEntity($dbName);
    }
    /**
     * @param string $dbName 数据库名
     *
     * @return \Entities\SyBase\WxconfigCorpEntity
     */
    public static function getWxconfigCorpEntity(string $dbName = '')
    {
        return new WxconfigCorpEntity($dbName);
    }
    /**
     * @param string $dbName 数据库名
     *
     * @return \Entities\SyBase\AliconfigPayEntity
     */
    public static function getAliconfigPayEntity(string $dbName = '')
    {
        return new AliconfigPayEntity($dbName);
    }
    /**
     * @param string $dbName 数据库名
     *
     * @return \Entities\SyBase\DingtalkConfigCorpEntity
     */
    public static function getDingtalkConfigCorpEntity(string $dbName = '')
    {
        return new DingtalkConfigCorpEntity($dbName);
    }
    /**
     * @param string $dbName 数据库名
     *
     * @return \Entities\SyBase\SyTokenBaseEntity
     */
    public static function getSyTokenBaseEntity(string $dbName = '')
    {
        return new SyTokenBaseEntity($dbName);
    }
}
