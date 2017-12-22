<?php

namespace frontend\models;

use Yii;

class VtAlbumGenreJoin extends \common\models\VtAlbumGenreJoinBase {
  public function getGenreByAlbumId($id)
  {
    $cache = \Yii::$app->cache;
    $key = 'VtAlbumGenreJoin_getGenreByAlbumId_' . $id;
    $data = $cache->get($key);
    if (!$data) {
        $query = VtAlbumGenreJoin::find()->select(static::tableName() . '.music_genre_id')
            ->andWhere(static::tableName() . '.album_id=:album_id', ['album_id' => $id])
            ->asArray();
        $data = $query->all();
        $cache->set($key, $data, CACHE_TIMEOUT);
    }
    return $data;
  }
}
