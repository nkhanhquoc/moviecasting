<?php
/**
 * Created by PhpStorm.
 * User: hoangl
 * Date: 10/18/2016
 * Time: 9:38 AM
 */

namespace backend\models\auth;

use yii\redis\ActiveRecord;

/**
 * This is the model class for table "LoginFailed" in redis.
 *
 * @property string $id
 * @property string $username
 * @property integer $userId
 * @property string $ip
 * @property integer $createdAt
 */
class LoginFailed extends ActiveRecord
{
    public function attributes()
    {
        return ['id', 'username', 'userId', 'ip', 'createdAt'];
    }

    public static function primaryKey()
    {
        return ['id'];
    }

    public static function countByUsername($username, $timeStart, $timeEnd)
    {
        return LoginFailed::find()
            ->where(['username' => $username])
            ->andWhere(['between', 'createdAt', intval($timeStart), intval($timeEnd) ])
            ->count();
    }

    public static function countByUserId($userId, $timeStart, $timeEnd)
    {
        return LoginFailed::find()
            ->where(['userId' => $userId])
            ->andWhere(['between', 'createdAt', intval($timeStart), intval($timeEnd) ])
            ->count();
    }

    public static function countByIp($ip, $timeStart, $timeEnd)
    {
        return LoginFailed::find()
            ->where(['ip' => $ip])
            ->andWhere(['between', 'createdAt', intval($timeStart), intval($timeEnd) ])
            ->count();
    }

    public static function log($username, $userId, $ip, $createdAt = null)
    {
        if (!$createdAt) $createdAt = time();
        $loginFailed = new LoginFailed;
        $loginFailed->username = $username;
        $loginFailed->userId = $userId;
        $loginFailed->ip = $ip;
        $loginFailed->createdAt = $createdAt;
        $loginFailed->insert();
    }

    public static function clear($username) {
        LoginFailed::deleteAll(['username' => $username]);
    }
}