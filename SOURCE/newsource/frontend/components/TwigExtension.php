<?php

/**
 * Created by JetBrains PhpStorm.
 * User: HUYNC2
 * Date: 10/17/15
 * Time: 9:24 AM
 * To change this template use File | Settings | File Templates.
 */

namespace frontend\components;

use common\helpers\MusicHelper;
use common\libs\Constant;
use yii\base\Exception;
use Twig_SimpleFunction;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseHtmlPurifier;
use yii\helpers\Url;
use yii\imagine\Image;
use Imagine\Image\Box;
use yii\twig\Extension;


class TwigExtension extends Extension {

    public function getName() {
        return "TwigExtension";
    }

    public function getFunctions() {
        return ArrayHelper::merge(array(
                    new Twig_SimpleFunction('ajax_url', array($this, 'ajax_url')),
                    new Twig_SimpleFunction('prefixJavascript', array($this, 'prefixJavascript'))
                        ), parent::getFunctions());
    }

    public function getFilters() {
        return ArrayHelper::merge(array(
                    new \Twig_SimpleFilter('addSlashes', array($this, 'addSlashes')),
                    new \Twig_SimpleFilter('imagePath', array($this, 'imagePath')),
                    new \Twig_SimpleFilter('imagePathThumb', array($this, 'imagePathThumb')),
                    new \Twig_SimpleFilter('encodeSongBase64', array($this, 'encodeSongBase64')),
                    new \Twig_SimpleFilter('getSingerNameJson', array($this, 'getSingerNameJson')),
                    new \Twig_SimpleFilter('getSingerName', array($this, 'getSingerName')),
                    new \Twig_SimpleFilter('stripScript', array($this, 'strip_html_tags_and_decode')),
                    new \Twig_SimpleFilter('encodeBase64', array($this, 'encodeBase64')),
                    new \Twig_SimpleFilter('purify', array($this, 'purify')),
                    new \Twig_SimpleFilter('encodeJsonNotSong', array($this, 'encodeJsonNotSong')),
                    new \Twig_SimpleFilter('limitLength', array($this, 'limitLength')),
                    new \Twig_SimpleFilter('var_dump', array($this, 'var_dump')),
                    new \Twig_SimpleFilter('implode', array($this, 'implode')),
                    new \Twig_SimpleFilter('encodeVideoBase64', array($this, 'encodeVideoBase64')),
                    new \Twig_SimpleFilter('getSingerNameByListSinger', array($this, 'getSingerNameByListSinger')),
                    new \Twig_SimpleFilter('getImagePathBySong', array($this, 'getImagePathBySong')),
                    new \Twig_SimpleFilter('getImageThumbPathBySong', array($this, 'getImageThumbPathBySong')),
                    new \Twig_SimpleFilter('getImageBlurPathBySong', array($this, 'getImageBlurPathBySong')),
                    new \Twig_SimpleFilter('getSingerNameBySong', array($this, 'getSingerNameBySong')),
                    new \Twig_SimpleFilter('ajax_url', array($this, 'ajax_url')),
                    new \Twig_SimpleFilter('getArrayId', array($this, 'getArrayId')),
                    new \Twig_SimpleFilter('encodeRbtSongBase64', array($this, 'encodeRbtSongBase64')),
                    new \Twig_SimpleFilter('getSettingName', array($this, 'getSettingName')), //khanhnq16
                    new \Twig_SimpleFilter('checkRegisterVIP', array($this, 'checkRegisterVIP')),
                    new \Twig_SimpleFilter('checkVip', array($this, 'checkVip')),
                    new \Twig_SimpleFilter('_htmlentities', array($this, '_htmlentities')),
                    new \Twig_SimpleFilter('formatNumber', array($this, 'formatNumber')),
                    new \Twig_SimpleFilter('prefixJavascript', array($this, 'prefixJavascript')),
                    new \Twig_SimpleFilter('linkPager', array($this, 'linkPager')),
                        ), parent::getFilters());
    }

    /**
     * generate link ajax dua theo url
     * @author ducda2@viettel.com.vn
     * @param $path
     * @param array $args
     * @return string
     */
    public function ajax_url($path, $args = []) {
        if ($args !== []) {
            $path = array_merge([$path], $args);
        }
        $url = Url::to($path, true);
        return 'href="' . $url . '"';
    }

