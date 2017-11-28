<?php

namespace backend\controllers;

use Yii;

class SocketController extends AppController {

    public function actionIndex() {
        $return = array(
            'status'    => 500,
            'message'   => 'Error!'
        );

        if (Yii::$app->request->queryParams) {
            $data = Yii::$app->request->queryParams['data'];
            \Yii::info('client send data: ' . $data);
            new \common\socket\Socket($data);

            $return = array(
                'status'    => 200,
                'message'   => 'Success!'
            );
        }

        return json_encode($return); die();
    }

}
