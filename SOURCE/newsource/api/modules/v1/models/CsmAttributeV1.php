<?php
/**
 * Created by PhpStorm.
 * User: hoangl
 * Date: 10/22/2016
 * Time: 5:08 PM
 */

namespace api\modules\v1\models;


use api\models\CsmAttribute;
use yii\db\Query;

class CsmAttributeV1 extends CsmAttribute
{
    /**
     * @param $startDate
     * @param $endDate
     * @param $type
     * @return Query
     */
    private static function findMediaAttribute($name, $startDate, $endDate, $type)
    {
        $q = CsmAttributeV1::find()
            ->alias('ca')
//            ->leftJoin('csm_media_attribute as cma', 'ca.type = cma.attribute_id')
            ->where(['ca.is_active' => ACTIVE]);
        if ($name) {
            $q->andWhere(['like', 'name', $name]);
        }
        if ($type && count($type)) {
            $q->andWhere(['ca.type' => $type]);
        }
        if ($startDate != null) {
            $q->andWhere('ca.updated_at >= :startDate', ['startDate' => $startDate]);
        }
        if ($endDate != null) {
            $q->andWhere('ca.updated_at <= :endDate', ['endDate' => $endDate]);
        }
        return $q;
    }

    public static function getMediaAttribute($name, $startDate, $endDate, $type, $offset, $limit)
    {
        $offset = $offset ? $offset : 0;
        $limit = $limit ? $limit : 100;
        return self::findMediaAttribute($name, $startDate, $endDate, $type)
            ->orderBy('ca.updated_at, ca.id')
            ->offset($offset)
            ->limit($limit)
            ->all();
    }

    public static function countMediaAttribute($name, $startDate, $endDate, $type)
    {
        return self::findMediaAttribute($name, $startDate, $endDate, $type)->count();
    }
}