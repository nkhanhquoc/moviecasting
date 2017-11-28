<?php

namespace console\controllers;

use common\libs\Constant;
use common\models\HydrometeorologyBase;
use common\models\LocationBase;
use common\models\ProductCategoriesBase;
use yii;
use yii\console\Controller;

class AdminController extends Controller
{
    public function actionIndex()
    {
        echo "run";
    }

    public function actionCrontabWeather()
    {
        echo "start CrontabWeather";
        try {
            // lay danh sach tinh thanh
            $listLocation = LocationBase::find()
                ->andWhere([
                    'is_active' => Constant::ACTIVE,
                ])
                ->andWhere('location_parent_id is null or location_parent_id=0')
                ->all();

            $tps_60 = Yii::$app->params['tps_60'];
            $timeSleep = Yii::$app->params['time_sleep'];
            $timeRun = Yii::$app->params['time_run'];
            $timeNow = strtotime('now');
            $timeEnd = $timeNow + $timeRun;
            $dem = 0;
            $appid = Yii::$app->params['appid'];
            foreach ($listLocation as $location) {
                $city_id = $location->location_key;
                $location_id = $location->location_id;
                echo "CrontabWeather, location_name=" . $location->location_name . "|location_key: " . $city_id . "|location_id=" . $location_id . "\n";
                //60lan/p
                if ($city_id) {
                    $url_weather_detail = str_replace('{appid}', $appid, (str_replace('{city_id}', $city_id, Yii::$app->params['url_weather_detail'])));
                    $url_weather_info = str_replace('{appid}', $appid, (str_replace('{city_id}', $city_id, Yii::$app->params['url_weather_info'])));
                    $weather_info = self::getWeatherInfoNew($url_weather_info);
                    $weather_detail = self::getWeatherDetailNew($url_weather_detail);

                    // cap nhap $weather_info
                    foreach ($weather_detail as $key => $itemDetail) {
//                        echo $key;die;
                        // kiem tra co ban ghi hay chua
                        $objWeather = HydrometeorologyBase::find()
                            ->andWhere([
                                'location_id' => $location_id,
                            ])
                            ->andWhere('date(date)=:date', [':date' => $key])
                            ->one();
                        if ($objWeather) {
                            if (isset($objWeather->weather_detail)) {

                                $objWeather->weather_detail = json_encode(array_merge((array)json_decode($objWeather->weather_detail), (array)json_decode(json_encode($itemDetail))));
                            }else{
                                $objWeather->weather_detail=json_encode($itemDetail);
                            }
                            $objWeather->weather_info = json_encode($weather_info[$key]);
//                            $objWeather->weather_detail = json_encode($weather_detail[$key]);
                            $objWeather->save(false);
                        } else {
                            $weather = new HydrometeorologyBase();
//                            echo json_encode($weather_info);die;
                            $weather->weather_info = json_encode($weather_info[$key]);
                            $weather->weather_detail = json_encode($itemDetail);
                            $weather->location_id = $location_id;
                            $weather->date = $key;
                            $weather->save(false);
                        }

                    }


                    /*$date = date('Y-m-d');

                    $objWeather = HydrometeorologyBase::find()
                        ->andWhere([
                            'location_id' => $location_id,
                        ])
                        ->andWhere('date(date)=:date', [':date' => $date])
                        ->all();
                    if ($objWeather) {
                        foreach ($objWeather as $weather) {
                            $weather->weather_info = json_encode($weather_info);
                            $weather->weather_detail = json_encode($weather_detail);
                            $weather->save();
                        }

                    } else {
                        $weather = new HydrometeorologyBase();
                        $weather->weather_info = json_encode($weather_info);
                        $weather->weather_detail = json_encode($weather_detail);
                        $weather->location_id = $location_id;
                        $weather->date = $date;
                        $weather->save();
                    }*/

                    $dem = $dem + 2;

                    if ($timeEnd > strtotime('now') && $dem >= $tps_60) {
                        echo "sleep CrontabWeather1: " . $timeSleep;
                        sleep($timeSleep);
                        $timeNow = strtotime('now');
                        $timeEnd = $timeNow + $timeRun;
                        $dem = 0;
                    } elseif ($timeEnd < strtotime('now') && $dem >= $tps_60) {
                        echo "sleep CrontabWeather2: " . $timeSleep;
                        sleep($timeSleep);
                        $timeNow = strtotime('now');
                        $timeEnd = $timeNow + $timeRun;
                        $dem = 0;
                    }
                }
            }
        } catch (yii\base\Exception $e) {
            echo "CrontabWeather exception:" . $e->getMessage();
        }
        echo "end CrontabWeather";
    }

