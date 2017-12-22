<?php

namespace frontend\models;

use Yii;

class VtSongAlbumJoin extends \common\models\VtSongAlbumJoinBase {

    public static function countTotalSongAlbum($arrAlbumId) {
        $totalSongAlbum = VtSongAlbumJoin::find()
                ->select(VtSongAlbumJoin::tableName() . '.`album_id`, COUNT(' . VtSongAlbumJoin::tableName() . '.`song_id`) AS total_song')
                ->where([
                    'album_id' => $arrAlbumId
                ])
                ->groupBy(VtSongAlbumJoin::tableName() . '.`album_id`')
                ->asArray()
                ->all();
        $arrSongAlbum = array();
        if (count($totalSongAlbum)) {
            foreach ($totalSongAlbum as $item) {
                $arrSongAlbum[$item['album_id']] = $item['total_song'];
            }
        }
        return $arrSongAlbum;
    }

    public static function getListSongAlbum($albumId) {
        $cache = \Yii::$app->cache;
        $key = 'VtSongAlbumJoin_getListSongAlbum_' . $albumId;
        $data = $cache->get($key);
        if (!$data) {
            $data = VtSongAlbumJoin::find()
                    ->leftJoin(VtSong::tableName(), VtSongAlbumJoin::tableName() . '.song_id=' . VtSong::tableName() . '.id')
                    ->where([
                        VtSongAlbumJoin::tableName() . '.album_id' >= $albumId
                    ])
                    ->all();
            $cache->set($key, $data, CACHE_TIMEOUT);
        }
        return $data;
    }

}
