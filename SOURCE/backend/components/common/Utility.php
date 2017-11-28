<?php

namespace backend\components\common;

use Yii;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Utility {

    public static function getFilePathToSave($filePath, $type) {
        if (is_file($filePath)) {
            $config = Yii::$app->params['upload'][$type]['basePath'];
            $file = explode($config, $filePath);
            return $config . $file[1];
        }
        return '';
    }

    public static function getBasePathUpload($type) {
        return Yii::$app->params['upload']['basePath'] . Yii::$app->params['upload'][$type]['basePath'];
    }
    
    public static function getBasePathUploadImage($type) {
        return Yii::$app->params['upload']['baseDirImages'] . Yii::$app->params['upload'][$type]['basePath'];
    }

    public static function htmlEncode($text)
    {
        return htmlspecialchars($text,ENT_QUOTES);
    }

    public static function truncate($string, $len = 30, $dots = TRUE) {
        $retVal = $string;

        $encoding = mb_detect_encoding($string, "auto");

        // leng of string in current encoding
        $strlen = mb_strlen($string, $encoding);

        $delta = $strlen - $len;
        if ($delta > 0) {
            $shortText = "";

            // trim it by length in current encoding
            $shortText = mb_substr($string, 0, $len, $encoding);

            // find the last break word
            $breakPos = $len;
            $breakPatten = array(" ", ",", ".", ":", "_", "-", "+");
            foreach ($breakPatten as $id => $breakKey) {
                if (mb_strrpos($shortText, $breakKey, $encoding)) {
                    if ($id == "0") {
                        $breakPos = mb_strrpos($shortText, $breakKey, $encoding);
                    } else {
                        $breakPos = ($breakPos > mb_strrpos($shortText, $breakKey, $encoding)) ? $breakPos : mb_strrpos($shortText, $breakKey, $encoding);
                    }
                }
            }

            $shortText = mb_substr($shortText, 0, $breakPos, $encoding);

            if ($dots)
                $shortText .= "...";

            $retVal = $shortText;
        }

        return $retVal;
    }

    public static function getThumbImg($thumb) {
        if (empty($thumb)) {
            $thumb = NO_IMAGE;
        }

        return  $thumb;
    }


}
