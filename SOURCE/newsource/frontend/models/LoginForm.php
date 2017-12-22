<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model {

    public $username;
    public $password;
    public $captcha;
    public $rememberMe = true;
    private $_user;
    public $loginFailCount = 0;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            // username and password are both required
            [['username', 'password', 'captcha'], 'required'],
            [['username', 'password', 'captcha'], 'trim'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            ['captcha', 'captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'username' => Yii::t('wap', 'Số điện thoại'),
            'password' => Yii::t('wap', 'Mật khẩu'),
            'rememberMe' => Yii::t('wap', 'Nhớ mật khẩu'),
            'captcha' => Yii::t('wap', 'Mã xác thực'),
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params) {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'username hoặc password không đúng');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login() {
        if ($this->validate()) {
            $user = $this->getUser();
            if ($user->is_active == 0) {
                $this->addError('password', Yii::t('wap', 'Tài khoản của bạn chưa được kích hoạt'));
            } elseif ($user->locked == 1) {
                $this->addError('password', Yii::t('wap', 'Tài khoản của bạn đang bị khóa'));
            } elseif ($user->is_active == 1) {
//                return Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
                return Yii::$app->user->login($user);
            }
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser() {
        if ($this->_user === null) {
            $this->_user = Member::findByUsername(\common\libs\RemoveSign::convertMsisdn($this->username));
        }

        return $this->_user;
    }

}
