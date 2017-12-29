<?php

/*
 * Created by KhanhNQ16@viettel.com.vn
 * Alright reserve by Viettel Group 
 */

namespace common\libs;



use yii\captcha\CaptchaAction;
use yii;
use yii\base\InvalidConfigException;

/**
 * Description of WapCaptcha
 *
 * @author khanhnq16
 */
class WapCaptcha extends CaptchaAction{
    public $libfont = '@wap/web/css/fonts/vavobi.ttf,@wap/web/css/fonts/momtype.ttf';
    public $chars = 'abcdefhjkmnpqrstuxyz2345678';
    /**
     * Initializes the action.
     * @throws InvalidConfigException if the font file does not exist.
     */
    public function init()
    {
        $num = rand(0,count($this->libfont)-1);
        $this->fontFile = Yii::getAlias($this->libfont[$num]);
        if (!is_file($this->fontFile)) {
            $this->fontFile = '@wap/web/css/fonts/momtype.ttf';
        }
    }
    
    
    /**
     * Generates a new verification code.
     * @return string the generated verification code
     */
    protected function generateVerifyCode()
    {
        if ($this->minLength > $this->maxLength) {
            $this->maxLength = $this->minLength;
        }
        if ($this->minLength < 3) {
            $this->minLength = 3;
        }
        if ($this->maxLength > 20) {
            $this->maxLength = 20;
        }
        $length = mt_rand($this->minLength, $this->maxLength);
        $size = strlen($this->chars)-1;
        $code = '';
        for ($i = 0; $i < $length; ++$i) {           
            $code .= $this->chars[mt_rand(0, $size)];
        }
        return $code;
    }
}
