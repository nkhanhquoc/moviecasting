<?php

use backend\components\common\Utility;
?>
<div class="row modules">
    <?php
    $data = $dataProvider->getModels();
    if (!empty($data)) {
        foreach ($data as $val) {
            $route = Yii::$app->controller->route;
            $arrayParams = ['p1' => 'v1', 'p2' => 'v2'];
            $params = array_merge([$route], $arrayParams);
            ?>
            <div class="col-md-4">
                <a href="<?php echo Yii::$app->getUrlManager()->createUrl(['modules/view', 'id' => $val['id']]); ?>" title="<?php echo Utility::htmlEncode($val['msisdn']); ?>">
                    <?php
                    $thumb = '';
                    if (isset($val['thumb']) && !empty($val['thumb'])) {
                        $thumb = $val['thumb'];
                    }
                    ?>
                    <img class="img-responsive" src="<?php echo Utility::getThumbImg($thumb); ?>" alt="<?php echo Utility::htmlEncode($val['mode_id']); ?>" />
                    <p class="">ID: <?php echo Utility::htmlEncode($val['mode_id']); ?></p>
                    <p class=""><?php echo Utility::htmlEncode($val['name']); ?></p>
                </a>
            </div>
            <?php
        }
    }
    ?>
</div>
