<?php
/*
@Author: Nguyen Quoc Khanh
@Date:   2016/11/04 11:03:44
@Email:  KhanhNQ16@viettel.com.vn
@Project: Imuzik Plus 1.5
@Last modified by:   Nguyen Quoc Khanh
@Last modified time: 2016/11/04 11:09:10
*/

namespace frontend\controllers;

use yii;
use yii\data\Pagination;
use yii\base\Exception;
use yii\web\NotFoundHttpException;
use frontend\models\VtMusicGenre;
use frontend\models\VtVideo;
use frontend\models\VtLogVideo;
use frontend\models\VtVideoGenreJoin;
use frontend\models\VtSong;
use frontend\models\VtSongSingerJoin;
use frontend\models\VtAlbum;
use common\helpers\Helpers;
use common\helpers\MusicHelper;

class VideoController extends AppController
{

  public function beforeAction($action) {
      if ($_SERVER['HTTP_HOST'] === Yii::$app->params['vip_domain']) {
          $user = Yii::$app->getUser()->getIdentity();
          $vip = Yii::$app->session->get('user_vip');
          if ($user && $vip) {
              VtLogAction::insertLog($vip->id, $user->phonenumber, $_SERVER['REQUEST_URI'], ACTION_VIDEO);
          }
      }
      return parent::beforeAction($action);
  }

  public function actionIndex() {
      $slug = Yii::$app->getRequest()->getQueryParam('slug');
      $listGenre = VtMusicGenre::getActive();
      $limit = Yii::$app->params['limit_video_list'];
      if ($slug == 'video-hot') {
          $genreId = Yii::$app->params['genre_id_video_hot'];
          $title = "VIDEO HOT";
      }
      // else {
      //     $musicGenre = VtMusicGenre::getObjVtMusicGenreBySlug($slug);
      //     $genreId = $musicGenre['id'];
      //     $title = $musicGenre['name'];
      // }
      // if (!$genreId) {
      //     throw new NotFoundHttpException;
      // }
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
        $listVideo = VtVideo::getListVideoHot($genreId, 1000);
        $page = Yii::$app->getRequest()->getQueryParam('page');
        if(!$page) $page = 1;
        $pages = new Pagination(['totalCount' => count($listVideo)]);
        $pages->setPage($page-1);
        $pages->setPageSize(20);
        $listVideo = array_slice($listVideo,($page-1)*20,20);
      }
      return $this->render('list.twig', [
                  'listVideo' => $listVideo,
                  'listGenre' => $listGenre,
                  'title' => $title,
                  'genreId' => $genreId,
                  'pages' => $pages
      ]);
  }

/**
 * [actionDetail description]
 * @author KhanhNQ16
 * @return [type] [description]
 */
  public function actionDetail()
  {
    $slug = Yii::$app->getRequest()->getQueryParam('slug');
    if ($slug) {
        /* @var VtVideo $video */
        $video = VtVideo::getActiveSlug($slug);
        if (!$video) {
            throw new NotFoundHttpException;
        }
        $qualityPath = json_decode($video->quality_path);
        $listQuality = [];
        if ($qualityPath) {
            foreach ($qualityPath as $quality => $formatUrl) {
                $listQuality[$quality] = "";
            }
        }

        $listVideoQuality = array_intersect_key(Yii::$app->params['quality_video'], $listQuality);
        $selectQuality = count($listVideoQuality) > 0 ? array_values($listVideoQuality)[0] : '';
        $selectQualityKey = count($listVideoQuality) > 0 ? array_keys($listVideoQuality)[0] : '';
        $listFile = array();
        if ($video->quality_path) {
            foreach (json_decode($video->quality_path) as $key => $object) {
                $listFile[$key] = array();
                $listFile[$key]['format'] = $object->format;
                $listFile[$key]['url'] = \wap\components\WapExtension::getMediaPath($object->url);
            }
        }

        try {
            $log = new VtLogVideo();
            $log->video_id = $video->id;
            $log->action = VIEW;
            $log->created_at = date('Y-m-d H:i:s', time());
            $log->save(false);
        } catch (Exception $e) {

        }


        try {
            $user = Yii::$app->getUser()->getIdentity();
            $vip = Yii::$app->session->get('user_vip');
            if ($user && $vip) {
                Payment::charge($user->phonenumber, '2', $video->id, Yii::$app->params['payment_song_fee'], $video->cp_code);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        $limit = Yii::$app->params['limit_video_list']; //lan dau load 20
        $related = VtVideo::getVideoRelated($slug, $limit, $offset);

        $singerIds = MusicHelper::getSingerIdJson($video->singer_list);
        if($singerIds){
          $songs = VtSong::getListSongBySingerId($singerIds,10);
          $albumsSinger = VtAlbum::getPlaylistBySingerId($singerIds,6);
        } else {
          $songs = [];
          $albumsSinger = [];
        }
        $listVideoHot = VtVideo::getListVideoHot(Yii::$app->params['genre_id_video_hot'],6);
        return $this->render('detail.twig', [
                    'video' => $video,
                    'listVideoQuality' => $listVideoQuality,
                    'selectQuality' => $selectQuality,
                    'selectQualityKey' => $selectQualityKey,
                    'qualityPath' => base64_encode(json_encode($listFile)),
                    'imageBlur' => MusicHelper::getImageBlurPathByVideo($video->image_blur_path),
                    'related' => $related,
                    'songs' => $songs,
                    'albumsSinger' => $albumsSinger,
                    'hot' => $listVideoHot,
        ]);

    }
    else {
        throw new NotFoundHttpException;
    }
  }
}
