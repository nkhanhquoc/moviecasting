<?php
namespace frontend\controllers;

use yii;
use yii\data\Pagination;
use yii\base\Exception;
use yii\web\NotFoundHttpException;
use yii\helpers\BaseHtmlPurifier;
use frontend\models\VtMusicGenre;
use frontend\models\VtSong;
use frontend\models\VtVideo;
use frontend\models\VtLogSong;
use frontend\models\VtLogAction;
use common\helpers\Helpers;
use common\helpers\MusicHelper;
use common\helpers\FileHelper;
class SongController extends AppController
{

  public function beforeAction($action) {
      if ($_SERVER['HTTP_HOST'] === Yii::$app->params['vip_domain']) {
          $user = Yii::$app->getUser()->getIdentity();
          $vip = Yii::$app->session->get('user_vip');
          if ($user && $vip) {
              VtLogAction::insertLog($vip->id, $user->phonenumber, $_SERVER['REQUEST_URI'], ACTION_SONG);
          }
      }
      return parent::beforeAction($action);
  }

  public function actionIndex() {
      $slug = Yii::$app->getRequest()->getQueryParam('slug');
      $limit = Yii::$app->params['limit_list_song'];
      $listGenre = VtMusicGenre::getActive();
      $genreId = 0;
      if ($slug == 'song-hot') {
          $genreId = Yii::$app->params['genre_id_song_hot'];
          $title = "Bài hát hot";
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
        $listSong = VtSong::getListSongHotByGenreId($genreId, 1000);
        $page = Yii::$app->getRequest()->getQueryParam('page');
        if(!$page) $page = 1;
        $pages = new Pagination(['totalCount' => count($listSong)]);
        $pages->setPage($page-1);
        $pages->setPageSize(15);
        $listSong = array_slice($listSong,($page-1)*15,15);

        return $this->render('list.twig', [
              'listSong' => $listSong,
              'title' => $title,
              'listGenre' => $listGenre,
              'pages' => $pages,
              'genreId' => $genreId
        ]);
      } else {
        return $this->redirect('/');
      }
  }

