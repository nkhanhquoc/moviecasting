<?php
/**
 * Created by PhpStorm.
 * User: hoangl
 * Date: 10/22/2016
 * Time: 5:05 PM
 */

namespace api\modules\v1\models;


use api\models\CsmAttributeType;
use yii\db\Query;

class CsmAttributeTypeV1 extends CsmAttributeType
{
    /**
     * @param $startDate
     * @param $endDate
     * @return Query
     */
    private static function findAttributeType($startDate, $endDate)
    {
        $q = CsmAttributeTypeV1::find()->where(['is_active' => ACTIVE]);
        if ($startDate != null) {
            $q->andWhere('updated_at >= :startDate', ['startDate' => $startDate]);
        }
        if ($endDate != null) {
            $q->andWhere('updated_at <= :endDate', ['endDate' => $endDate]);
        }
        return $q;
    }

    public static function getAttributeType($startDate, $endDate, $offset, $limit) {
        $offset = $offset ? $offset : 0;
        $limit = $limit ? $limit : 100;
        return self::findAttributeType($startDate, $endDate)
            ->orderBy('updated_at, id')
            ->offset($offset)
            ->limit($limit)
            ->all();
    }

    public static function countAttributeType($startDate, $endDate) {
        return self::findAttributeType($startDate, $endDate)->count();
    }
}