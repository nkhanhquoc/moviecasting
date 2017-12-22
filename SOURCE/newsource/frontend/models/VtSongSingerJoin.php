<?php

namespace frontend\models;

use common\libs\Constant;
use Yii;

class VtSongSingerJoin extends \common\models\VtSongSingerJoinBase {

    public static function getListSingerBySongId($listSongID) {
        $query = VtSongSingerJoin::find()->select(VtSongSingerJoin::tableName() . '.*, vt_singer.*')
                ->leftJoin('vt_singer', VtSongSingerJoin::tableName() . '.singer_id=vt_singer.id')
                ->where([VtSongSingerJoin::tableName() . '.song_id' => $listSongID])
                ->asArray()
                ->all();
        return $query;
    }

    public static function getListSongBySingerId($singerId, $limit = 40, $offset = 0) {
        $cache = \Yii::$app->cache;
        $key = 'VtSongSingerJoin_getListSongBySingerId_' . $singerId . $offset . $limit;
        $data = $cache->get($key);
        if (!$data) {
            $data = VtSongSingerJoin::find()
                    ->leftJoin('vt_song', VtSongSingerJoin::tableName() . '.`song_id`=vt_song.`id`')
                    ->where([
                        VtSongSingerJoin::tableName() . '.singer_id' => $singerId,
                        'vt_song.is_active' => Constant::ACTIVE,
                    ])
                    ->orderBy(VtSongSingerJoin::tableName() . '.`priority`, ' . VtSongSingerJoin::tableName() . '.`updated_at` DESC')
                    ->limit($limit)
                    ->offset($offset)
                    ->all();
            $cache->set($key, $data, CACHE_TIMEOUT);
        }
        return $data;
    }

}