    public function getJsonDecode($val) {
        return json_decode($val);
    }

    public function prefixJavascript() {
        $tmp = "auto_select_song = " . json_encode(Yii::$app->params["auto_select_song"]) . "; \n            ";
        $tmp .= "default_select_song = " . json_encode(Yii::$app->params["default_select_song"]) . ";";
        return $tmp;
    }

    public function var_dump($val, $die = false) {
        var_dump($val);
        if ($die) {
            die($die);
        }
    }

    public function implode($val) {
        if ($val)
            return implode(',', $val);
        else
            return '';
    }

    public function encodeSongBase64($val, $artist, $poster, $posterBlur) {
        $listFile = array();
        $qualityList = array();
        if ($val['quality_path']) {
            foreach (json_decode($val['quality_path']) as $key => $object) {
                $qualityList[] = $key;
                $listFile[$key] = array();
                $listFile[$key]['format'] = "mp3"; //$object->format;
                $listFile[$key]['url'] = self::getMediaPath($object->url);
            }
        }
        $arrData = array(
            'song_id' => $val['id'],
            'index' => 0,
            'title' => $val['name'],
            'artist' => $artist,
            'slug' => $val['slug'],
            'poster' => $poster,
            'poster_blur' => $posterBlur,
            'quality_path' => $listFile,
            'quality_list' => $qualityList,
            'lyrics' => self::purify($val['lyric']),
        );
        return base64_encode(json_encode($arrData));
    }

    public function encodeVideoBase64($val, $artist = null, $poster = null) {
        $listFile = array();
        $qualityList = array();
        if ($val->quality_path) {
            foreach (json_decode($val->quality_path) as $key => $object) {
                $qualityList[] = $key;
                $listFile[$key] = array();
                $listFile[$key]['format'] = $object->format;
                $listFile[$key]['url'] = self::getMediaPath($object->url);
            }
        }
        /* @var VtVideo $val */
        $arrData = array(
            'video_id' => $val->id,
            'index' => $val->id,
            'title' => $val->name,
            'artist' => $artist ? $artist : MusicHelper::getSingerNameJson($val->singer_list),
            'poster' => $poster ? $poster : MusicHelper::getImagePathBySong($val->image_path),
            'slug' => $val->slug,
            'quality_path' => $listFile,
            'quality_list' => $qualityList,
            'poster_blur' => MusicHelper::getImageBlurPathByVideo($val->image_blur_path),
            'view_number' => $val->view_number,
            'download_number' => $val->download_number,
            'like_number' => $val->like_number
        );
        return base64_encode(json_encode($arrData));
    }

    public function encodeBase64($val) {
        return base64_encode($val);
    }

    public function imagePath($path, $type = "album") {
        try {
            if (strlen($path) == 0) {
                return Yii::$app->params[$type . '_default_media_path'];
            } else {
                $filename = Yii::$app->params['upload_path'] . $path;
                if (is_file($filename)) {
                    return Yii::$app->params['media_path'] . $path;
                } else {
                    return Yii::$app->params[$type . '_default_media_path'];
                }
            }
        } catch (Exception $e) {
            return Yii::$app->params[$type . '_default_media_path'];
        }
    }

