<?php
/**
 * Created by PhpStorm.
 * User: hoangl
 * Date: 10/22/2016
 * Time: 5:13 PM
 */

namespace api\modules\v1\models;


use api\models\CsmItemDeleted;
use yii\db\Query;

class CsmItemDeletedV1 extends CsmItemDeleted
{
    /**
     * @param $startDate
     * @param $endDate
     * @param $type
     * @return Query
     */
    private static function findItemDeleted($startDate, $endDate, $type)
    {
        $q = CsmItemDeletedV1::find();
        if ($type && count($type)) {
            $q->andWhere(['type' => $type]);
        }
        if ($startDate != null) {
            $q->andWhere('deleted_at >= :startDate', ['startDate' => $startDate]);
        }
        if ($endDate != null) {
            $q->andWhere('deleted_at <= :endDate', ['endDate' => $endDate]);
        }
        return $q;
    }

    public static function getItemDeleted($startDate, $endDate, $type, $offset, $limit)
    {
        $offset = $offset ? $offset : 0;
        $limit = $limit ? $limit : 100;
        return self::findItemDeleted($startDate, $endDate, $type)
            ->orderBy('deleted_at, id')
            ->offset($offset)
            ->limit($limit)
            ->all();
    }

    public static function countItemDeleted($startDate, $endDate, $type)
    {
        return self::findItemDeleted($startDate, $endDate, $type)->count();
    }
}