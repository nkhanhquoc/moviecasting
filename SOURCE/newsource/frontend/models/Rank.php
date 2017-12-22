<?php

namespace frontend\models;

use Yii;

class Rank extends \common\models\RankBase {

  public static function getBySlug($slug, $type=1)
  {
      $cache = Yii::$app->cache;
      $key = "Rank_getBySlug_" . $slug;
      $data = $cache->get($key);
      if (!$data) {
          $data = Rank::find()
              ->where([
                  'slug' => $slug,
                  'is_active' => Constant::ACTIVE,
                  'type' => $type
              ])
              ->one();
          $cache->set($key, $data, CACHE_TIMEOUT);
      }
      return $data;
  }

  /**
   * KhanhNQ16
   * @param int $type
   * @return array|mixed|\yii\db\ActiveRecord[]
   */
  public static function getActive($type = 1)
  {
      $cache = Yii::$app->cache;
      $key = "Rank_getActive";
      $data = $cache->get($key);
      if (!$data) {
          $data = Rank::find()
              ->where([
                  'is_active' => Constant::ACTIVE,
                  'type' => $type
              ])
              ->orderBy('created_at desc')
              ->all();
          $cache->set($key, $data, CACHE_TIMEOUT);
      }
      return $data;
  }
}
