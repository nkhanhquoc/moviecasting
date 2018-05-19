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
        $page = 0;
        $others = News::find()
                ->where(['status' => 1])
//                    ->andWhere(['not in', 'id', $hot->id])
                ->orderBy('created_time desc');
//                    ->limit($limit)
//                    ->all();
        if ($hot) {
            $others->andWhere(['not in', 'id', $hot->id]);
        }
        $all = $others->all();
        $total = count($all);
        $list = $all;
        if($total > $limit){
            $list = array_slice($all, 0, $limit);
            $page = 2;
        }
        return $this->render('index.twig', [
                    'hot' => $hot,
                    'others' => $list,
                    'page' => $page,
                    'removeid' => $hot->id,
            'total'=>$total,
            'limit'=>$limit
        ]);
    }

    public function actionDetail() {
        $id = Yii::$app->getRequest()->getQueryParam('id');
        $news = News::find()->where(['id' => $id, 'status' => 1])->one();
        $page = 0;
        $other = News::find()
                ->where(['!=', 'id', $id])
                ->andWhere(['status' => 1])
                ->all();

        if ($news) {
            $total = count($other);
            $limit = Yii::$app->params['page_movie'];
            if ($total > $limit) {
                $list = array_slice($other, 0, $limit);
                $page = 2;
            } else {
                $list = $other;
            }
            return $this->render('detail.twig', [
                        'news' => $news,
                        'others' => $list,
                        'limit' => $limit,
                        'total' => count($other),
                        'page' => $page,
                
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
        if($page*$limit >= count($movie)){
            $hide = 1;
        } else {
            $hide = 0;
        }
        $arrData = array(
            'text' => $text,
            'page' => $page + 1,
            'hide' =>$hide
        );
        return json_encode($arrData);
    }

}
