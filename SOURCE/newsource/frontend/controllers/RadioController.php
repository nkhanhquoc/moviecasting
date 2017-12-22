<?php
/*@Author: Nguyen Quoc Khanh
@Date:   2016/11/11 9:11:16
@Email:  KhanhNQ16@viettel.com.vn
@Project: Imuzik Plus 1.5
@Last modified by:   Nguyen Quoc Khanh
@Last modified time: 2016/11/11 9:11:23
*/

namespace frontend\controllers;

use yii;
use yii\data\Pagination;
use yii\base\Exception;
use yii\web\NotFoundHttpException;
use common\helpers\MusicHelper;
use frontend\models\VtSong;
use frontend\models\VtLogSong;
use frontend\models\VtLogAction;
use yii\helpers\BaseHtmlPurifier;

class RadioController extends AppController{

  public function beforeAction($action) {
      if ($_SERVER['HTTP_HOST'] === Yii::$app->params['vip_domain']) {
          $user = Yii::$app->getUser()->getIdentity();
          $vip = Yii::$app->session->get('user_vip');
          if ($user && $vip) {
              VtLogAction::insertLog($vip->id, $user->phonenumber, $_SERVER['REQUEST_URI'], ACTION_RADIO);
          }
      }
      return parent::beforeAction($action);
  }

  /**
   *
   * @author KhanhNQ16
   * @return [type] [description]
   */
  public function actionIndex()
  {
    $listSong = VtSong::getListSongHotByGenreId(Yii::$app->params['genre_id_radio'], 1000);
    $page = Yii::$app->getRequest()->getQueryParam('page');
    if(!$page) $page = 1;
    $pages = new Pagination(['totalCount' => count($listSong)]);
    $pages->setPage($page-1);
    $pages->setPageSize(20);
    $listSong = array_slice($listSong,($page-1)*20,20);
    return $this->render('index.twig',[
      'listSong' => $listSong,
      'pages'=>$pages
    ]);
  }

  public function actionDetail()
  {
    $slug = Yii::$app->getRequest()->getQueryParam('slug');
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
        // try {
        //     $user = Yii::$app->getUser()->getIdentity();
        //     $vip = Yii::$app->session->get('user_vip');
        //     if ($user && $vip) {
        //         Payment::charge($user->phonenumber, '1', $song->id,Yii::$app->params['payment_song_fee'], $song->cp_code);
        //     }
        // } catch (Exception $e) {
        //     echo $e->getMessage();
        // }
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
        $related = VtSong::getListSongHotByGenreId(Yii::$app->params['genre_id_radio'], 10, 0, $song->id);


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
        ]);
      }
    }
  }


}