    public function imagePathThumb($path, $width, $height = 0, $type = "album") {
        try {
            if (strlen($path) == 0) {
                return self::generateDefaultThumb($width, $height, $type);
            } else {
                $thumbnail = Yii::$app->params['image_thumb_path'] . DIRECTORY_SEPARATOR . $width . $path;
                if (is_file($thumbnail)) {
                    return Yii::$app->params['media_thumb_path'] . DIRECTORY_SEPARATOR . $width . $path;
                } else {
                    $filename = Yii::$app->params['upload_path'] . $path;
                    if (is_file($filename)) {
                      //  $image = new \Imagick($filename);//lib imagick
                        $imagine = Image::getImagine();
                        $image = $imagine->open($filename);
                        if ($height == 0) {
                            $size = $image->getSize();
                            if (count($size)) {
                               $height = round($width * $size->getHeight() / $size->getWidth());
                                // $height = round($width * $size['rows'] / $size['columns']);
                            } else {
                                if ($type == 'video') {
                                    $height = $width * 9 / 16;
                                } else {
                                    $height = $width;
                                }
                            }
                        }
                        //create folder
                        $pathToFile = $width . $path;
                        $fileName = basename($pathToFile);
                        $folders = explode(DIRECTORY_SEPARATOR, str_replace(DIRECTORY_SEPARATOR . $fileName, '', $pathToFile));
                        $currentFolder = Yii::$app->params['image_thumb_path'] . DIRECTORY_SEPARATOR;
                        foreach ($folders as $folder) {
                            $currentFolder .= $folder . DIRECTORY_SEPARATOR;
                            if (!file_exists($currentFolder)) {
                                mkdir($currentFolder, 0775);
                            }
                        }
                       $image->resize(new Box($width, $height))->save($thumbnail, ['quality' => 75]);
                      //  $image->scaleImage($width, $height);
                        // $image->writeimage($thumbnail);
                        if (is_file($thumbnail)) {
                            return Yii::$app->params['media_thumb_path'] . DIRECTORY_SEPARATOR . $width . $path;
                        }
                        return Yii::$app->params['media_path'] . $path;
                    }
                }
            }
        } catch (\yii\base\ErrorException $e) {
            Yii::error("[imagePathThumb] file path: ".$filename);
            $size = $image->getSize();
            Yii::error('[imagePathThumb] size = ' . json_encode($size));
        }
        return self::generateDefaultThumb($width, $height, $type);
    }

    static function generateDefaultThumb($width, $height = 0, $type = "album") {

        $thumbnail = Yii::$app->params['image_thumb_path'] . DIRECTORY_SEPARATOR . $width . Yii::$app->params[$type . '_default_thumb_path'];
        if (is_file($thumbnail)) {
            return Yii::$app->params['media_thumb_path'] . DIRECTORY_SEPARATOR . $width . Yii::$app->params[$type . '_default_thumb_path'];
        } else {
            $filename = Yii::$app->params[$type . '_default_thumb_full_path'];
            if (is_file($filename)) {
//                $imagine = Image::getImagine();
//                $image = $imagine->open($filename);
                $image = new \Imagick($filename);
                if ($height == 0) {
                    $size = $image->getSize();
                    $height = round($width * $size['rows'] / $size['columns']);
                }

                //create folder
                $pathToFile = $width . Yii::$app->params[$type . '_default_thumb_path'];
                $fileName = basename($pathToFile);
                $folders = explode(DIRECTORY_SEPARATOR, str_replace(DIRECTORY_SEPARATOR . $fileName, '', $pathToFile));
                $currentFolder = Yii::$app->params['image_thumb_path'] . DIRECTORY_SEPARATOR;
                foreach ($folders as $folder) {
                    $currentFolder .= $folder . DIRECTORY_SEPARATOR;
                    if (!file_exists($currentFolder)) {
                        mkdir($currentFolder, 0775);
                    }
                }
//                $image->resize(new Box($width, $height))->save($thumbnail, ['quality' => 75]);
                $image->scaleImage($width, $height);
                $image->writeimage($thumbnail);
                if (is_file($thumbnail)) {
                    return Yii::$app->params['media_thumb_path'] . DIRECTORY_SEPARATOR . $width . Yii::$app->params[$type . '_default_thumb_path'];
                }
            }
        }
        return Yii::$app->params[$type . '_default_media_path'];
    }

    /**
     * prerpcess special char for js
     * @param $param
     * @return mixed
     */
    public function addSlashes($str) {
        return addslashes($str);
    }

    public function getSingerName($arrSinger) {
        $arrName = array();
        if (!$arrSinger) {
            return "V.A";
        } else if (count($arrSinger) > 3)
            return "V.A";
        foreach ($arrSinger as $item) {
            $arrName[] = $item['alias'];
        }
        if (count($arrName))
            return implode($arrName, ',');
        return "V.A";
    }

    public function getSingerNameJson($strSingerName) {
        return MusicHelper::getSingerNameJson($strSingerName);
    }

    /**
     * @param $str
     */
    public function purify($str) {
        return BaseHtmlPurifier::process($str);
    }

    public function encodeJsonNotSong($link, $val = false) {
        $return = array(
            'slug' => isset($val) ? (is_array($val) ? $val['slug'] : $val->slug) : '',
            'link' => $link,
        );
        return base64_encode(json_encode($return));
    }

    /**
     * KhanhNQ16
     * @param $str
     * @param int $length
     * @return string
     */
    public function limitLength($str, $length = 40) {
        if (strlen($str) > $length) {
            return substr($str, 0, $length) . "...";
        } else {
            return $str;
        }
    }