    public function getWeatherDetail($url_weather_detail)
    {
        $weather_detail = self::getDataContentByCurl($url_weather_detail);
        $objWeatherDetail = json_decode($weather_detail);
        $listWeatherDetail = $objWeatherDetail->list;
        $dataWeatherDetail = [];
        foreach ($listWeatherDetail as $weatherDetail) {
            $dataWeatherDetailItem['main_temp'] = $weatherDetail->main->temp;
            $dataWeatherDetailItem['main_temp_min'] = $weatherDetail->main->temp_min;
            $dataWeatherDetailItem['main_pressure'] = $weatherDetail->main->pressure;;
            $dataWeatherDetailItem['main_sea_level'] = $weatherDetail->main->sea_level;
            $dataWeatherDetailItem['main_grnd_level'] = $weatherDetail->main->grnd_level;
            $dataWeatherDetailItem['main_humidity'] = $weatherDetail->main->humidity;
            $dataWeatherDetailItem['weather_main'] = $weatherDetail->weather[0]->main;
            $dataWeatherDetailItem['weather_description'] = $weatherDetail->weather[0]->description;
            $dataWeatherDetailItem['weather_icon'] = $weatherDetail->weather[0]->icon;
            $dataWeatherDetailItem['clouds_all'] = $weatherDetail->clouds->all;
            $dataWeatherDetailItem['wind_speed'] = $weatherDetail->wind->speed;
            $dataWeatherDetailItem['wind_deg'] = $weatherDetail->wind->deg;
            if (isset($weatherDetail->rain))
                $dataWeatherDetailItem['rain'] = $weatherDetail->rain;
            $dataWeatherDetailItem['dt_txt'] = $weatherDetail->dt_txt;
            $dataWeatherDetail[] = $dataWeatherDetailItem;
        }
        return $dataWeatherDetail;
    }

    public function getWeatherDetailNew($url_weather_detail)
    {
        $weather_detail = self::getDataContentByCurl($url_weather_detail);
        $objWeatherDetail = json_decode($weather_detail);
        $listWeatherDetail = $objWeatherDetail->list;
        $dataWeatherDetail = [];
        $arrItem = [];
        foreach ($listWeatherDetail as $weatherDetail) {
            $arr_dt_txt = explode(' ', $weatherDetail->dt_txt);
            $dataWeatherDetailItem['dt_txt'] = $weatherDetail->dt_txt;
            $dataWeatherDetailItem['main_temp'] = $weatherDetail->main->temp;
            $dataWeatherDetailItem['main_temp_min'] = $weatherDetail->main->temp_min;
            $dataWeatherDetailItem['main_pressure'] = $weatherDetail->main->pressure;;
            $dataWeatherDetailItem['main_sea_level'] = $weatherDetail->main->sea_level;
            $dataWeatherDetailItem['main_grnd_level'] = $weatherDetail->main->grnd_level;
            $dataWeatherDetailItem['main_humidity'] = $weatherDetail->main->humidity;
            $dataWeatherDetailItem['weather_main'] = $weatherDetail->weather[0]->main;
            $dataWeatherDetailItem['weather_description'] = $weatherDetail->weather[0]->description;
            $dataWeatherDetailItem['weather_icon'] = $weatherDetail->weather[0]->icon;
            $dataWeatherDetailItem['clouds_all'] = $weatherDetail->clouds->all;
            $dataWeatherDetailItem['wind_speed'] = $weatherDetail->wind->speed;
            $dataWeatherDetailItem['wind_deg'] = $weatherDetail->wind->deg;
            if (isset($weatherDetail->rain))
                $dataWeatherDetailItem['rain'] = $weatherDetail->rain;

            $arrItem[$arr_dt_txt[0]][$arr_dt_txt[1]] = $dataWeatherDetailItem;
            $dataWeatherDetail[] = $arrItem;
        }
        return $arrItem;
    }

