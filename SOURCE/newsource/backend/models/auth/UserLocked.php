<?php
/**
 * Created by PhpStorm.
 * User: hoangl
 * Date: 10/18/2016
 * Time: 2:18 PM
 */

namespace backend\models\auth;

use yii\redis\ActiveRecord;

/**
 * This is the model class for table "UserLocked" in redis.
 *
 * @property string $id
 * @property string $username
 * @property string $ip
 * @property integer $createdAt
 */
class UserLocked extends ActiveRecord
{
    public function attributes()
    {
        return ['id', 'username', 'ip', 'createdAt'];
    }

    public static function primaryKey()
    {
        return ['id'];
    }

    public static function isUsernameLocked($username, $timeStart, $timeEnd) {
        return UserLocked::find()
            ->where(['username' => $username])
            ->andWhere(['between', 'createdAt', intval($timeStart), intval($timeEnd) ])
            ->count();
    }

    public static function isIpLocked($ip, $timeStart, $timeEnd) {
        return UserLocked::find()
            ->where(['ip' => $ip])
            ->andWhere(['between', 'createdAt', intval($timeStart), intval($timeEnd) ])
            ->count();
    }

    public static function lockUsername($username, $createdAt = null)
    {
        if (!$createdAt) $createdAt = time();
        $loginFailed = new UserLocked;
        $loginFailed->username = $username;
        $loginFailed->createdAt = $createdAt;
        $loginFailed->insert();
    }

    public static function lockIp($ip, $createdAt = null)
    {
        if (!$createdAt) $createdAt = time();
        $loginFailed = new UserLocked;
        $loginFailed->ip = $ip;
        $loginFailed->createdAt = $createdAt;
        $loginFailed->insert();
    }

    public static function unlockUsername($username) {
        LoginFailed::deleteAll(['username' => $username]);
    }

    public static function unlockIp($ip) {
        LoginFailed::deleteAll(['ip' => $ip]);
    }
}