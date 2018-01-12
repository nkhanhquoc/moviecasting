<?php

namespace frontend\models;

use common\libs\Constant;
use common\helpers\Helpers;
use Yii;
use yii\db\Query;

class VtAlbum extends \common\models\VtAlbumBase
{
    /**
     * huync2
     * @param $genreId
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public static function getListPlaylistHot($genreId, $limit = 12, $offset = 0)
    {
        $cache = \Yii::$app->cache;
        $key = 'VtAlbum_getListPlaylistHot_' . $genreId . $offset . $limit;
        $data = $cache->get($key);
        if (!$data) {
            $data = VtAlbum::find()
                ->leftJoin('vt_album_genre_join', VtAlbum::tableName() . '.id =vt_album_genre_join.album_id')
                ->where([
                    'vt_album_genre_join.music_genre_id' => $genreId,
                    VtAlbum::tableName() . '.is_active' => Constant::ACTIVE,
                ])
                ->orderBy('vt_album_genre_join.priority, vt_album_genre_join.updated_at desc')
                ->limit($limit)
                ->offset($offset)
                ->all();
            $dependency = new \yii\caching\FileDependency(['fileName' => \Yii::$aliases['@common'] . '\cache\vt_album.txt']);
            $cache->set($key, $data, CACHE_TIMEOUT, $dependency);
        }
        return $data;
    }

    /**
     * KhanhNQ16 - 21/10/2015
     * @param $slug
     */
    public static function getActiveSlug($slug)
    {
        $cache = \Yii::$app->cache;
        $key = 'VtAlbum_getActiveSlug_' . $slug;
        $data = $cache->get($key);
        if (!$data) {
            $data = VtAlbum::find()
                ->where([
                    'is_active' => Constant::ACTIVE,
                    'slug' => $slug
                ])
                ->with(['songs.singers' => function ($query) {
                    $query->andWhere('is_active = :active', [':active' => Constant::ACTIVE]);
                }])
                ->with(['singers0' => function ($query) {
                    $query->andWhere('is_active = :active', [':active' => Constant::ACTIVE]);
                }])
                ->with(['musicGenres' => function ($query) {
                    $query->andWhere([
                        //                   'status'=>Constant::APPROVAL,
                        //                    'is_active' => Constant::ACTIVE
                    ]);
                }])
                ->one();
            $cache->set($key, $data, CACHE_TIMEOUT);
        }
        return $data;
    }


    /**
     * huync2
     * @param $slug
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function getListSongBySlug($slug)
    {
        $cache = \Yii::$app->cache;
        $key = 'VtAlbum_getListSongBySlug_' . $slug;
        $data = $cache->get($key);
        if (!$data) {
            $data = VtAlbum::find()
                ->where([
                    'is_active' => Constant::ACTIVE,
                    'slug' => $slug
                ])
                ->with(['songs' => function ($query) {
                    $query->andWhere([
                        'is_active' => Constant::ACTIVE
                    ]);
                }])
                ->one();
            $cache->set($key, $data, CACHE_TIMEOUT);
        }
        return $data;
    }

    /**
     * @param $singerId
     * @return mixed
     * huync2
     */
    public static function getPlaylistBySingerId($singerId, $limit = 20, $offset = 0)
    {
        $cache = \Yii::$app->cache;
        $key = 'VtAlbum_getPlaylistBySingerId_' . $singerId . $offset . $limit;
        $data = $cache->get($key);
        if (!$data) {
            $data = VtAlbum::find()
                ->leftJoin('vt_album_singer_join', VtAlbum::tableName() . '.id=vt_album_singer_join.album_id')
                ->where([
                    'singer_id' => $singerId,
                    'is_active' => Constant::ACTIVE
                ])
                ->orderBy('vt_album_singer_join.`priority`, vt_album_singer_join.`updated_at` DESC')
                ->limit($limit)
                ->offset($offset)
                ->all();
            $dependency = new \yii\caching\FileDependency(['fileName' => \Yii::$aliases['@common'] . '\cache\vt_album.txt']);
            $cache->set($key, $data, CACHE_TIMEOUT, $dependency);
        }
        return $data;
    }

