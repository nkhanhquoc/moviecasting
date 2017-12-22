<?php
/*
@Author: Nguyen Quoc Khanh
@Date:   2016/11/05 8:44:09
@Email:  KhanhNQ16@viettel.com.vn
@Project: Imuzik Plus 1.5
@Last modified by:   Nguyen Quoc Khanh
@Last modified time: 2016/11/05 8:44:24
*/



namespace frontend\controllers;

use yii;
use yii\data\Pagination;
use frontend\models\Topic;
use frontend\models\VtSong;
use frontend\models\VtAlbum;
use frontend\models\VtVideo;
use yii\web\NotFoundHttpException;

class TopicController extends AppController{
  public function beforeAction($action) {
      if ($_SERVER['HTTP_HOST'] === Yii::$app->params['vip_domain']) {
          $user = Yii::$app->getUser()->getIdentity();
          $vip =  Yii::$app->session->get('user_vip');
          if($user && $vip){
              VtLogAction::insertLog($vip->id, $user->phonenumber, $_SERVER['REQUEST_URI'], ACTION_TOPIC);
          }
      }
      return parent::beforeAction($action);
  }

    public function actionIndex()
    {
      $limit = Yii::$app->params['limit_list_topic'];
      $listTopic = Topic::getListHot(1000);

      $page = Yii::$app->getRequest()->getQueryParam('page');
      if(!$page) $page = 1;
      $pages = new Pagination(['totalCount' => count($listTopic)]);
      $pages->setPage($page-1);
      $pages->setPageSize($limit);
      $listTopic = array_slice($listTopic,($page-1)*$limit,$limit);

      return $this->render('index.twig', [
                  'listTopic' => $listTopic,
                  'pages' => $pages
      ]);

    }

    public function actionDetail()
    {
      $slug = Yii::$app->getRequest()->getQueryParam('slug');
      if(!$slug){
        throw new NotFoundHttpException;
      }

      $objTopic = Topic::getTopicBySlug($slug);
      if (!$objTopic) {
          throw new NotFoundHttpException;
      }
      $topicId=$objTopic->id;
      $listSongTopic = VtSong::getListSongTopic($topicId,100);
      $listTopicHot = Topic::getListHot(12);
      $playListHot = VtAlbum::getListPlaylistHot(Yii::$app->params['genre_id_playlist_hot'],6);
      $listVideoHot = VtVideo::getListVideoHot(Yii::$app->params['genre_id_video_hot'],6);
      return $this->render('detail.twig', [
                  'listTopic' => $listTopicHot,
                  'listSongTopic' => $listSongTopic,
                  'playListHot' => $playListHot,
                  'listVideoHot' => $listVideoHot,
                  'topic' => $objTopic
      ]);
    }
}
