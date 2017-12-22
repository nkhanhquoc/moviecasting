<?php

namespace frontend\models;

use common\libs\Constant;
use Yii;

class Topic extends \common\models\TopicBase {

  public static function getListTopic()
  {
      $cache = \Yii::$app->cache;
      $key = 'Topic_getListTopic';
      $data = $cache->get($key);
      if (!$data) {
          $data = Topic::find()
              ->where([
                  'is_active' => Constant::ACTIVE
              ])
              ->orderBy('priority, updated_at desc')
              ->asArray()
              ->all();
          $cache->set($key, $data, CACHE_TIMEOUT);
      }
      return $data;
  }

  /**
   * huync2
   * @param int $limit
   * @param int $offset
   * @return array|\yii\db\ActiveRecord[]
   */
  public static function getListHot($limit = 12, $offset = 0)
  {
      $cache = \Yii::$app->cache;
      $key = 'Topic_getListHotMusicGenre_'.$limit.$offset;
      $data = $cache->get($key);
      if (!$data) {
          $data = Topic::find()
              ->where([
                  'is_active' => Constant::ACTIVE
              ])
              ->orderBy('priority, updated_at desc')
              ->limit($limit)
              ->offset($offset)
  //            ->asArray()
              ->all();
          $cache->set($key, $data, CACHE_TIMEOUT);
      }
      return $data;
  }

  public static function getTopicBySlug($slug)
  {
      $cache = \Yii::$app->cache;
      $key = 'Topic_getTopicBySlug_'.$slug;
      $data = $cache->get($key);
      if (!$data) {
          $data = Topic::find()
              ->where([
                  'is_active' => Constant::ACTIVE,
                  'slug' => $slug,
              ])
              ->one();
          $cache->set($key, $data, CACHE_TIMEOUT);
      }
      return $data;
  }
}