    public function getWeatherInfo($url_weather_info)
    {
        $weather_info = self::getDataContentByCurl($url_weather_info);
        $objWeatherInfo = json_decode($weather_info);
        $listWeatherInfo = $objWeatherInfo->list;
        $dataWeatherInfo = [];
        foreach ($listWeatherInfo as $weatherInfo) {
            $dataWeatherInfoItem['temp_day'] = $weatherInfo->temp->day;
            $dataWeatherInfoItem['temp_min'] = $weatherInfo->temp->min;
            $dataWeatherInfoItem['temp_max'] = $weatherInfo->temp->max;
            $dataWeatherInfoItem['temp_night'] = $weatherInfo->temp->night;
            $dataWeatherInfoItem['temp_eve'] = $weatherInfo->temp->eve;
            $dataWeatherInfoItem['temp_morn'] = $weatherInfo->temp->morn;
            $dataWeatherInfoItem['pressure'] = $weatherInfo->pressure;
            $dataWeatherInfoItem['humidity'] = $weatherInfo->humidity;
            $dataWeatherInfoItem['weather_main'] = $weatherInfo->weather[0]->main;
            $dataWeatherInfoItem['weather_description'] = $weatherInfo->weather[0]->description;
            $dataWeatherInfoItem['weather_icon'] = $weatherInfo->weather[0]->icon;
            $dataWeatherInfoItem['speed'] = $weatherInfo->speed;
            $dataWeatherInfoItem['deg'] = $weatherInfo->deg;
            $dataWeatherInfoItem['clouds'] = $weatherInfo->clouds;
            if (isset($weatherInfo->rain))
                $dataWeatherInfoItem['rain'] = $weatherInfo->rain;
            $dataWeatherInfoItem['dt'] = date('Y-m-d h:i:s', $weatherInfo->dt);
            $dataWeatherInfo[] = $dataWeatherInfoItem;
        }
        return $dataWeatherInfo;
    }

    public function getWeatherInfoNew($url_weather_info)
    {
        $weather_info = self::getDataContentByCurl($url_weather_info);
        $objWeatherInfo = json_decode($weather_info);
        $listWeatherInfo = $objWeatherInfo->list;
        $dataWeatherInfo = [];
        $arrItem = [];

        foreach ($listWeatherInfo as $weatherInfo) {
            $arr_dt = explode(' ', date('Y-m-d h:i:s', $weatherInfo->dt));

            $dataWeatherInfoItem['temp_day'] = $weatherInfo->temp->day;
            $dataWeatherInfoItem['temp_min'] = $weatherInfo->temp->min;
            $dataWeatherInfoItem['temp_max'] = $weatherInfo->temp->max;
            $dataWeatherInfoItem['temp_night'] = $weatherInfo->temp->night;
            $dataWeatherInfoItem['temp_eve'] = $weatherInfo->temp->eve;
            $dataWeatherInfoItem['temp_morn'] = $weatherInfo->temp->morn;
            $dataWeatherInfoItem['pressure'] = $weatherInfo->pressure;
            $dataWeatherInfoItem['humidity'] = $weatherInfo->humidity;
            $dataWeatherInfoItem['weather_main'] = $weatherInfo->weather[0]->main;
            $dataWeatherInfoItem['weather_description'] = $weatherInfo->weather[0]->description;
            $dataWeatherInfoItem['weather_icon'] = $weatherInfo->weather[0]->icon;
            $dataWeatherInfoItem['speed'] = $weatherInfo->speed;
            $dataWeatherInfoItem['deg'] = $weatherInfo->deg;
            $dataWeatherInfoItem['clouds'] = $weatherInfo->clouds;
            if (isset($weatherInfo->rain))
                $dataWeatherInfoItem['rain'] = $weatherInfo->rain;
            $dataWeatherInfoItem['dt'] = date('Y-m-d h:i:s', $weatherInfo->dt);
            $arrItem[$arr_dt[0]] = $dataWeatherInfoItem;
            $dataWeatherInfo[] = $arrItem;
        }
        return $arrItem;
    }

    function getDataContentByCurl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if (Yii::$app->params['crontab_proxy'])
            curl_setopt($ch, CURLOPT_PROXY, Yii::$app->params['crontab_proxy']);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    public function getDataContentByStream()
    {
        $opts = array(
            'http' => array(
                'method' => "GET",
                'header' => "Content-Type: text/html; charset=utf-8",
//                'proxy' => "tcp://192.168.193.12:3128",
                'request_fulluri' => true,
            )
        );

        if (Yii::$app->params['crontab_proxy']) {
            $opts['http']['proxy'] = Yii::$app->params['crontab_proxy'];
        }

        $context = stream_context_create($opts);
        $result = @file_get_contents("http://api.openweathermap.org/data/2.5/forecast?id=1566083&appid=12cae80fa90f579b1f367beb508027ce", false, $context);
        return $result;
    }


    public function actionUpdateListCategory()
    {
        echo "crontab actionUpdateListCategory\n";
        $categories = ProductCategoriesBase::find()
            ->where(['is_active' => Constant::ACTIVE])->all();
        foreach ($categories as $category) {
            echo "crontab actionUpdateListCategory update category:" . $category->id . "|" . $category->name . "\n";
            $listCategory = ProductCategoriesBase::getCategoryByParent($category->id);
            $category->list_category = $listCategory;
            $category->save();
        }
    }
}
