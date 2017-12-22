<?php
/*
@Author: Nguyen Quoc Khanh
@Date:   2016/11/05 2:46:50
@Email:  KhanhNQ16@viettel.com.vn
@Project: Imuzik Plus 1.5
@Last modified by:   Nguyen Quoc Khanh
@Last modified time: 2016/11/05 2:46:57
*/
namespace frontend\controllers;

use yii;
use frontend\models\VtAlbum;
use frontend\models\VtSong;
use frontend\models\VtVideo;

class RankController extends AppController{

  public function beforeAction($action) {
      if ($_SERVER['HTTP_HOST'] === Yii::$app->params['vip_domain']) {
          $user = Yii::$app->getUser()->getIdentity();
          $vip =  Yii::$app->session->get('user_vip');
          if($user && $vip){
              VtLogAction::insertLog($vip->id, $user->phonenumber, $_SERVER['REQUEST_URI'], ACTION_RANK);
          }
      }
      return parent::beforeAction($action);
  }

    public function actionIndex()
    {
      $rankVnSong = VtSong::getListRankSong(Yii::$app->params['rank_song_vn']);
      $rankEuSong = VtSong::getListRankSong(Yii::$app->params['rank_song_eu']);

      $rankVnVideo = VtVideo::getListRankVideo(Yii::$app->params['rank_video_vn']);
      $rankEuVideo = VtVideo::getListRankVideo(Yii::$app->params['rank_video_eu']);

      $rankVnAlbum = VtAlbum::getListRankAlbum(Yii::$app->params['rank_album_vn']);
      $rankEuAlbum = VtAlbum::getListRankAlbum(Yii::$app->params['rank_album_eu']);

      return $this->render('index.twig', [
            'rankVnSong' => $rankVnSong,
            'rankEuSong' => $rankEuSong,
            'rankVnVideo' => $rankVnVideo,
            'rankEuVideo' => $rankEuVideo,
            'rankVnAlbum' => $rankVnAlbum,
            'rankEuAlbum' => $rankEuAlbum
      ]);
    }
}
