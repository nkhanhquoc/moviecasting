<?php
/**
 * Created by PhpStorm.
 * User: hoangl
 * Date: 11/29/2016
 * Time: 9:28 AM
 */

namespace api\modules\v1\models;

use api\models\CsmCrawler;

class CsmCrawlerV1 extends CsmCrawler
{
    private static function findCrawler($name)
    {
        $q = CsmCrawlerV1::find();
        if ($name) {
            $q->where(['like', 'name', $name]);
        }
        return $q;
    }

    public static function countCrawler($name)
    {
        return self::findCrawler($name)->count();
    }

    public static function getCrawler($name, $offset, $limit)
    {
        $offset = $offset ? $offset : 0;
        $limit = $limit ? $limit : 20;
        return self::findCrawler($name)
            ->orderBy('id asc')
            ->offset($offset)
            ->limit($limit)
            ->all();
    }
}