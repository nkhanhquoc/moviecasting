<?php

/*
@Author: Nguyen Quoc Khanh
@Date:   2016/11/02 4:09:03
@Email:  KhanhNQ16@viettel.com.vn
@Project: Imuzik Plus 1.5
@Last modified by:   Nguyen Quoc Khanh
@Last modified time: 2016/11/02 4:11:50
*/

namespace frontend\controllers;

use frontend\models\VtAlbum;
use frontend\models\VtMusicGenre;
use frontend\models\VtSong;
use frontend\models\VtLogAlbum;
use frontend\models\VtLogAction;
use common\helpers\Helpers;
use Yii;
use yii\data\Pagination;
use yii\base\Exception;
use yii\web\NotFoundHttpException;

class PlaylistController extends AppController
{
  public function beforeAction($action) {
      if ($_SERVER['HTTP_HOST'] === Yii::$app->params['vip_domain']) {
          $user = Yii::$app->getUser()->getIdentity();
          $vip =  Yii::$app->session->get('user_vip');
          if($user && $vip){
              VtLogAction::insertLog($vip->id, $user->phonenumber, $_SERVER['REQUEST_URI'], ACTION_ALBUM);
          }
      }
      return parent::beforeAction($action);
  }

/**
 * Sua lai chi query 1 lan
 * @author KhanhNQ16
 * @return [type] [description]
 */
  public function actionList()
  {
      $listGenre = VtMusicGenre::getActive();
      $genreId = 0;
      $slug = Yii::$app->getRequest()->getQueryParam('slug');
      if ($slug == 'playlist-hot') {
          $genreId = Yii::$app->params['genre_id_playlist_hot'];
          $title = "Playlist Hot";
      } elseif ($slug == 'playlist-new') {
          $genreId = Yii::$app->params['genre_id_playlist_new'];
          $title = "Playlist Mới";
      }
      // var_dump($genreId);
      // var_dump($listGenre);
      // die;
      if(!Helpers::inMultiArray($genreId,'id',$listGenre) && !Helpers::inMultiArray($slug,'slug',$listGenre)){
        throw new NotFoundHttpException;
      }
      // else {
      //     $ = VtMusicGenre::getObjVtMusicGenreBySlug($slug);
      //     $genreId = $musicGenre['id'];
      //     $title = $musicGenre['name'];
      // }

      // if (!$genreId) {
      //     throw new NotFoundHttpException;
      // }
      if (!$genreId) {
        foreach($listGenre as $genre){
          if($genre['slug'] == $slug){
            $activeGenre = $genre;
            $genreId = $genre['id'];
            $title = $genre['name'];
            break;
          }
        }
      }
      if ($genreId) {
          $page = Yii::$app->getRequest()->getQueryParam('page');
          if(!$page) $page = 1;
          $playlists = VtAlbum::getSameGenre($genreId,1000);
          $pages = new Pagination(['totalCount' => count($playlists)]);
          //gives the current page number (zero-based). The default value is 0, meaning the first page.
          $pages->setPage($page-1);
          $pages->setPageSize(20);
          $playlists = array_slice($playlists,($page-1)*20,20);
          // $pages->route = 'playlist/listGenre';//not set -> current
          // $activeGenre = VtMusicGenre::find()
          //     ->where('id = :id', [':id' => $genreId])
          //     ->one();
          return $this->render('list.twig', [
            'activeGenre' => $activeGenre,
            'listGenre' => $listGenre,
            'playlists' => $playlists,
            'title' => $title,
            'genreId' => $genreId,
            'pages' => $pages]);

      } else {
          return $this->redirect('/');
      }
  }


  public function actionDetail()
  {
      $slug = Yii::$app->getRequest()->getQueryParam('slug');
      if ($slug) {
          $playlist = VtAlbum::getListSongBySlug($slug);
          if ($playlist) {
              $limit = Yii::$app->params['limit_list_playlist'];
              $albumId = $playlist->id;
              $listSong = VtSong::getListSongByAlbumId($albumId, $limit);
              try {
                  $log = new VtLogAlbum();
                  $log->album_id = $playlist->id;
                  $log->action = VIEW;
                  $log->created_at = date('Y-m-d H:i:s', time());
                  $log->save();
              } catch (Exception $e) {

              }
              $listRelated = VtAlbum::getRelatedById($albumId,6);
              $listHot = VtAlbum::getListPlaylistHot(Yii::$app->params['genre_id_playlist_hot'],6);

              return $this->render('detail.twig', [
                  'playlist' => $playlist,
                  'listSong' => $listSong,
                  'albumId' => $albumId,
                  'listRelated' => $listRelated,
                  'listHot' => $listHot,
              ]);
          } else {
              throw new NotFoundHttpException;
          }
      }
  }
  public function actionWriteLogAlbum()
  {
      $slug = Yii::$app->request->getQueryParam('slug');
      $objAlbum = VtAlbum::getObjAlbumBySlug($slug);
      if (!$objAlbum) {
          return 0;
      }
      try {
          $log = new VtLogAlbum();
          $log->album_id = $objAlbum->id;
          $log->action = VIEW;
          $log->created_at = date('Y-m-d H:i:s', time());
          $log->save();
      } catch (Exception $e) {
      }
      return 1;
  }
}
