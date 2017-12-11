<?php
/**
 * Created by PhpStorm.
 * User: hoangl
 * Date: 10/22/2016
 * Time: 8:58 AM
 */

namespace api\modules\v1\models;


use api\models\CsmMedia;
use yii\db\Query;

class CsmMediaV1 extends CsmMedia
{
    /**
     * Find media by params
     * @param string $startDate
     * @param string $endDate
     * @param int $type
     * @param int $maxQuantity
     * @param bool $isCrawler
     * @param string $clientId
     * @return Query
     */
    private static function findMediaPublish($startDate, $endDate, $type, $maxQuantity, $isCrawler, $clientId)
    {
        $q = CsmMediaV1::find()
            ->alias('cm')
            ->innerJoin('csm_media_publish as cmp', 'cm.id = cmp.media_id')
            ->where([
                'cm.status' => STATUS_MEDIA_PUBLISHED,
                'cm.convert_status' => CONVERT_STATUS_MEDIA_CONVERT_SUCCESS,
                'cmp.client_id' => $clientId,
            ]);
        if ($startDate != null) {
            $q->andWhere('cm.updated_at >= :startDate OR cmp.published_at >= :startDate', ['startDate' => $startDate]);
        }
        if ($endDate != null) {
            $q->andWhere('cm.updated_at <= :endDate OR cmp.published_at <= :endDate', ['endDate' => $endDate]);
        }
        if ($type != null) {
            $q->andWhere(['cm.type' => $type]);
        }
        if ($maxQuantity != null) {
            $q->andWhere('cm.max_quantity >= :maxQuantity', ['maxQuantity' => $maxQuantity]);
        }
        if ($isCrawler != null) {
            $q->andWhere(['cm.is_crawler' => $isCrawler]);
        }
        return $q;
    }

    public static function countMedia($startDate, $endDate, $type, $maxQuantity, $isCrawler, $clientId)
    {
        return self::findMediaPublish($startDate, $endDate, $type, $maxQuantity, $isCrawler, $clientId)->count();
    }

    public static function getMedia($startDate, $endDate, $type, $maxQuantity, $isCrawler, $clientId, $offset, $limit)
    {
        $offset = $offset ? $offset : 0;
        $limit = $limit ? $limit : 100;
        return self::findMediaPublish($startDate, $endDate, $type, $maxQuantity, $isCrawler, $clientId)
            ->orderBy('updated_at, id')
            ->offset($offset)
            ->limit($limit)
            ->all();
    }

}