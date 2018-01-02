<?php
namespace frontend\controllers;

use common\helpers\Helpers;
use common\helpers\MusicHelper;
use frontend\components\TwigExtension;
use frontend\models\Topic;
use frontend\models\VtAlbum;
use frontend\models\VtSong;
use frontend\models\VtLogAction;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;

class AjaxController extends Controller
{

    public function beforeAction($action) {
        if ($_SERVER['HTTP_HOST'] === Yii::$app->params['vip_domain']) {
            $user = Yii::$app->getUser()->getIdentity();
            $vip =  Yii::$app->session->get('user_vip');
            if($user && $vip){
                VtLogAction::insertLog($vip->id, $user->phonenumber, $_SERVER['REQUEST_URI'], ACTION_AJAX);
            }
        }
        return parent::beforeAction($action);
    }

    public function actionGetToken()
    {
        Yii::$app->response->format = 'json';
        $request = Yii::$app->getRequest();
        return [
            'token' => $request->getCsrfToken()
        ];
    }

    public function actionGetPlaylistPlayer()
    {
        $slug = Yii::$app->request->get('slug');
        Yii::$app->response->format = 'json';
        if ($slug) {
            /* @var VtAlbum $playlist */
            $playlist = VtAlbum::getListSongBySlug($slug);
//            print_r($playlist);die();
            if ($playlist) {
                $arrSong = array();
                foreach ($playlist->songs as $index => $song) {
                    /* @var VtSong $song */
                    $listFile = array();
                    $qualityList = array();
                    if ($song->quality_path) {
                        foreach (json_decode($song->quality_path) as $key => $object) {
                            $qualityList[] = $key;
                            $listFile[$key] = array();
                            $listFile[$key]['format'] = $object->format;
                            $listFile[$key]['url'] = TwigExtension::getMediaPath($object->url);
                        }
                    }
                    $arrSong[$index] = array();
                    $arrSong[$index]['song_id'] = $song->id;
                    $arrSong[$index]['index'] = $index;
                    $arrSong[$index]['title'] = $song->name;
                    $arrSong[$index]['artist'] = TwigExtension::getSingerNameBySong($song);
//                    $arrSong[$index]['artist'] = MusicHelper::getSingerNameJson($song->singer_list);
                    $arrSong[$index]['poster'] = TwigExtension::getImagePathBySong($song);
                    $arrSong[$index]['poster_blur'] = TwigExtension::getImageBlurPathBySong($song);
//                    $arrSong[$index]['poster'] = Helpers::getOnlyMediaImage('/medias/image/1444360970453.jpg');
                    $arrSong[$index]['quality_path'] = $listFile;
                    $arrSong[$index]['quality_list'] = $qualityList;
                    $arrSong[$index]['lyrics'] = $song->lyric;
                    $arrSong[$index]['slug'] = $song->slug;
                    $arrSong[$index]['song_url'] = Url::to(['song-detail/' . $song->slug], true);
                }
                return $arrSong;
            } else {
                return [];
            }
        }
        return [];
    }

    public function actionGetTopicPlayer()
    {
        $slug = Yii::$app->request->get('slug');
        Yii::$app->response->format = 'json';
        if ($slug) {
            /* @var Topic $objTopic */
            $objTopic = Topic::getTopicBySlug($slug);
            if (!$objTopic) {
                return [];
            }
            $listSongTopic = VtSong::getListSongTopic($objTopic->id);

            if ($listSongTopic) {
                $arrSong = array();
                foreach ($listSongTopic as $index => $song) {
                    /* @var VtSong $song */
                    $listFile = array();
                    $qualityList = array();
                    if ($song->quality_path) {
                        foreach (json_decode($song->quality_path) as $key => $object) {
                            $qualityList[] = $key;
                            $listFile[$key] = array();
                            $listFile[$key]['format'] = $object->format;
                            $listFile[$key]['url'] = TwigExtension::getMediaPath($object->url);
                        }
                    }
                    $arrSong[$index] = array();
                    $arrSong[$index]['song_id'] = $song->id;
                    $arrSong[$index]['index'] = $index;
                    $arrSong[$index]['title'] = $song->name;
                    $arrSong[$index]['artist'] = TwigExtension::getSingerNameBySong($song);
//                    $arrSong[$index]['artist'] = MusicHelper::getSingerNameJson($song->singer_list);
                    $arrSong[$index]['poster'] = TwigExtension::getImagePathBySong($song);
                    $arrSong[$index]['poster_blur'] = TwigExtension::getImageBlurPathBySong($song);
//                    $arrSong[$index]['poster'] = Helpers::getOnlyMediaImage('/medias/image/7E4149A9_9.jpg');
                    $arrSong[$index]['quality_path'] = $listFile;
                    $arrSong[$index]['quality_list'] = $qualityList;
                    $arrSong[$index]['lyrics'] = $song->lyric;
                }
                return $arrSong;
            } else {
                return [];
            }
        }
        return [];
    }
    
    public function getMoreMovie(){
        $page = Yii::$app->request->get('page');
    }

}
