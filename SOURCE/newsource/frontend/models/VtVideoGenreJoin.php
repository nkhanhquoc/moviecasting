<?php

namespace frontend\models;

use common\libs\Constant;
use Yii;

class VtVideoGenreJoin extends \common\models\VtVideoGenreJoinBase
{

    public static function getGenreByVideoId($videoId)
    {
        $cache = \Yii::$app->cache;
        $key = 'VtVideoGenreJoin_getGenreByVideoId_' . $videoId;
        $data = $cache->get($key);
        if (!$data) {
            $query = VtVideoGenreJoin::find()->select(static::tableName() . '.genre_id')
                ->andWhere(static::tableName() . '.video_id=:video_id', ['video_id' => $videoId])
                ->asArray();
            $data = $query->all();
            $cache->set($key, $data, CACHE_TIMEOUT);
        }
        return $data;
    }

    public static function getListVideoHot($genreId, $limit = 18)
    {
        $cache = \Yii::$app->cache;
        $key = 'VtVideoGenreJoin_getListVideoHot_' . $genreId . $limit;
        $data = $cache->get($key);
        if (!$data) {
            $query = VtVideoGenreJoin::find()->select('d.*')
                ->leftJoin(['d' => 'vt_video'], static::tableName() . '.video_id=d.`id`')
                ->andWhere('d.`is_active`=:is_active AND vt_video_genre_join.`genre_id`=:genre_id', [':is_active' => 1, ':genre_id' => $genreId])
                ->orderBy(static::tableName() . '.priority asc, ' . static::tableName() . '.updated_at desc');
            if ($limit) {
                $query->limit($limit);
            }
            $query->asArray();
            $data = $query->all();
            $cache->set($key, $data, CACHE_TIMEOUT);
        }
        return $data;
    }

}
