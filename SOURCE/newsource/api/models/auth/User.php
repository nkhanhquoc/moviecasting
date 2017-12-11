<?php

namespace api\models\auth;

use api\models\Member;
use api\modules\v1\models\SubscriberV1;
use Yii;
use yii\base\Exception;
use yii\redis\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "User" in redis.
 *
 * @property string $id
 * @property string $token
 * @property string $msisdn
 * @property integer $user_id
 * @property boolean $is_vip
 * @property string $permission
 * @property string $username
 * @property string $name
 * @property string $theme_path
 * @property string $image_path
 */
class User extends ActiveRecord implements IdentityInterface {

    public function init() {
        parent::init();
        Yii::$app->user->enableSession = false;
    }

    /**
     * @return array the list of attributes for this record
     */
    public function attributes() {
        return ['id', 'token', 'msisdn', 'user_id', 'is_vip', 'permission', 'username', 'name', 'theme_path', 'image_path'];
    }

    public static function primaryKey() {
        return ['id'];
    }

    public static function getByToken($token) {
        return User::find()->where(['token' => $token])->one();
    }

    public static function getByMsisdn($msisdn) {
        return User::find()->where(['msisdn' => $msisdn])->one();
    }

    public static function insertNewItem($msisdn, $user_id, $is_vip, $username, $name, $theme_path, $image_path, $permission = '', $duplicate = true) {

        $user = new User;
        try {
            if (!$duplicate) {
                User::deleteAll(['msisdn' => $msisdn]);
            }
            $user->token = Yii::$app->security->generateRandomString();
            $user->msisdn = $msisdn;
            $user->user_id = $user_id;
            $user->is_vip = $is_vip;
            $user->username = $username;
            $user->name = $name;

            $user->theme_path = \common\helpers\Helpers::imagePath($theme_path);
            $user->image_path = \common\helpers\Helpers::imagePath($image_path);
            $user->insert();
            return $user;
        } catch (Exception $ex) {
            return false;
        }
    }

    public function updateUserData() {
        try {
            $member = Member::findByUsername($this->username);
            /* @var Member $member */
            $vip = SubscriberV1::getSubMusicOnlineActive($member->id);
            if ($vip) {
                $this->is_vip = true;
            } else {
                $this->is_vip = false;
            }
            $this->name = $member->fullname;
            return $this->save();
        } catch (Exception $ex) {
            return false;
        }
    }

    public function updateSubUser() {
        try {
            $vip = SubscriberV1::getSubMusicOnlineActive($this->user_id);
            if ($vip) {
                $this->is_vip = true;
            } else {
                $this->is_vip = false;
            }
            return $this->save();
        } catch (Exception $ex) {
            return false;
        }
    }

    /**
     * Finds an identity by the given ID.
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id) {
        return User::find()->where(['id' => $id])->one();
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        return User::find()->where(['token' => $token])->one();
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|integer an ID that uniquely identifies a user identity.
     */
    public function getId() {
        return $this->user_id;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey() {
        return $this->token;
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return boolean whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey) {
        return $this->token == $authKey;
    }

}
