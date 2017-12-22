<?php
/**
 * Created by PhpStorm.
 * User: HoangL
 * Date: 27-May-16
 * Time: 11:28
 */

namespace frontend\validators;

use Yii;
use yii\base\InvalidConfigException;
use yii\validators\ValidationAsset;
use yii\validators\Validator;

class PjaxcaptchaValidator extends Validator
{
    /**
     * @var boolean whether to skip this validator if the input is empty.
     */
    public $skipOnEmpty = false;
    /**
     * @var boolean whether the comparison is case sensitive. Defaults to false.
     */
    public $caseSensitive = false;
    /**
     * @var string the route of the controller action that renders the CAPTCHA image.
     */
    public $captchaAction = 'site/pjaxcaptcha';


    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if ($this->message === null) {
            $this->message = Yii::t('yii', 'The verification code is incorrect.');
        }
    }

    /**
     * @inheritdoc
     */
    protected function validateValue($value)
    {
        $captcha = $this->createCaptchaAction();
        $valid = !is_array($value) && $captcha->validate($value, $this->caseSensitive);

        return $valid ? null : [$this->message, []];
    }

    /**
     * Creates the CAPTCHA action object from the route specified by [[captchaAction]].
     * @return \yii\captcha\CaptchaAction the action object
     * @throws InvalidConfigException
     */
    public function createCaptchaAction()
    {
        $ca = Yii::$app->createController($this->captchaAction);
        if ($ca !== false) {
            /* @var $controller \yii\base\Controller */
            list($controller, $actionID) = $ca;
            $action = $controller->createAction($actionID);
            if ($action !== null) {
                return $action;
            }
        }
        throw new InvalidConfigException('Invalid CAPTCHA action ID: ' . $this->captchaAction);
    }

    /**
     * @inheritdoc
     */
    public function clientValidateAttribute($object, $attribute, $view)
    {
        $captcha = $this->createCaptchaAction();
        $code = $captcha->getVerifyCode(false);
        $hash = $captcha->generateValidationHash($this->caseSensitive ? $code : strtolower($code));
        $options = [
            'hash' => $hash,
            'hashKey' => 'yiiCaptcha/' . $this->captchaAction,
            'caseSensitive' => $this->caseSensitive,
            'message' => Yii::$app->getI18n()->format($this->message, [
                'attribute' => $object->getAttributeLabel($attribute),
            ], Yii::$app->language),
        ];
        if ($this->skipOnEmpty) {
            $options['skipOnEmpty'] = 1;
        }

        ValidationAsset::register($view);

        return 'yii.validation.captcha(value, messages, ' . json_encode($options, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . ');';
    }
}