    /**
     * huync2
     * @param $song
     * @return string
     */
    public static function getSingerNameBySong($song) {
        /* @var VtSong $song */
        if ($song && $song->singer_list) {
            return MusicHelper::getSingerNameJson($song->singer_list);
        } else {
            if (is_array($song) && $song['singer_list']) {   // neu la kieu mang
                return MusicHelper::getSingerNameJson($song['singer_list']);
            }
        }
        return "V.A";
    }

    /**
     * huync2
     * @param $song VtSong
     * @return string
     */
    public static function getImagePathBySong($song) {
        /* @var VtSong $song */
        if ($song && $song->singer_list) {
            return MusicHelper::getImagePathBySong($song->singer_list);
        } else {
            if (is_array($song) && $song['singer_list']) {   // neu la kieu mang
                return MusicHelper::getImagePathBySong($song['singer_list']);
            }
        }
        return Yii::$app->params['album_default_media_path'];
    }

    /**
     * huync2
     * @param $song VtSong
     * @return string
     */
    public static function getImageThumbPathBySong($song, $width, $height = 0) {
        /* @var VtSong $song */
        if ($song && $song->singer_list) {
            return MusicHelper::getImageThumbPathBySong($song->singer_list, $width, $height);
        } else {
            if (is_array($song) && $song['singer_list']) {   // neu la kieu mang
                return MusicHelper::getImageThumbPathBySong($song['singer_list'], $width, $height);
            }
        }
        return self::generateDefaultThumb($width, $height, 'album');
    }

    /**
     * huync2
     * @param $song
     * @return string
     */
    public static function getImageBlurPathBySong($song) {
        if ($song && $song->singer_list) {
            return MusicHelper::getImageBlurPathBySong($song->singer_list);
        } else {
            if (is_array($song) && $song['singer_list']) {   // neu la kieu mang
                return MusicHelper::getImageBlurPathBySong($song['singer_list']);
            }
        }
        return Yii::$app->params['default_bg_blur_song'];
    }

    public static function getSingerNameByListSinger($singers) {
        if ($singers) {
            $nameSinger = array();
            foreach ($singers as $item) {
                if ($item->is_active == Constant::ACTIVE) {
                    $nameSinger[] = $item->alias;
                }
            }
            if (count($nameSinger))
                return implode(',', $nameSinger);
        }
        return "V.A";
    }

    /**
     * KhanhNQ16 - code luc khong tinh tao
     * @param $arr
     * @return array
     */
    public static function getArrayId($objects) {
        if ($objects) {
            $list = array();
            foreach ($objects as $object) {
                $list[] = $object['id'];
            }
            return $list;
        } else
            return array();
    }

    public static function getMediaPath($path) {
        #return Yii::$app->params['media_path'] . $path;
        $isVip = \Yii::$app->session->get('user_vip');
        if ($isVip) {
            $key = \Yii::$app->security->generateRandomString(32);
            #$memCache = new \common\helpers\MemCached('streaming_memcache_servers');
            $memCache = new \common\helpers\MemCached(\Yii::$app->params['streaming_memcache_servers']);
            #var_dump($memCache->getServers()); die();
            #$memCache->setValue($key, \common\libs\MobileRecognized::getRemoteIp(), Yii::$app->params['streaming_memcache_duration']);
            $memCache->setValue($key, '10.58.50.125', Yii::$app->params['streaming_memcache_duration']);
            $path = \Yii::$app->params['streaming_media_vip'] . $path . '?' .
            \Yii::$app->params['streaming_media_token_name'] . '=' . $key;
            return $path;
        } else {
            return \Yii::$app->params['streaming_media_fee'] . $path;
        }
    }

