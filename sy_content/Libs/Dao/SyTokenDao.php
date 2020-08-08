<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-19
 * Time: 下午11:11
 */
namespace Dao;

use Factories\SyBaseMysqlFactory;
use ProjectCache\SyToken;
use SyConstant\ErrorCode;
use SyException\Common\CheckException;
use SyTool\Tool;
use SyTrait\SimpleDaoTrait;

class SyTokenDao
{
    use SimpleDaoTrait;

    public static function addTokenByStation(array $data)
    {
        $tokenBase = SyBaseMysqlFactory::getSyTokenBaseEntity();
        $ormResult1 = $tokenBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`tag`=?', [$data['tag']]);
        $tokenInfo = $tokenBase->getContainer()->getModel()->findOne($ormResult1);
        if (!empty($tokenInfo)) {
            throw new CheckException('令牌标识已存在', ErrorCode::COMMON_PARAM_ERROR);
        }

        $nowTime = Tool::getNowTime();
        $tokenBase->tag = $data['tag'];
        $tokenBase->title = $data['title'];
        $tokenBase->remark = $data['remark'];
        $tokenBase->expire_time = $data['expire_time'];
        $tokenBase->created = $nowTime;
        $tokenBase->updated = $nowTime;
        $tokenBase->getContainer()->getModel()->insert($tokenBase->getEntityDataArray());
        unset($ormResult1, $tokenBase);

        return [
            'msg' => '添加令牌成功',
        ];
    }

    public static function editTokenByStation(array $data)
    {
        $tokenBase = SyBaseMysqlFactory::getSyTokenBaseEntity();
        $ormResult1 = $tokenBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`tag`=?', [$data['tag']]);
        $tokenInfo = $tokenBase->getContainer()->getModel()->findOne($ormResult1);
        if (empty($tokenInfo)) {
            throw new CheckException('令牌信息不存在', ErrorCode::COMMON_PARAM_ERROR);
        }

        $tokenBase->getContainer()->getModel()->update($ormResult1, [
            'title' => $data['title'],
            'remark' => $data['remark'],
            'expire_time' => $data['expire_time'],
            'updated' => Tool::getNowTime(),
        ]);
        unset($ormResult1, $tokenBase);
        SyToken::clearTokenData($data['tag']);

        return [
            'msg' => '修改令牌成功',
        ];
    }

    public static function getTokenInfoByStation(array $data)
    {
        $tokenBase = SyBaseMysqlFactory::getSyTokenBaseEntity();
        $ormResult1 = $tokenBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`tag`=?', [$data['tag']]);
        $tokenInfo = $tokenBase->getContainer()->getModel()->findOne($ormResult1);
        unset($ormResult1, $tokenBase);
        if (empty($tokenInfo)) {
            throw new CheckException('令牌信息不存在', ErrorCode::COMMON_PARAM_ERROR);
        }

        return $tokenInfo;
    }

    public static function getTokenListByStation(array $data)
    {
        $tokenBase = SyBaseMysqlFactory::getSyTokenBaseEntity();
        $ormResult1 = $tokenBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->order('`id` DESC');
        $tokenList = $tokenBase->getContainer()->getModel()->findPage($ormResult1, $data['page'], $data['limit']);
        unset($ormResult1, $tokenBase);

        return $tokenList;
    }
}
