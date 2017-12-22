<?php

namespace frontend\models;

use common\libs\Constant;
use Yii;

class VtVideoSingerJoin extends \common\models\VtVideoSingerJoinBase
{

    public static function getListSingerByVideoId($listVideoId, $limit = 18)
    {
        $query = VtVideoSingerJoin::find()
            ->select(VtVideoSingerJoin::tableName() . '.`video_id`, vt_singer.*')
            ->leftJoin('vt_singer', 'vt_singer.id = ' . VtVideoSingerJoin::tableName() . '.singer_id')
            ->where([VtVideoSingerJoin::tableName() . '.video_id' => $listVideoId])
            ->limit($limit)
            ->asArray()
            ->all();
        return $query;
    }

    public static function getSingerIdByVideoId($videoId)
    {
        $cache = \Yii::$app->cache;
        $key = 'VtVideoSingerJoin_getSingerIdByVideoId_' . $videoId;
        $data = $cache->get($key);
        if (!$data) {
            $data = VtVideoSingerJoin::find()
                ->where(VtVideoSingerJoin::tableName() . '.video_id = :video_id', ['video_id' => $videoId])
                ->asArray()
                ->all();
            $cache->set($key, $data, CACHE_TIMEOUT);
        }
        return $data;
    }

    public static function getListVideoBySingerId($singerId, $limit = 20, $offset = 0)
    {
        $cache = \Yii::$app->cache;
        $key = 'VtVideoSingerJoin_getListVideoBySingerId_' . $singerId . $offset . $limit;
        $data = $cache->get($key);
        if (!$data) {
            $data = VtVideoSingerJoin::find()
                ->leftJoin('vt_video', VtVideoSingerJoin::tableName() . '.video_id=vt_video.id')
                ->where([
                    VtVideoSingerJoin::tableName() . '.singer_id' => $singerId,
                    'vt_video.is_active' => Constant::ACTIVE
                ])
                ->orderBy(VtVideoSingerJoin::tableName() . '.`priority`, ' . VtVideoSingerJoin::tableName() . '.`updated_at` DESC')
                ->limit($limit)
                ->offset($offset)
                ->all();
            $cache->set($key, $data, CACHE_TIMEOUT);
        }
        return $data;
    }

}
