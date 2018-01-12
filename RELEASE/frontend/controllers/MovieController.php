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
        $id = Yii::$app->getRequest()->getQueryParam('id');
        $limit = Yii::$app->params['page_movie'];
        $movie = Movie::findOne($id);
        $casting = Casting::find()->where(['movie_id' => $id, 'status' => 1])->all();
        $arrHot = array();
        foreach ($hot as $h) {
            $arrHot[] = $h->id;
        }
        $normal = Movie::getNormal($arrHot,$limit);
        return $this->render('moviedetail.twig', [
                    'hot' => $hot,
                    'normal' => $normal,
                    'movie' => $movie,
                    'casting' => $casting,
                    'page' => 2
        ]);
    }

    public function actionGetMore() {
        $this->layout = false;
        $page = Yii::$app->getRequest()->getQueryParam('page');
        $removeid = Yii::$app->getRequest()->getQueryParam('removeid');
        $movie = Movie::getMoreMovie($removeid,true);
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
        $arrData = array(
            'text'=>$text,
            'page'=>$page+1
        );
        return json_encode($arrData);
    }

}
