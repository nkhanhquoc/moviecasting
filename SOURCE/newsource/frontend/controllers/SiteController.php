<?php

/**
 * Created by PhpStorm.
 * User: hoangl
 * Date: 9/17/2016
 * Time: 2:50 PM
 */

namespace frontend\controllers;

use Yii;
use frontend\models\Movie;
use yii\data\Pagination;

class SiteController extends AppController {

    public function beforeAction($event) {
        Yii::$app->session->set('frontend', \Yii::t('frontend', ''));
        return parent::beforeAction($event);
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'captcha' => Yii::$app->params['captcha'],
        ];
    }

    public function actionIndex() {
        $hot = Movie::getHot();
        $page = 0;
        $arrHot = array();
        foreach ($hot as $h) {
            $arrHot[] = $h->id;
        }
        $query = Movie::find()->where(['status' => 1, 'hot' => 0])
                ->andWhere(['not in', 'id', $arrHot])
                ->orderBy('id desc')
                ->all();
        $limit = Yii::$app->params['page_movie'];
        $total = count($query);
        $list = $query;
        if ($total > $limit) {
            $list = array_slice($query, 0, $limit);
            $page = 2;
        }
        return $this->render('home.twig', [
                    'hot' => $hot,
                    'normal' => $list,
                    'page' => $page,
                    'total' => $total,
                    'limit' => $limit
        ]);
    }

    public function actionGetMore() {
        $this->layout = false;
        $page = Yii::$app->getRequest()->getQueryParam('page');
        $hot = Movie::getHot();
        $arrHot = array();
        foreach ($hot as $h) {
            $arrHot[] = $h->id;
        }
        $movie = Movie::getMoreMovie($arrHot, false);
        $limit = Yii::$app->params['page_movie'];
        if (!$page)
            $page = 1;
        $pages = new Pagination(['totalCount' => count($movie)]);
        $pages->setPage($page - 1);
        $pages->setPageSize($limit);
        $listMore = array_slice($movie, ($page - 1) * $limit, $limit);
        $text = $this->render('/movie/_listmore.twig', [
            'normal' => $listMore
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
