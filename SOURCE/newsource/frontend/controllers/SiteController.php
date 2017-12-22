<?php
/**
 * Created by PhpStorm.
 * User: hoangl
 * Date: 9/17/2016
 * Time: 2:50 PM
 */

namespace frontend\controllers;

use Yii;
use frontend\models\VtAlbum;
use frontend\models\VtSong;
use frontend\models\VtVideo;
use frontend\models\Topic;
use frontend\models\VtSinger;

class SiteController extends AppController
{
    public function beforeAction($event)
    {
        Yii::$app->session->set('wap_message', \Yii::t('wap', ''));
        return parent::beforeAction($event);
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'captcha' => Yii::$app->params['captcha'],
        ];
    }

    public function actionIndex()
    {
        $playListHot = VtAlbum::getListPlaylistHot(Yii::$app->params['genre_id_playlist_hot'],6);
        $listSongHot = VtSong::getListSongHotByGenreId(Yii::$app->params['genre_id_song_hot'],12);
        $listVideoHot = VtVideo::getListVideoHot(Yii::$app->params['genre_id_video_hot'],5);
        $getListSingerHot = VtSinger::getListSingerHot(8);
        $subject = Topic::getListHot(7);

        $rankSongs = VtSong::getListRankSong(Yii::$app->params['home_song_rank_id']);
        $rankVideos = VtVideo::getListRankVideo(Yii::$app->params['home_video_rank_id']);
        $rankAlbums = VtAlbum::getListRankAlbum(Yii::$app->params['home_album_rank_id']);

        return $this->render('homePage.twig',[
          'playListHot' => $playListHot,
          'listSongHot' => $listSongHot,
          'listVideoHot' => $listVideoHot,
          'subject' => $subject,
          'getListSingerHot' => $getListSingerHot,
          'rankSongs' => $rankSongs,
          'rankVideos' => $rankVideos,
          'rankAlbums' => $rankAlbums
        ]);
    }

}
