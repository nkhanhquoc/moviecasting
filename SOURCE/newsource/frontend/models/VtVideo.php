<?php

namespace frontend\models;

use common\helpers\Helpers;
use Yii;
use yii\db\Query;
use common\libs\Constant;

class VtVideo extends \common\models\VtVideoBase
{

    /**
     * KhanhNQ16
     * @param $id
     * @return mixed
     */
    public static function getListRankVideo($id)
    {
        $cache = \Yii::$app->cache;
        $key = 'VtVideo_getListRankVideo_' . $id;
        $data = $cache->get($key);
        if (!$data) {
            $limit = \Yii::$app->params['number_rank_video'];
            $data = VtVideo::find()
                ->leftJoin('rank_video', 'vt_video.id = rank_video.video_id')
                ->where([
                    'rank_video.rank_id' => $id,
                    'vt_video.is_active' => Constant::ACTIVE,
                ])
                ->with(['singers' => function ($query) {
                    $query->andWhere('is_active = :active', [':active' => Constant::ACTIVE]);
                }])
                ->orderBy('rank_video.position asc')
                ->limit($limit)
                ->all();
            $dependency = new \yii\caching\FileDependency(['fileName' => \Yii::$aliases['@common'] . '\cache\vt_video.txt']);
            $cache->set($key, $data, CACHE_TIMEOUT, $dependency);
        }
        return $data;
    }

    public static function getListSinger($arrVideoId)
    {
        $query = VtVideo::find()
            ->leftJoin('vt_video_singer_join', 'vt_video.id = vt_video_singer_join.video_id')
            ->where(['vt_video.id' => $arrVideoId])
            ->with(['singers' => function ($query) {
                $query->andWhere('is_active = :active', [':active' => Constant::ACTIVE]);
            }])
            ->asArray()
            ->all();
        return $query;
    }

    /**
     * KhanhNQ16
     * @param $slug
     */
    public static function getActiveSlug($slug)
    {
        $cache = \Yii::$app->cache;
        $key = 'VtVideo_getActiveSlug_' . $slug;
        $data = $cache->get($key);
        if (!$data) {
            $data = VtVideo::find()
                ->where([
                    'slug' => $slug,
                    'vt_video.is_active' => Constant::ACTIVE,
                ])
                ->with(['singers' => function ($query) {
                    $query->andWhere('is_active = :active', [':active' => Constant::ACTIVE]);
                }])
                ->with(['genres' => function ($query) {
                    $query->andWhere('is_active = :active', [':active' => Constant::ACTIVE]);
                }])
                ->one();
            $cache->set($key, $data, CACHE_TIMEOUT);
        }
        return $data;
    }

    /**
     * Get Related Video By Video Slug
     * @author HoangL
     * @param $slug
     * @param int $limit
     * @param int $offset
     * @return array|mixed
     */
    public static function getVideoRelated($slug, $limit = 20, $offset = 0)
    {
        $cache = \Yii::$app->cache;
        $key = 'VtVideo_getVideoRelated_' . $slug . '_' . $limit . '_' . $offset;
        $data = $cache->get($key);
        if (!$data) {
            $data = [];
            if ($slug) {
                /* @var VtVideo $video */
                $video = VtVideo::find()
                    ->where('is_active = :is_active AND slug = :slug', [
                        'is_active' => Constant::ACTIVE,
                        'slug' => $slug
                    ])
                    ->one();
                if ($video) {
                    $genreIds = VtVideoGenreJoin::getGenreByVideoId($video->id);
                    $genreIds = Helpers::getArrayColumn($genreIds, 'genre_id');
                    if ($genreIds) {
                        $query = VtVideo::find()->distinct()
                            ->leftJoin(VtVideoGenreJoin::tableName(), static::tableName() . '.id = ' . VtVideoGenreJoin::tableName() . '.video_id')
                            ->andwhere([
                                static::tableName() . '.is_active' => Constant::ACTIVE,
                                VtVideoGenreJoin::tableName() . '.genre_id' => $genreIds
                            ])
                            ->andWhere(static::tableName() . '.id != :id', ['id' => $video->id])
                            //khanhnq16: bo dong code nay, khong hieu sao lai them vao
//                            ->andWhere(static::tableName() . '.updated_at <= :updated_at', ['updated_at' => $video->updated_at])
                            ->orderBy(VtVideoGenreJoin::tableName() . '.priority asc, ' . static::tableName() . '.updated_at desc')
                            ->limit($limit)->offset($offset)
                            ->asArray();
                        $data = $query->all();
                        if ($data) {
                            $dependency = new \yii\caching\FileDependency(['fileName' => \Yii::$aliases['@common'] . '\cache\vt_video.txt']);
                            $cache->set($key, $data, CACHE_TIMEOUT, $dependency);
                        }
                    }
                }
            }
        }
        return $data;
    }

