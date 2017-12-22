<?php

namespace frontend\models;

use common\libs\Constant;
use common\models\VtSongBase;
use yii\db\ActiveRecord;
use yii\db\Expression;

class VtSong extends VtSongBase
{

    public static function findIdentity($id)
    {
        $cache = \Yii::$app->cache;
        $key = 'VtSong_findIdentity_' . $id;
        $data = $cache->get($key);
        if (!$data) {
            $data = static::findOne($id);
            $cache->set($key, $data, CACHE_TIMEOUT);
        }
        return $data;
    }

    /**
     * KhanhNQ16
     * @param $id
     * @return mixed
     */
    public static function getListRankSong($id)
    {
        $limit = \Yii::$app->params['number_rank_song'];
        $cache = \Yii::$app->cache;
        $key = 'VtSong_getListRankSong_' . $id;
        $data = $cache->get($key);
        if (!$data) {
            $data = VtSong::find()
                ->select('vt_song.*, rank_song.position, rank_song.image_path   ')
                ->leftJoin('rank_song', 'vt_song.id = rank_song.song_id')
                ->where([
                    'rank_song.rank_id' => $id,
                    'vt_song.is_active' => Constant::ACTIVE
                ])->with(['singers' => function ($query) {
                    $query->andWhere('is_active = :active', [':active' => Constant::ACTIVE]);
                }])
                ->orderBy('rank_song.position asc')
                ->limit($limit)
                ->asArray()
                ->all();
            $dependency = new \yii\caching\FileDependency(['fileName' => \Yii::$aliases['@common'] . '\cache\vt_song.txt']);
            $cache->set($key, $data, CACHE_TIMEOUT, $dependency);
        }
        return $data;
    }

    /**
     * huync2
     * @param $slug
     * @return array|null|ActiveRecord
     */
    public static function getSongBySlug($slug)
    {
        $cache = \Yii::$app->cache;
        $key = 'VtSong_getSongBySlug_' . $slug;
        $data = $cache->get($key);
        if (!$data) {
            $data = VtSong::find()
                ->where([
                    'is_active' => Constant::ACTIVE,
                    'slug' => $slug
                ])
                ->one();
            $cache->set($key, $data, CACHE_TIMEOUT);
        }
        return $data;
    }

    /**
     * huync2
     * @param $topicId
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public static function getListSongTopic($topicId, $limit = 40, $offset = 0)
    {
        $cache = \Yii::$app->cache;
        $key = 'VtSong_getListSongTopic_' . $topicId . $offset . $limit;
        $data = $cache->get($key);
        if (!$data) {
            $data = VtSong::find()
                ->leftJoin('topic_song', VtSong::tableName() . '.id=topic_song.song_id')
                ->where([
                    'is_active' => Constant::ACTIVE,
                    'topic_song.topic_id' => $topicId
                ])
                ->orderBy('topic_song.priority, topic_song.updated_at desc')
                ->limit($limit)
                ->offset($offset)
                ->all();
            $dependency = new \yii\caching\FileDependency(['fileName' => \Yii::$aliases['@common'] . '\cache\vt_song.txt']);
            $cache->set($key, $data, CACHE_TIMEOUT, $dependency);
        }
        return $data;
    }

    /**
     * huync2
     * @param $genreId
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public static function getListSongHotByGenreId($genreId, $limit = 20, $offset = 0, $songid = 0)
    {
        $cache = \Yii::$app->cache;
        $key = 'VtSong_getListSongHotByGenreId_' . $genreId . $offset . $limit;
        $data = $cache->get($key);
        if (!$data) {
            $data = VtSong::find()
                ->select('*')
                ->leftJoin(VtMusicGenreJoin::tableName(), VtMusicGenreJoin::tableName() . '.song_id=' . VtSong::tableName() . '.id')
                ->where([
                    VtSong::tableName() . '.is_active' => Constant::ACTIVE,
                    VtMusicGenreJoin::tableName() . '.music_genre_id' => $genreId
                ])
                    ->andWhere(['<>','id',$songid])
                // ->orderBy(VtMusicGenreJoin::tableName() . '.priority, ' . VtMusicGenreJoin::tableName() . '.updated_at desc')
                ->orderBy(VtMusicGenreJoin::tableName() . '.updated_at desc')
                ->offset($offset)
                ->limit($limit)
                ->all();
            $dependency = new \yii\caching\FileDependency(['fileName' => \Yii::$aliases['@common'] . '\cache\vt_song.txt']);
            $cache->set($key, $data, CACHE_TIMEOUT, $dependency);
        }
        return $data;
    }

    /**
     * huync2
     * khanhnq dung trong searchcontroller
     * @param $arrSong
     * @return array|ActiveRecord[]
     */
    public static function getListSongById($arrSong)
    {

        return VtSong::find()
            ->where([
                'id' => $arrSong,
                'is_active' => Constant::ACTIVE
            ])
//        var_dump($arrSong);die;
//        var_dump(array_reverse($arrSong));die;
//            ->orderBy('FIELD(id,'.implode(',',$arrSong).')')
//            ->orderBy(['id' => array_reverse($arrSong)])
            ->orderBy([new \yii\db\Expression('FIELD (id, ' . implode(',', $arrSong) . ')')])
            ->all();
    }

    /**
     * huync2: lay danh sach bai hat trong album
     * @param $albumId
     * @param int $limit
     * @param int $offset
     * @return array|mixed
     */
    public static function getListSongByAlbumId($albumId, $limit = 40, $offset = 0)
    {
        $cache = \Yii::$app->cache;
        $key = 'VtSong_getListSongByAlbumId_' . $albumId . $offset . $limit;
        $data = $cache->get($key);
        if (!$data) {
            $data = VtSong::find()
                ->leftJoin(VtSongAlbumJoin::tableName(), VtSongAlbumJoin::tableName() . '.song_id=' . VtSong::tableName() . '.id')
                ->andWhere([
                    VtSong::tableName() . '.is_active' => Constant::ACTIVE,
                    VtSongAlbumJoin::tableName() . '.album_id' => $albumId
                ])
                ->orderBy(VtSongAlbumJoin::tableName() . '.updated_at desc')
                ->limit($limit)
                ->offset($offset)
                ->all();
            $dependency = new \yii\caching\FileDependency(['fileName' => \Yii::$aliases['@common'] . '\cache\vt_song.txt']);
            $cache->set($key, $data, CACHE_TIMEOUT, $dependency);
        }
        return $data;
    }

    /**
     * huync2
     * @param $singerId
     * @param int $limit
     * @param int $offset
     * @return mixed
     */
    public static function getListSongBySingerId($singerId, $limit = 40, $offset = 0)
    {
        $cache = \Yii::$app->cache;
        $key = 'VtSong_getListSongBySingerId_' . $singerId . $offset . $limit;
        // VtSongSingerJoin
        $data = $cache->get($key);
        if (!$data) {
            $data = VtSong::find()
                ->leftJoin(VtSongSingerJoin::tableName(), VtSongSingerJoin::tableName() . '.`song_id`=' . VtSong::tableName() . '.`id`')
                ->where([
                    VtSongSingerJoin::tableName() . '.singer_id' => $singerId,
                    VtSong::tableName() . '.is_active' => Constant::ACTIVE,
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
