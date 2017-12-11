<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace api\modules\v1\models;
use Yii;
use common\models\ProductBase;
/**
 * Description of Product
 *
 * @author khanhnq16
 */
class Product extends ProductBase{
    //put your code here
    public static function getTop($arrCat,$page, $limit){
        $query = Product::find()->where(['status'=>1,'is_hot'=>1])
                 ->andWhere('END_TIME >= now()')
                 ->limit($limit)
                 ->offset(($page-1)*$limit)
                ->orderBy('CREATED_TIME desc');
        
        foreach($arrCat as $cat){
            $query->addWhere(['like','category',$cat]);
        }
        return $query->asArray()->all();
    }
    
    public static function getDetail($id,$type){
        
        $query = Product::find()->where(['STATUS'=>1,'ID'=>$id]);
        $query->andWhere('END_TIME >= now()');
        if($type != 1){
            $query->asArray();
        }
        
        return $query->one();
    }
    
    public static function getDetailHistory($id){
        
        $query = Product::find()->where(['ID'=>$id])->orderBy('CREATED_TIME desc');
        
        return $query->asArray()->one();
    }
    
    public static function getList($k){
        $query = Product::find()->where(['STATUS'=>1])
                ->andWhere('END_TIME >= now()');
//                ->limit($limit)
//                ->offset(($page-1)*$limit);
        if($k){
            $query->andWhere(['like','NAME',$k]);
        }
        return $query;
    }
    
    public static function updateRegProduct($id,$value){
        $connection = Yii::$app->db;
        $connection->createCommand("Update product set CURRENT_REG = CURRENT_REG + :val where ID = :id")
                ->bindParam(":val", $value)
                ->bindParam(":id", $id)
                ->execute();
    }
    
    public static function updateNoView($id){
        $connection = Yii::$app->db;
        $connection->createCommand("Update product set NO_VIEW = NO_VIEW + 1 where ID = :id")
                ->bindParam(":id", $id)
                ->execute();
    }
}