    /**
     * Get Video List the same singer by Video Slug
     * @author HoangL
     * @param $slug
     * @param int $limit
     * @param int $offset
     * @return array|mixed
     */
    public static function getVideoSinger($slug, $limit = 20, $offset = 0) {
        $cache = \Yii::$app->cache;
        $key = 'VtVideo_getVideoSinger_' . $slug . '_' . $limit . '_' . $offset;
        $data = $cache->get($key);
        if (!$data) {
            $data = [];
            if ($slug) {
                /* @var VtVideo $video */
                $video = VtVideo::find()
                    ->where('is_active = :is_active AND slug = :slug', [
                        'is_active' => Constant::ACTIVE,
                        'slug' => $slug
                    ])
                    ->one();
                if ($video) {
                    $singerIds = VtVideoSingerJoin::getSingerIdByVideoId($video->id);
                    $singerIds = Helpers::getArrayColumn($singerIds, 'singer_id');
                    if ($singerIds) {
                        $query = VtVideo::find()->distinct()
                            ->leftJoin(VtVideoSingerJoin::tableName(), static::tableName() . '.id = ' . VtVideoSingerJoin::tableName() . '.video_id')
                            ->andwhere([
                                static::tableName() . '.is_active' => Constant::ACTIVE,
                                VtVideoSingerJoin::tableName() . '.singer_id' => $singerIds
                            ])
                            ->andWhere(static::tableName() . '.id != :id', ['id' => $video->id])
//                            ->andWhere(static::tableName() . '.updated_at <= :updated_at', ['updated_at' => $video->updated_at])
                            ->orderBy(VtVideoSingerJoin::tableName() . '.priority asc, ' . static::tableName() . '.updated_at desc')
                            ->limit($limit)->offset($offset)
                            ->asArray();
                        $data = $query->all();
                        if ($data) {
                            $dependency = new \yii\caching\FileDependency(['fileName' => \Yii::$aliases['@common'] . '\cache\vt_video.txt']);
                            $cache->set($key, $data, CACHE_TIMEOUT, $dependency);
                        }
                    }
                }
            }
        }
        return $data;
    }


    /**
     * KhanhNQ16
     * @param $id
     */
    public static function getRelated($ids)
    {
        $cache = \Yii::$app->cache;
        $key = md5('VtVideo_getRelated_' . json_encode($ids));
        $data = $cache->get($key);
        if (!$data) {
            $data = VtVideo::find()
                ->leftJoin('vt_video_genre_join', 'vt_video.id = vt_video_genre_join.video_id')
                ->where([
                    'vt_video.is_active' => Constant::ACTIVE,
                    'vt_video_genre_join.genre_id' => $ids
                ])
                ->with(['singers' => function ($query) {
                    $query->andWhere('is_active = :active', [':active' => Constant::ACTIVE]);
                }])
                ->limit(\Yii::$app->params['common_list_number'])
                ->orderBy('vt_video_genre_join.priority asc, vt_video.created_at desc')
                ->asArray()
                ->all();
            $dependency = new \yii\caching\FileDependency(['fileName' => \Yii::$aliases['@common'] . '\cache\vt_video.txt']);
            $cache->set($key, $data, CACHE_TIMEOUT, $dependency);
        }
        return $data;
    }

    /**
     * KhanhNQ16
     * @param $singerId
     */
    public static function getSameSinger($singerIds, $limit = 20, $offset = 0)
    {
        $cache = \Yii::$app->cache;
        $key = md5('VtVideo_getSameSinger_' . json_encode($singerIds) . $offset . $limit);
        $data = $cache->get($key);
        if (!$data) {
            $data = VtVideo::find()
                ->leftJoin('vt_video_singer_join', 'vt_video_singer_join.video_id = vt_video.id')
                ->where([
                    'vt_video.is_active' => Constant::ACTIVE,
                    'vt_video_singer_join.singer_id' => $singerIds
                ])
                ->with(['singers' => function ($query) {
                    $query->andWhere('is_active = :active', [':active' => Constant::ACTIVE]);
                }])
                ->limit(\Yii::$app->params['common_list_number'])
                ->orderBy('vt_video_singer_join.priority asc, vt_video.created_at desc')
                ->offset($offset)
                ->limit($limit)
                ->all();
            $dependency = new \yii\caching\FileDependency(['fileName' => \Yii::$aliases['@common'] . '\cache\vt_video.txt']);
            $cache->set($key, $data, CACHE_TIMEOUT, $dependency);
        }
        return $data;
    }

    public static function getListVideoHot($genreId, $limit = 12, $offset = 0)
    {
        $cache = \Yii::$app->cache;
        $key = 'VtVideo_getListVideoHot_' . $genreId . $offset . $limit;
        $data = $cache->get($key);
        if (!$data) {
            $data = VtVideo::find()
                ->leftJoin('vt_video_genre_join', 'vt_video_genre_join.video_id = vt_video.id')
//                ->with(['singers' => function ($query) {
//                    $query->andWhere('is_active = :active', [':active' => Constant::ACTIVE]);
//                }])
                ->where([
                    'vt_video_genre_join.genre_id' => $genreId,
                    'vt_video.is_active' => Constant::ACTIVE,
                ])
                // ->orderBy('vt_video_genre_join.priority, vt_video_genre_join.updated_at desc')
                ->orderBy('vt_video_genre_join.updated_at desc') //bo sap xep theo priority
                ->offset($offset)
                ->limit($limit)
                ->all();
            $dependency = new \yii\caching\FileDependency(['fileName' => \Yii::$aliases['@common'] . '\cache\vt_video.txt']);
            $cache->set($key, $data, CACHE_TIMEOUT, $dependency);
        }
        return $data;
    }

    /**
     * huync2
     * @param $singerId
     * @param int $limit
     * @param int $offset
     * @return array|mixed
     */

    public static function getListVideoBySingerId($singerId, $limit = 20, $offset = 0)
    {
        $cache = \Yii::$app->cache;
        $key = 'VtVideo_getListVideoBySingerId_' . $singerId . $offset . $limit;
        $data = $cache->get($key);
        if (!$data) {
            $data = VtVideo::find()
                ->leftJoin(VtVideoSingerJoin::tableName(), VtVideoSingerJoin::tableName() . '.video_id=vt_video.id')
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


    /**
     * huync2
     * khanhnq dung trong searchcontroller
     * @param $arrSong
     * @return array|ActiveRecord[]
     */
    public static function getVidsbyIds($arrVid)
    {
        return VtVideo::find()
            ->where([
                'id' => $arrVid,
                'is_active' => Constant::ACTIVE
            ])
            ->orderBy(['id' => array_reverse($arrVid)])
            ->all();
    }
}