    public function encodeRbtSongBase64($val) {
        if (is_object($val)) {
            #$filePath = Yii::$app->params['media_path'] . $val->vt_link;
            $filePath = self::getMediaPath($val->vt_link);
            $huawei_tone_name = $val->huawei_tone_name;
            $huawei_singer_name = $val->huawei_singer_name;
            $huawei_tone_code = $val->huawei_tone_code;
        } else {
            #$filePath = Yii::$app->params['media_path'] . $val['vt_link'];
            $filePath = self::getMediaPath($val['vt_link']);
            $huawei_tone_code = $val['huawei_tone_code'];
            $huawei_tone_name = $val['huawei_tone_name'];
            $huawei_singer_name = $val['huawei_singer_name'];
        }
        $listFile = array();
//        $filePath = 'http://10.61.9.202:9501/medias/songs/song/806.mp3';

        $ext = substr($filePath, strrpos($filePath, '.') + 1, strlen($filePath));

        $listFile['128kbs'] = array();
        $listFile['128kbs']['format'] = $ext;
        $listFile['128kbs']['url'] = $filePath;
//                $listFile['128kbs']['url'] = self::getMediaPatandomString;

        $arrData = array(
            'song_id' => $huawei_tone_code,
            'index' => 0,
            'title' => $huawei_tone_name, // $val['huawei_tone_name'],
            'artist' => $huawei_singer_name, // $val['huawei_singer_name'],
            'slug' => '',
            'poster' => '',
            'quality_path' => $filePath,
            'lyrics' => '',
            'format' => $ext,
        );
        return base64_encode(json_encode($arrData));
    }

    /**
     * KhanhNQ16
     * @param $setting
     * @return string
     */
    public function getSettingName($setting) {
        switch ($setting['setType']) {
            case GROUP_TONE:
                return $setting['callerName'];
                break;
            case PERSONAL_TONE:
                return "0" . $setting['callerNumber'];
                break;
            default:
                return "Nhóm mặc định";
                break;
        }
    }

    /**
     * Trả về nội dung button cho người dùng click: đăng ký, hủy, chuyển, xác nhận đk.... dựa theo status
     * @modified by khanhnq16
     * @param $subtypes
     * @param $subs
     * @param $item_id
     * @return array
     */
    public function checkRegisterVIP($subtype, $subs) {
        $name = '';
        $class = 'btn btn-success';
        $name = 'Đăng ký';
        $name2 = 'Hủy dịch vụ';
        $class2 = 'btn btn-danger';
        $status = 0;
        if ($subs) {
            $data[$subs->sub_type_id] = $subs->status;
            if ($subs->status == 1) {
                $name = "Chuyển đổi gói cước";
            }

            switch ($data[$subtype->id]) {
                case -1:
                    $status = -1;
                    $name = 'Xác nhận Đăng ký';
                    break;
                case 1:
                    $status = 1;
                    $name = 'Hủy dịch vụ';
                    $class = 'btn btn-danger';
                    break;
                case 2:
                    $status = 2;
                    $name = 'Khôi phục';
                    break;
                default:
                    $status = 0;
                    break;
            };
        }
        return ['status' => $status, 'name' => $name, 'class' => $class, 'name2'=>$name2, 'class2'=>$class2];
    }

    public function checkVip() {
        return \wap\models\Subscriber::getSubActive();
    }

    public function _htmlentities($val) {
        return htmlentities($val, ENT_QUOTES, 'UTF-8');
    }

    /**
     * KhanhNQ16
     * dung number_format cua PHP. Sua dau ngan phan nghin thanh ( . )
     * @param $value
     * @return int|string
     */
    public function formatNumber($value) {
        if (!$value)
            return 0;
        return number_format($value, 0, ',', '.');
    }

    public function linkPager($pages,$nb_links = 5)
    {
      $links = array();
      $page  = $pages->page+1;
      $tmp   = $page - floor($nb_links / 2);//tinh page dau tien

      $check = $pages->pageCount - $nb_links + 1;//tinh page dau tien
      $limit = $check > 0 ? $check : 1;//tinh so page toi da co the lay
      $begin = $tmp > 0 ? ($tmp > $limit ? $limit : $tmp) : 1;//tinh page bat dau
      $i = (int) $begin;

      if($i > 1){
        $links['<<']['url'] = $pages->createUrl(0 , null, false);
        $links['<<']['numb'] =  '<<';
      }
      while ($i < $begin + $nb_links && $i <= $pages->pageCount)
      {
        $links[$i]['url'] = $pages->createUrl($i-1 , null, false);
        $links[$i]['numb'] =  $i;
        $i++;
      }
      if(($begin+$nb_links) < $pages->pageCount){
        $links['>>']['url'] = $pages->createUrl($pages->pageCount - 1 , null, false);
        $links['>>']['numb'] =  '>>';
      }
      return $links;
    }

}