  public function actionSongDetail()
  {
    $slug = Yii::$app->getRequest()->getQueryParam('slug');
    $lowSongPath = null;
    if ($slug) {
      $song = VtSong::getSongBySlug($slug);
      if ($song) {
        $qualityPath = json_decode($song->quality_path);
        $listQuality = [];
        $listFile = array();
        if ($song->quality_path) {
          foreach ($qualityPath as $key => $object) {
              $listQuality[$key] = "";
              $listFile[$key] = array();
              $listFile[$key]['format'] = $object->format;
              #$listFile[$key]['url'] = Yii::$app->params['media_path'] . $object->url;
              $listFile[$key]['url'] = \wap\components\WapExtension::getMediaPath($object->url);
              if (!$lowSongPath) {
                  $lowSongPath = "{ " . $listFile[$key]['format'] . " : '" . $listFile[$key]['url'] . "' }";
              }
          }
        }
        $listSongQuality = array_intersect_key(Yii::$app->params['quality_song'], $listQuality);
        $selectQuality = count($listSongQuality) > 0 ? array_values($listSongQuality)[0] : '';
        $selectQualityKey = count($listSongQuality) > 0 ? array_keys($listSongQuality)[0] : '';
        $imagePoster = MusicHelper::getImagePathBySong($song->singer_list);
        $singerName = MusicHelper::getSingerNameJson($song->singer_list);
        $imageBlur = MusicHelper::getImageBlurPathBySong($song->singer_list);

        try {
            $objLogSong = new VtLogSong();
            $objLogSong->song_id = $song->id;
            $objLogSong->action = VIEW;
            $objLogSong->created_at = date('Y-m-d H:i:s', time());
            $objLogSong->save();
        } catch (Exception $e) {

        }
        try {
            $user = Yii::$app->getUser()->getIdentity();
            $vip = Yii::$app->session->get('user_vip');
            if ($user && $vip) {
                Payment::charge($user->phonenumber, '1', $song->id,Yii::$app->params['payment_song_fee'], $song->cp_code);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        $arrData = array(
            'song_id' => $song->id,
            'index' => 0,
            'title' => $song->name,
            'artist' => $singerName,
            'slug' => $song->slug,
            'poster' => $imagePoster,
            'poster_blur' => $imageBlur,
            'quality_path' => $listFile,
            'quality_list' => array_keys($listSongQuality),
            'lyrics' => BaseHtmlPurifier::process($song->lyric),
        );
        $genres = \frontend\models\VtMusicGenreJoin::getListGenreBySongId($song->id);
        if ($genres) {
            $genresId = array();
            foreach ($genres as $g) {
                $genresId[] = $g->music_genre_id;
            }
            $limit = Yii::$app->params['limit_list_song'];
            $related = VtSong::getListSongHotByGenreId($genresId, 5, 0, $song->id);
        } else {
            $related = array();
        }
        $hots = VtSong::getListSongHotByGenreId(Yii::$app->params['genre_id_song_hot'],5);

        $singerIds = MusicHelper::getSingerIdJson($song->singer_list);
        $videos = VtVideo::getSameSinger($singerIds,6);

        return $this->render('detail.twig', [
                    'song' => $song,
                    'listSongQuality' => $listSongQuality,
                    'lowSongPath' => $lowSongPath,
                    'selectQuality' => $selectQuality,
                    'selectQualityKey' => $selectQualityKey,
                    'songData' => base64_encode(json_encode($arrData)),
                    'imagePoster' => $imagePoster,
                    'singerName' => $singerName,
                    'imageBlur' => $imageBlur,
                    'related' => $related,
                    'hots' => $hots,
                    'videos' => $videos,
        ]);
      }
    }
      throw new NotFoundHttpException;
  }

  /**
   * huync2: ajax log song
   * @return int
   */
  public function actionWriteLogSong() {
      $slug = Yii::$app->request->getQueryParam('slug');
      $objSong = VtSong::getSongBySlug($slug);
      if (!$objSong) {
          return 0;
      }
      try {
          $objLogSong = new VtLogSong();
          $objLogSong->song_id = $objSong->id;
          $objLogSong->action = VIEW;
          $objLogSong->created_at = date('Y-m-d H:i:s', time());
          $objLogSong->save();
      } catch (Exception $e) {

      }

      try {
          $user = Yii::$app->getUser()->getIdentity();
          $vip = Yii::$app->session->get('user_vip');
          if ($user && $vip) {
              Payment::charge($user->phonenumber, '1', $objSong->id, Yii::$app->params['payment_song_fee'], $objSong->cp_code);
          }
      } catch (Exception $e) {

      }
      return 1;
  }


  /**
   * KhanhNQ16 - 26/05/2016
   *
   */
  public function actionDownload() {
      $this->layout = false;
      $slug = \Yii::$app->getRequest()->getQueryParam('slug');
      $quality = \Yii::$app->getRequest()->getQueryParam('quality');
      if ($slug) {
          $song = VtSong::getSongBySlug($slug);
          if (!$song) {
              Yii::$app->session->set('wap_message', \Yii::t('wap', 'Bài hát không tồn tại, quý khách vui lòng tải bài hát khác!'));
              Yii::$app->view->render("/components/message.twig");
          } else {
              $name = Helpers::removeSign($song->name);
              $qualityPath = json_decode($song->quality_path);
              $listFile = array();
              foreach ($qualityPath as $key => $object) {
                  $listFile[$key]['url'] = \Yii::$app->params['upload_path'] . $object->url;
              }
              if (file_exists($listFile[$quality]['url'])) {
                  FileHelper::downloadFile($listFile[$quality]['url'], $name);
              } else {
                  Yii::$app->session->set('wap_message', \Yii::t('wap', 'Bài hát không tồn tại, quý khách vui lòng chọn chất lượng khác!'));
                  Yii::$app->view->render("/components/message.twig");
              }
          }
      } else {
          Yii::$app->session->set('wap_message', \Yii::t('wap', 'Tải nhạc khong thành công, quý khách vui lòng thử lại sau!'));
          Yii::$app->view->render("/components/message.twig");
      }
  }
}