    /**
     * KhanhNQ16
     */
    public static function getSameGenre($genreId, $limit = 20, $offset = 0)
    {
        $cache = \Yii::$app->cache;
        $key = md5('VtAlbum_getSameGenre_' . json_encode($genreId) . $offset . $limit);
        $data = $cache->get($key);
        if (!$data) {
            $data = VtAlbum::find()
                ->leftJoin('vt_album_genre_join', 'vt_album.id = vt_album_genre_join.album_id')
                ->where([
                    'vt_album.is_active' => Constant::ACTIVE,
                    'vt_album_genre_join.music_genre_id' => $genreId
                ])
                ->with(['singers0' => function ($query) {
                    $query->andWhere('is_active = :active', [':active' => Constant::ACTIVE]);
                }])
                ->with(['songs' => function ($query) {
                    $query->andWhere('is_active = :active', [':active' => Constant::ACTIVE]);
                }])
                ->orderBy('vt_album_genre_join.priority, vt_album_genre_join.updated_at desc')
                ->limit($limit)
                ->offset($offset)
                ->asArray()
                ->all();
            $dependency = new \yii\caching\FileDependency(['fileName' => \Yii::$aliases['@common'] . '\cache\vt_album.txt']);
            $cache->set($key, $data, CACHE_TIMEOUT, $dependency);
        }
        return $data;
    }

    /**
     * huync2
     * @param $slug
     * @return array|mixed|null|\yii\db\ActiveRecord
     */
    public static function getObjAlbumBySlug($slug)
    {
        $cache = \Yii::$app->cache;
        $key = md5('VtAlbum_getObjAlbumBySlug_' . $slug);
        $data = $cache->get($key);
        if (!$data) {
        $data = VtAlbum::find()
            ->andWhere([
                'slug' => $slug,
                'is_active' => Constant::ACTIVE,
            ])
            ->one();
            $cache->set($key, $data, CACHE_TIMEOUT);
        }
        return $data;
    }



        /**
         * KhanhNQ16
         * @param $id
         * @return mixed
         */
        public static function getListRankAlbum($id)
        {
            $limit = \Yii::$app->params['number_rank_album'];
            $cache = \Yii::$app->cache;
            $key = 'VtAlbum_getListRankAlbum_' . $id;
            $data = $cache->get($key);
            if (!$data) {
                $data = VtAlbum::find()
                    ->select('vt_album.*, rank_album.position, rank_album.image_path   ')
                    ->leftJoin('rank_album', 'vt_album.id = rank_album.album_id')
                    ->where([
                        'rank_album.rank_id' => $id,
                        'vt_album.is_active' => Constant::ACTIVE
                    ])
                    ->with(['singers0' => function ($query) {
                        $query->andWhere('is_active = :active', [':active' => Constant::ACTIVE]);
                    }])
                    ->orderBy('rank_album.position asc')
                    ->limit($limit)
                    ->asArray()
                    ->all();
                $dependency = new \yii\caching\FileDependency(['fileName' => \Yii::$aliases['@common'] . '\cache\vt_album.txt']);
                $cache->set($key, $data, CACHE_TIMEOUT, $dependency);
            }
            return $data;
        }


        public static function getRelatedById($albumId,$limit = 20, $offset = 0)
        {
          $cache = \Yii::$app->cache;
          $key = 'VtAlbum_getRelatedById_' . $albumId . '_' . $limit . '_' . $offset;
          $data = $cache->get($key);
          if (!$data) {
            $date = [];
            if($albumId){
              $album = VtAlbum::find()
                ->where('is_active = :is_active AND id = :id', [
                    'is_active' => Constant::ACTIVE,
                    'id' => $albumId
                ])
                ->one();
                if($album){
                    $genreIds = VtAlbumGenreJoin::getGenreByAlbumId($albumId);
                    $genreIds = Helpers::getArrayColumn($genreIds, 'music_genre_id');

                    if ($genreIds) {
                      $query = VtAlbum::find()->distinct()
                          ->leftJoin(VtAlbumGenreJoin::tableName(), static::tableName() . '.id = ' . VtAlbumGenreJoin::tableName() . '.album_id')
                          ->andwhere([
                              static::tableName() . '.is_active' => Constant::ACTIVE,
                              VtAlbumGenreJoin::tableName() . '.music_genre_id' => $genreIds
                          ])
                          ->andWhere(static::tableName() . '.id != :id', ['id' => $albumId])
                          //khanhnq16: bo dong code nay, khong hieu sao lai them vao
//                            ->andWhere(static::tableName() . '.updated_at <= :updated_at', ['updated_at' => $video->updated_at])
                          ->orderBy(VtAlbumGenreJoin::tableName() . '.priority asc, ' . static::tableName() . '.updated_at desc')
                          ->limit($limit)
                          ->offset($offset)
                          ->asArray();
                      $data = $query->all();
                      if ($data) {
                          $dependency = new \yii\caching\FileDependency(['fileName' => \Yii::$aliases['@common'] . '\cache\vt_album.txt']);
                          $cache->set($key, $data, CACHE_TIMEOUT, $dependency);
                      }
                    }
                }
            }
          }
          return $data;
        }
}
