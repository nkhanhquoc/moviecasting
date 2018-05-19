<?php

namespace frontend\controllers;

#Created by  Nguyen Quoc Khanh
#Created on Dec 24, 2017, 8:07:07 AM
#Copyright(c) 2017 Nguyen Quoc Khanh,  All Rights Reserved.
#This software is the proprietary information of Nguyen Quoc Khanh.

use Yii;
use frontend\models\Movie;
use frontend\models\Casting;
use yii\data\Pagination;

/**
 * Description of MovieController
 *
 * @author Nguyen Quoc Khanh
 */
class MovieController extends AppController {

    //put your code here
    public function actionIndex() {
        $slug = Yii::$app->getRequest()->getQueryParam('slug');
        $page = 0;
        $limit = Yii::$app->params['page_movie'];
        $movie = Movie::find()->where(['slug'=>$slug])->one();
        if($movie){
            $casting = Casting::find()->where(['movie_id' => $movie->id, 'status' => 1])->all();            
        } else {
            $casting = array();
        }
        $arrHot = array();
//        foreach ($movie as $h) {
//            $arrHot[] = $h->id;
//        }
        $query = Movie::find()->where(['status' => 1, 'hot' => 0])
                ->andWhere(['<>', 'id', $movie->id])
                ->orderBy('id desc')
                ->all();
        $total = count($query);
        $list = $query;
        if ($total > $limit) {
            $list = array_slice($query, 0, $limit);
            $page = 2;
        }
        return $this->render('moviedetail.twig', [
                    'hot' => $hot,
                    'normal' => $list,
                    'movie' => $movie,
                    'casting' => $casting,
                    'page' => $page,
                    'total' => $total,
                    'limit' => $limit
        ]);
    }

    public function actionGetMore() {
        $this->layout = false;
        $page = Yii::$app->getRequest()->getQueryParam('page');
        $removeid = Yii::$app->getRequest()->getQueryParam('removeid');
        $movie = Movie::getMoreMovie($removeid, true);
        $limit = Yii::$app->params['page_movie'];
        if (!$page)
            $page = 1;
        $pages = new Pagination(['totalCount' => count($movie)]);
        $pages->setPage($page - 1);
        $pages->setPageSize($limit);
        $listMore = array_slice($movie, ($page - 1) * $limit, $limit);
        $text = $this->render('_listmore.twig', [
            'normal' => $listMore
        ]);
        if ($page * $limit >= count($movie)) {
            $hide = 1;
        } else {
            $hide = 0;
        }
        $arrData = array(
            'text' => $text,
            'page' => $page + 1,
            'hide' => $hide
        );
        return json_encode($arrData);
    }

    public function actionList() {
        $limit = Yii::$app->params['page_movie'];
        $normal = Movie::find()
                ->where(['status' => 1])
//                ->limit($limit)
                ->orderBy('id desc')
                ->all();
        if (count($normal) > $limit) {
            $list = array_slice($normal, 0, $limit);
            $page = 2;
        } else {
            $list = $normal;
            $page = 0;
        }
        return $this->render('list.twig', [
                    'normal' => $list,
                    'page' => $page,
                    'removeid' => 0
        ]);
    }

}
