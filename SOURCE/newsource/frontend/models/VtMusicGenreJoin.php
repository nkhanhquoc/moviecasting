<?php

namespace frontend\models;

use common\libs\Constant;
use frontend\components\TwigExtension;
use Yii;

class VtMusicGenreJoin extends \common\models\VtMusicGenreJoinBase
{

    public static function getListSongHotByGenreId($genreId, $limit = 20, $offset = 0)
    {
        $ObjSongGenre = VtMusicGenreJoin::find()
            ->where([
                VtMusicGenreJoin::tableName() . '.music_genre_id' => $genreId,
            ])
            ->leftJoin('vt_song', VtMusicGenreJoin::tableName() . '.song_id=vt_song.id')
            ->andWhere([
                'vt_song.is_active' => Constant::ACTIVE,
            ])
            ->orderBy(VtMusicGenreJoin::tableName() . '.priority, ' . VtMusicGenreJoin::tableName() . '.updated_at desc')
            ->offset($offset)
            ->limit($limit)
            ->all();

        $arrSongGenreReturn = array();
        foreach ($ObjSongGenre as $items) {
            $arrSongGenre = array();
            $arrSongGenre['id'] = $items->song_id;

            /**
             * @var VtSong $song
             */

            $song = $items->song;

            $arrSongGenre['name'] = $song->name;
            $arrSongGenre['file_path'] = $song->file_path;
            $arrSongGenre['view_number'] = $song->view_number;
            $arrSongGenre['download_number'] = $song->download_number;
            $arrSongGenre['like_number'] = $song->like_number;
            $arrSongGenre['slug'] = $song->slug;
            $arrSongGenre['quality'] = $song->quality;
            $arrSongGenre['quality_path'] = $song->quality_path;
            $arrSongGenre['lyric'] = $song->lyric;
            /**
             * @var VtSongSingerJoin $VtSongSingerJoins
             */
            $VtSongSingerJoins = $song->vtSongSingerJoinDBs;
            /**
             * @var VtSinger $singer
             */
            $listSinger = array();
            foreach ($VtSongSingerJoins as $singerItem) {
                $listSinger[] = $singerItem->singer;
            }
            $arrSinger = array();
            $singerName = array();
            $image_path = '';
            foreach ($listSinger as $singer) {
                $singerName[] = $singer->alias;
                $arrSingerItem = array();
                $arrSingerItem['name'] = $singer->name;
                $arrSingerItem['alias'] = $singer->alias;
                $arrSingerItem['image_path'] = $singer->image_path;
                $arrSingerItem['birthday'] = $singer->birthday;
                $arrSingerItem['slug'] = $singer->slug;
                $arrSingerItem['like_number'] = $singer->like_number;
                $arrSinger[] = $arrSingerItem;
                if (!$image_path) {
                    $image_path = $singer->image_path;
                }
            }
            $arrSongGenre['singer'] = $arrSinger;
            $arrSongGenre['list_singer_name'] = TwigExtension::getSingerNameBySong($song);
//            $arrSongGenre['list_singer_name'] = implode(',', $singerName);
            $arrSongGenre['image_path_singer'] = TwigExtension::getImagePathBySong($song);
//            $arrSongGenre['image_path_singer'] = $image_path;
            $arrSongGenreReturn[] = $arrSongGenre;
        }
        return $arrSongGenreReturn;
    }

    /**
     * KhanhNQ16
     * 4/6/2016
     * @param type $songId
     */
    public function getListGenreBySongId($songId){
        $genres = VtMusicGenreJoin::find()
            ->where([
                VtMusicGenreJoin::tableName() . '.song_id' => $songId,
            ])
            ->leftJoin('vt_music_genre', VtMusicGenreJoin::tableName() . '.music_genre_id = vt_music_genre.id')
            ->andWhere([
                'vt_music_genre.is_active' => Constant::ACTIVE,
            ])
            ->orderBy(VtMusicGenreJoin::tableName() . '.priority, ' . VtMusicGenreJoin::tableName() . '.updated_at desc')
//            ->offset($offset)
//            ->limit($limit)
            ->all();
        return $genres;
    }
}
