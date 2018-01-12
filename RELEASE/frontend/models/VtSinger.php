<?php

namespace frontend\models;

use Yii;
use common\libs\Constant;

class VtSinger extends \common\models\VtSingerBase
{

    public static function getSingerGenre($genreId)
    {
        $cache = \Yii::$app->cache;
        $key = 'VtSinger_getSingerGenre_' . $genreId;
        $data = $cache->get($key);
        if (!$data) {
            $data = VtSinger::find()
                ->leftJoin('vt_singer_genre_join', 'vt_singer.id = vt_singer_genre_join.singer_id')
                ->where([
                    'vt_singer.is_active' => Constant::ACTIVE,
                    'vt_singer_genre_join.music_genre_id' => $genreId
                ])
                ->asArray()
                ->limit(\Yii::$app->params['number_hot_singer'])
                ->all();
            $dependency = new \yii\caching\FileDependency(['fileName' => \Yii::$aliases['@common'] . '\cache\vt_singer.txt']);
            $cache->set($key, $data, CACHE_TIMEOUT, $dependency);
        }
        return $data;
    }

    public static function getListHotSinger($limit = 5)
    {
        $cache = \Yii::$app->cache;
        $key = 'VtSinger_getListHotSinger_' . $limit;
        $data = $cache->get($key);
        if (!$data) {
            $data = VtSinger::find()
                ->where(VtSinger::tableName() . '.is_active=1')
                ->orderBy(VtSinger::tableName() . '.updated_at desc')
                ->limit($limit)
                ->asArray()
                ->all();
            $dependency = new \yii\caching\FileDependency(['fileName' => \Yii::$aliases['@common'] . '\cache\vt_singer.txt']);
            $cache->set($key, $data, CACHE_TIMEOUT, $dependency);
        }
        return $data;
    }

    /**
     * huync2: danh sach ca sy
     * @param int $limit
     * @param int $offset
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getListSinger($limit = 24, $offset = 0)
    {
        $cache = \Yii::$app->cache;
        $key = 'VtSinger_getListSinger_' . $offset . '_' . $limit;
        $data = $cache->get($key);
        if (!$data) {
            $data = VtSinger::find()
                ->where(VtSinger::tableName() . '.is_active=1')
                ->orderBy(VtSinger::tableName() . '.alias asc')
                ->offset($offset)
                ->limit($limit)
                ->asArray()
                ->all();
            $dependency = new \yii\caching\FileDependency(['fileName' => \Yii::$aliases['@common'] . '\cache\vt_singer.txt']);
            $cache->set($key, $data, CACHE_TIMEOUT, $dependency);
        }
        return $data;
    }

    /**
     * huync2: danh sach ca sy
     * @param int $limit
     * @param int $offset
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getListSingerHot($limit = 12, $offset = 0)
    {
        $cache = \Yii::$app->cache;
        $key = 'VtSinger_getListSingerHot_' . $offset . '_' . $limit;
        $data = $cache->get($key);
        if (!$data) {
            $data = VtSinger::find()
                ->where('is_active = 1')
                ->andWhere('attr & 1 = 1')
                ->orderBy('updated_at desc')
                ->offset($offset)
                ->limit($limit)
                ->asArray()
                ->all();
            $dependency = new \yii\caching\FileDependency(['fileName' => \Yii::$aliases['@common'] . '\cache\vt_singer.txt']);
            $cache->set($key, $data, CACHE_TIMEOUT, $dependency);
        }
        return $data;
    }

    /**
     * huync2: danh sach ca sy
     * @param string $firstWord
     * @param int $limit
     * @param int $offset
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getListSingerByFirstWord($firstWord, $limit = 20, $offset = 0)
    {
        $cache = \Yii::$app->cache;
        $key = 'VtSinger_getListSingerByFirstWord_' . $firstWord . '_' . $offset . '_' . $limit;
        $data = $cache->get($key);
        if (!$data) {
            $data = VtSinger::find()
                ->where('is_active = 1')
                ->andWhere('first_word = :firstWord', ['firstWord' => $firstWord])
                ->orderBy('fan_number desc, like_number desc, updated_at desc, alias desc')
                ->offset($offset)
                ->limit($limit)
                ->asArray()
                ->all();
            $dependency = new \yii\caching\FileDependency(['fileName' => \Yii::$aliases['@common'] . '\cache\vt_singer.txt']);
            $cache->set($key, $data, CACHE_TIMEOUT, $dependency);
        }
        return $data;
    }

    public static function getSingerBySlug($slug)
    {
        $cache = \Yii::$app->cache;
        $key = 'VtSinger_getSingerBySlug_' . $slug;
        $data = $cache->get($key);
        if (!$data) {
//            $data = VtSinger::find()->select(VtSinger::tableName() . '.*, vt_singer_translation.description')
            $data = VtSinger::find()->select(VtSinger::tableName() . '.*')
                ->where([
                    'slug' => $slug,
                    'is_active' => Constant::ACTIVE,
                ])
//                ->leftJoin('vt_singer_translation', VtSinger::tableName() . '.id=vt_singer_translation.id')
                ->asArray()
                ->one();
            $cache->set($key, $data, CACHE_TIMEOUT);
        }
        return $data;
    }

    public static function getSingerById($singerId)
    {
        $cache = \Yii::$app->cache;
        $key = 'VtSinger_getSingerById_' . $singerId;
        $data = $cache->get($key);
        if (!$data) {
            $data = VtSinger::find()->select(VtSinger::tableName() . '.*, vt_singer_translation.description')
                ->where([
                    VtSinger::tableName() . '.id' => $singerId,
                    VtSinger::tableName() . '.is_active' => Constant::ACTIVE,
                ])
                ->leftJoin('vt_singer_translation', VtSinger::tableName() . '.id=vt_singer_translation.id')
                ->asArray()
                ->one();
            $cache->set($key, $data, CACHE_TIMEOUT);
        }
        return $data;
    }

//    /**
//     * huync2: lay danh sach ca sy hot
//     * @param $genreId
//     * @param int $limit
//     * @param int $offset
//     * @return array
//     */
//    public static function getListSingerHot($genreId, $limit = 20, $offset = 0)
//    {
//        $cache = \Yii::$app->cache;
//        $key = 'VtSinger_getListSingerHot_' . $genreId . '_' . $offset . $limit;
//        $data = $cache->get($key);
//        if (!$data) {
//            $data = VtSinger::find()
//                ->select('*')
//                ->leftJoin(VtSingerGenreJoin::tableName(), VtSingerGenreJoin::tableName() . '.singer_id=' . VtSinger::tableName() . '.id')
//                ->andWhere([
//                    VtSingerGenreJoin::tableName() . '.music_genre_id' => $genreId,
//                    VtSinger::tableName() . '.is_active' => Constant::ACTIVE,
//                ])
//                ->orderBy(VtSingerGenreJoin::tableName() . '.priority,' . VtSingerGenreJoin::tableName() . '.updated_at desc')
//                ->limit($limit)
//                ->offset($offset)
//                ->all();
//            $dependency = new \yii\caching\FileDependency(['fileName' => \Yii::$aliases['@common'] . '\cache\vt_singer.txt']);
//            $cache->set($key, $data, CACHE_TIMEOUT, $dependency);
//        }
//        return $data;
//    }

}
