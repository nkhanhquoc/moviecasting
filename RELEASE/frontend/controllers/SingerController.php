<?php
/*
@Author: Nguyen Quoc Khanh
@Date:   2016/11/05 11:28:46
@Email:  KhanhNQ16@viettel.com.vn
@Project: Imuzik Plus 1.5
@Last modified by:   Nguyen Quoc Khanh
@Last modified time: 2016/11/05 11:29:03
*/

namespace frontend\controllers;

use yii;
use yii\data\Pagination;
use yii\base\Exception;
use yii\web\NotFoundHttpException;
use frontend\models\VtMusicGenre;
use frontend\models\VtSinger;
use frontend\models\VtAlbum;
use frontend\models\VtSong;
use frontend\models\VtVideo;
use frontend\models\VtVideoSingerJoin;
use common\helpers\Helpers;
use common\helpers\MusicHelper;

class SingerController extends AppController{

  public function beforeAction($action) {
      if ($_SERVER['HTTP_HOST'] === Yii::$app->params['vip_domain']) {
          $user = Yii::$app->getUser()->getIdentity();
          $vip =  Yii::$app->session->get('user_vip');
          if($user && $vip){
              VtLogAction::insertLog($vip->id, $user->phonenumber, $_SERVER['REQUEST_URI'], ACTION_SINGER);
          }
      }
      return parent::beforeAction($action);
  }
  public function actionIndex()
  {
    $slug = Yii::$app->getRequest()->getQueryParam('slug');
    $limit = Yii::$app->params['limit_list_singer'];
    $listGenre = VtMusicGenre::getActive();
    $genreId = 0;
    if ($slug == 'ca-si-hot') {
        $genreId = Yii::$app->params['genre_id_singer_hot'];
        $title = "Ca sĩ hot";
    }

    if(!Helpers::inMultiArray($genreId,'id',$listGenre) && !Helpers::inMultiArray($slug,'slug',$listGenre)){
      throw new NotFoundHttpException;
    }
    if (!$genreId) {
      foreach($listGenre as $genre){
        if($genre['slug'] == $slug){
          $genreId = $genre['id'];
          $title = $genre['name'];
          break;
        }
      }
    }
    if ($genreId) {
      $singer = VtSinger::getSingerGenre($genreId);
      $page = Yii::$app->getRequest()->getQueryParam('page');
      if(!$page) $page = 1;
      $pages = new Pagination(['totalCount' => count($singer)]);
      $pages->setPage($page-1);
      $pages->setPageSize(15);
      $singer = array_slice($singer,($page-1)*$limit,$limit);

      return $this->render('index.twig', [
            'singer' => $singer,
            'title' => $title,
            'listGenre' => $listGenre,
            'pages' => $pages,
            'genreId' => $genreId
      ]);
    }else {
      return $this->redirect('/');
    }
  }

/**
 * [actionDetail description]
 * @author KhanhNQ16
 * @return [type] [description]
 */
  public function actionDetail()
  {
    $slug = Yii::$app->getRequest()->getQueryParam('slug');
    $objSinger = VtSinger::getSingerBySlug($slug);
    if (!$objSinger) {
        throw new NotFoundHttpException;
    }
    $listAlbum = VtAlbum::getPlaylistBySingerId($objSinger['id'],6);
    $listSong = VtSong::getListSongBySingerId($objSinger['id'], 100);
    $listVideo = VtVideo::getListVideoBySingerId($objSinger['id'], 6);
    return $this->render('detail.twig', [
          'singer' => $objSinger,
          'listSong' => $listSong,
          'listVideo' => $listVideo,
          'listAlbum' => $listAlbum
    ]);
  }
}
