<?php

namespace frontend\controllers;

#Created by  Nguyen Quoc Khanh
#Created on Dec 30, 2017, 2:57:34 AM
#Copyright(c) 2017 Nguyen Quoc Khanh,  All Rights Reserved.
#This software is the proprietary information of Nguyen Quoc Khanh.

use Yii;
use frontend\models\News;
use yii\data\Pagination;

/**
 * Description of NewsController
 *
 * @author Nguyen Quoc Khanh
 */
class NewsController extends AppController {

    //put your code here
    public function actionIndex() {
        $limit = Yii::$app->params['page_movie'];
        $hot = News::find()->where(['status' => 1])->orderBy('created_time desc')->one();
        $others = array();
        if ($hot) {
            $others = News::find()
                    ->where(['status' => 1])
                    ->andWhere(['not in', 'id', $hot->id])
                    ->orderBy('created_time desc')
                    ->limit($limit)
                    ->all();
        }
        return $this->render('index.twig', [
                    'hot' => $hot,
                    'others' => $others,
                    'page' => 2,
                    'removeid' => $hot->id
        ]);
    }

    public function actionDetail() {
        $id = Yii::$app->getRequest()->getQueryParam('id');
        $news = News::find()->where(['id' => $id, 'status' => 1])->one();
        $other = News::find()
                ->where(['!=', 'id', $id])
                ->andWhere(['status' => 1])
                ->all();

        if ($news) {
            return $this->render('detail.twig', [
                        'news' => $news,
                        'others' => $other
            ]);
        } else {
            throw \yii\web\NotFoundHttpException;
        }
    }

    public function actionGetMore() {
        $this->layout = false;
        $page = Yii::$app->getRequest()->getQueryParam('page');
        $removeid = Yii::$app->getRequest()->getQueryParam('removeid');
        $movie = News::getMoreNews($removeid);
//        var_dump($movie);die;
        $limit = Yii::$app->params['page_movie'];
        if (!$page)
            $page = 1;
        $pages = new Pagination(['totalCount' => count($movie)]);
        $pages->setPage($page - 1);
        $pages->setPageSize($limit);
        $listMore = array_slice($movie, ($page - 1) * $limit, $limit);
        $text = $this->render('_listmore.twig', [
            'others' => $listMore
        ]);
        $arrData = array(
            'text' => $text,
            'page' => $page + 1
        );
        return json_encode($arrData);
    }

}
