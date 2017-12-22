<?php

namespace frontend\models;

use common\libs\Constant;
use Yii;

class VtMusicGenre extends \common\models\VtMusicGenreBase
{

    /**
     * huync2
     * @param $slug
     * @param array $exclude
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function getObjVtMusicGenreBySlug($slug)
    {
        $cache = \Yii::$app->cache;
        $key = 'VtMusicGenre_getObjVtMusicGenreBySlug_' . $slug;
        $data = $cache->get($key);
        if (!$data) {
            $data = VtMusicGenre::find()
                ->where([
                    'slug' => $slug
                ])
                ->asArray()
                ->one();
            $cache->set($key, $data, CACHE_TIMEOUT);
        }
        return $data;
    }

    public static function getActive($exclude = [0])
    {
        $cache = \Yii::$app->cache;
        $data = $cache->get('VtMusicGenre_getActive_' . json_encode($exclude));

        if (!$data) {
            $data = VtMusicGenre::find()
                ->where([
                    'is_active' => Constant::ACTIVE,
                    'type' => [Constant::TYPE_UNION, Constant::TYPE_PLAYLIST]
                ])
                ->andWhere(['not in', 'id', $exclude])
                ->orderBy('priority asc, updated_at desc')
                ->asArray()
                ->all();
            $dependency = new \yii\caching\FileDependency(['fileName' => \Yii::$aliases['@common'] . '\cache\vt_music_genre.txt']);
            $cache->set('VtMusicGenre_getActive', $data, CACHE_TIMEOUT, $dependency);
        }
        return $data;
    }

    /**
     * huync2
     * @param array $type
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getListVtMusicGenre($type = array(Constant::TYPE_UNION), $limit = 100, $exclude = [0])
    {
        $cache = \Yii::$app->cache;
        $key = md5('VtMusicGenre_getListVtMusicGenre_' . json_encode($type) . "_" . $limit . "_" . json_encode($exclude));
        $data = $cache->get($key);
        if (!$data) {
            $data = VtMusicGenre::find()
                ->where([
                    'is_active' => Constant::ACTIVE,
                    'type' => $type
                ])
                ->andWhere(['not in', 'id', $exclude])
                ->orderBy('priority, updated_at desc')
                ->limit($limit)
                ->asArray()
                ->all();
            $dependency = new \yii\caching\FileDependency(['fileName' => \Yii::$aliases['@common'] . '\cache\vt_music_genre.txt']);
            $cache->set($key, $data, CACHE_TIMEOUT, $dependency);
        }
        return $data;
    }

    public static function getListHotMusicGenre($limit = 12, $offset = 0)
    {
        $cache = \Yii::$app->cache;
        $key = 'VtMusicGenre_getListHotMusicGenre_' . $offset . "_" . $limit;
        $data = $cache->get($key);
        if (!$data) {
            $data = VtMusicGenre::find()
                ->where([
                    'is_active' => Constant::ACTIVE
                ])
                ->orderBy('priority, updated_at desc')
                ->limit($limit)
                ->offset($offset)
                ->asArray()
                ->all();
            $dependency = new \yii\caching\FileDependency(['fileName' => \Yii::$aliases['@common'] . '\cache\vt_music_genre.txt']);
            $cache->set($key, $data, CACHE_TIMEOUT, $dependency);
        }
        return $data;
    }

}
